<?php

namespace App\Http\Controllers;

use App\Models\HomeNavbarModel;
use Illuminate\Http\Request;

class HomeHeroController extends Controller
{
    //
    public function create(){
        return view('admin.homehero.create');
    }

    public function store(Request $request){
        $request->validate([
            'heading'=> 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        HomeNavbarModel::create([
            'heading' => $request->heading,
            'description' => $request->description,
            'image' => $request->image,
        ]);
        return redirect()->route('admin.page')->with('success','data inserted successfully');
    }
}
