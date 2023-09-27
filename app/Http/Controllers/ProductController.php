<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
         // Handle the file upload and store it as a blob
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = base64_encode(file_get_contents($image->getRealPath()));
    
        }

        $product=new Product();
        $product->name=$request->name;
        $product->price=$request->price;
        $product->description=$request->description;
        $product->image=$imageData;
        $product->save();
        return response()->json(["message"=>"Product uploaded successfully"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request,  $id)
    {
        // $imageData=null;
        $product=Product::findOrFail($id);
        $product->name=$request->name;
        $product->price=$request->price;
        $product->description=$request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = base64_encode(file_get_contents($image->getRealPath()));
            $product->image = $imageData;
        }
        // $product->save();
        return response()->json([
            "product"=>$product,
            'message' => 'Product updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $product=Product::findOrFail($id);
        $product->delete();
        return response()->json(["message"=>"Image deleted successfully"]);
    }
}
