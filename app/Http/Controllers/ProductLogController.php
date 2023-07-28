<?php

namespace App\Http\Controllers;
use App\Models\ProductLog;
use App\Models\Price;
use App\Models\Stock;

use Illuminate\Http\Request;

class ProductLogController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showWithPriceAndStock($id)
    {
        $price = Price::select('price')
            ->whereColumn('product_log_id', 'product_log.product_log_id')
            ->whereColumn('product_id', 'product_log.product_id')
            ->limit(1);

        $stock = Stock::select('stock_available')
            ->whereColumn('product_log_id', 'product_log.product_log_id')
            ->whereColumn('product_id', 'product_log.product_id')
            ->limit(1);

        $productSum = ProductLog::addSelect(['price' => $price])
                        ->addSelect(['stock' => $stock])
                        ->where('product_log.product_id', $id)
                        ->get(); 

        return response()->json($productSum);
    }

    public function showPrices($id)
    {
        $productLog = ProductLog::find($id);
        $productSum = $productLog->price;

        return response()->json($productSum);
    }
}
