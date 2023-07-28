<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductLogs;
use App\Models\Price;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all products from the database

        $products = Product::addSelect(
            ['latest_price' => Price::select('price')
            ->whereColumn('product_id', 'product.product_id')
            ->orderByDesc('created_at')
            ->limit(1)])
            ->addSelect(['latest_stock' => Stock::select('stock_available')
            ->whereColumn('product_id', 'product.product_id')
            ->orderByDesc('created_at')
            ->limit(1)]
        )->get();

        // Return the products as a JSON response
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        // Create a new product using the validated data
        $product = Product::create($validatedData);

        // Return the newly created product as a JSON response
        return response()->json($product, 201);
    }

    public function getName($id)
    {
        $product = Product::select('product_name')
                            ->findOrFail($id);

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the product with the given ID
        // $product = Product::
        //             // with('site')
        //             // ->with('price')
        //             join('price', 'product.product_id', '=', 'price.product_id')
        //             // ->select('price.created_at')
        //             ->orderBy('price.created_at', 'desc')
        //             ->findOrFail($id);

        $product = Product::addSelect(
            ['latest_price' => Price::select('price')
            ->whereColumn('product_id', 'product_id')
            ->orderByDesc('created_at')
            ->limit(1)])
            ->addSelect(['latest_stock' => Stock::select('stock_available')
            ->whereColumn('product_id', 'product_id')
            ->orderByDesc('created_at')
            ->limit(1)]
        )->findOrFail($id);

        // $nih = $product->latestPrice()
        //         ->orderBy('created_at', 'desc')
        //         ->firstOrFail();

        // Return the product as a JSON response
        return response()->json($product);
        // return response()->json($nih);
    }

    public function showLogs($id)
    {
        // Find the product with the given ID
        // $product = Product::
        //             // with('site')
        //             // ->with('price')
        //             join('price', 'product.product_id', '=', 'price.product_id')
        //             // ->select('price.created_at')
        //             ->orderBy('price.created_at', 'desc')
                    

        $product = Product::addSelect(
            ['latest_price' => Price::select('price')
            ->whereColumn('product_log_id', 'price.product_log_id')
            ->limit(1)]
        )->get();

        // $nih = $product->latestPrice()
        //         ->orderBy('created_at', 'desc')
        //         ->firstOrFail();

        // $product = Product::with('product_log')->findOrFail($id);
        // $product = Product::findOrFail($id)->product_log;
        

        // Return the product as a JSON response
        return response()->json($product);
        // return response()->json($nih);
    }

    public function showLogIndex()
    {
        $product = Product::with('product_log')->get();
        
        return response()->json($product);
    }

    public function site($id)
    {
        // Find the product with the given ID
        $product = Product::findOrFail($id);

        // Retrieve the category associated with the product
        $site = $product->site;

        // Return the category as a JSON response
        return response()->json($site);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the product with the given ID
        $product = Product::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        // Update the product with the validated data
        $product->update($validatedData);

        // Return the updated product as a JSON response
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the product with the given ID
        $product = Product::findOrFail($id);

        // Delete the product from the database
        $product->delete();

        // Return a success message as a JSON response
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
