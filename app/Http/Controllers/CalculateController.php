<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculateController extends Controller
{
    public $skip = [];
    public $warehouseAmount = [];
    public function index(Request $request): array
    {
        $result = [];
        foreach($request->get('products') as $product){
            $data = [
                'product_name' => Product::query()->find($product['product_id'])->name,
                'product_quantity' => $product['amount']
            ];
            $materials = DB::table('material_product')
                ->where('product_id', $product['product_id'])
                ->select('material_id', 'quantity')
                ->get();
            foreach ($materials as $material){
                $data['product_materials'][] = $this->test($material->material_id, $material->quantity * $product['amount']);
            }
            $result['result'][] = $data;
        }

        return $result;
    }

    public function calculate($material_id, $quantity){
        $material = Material::query()
            ->where('id', $material_id)
            ->whereHas('warehouses', function ($query){
                return $query->select('amount');
            });
    }

    public function test($material_id, $quantity)
    {
        $array = [];
        $materials = Warehouse::query()
            ->where('material_id', $material_id)
            ->when(count($this->skip), function($query){
                $query->whereNotIn('id', $this->skip);
            })
            ->get();
        $getter = $quantity;
        foreach ($materials as $warehouse){
                $house_id = $warehouse->id;
                if($warehouse->amount >= $getter && $getter){
                    $array[] = [
                        'warehouse_id' => $house_id,
                        'material_name' => $warehouse->material_id,
                        'quantity' => $getter,
                        'price' => $warehouse->price
                    ];
                    $this->warehouseAmount[] = [
                        "warehouse_id" => $warehouse->id,
                        "warehouseAmountRemainder" => $warehouse->amount - $getter
                    ];
                    $getter = 0;
                }else {
                    $get = $warehouse->amount;
                    $array[] = [
                        'warehouse_id' => $house_id,
                        'material_name' => $warehouse->material_id,
                        'quantity' => $get,
                        'price' => $warehouse->price
                    ];
                    $getter -= $get;
                    $this->skip[] = $house_id;
                }
            };
        return $array;
    }
}



//$users = DB::table('users')->skip(10)->take(5)->get();
