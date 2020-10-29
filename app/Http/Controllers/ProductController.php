<?php

namespace App\Http\Controllers;

use App\Product;
use App\SubCategory;
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
        $data = [
            'activeMenu' => 'product',
            'activeSubMenu' => 'all-products',
            'products' => Product::all()
        ];

        return view('admin.product.index', with($data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'activeMenu' => 'product',
            'activeSubMenu' => 'create-product',
        ];

        return view('admin.product.create', with($data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id'=>'required|not_in:0',
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg,jpg',
            'price'=>'required|numeric',
            'additional_info'=>'required'
        ]);

        $image = $request->file('image')->store('public/products');

        Product::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'image'=>$image,
            'price'=>$request->price,
            'additional_info'=>$request->additional_info,
            'sub_category_id'=>$request->sub_category_id
        ]);

        notify()->success('Product added successfully');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data = [
            'activeMenu' => 'product',
            'activeSubMenu' => 'all-products',
            'product' => $product
        ];

        return view('admin.product.edit', with($data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $image = $product->image;

        if($request->file('image')) {
            \Storage::delete($image);
            $image = $request->file('image')->store('public/products');
        }

        $product->name = $request->name;
        $product->image = $image;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->additional_info = $request->additional_info;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;

        $product->save();

        notify()->success('Product updated successfully');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $image = $product->image;
        $product->delete();

        \Storage::delete($image);

        notify()->success('Product deleted successfully!');
        return redirect()->route('product.index');
    }

    public function loadSubCategories(Request $request, $id) {
        $subCategories = SubCategory::where('category_id', $id)->pluck('name','id');

        return response()->json($subCategories);
    }
}
