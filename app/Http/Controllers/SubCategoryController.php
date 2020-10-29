<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $active = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'activeMenu' => 'sub-category',
            'activeSubMenu' => 'all-sub-category',
            'subCategories' => SubCategory::all()
        ];

        return view('admin.sub-category.index', with($data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $activeMenu = 'sub-category';
        // $activeSubMenu = 'create-sub-category';

        $data = [
            'activeMenu' => 'sub-category',
            'activeSubMenu' => 'create-sub-category',
        ];

        return view('admin.sub-category.create', with($data));
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
            'name'=>'required|min:3',
            'category_id'=>'required|not_in:0'
        ]);

        SubCategory::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id
        ]);

        notify()->success('Sub Category created successfully!');
        // return redirect()->back();
        return redirect()->route('sub-category.index');
    }

    /**
     * Display the specified resource.
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
        $data = [
            'activeMenu' => 'sub-category',
            'activeSubMenu' => '',
            'subCategory' => SubCategory::find($id)
        ];

        return view('admin.sub-category.edit', with($data));
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
        $subCategory = SubCategory::find($id);

        $this->validate($request, [
            'name'=>'required|min:3',
            'category_id'=>'required|not_in:0'
        ]);

        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;

        $subCategory->save();

        notify()->success('Sub Category updated successfully!');
        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);

        $subCategory->delete();

        notify()->success('Sub Category deleted successfully!');
        return redirect()->route('sub-category.index');
    }
}
