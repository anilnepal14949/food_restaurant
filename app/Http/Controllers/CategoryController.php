<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $activeMenu = 'category';
        $activeSubMenu = 'all-category';

        return view('admin.category.index', compact('categories', 'activeMenu', 'activeSubMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activeMenu = 'category';
        $activeSubMenu = 'create-category';

        return view('admin.category.create', compact('activeMenu', 'activeSubMenu'));
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
            'name' => 'required|unique:categories',
            'description' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg'
        ]);

        $image = $request->file('image')->store('public/files');
        Category::create([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'description' => $request->get('description'),
            'image' => $image
        ]);

        notify()->success('Category created successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        $activeMenu = 'category';
        $activeSubMenu = 'edit-category';

        return view('admin.category.edit', compact('category', 'activeMenu', 'activeSubMenu'));
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
        $category = Category::find($id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpeg,jpg'
        ]);

        $image = $category->image;

        if ($request->file('image')) {
            \Storage::delete($image);
            $image = $request->file('image')->store('public/files');
        }

        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->image = $image;

        $category->save();

        notify()->success('Category updated successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $image = $category->image;
        $category->delete();

        \Storage::delete($image);

        notify()->success('Category deleted successfully!');
        return redirect()->route('category.index');
    }
}
