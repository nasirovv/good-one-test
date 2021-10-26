<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculateController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $materials = DB::table('material_product')
            ->where('product_id', $request->get('product_id'))
            ->select('material_id', 'quantity')
            ->get();
        foreach ($materials as $material){
            $data[] = $this->test($material->material_id, $material->quantity);
        }
        return $data;
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
            ->get();
        foreach ($materials as $warehouse){
                $skip = 0;
                $get = 0;
                $house_id = $warehouse->id;
                if($warehouse->amount >= $quantity ){
                    $get = $quantity;
                    $array += [
                        'warehouse_id' => $house_id,
                        'material_name' => $warehouse->material_id,
                        'quantity' => $get,
                        'price' => $warehouse->price
                    ];
                }
            };
        return $array;
    }
}



//$users = DB::table('users')->skip(10)->take(5)->get();
