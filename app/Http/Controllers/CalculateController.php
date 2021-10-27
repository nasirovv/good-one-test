<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalculateController extends Controller
{
    private $skip = [];
    private $warehouseAmount = [];

    public function index(Request $request): JsonResponse
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
                $data['product_materials'][] = $this->calculate($material->material_id, $material->quantity * $product['amount']);
            }
            $result['result'][] = $data;
        }
            return response()->json($result, 200);
    }

    public function calculate($material_id, $quantity): array
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
                if(count($this->warehouseAmount)){
                    foreach ($this->warehouseAmount as $key => $value){
                        if ($house_id === $key){
                            $remainder = $value;
                        }
                    }
                }
                if(($remainder ?? $warehouse->amount) >= $getter && $getter){
                    $array[] = [
                        'warehouse_id' => $house_id,
                        'material_name' => $this->getMaterialName($warehouse->material_id),
                        'quantity' => $getter,
                        'price' => $warehouse->price
                    ];
                    if(array_key_exists($warehouse->id, $this->warehouseAmount)){
                        Log::debug($this->warehouseAmount[$warehouse->id]);
                        $this->warehouseAmount[$warehouse->id] -= $getter;
                    }else {
                        $this->warehouseAmount += [
                            $warehouse->id => $warehouse->amount - $getter
                        ];
                    }
                    $getter = 0;
                }else {
                    $get = $remainder ?? $warehouse->amount;
                    $array[] = [
                        'warehouse_id' => $house_id,
                        'material_name' => $this->getMaterialName($warehouse->material_id),
                        'quantity' => $get,
                        'price' => $warehouse->price
                    ];
                    $getter -= $get;
                    $this->skip[] = $house_id;
                }
            };
            if($getter){
                $array[] = [
                    'warehouse_id' => null,
                    'material_name' => $this->getMaterialName($material_id),
                    'quantity' => $getter,
                    'price' => null
                ];
            }
        return $array;
    }

    private function getMaterialName($id)
    {
        return Material::query()->findOrFail($id)->name;
    }
}


