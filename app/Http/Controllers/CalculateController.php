<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculateController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $product = DB::table('material_product')
            ->where('product_id', $request->get('product_id'))
            ->select('material_id', 'quantity')
            ->get();

        return response()->json($product, 200);
    }

    public function calculate($material_id, $quantity){
        $warehouse = Warehouse::query()
            ->where('material_id', $material_id)
            ->pluck('amount');

    }
}
