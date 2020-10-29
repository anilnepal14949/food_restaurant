<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $activeMenu = 'slider';
        $activeSubMenu = 'all-sliders';

        return view('admin.slider.index', compact('sliders', 'activeMenu', 'activeSubMenu'));
    }

    public function create()
    {
        $activeMenu = 'slider';
        $activeSubMenu = 'create-slider';

        return view('admin.slider.create', compact('activeMenu', 'activeSubMenu'));
    }

    public function store(Request $request)
    { 
        $this->validate($request, [
            'image' => 'required|mimes:png,jpeg,jpg'
        ]);

        $image = $request->file('image')->store('public/sliders');
        Slider::create([
            'image' => $image
        ]);

        notify()->success('Slider created successfully!');
        return redirect()->route('slider.index');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);

        $image = $slider->image;
        $slider->delete();

        \Storage::delete($image);

        notify()->success('Slider deleted successfully!');
        return redirect()->route('slider.index');
    }
}
