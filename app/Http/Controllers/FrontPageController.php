<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slider;
use App\SubCategory;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index()
    {
        $products = Product::latest()->limit(9)->get();
        $randomActiveProducts = Product::inRandomOrder()->limit(3)->get();

        $sliders = Slider::get();

        $randomActiveProductIds = [];
        foreach ($randomActiveProducts as $product) {
            array_push($randomActiveProductIds, $product->id);
        }

        $randomItemProducts = Product::whereNotIn('id', $randomActiveProductIds)->limit(3)->get();

        return view('frontend.home', compact('products', 'randomActiveProducts', 'randomItemProducts','sliders'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $similarProducts = Product::inRandomOrder()
            ->where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(3)->get();

        return view('frontend.show', compact('product', 'similarProducts'));
    }

    public function filterProducts($slug, Request $request)
    {
        $category = Category::whereSlug($slug)->first();

        if ($request->subcategory) {
            $products = $this->filteredProducts($request);
            $filterIds = $this->getSubCategoryIds($request);
        } elseif ($request->max || $request->min) {
            $products = $this->filteredProductsByPrice($request);
            $filterIds = [];
        } else {
            $products = Product::where('category_id', $category->id)->get();
            $filterIds = [];
        }

        $subCategories = SubCategory::where('category_id', $category->id)->get();

        return view('frontend.category', compact('category', 'products', 'subCategories', 'filterIds'));
    }

    public function filteredProducts(Request $request)
    {
        $subIds = [];
        $subCategories = SubCategory::whereIn('id', $request->subcategory)->get();

        foreach ($subCategories as $subCategory) {
            array_push($subIds, $subCategory->id);
        }

        $products = Product::whereIn('sub_category_id', $subIds)->get();

        return $products;
    }

    public function getSubCategoryIds(Request $request)
    {
        $subIds = [];
        $subCategories = SubCategory::whereIn('id', $request->subcategory)->get();

        foreach ($subCategories as $subCategory) {
            array_push($subIds, $subCategory->id);
        }

        return $subIds;
    }

    public function filteredProductsByPrice(Request $request)
    {
        $category_id = $request->category_id;
        $products = Product::whereBetween('price', [$request->min, $request->max])->where('category_id', $category_id)->get();

        return $products;
    }

    public function viewAllProducts(Request $request)
    {
        if ($request->search) {
            $search = $request->search;
            $products = Product::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('additional_info', 'like', '%' . $request->search . '%')
                ->paginate(20);
        } else {
            $search = '';
            $products = Product::latest()->paginate(20);
        }

        return view('frontend.products', compact('products', 'search'));
    }
}
