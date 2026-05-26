<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ChefModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChefController extends Controller
{
    //
    public function create()
    {
        return view('admin.chef.create');
    }
    public function index()
    {
        $chefs = ChefModel::get();
        return view('admin.chef.index', compact('chefs'));
    }
    public function store(Request $request)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'designation' => 'required|string|max:255',
        'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imageName = null;

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('chefs', $imageName, 'public');
    }

    $chef = new ChefModel();
    $chef->name = $request->name;
    $chef->designation = $request->designation;
    $chef->image = $imageName;
    $chef->save();

    return redirect()->route('chef.index');
}


    public function edit($id)
    {
        $chef = ChefModel::findOrFail($id);
        return view('admin.chef.edit', compact('chef'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $chef = ChefModel::findOrFail($id);

        if ($request->hasFile('image')) {

            // old image delete
            if ($chef->image && Storage::exists('public/chefs/' . $chef->image)) {
                Storage::delete('public/chefs/' . $chef->image);
            }

            // new image upload
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('chefs', $imageName, 'public');

            $chef->image = $imageName;
        };
        $chef->name = $request->input('name');
        $chef->designation = $request->input('designation');
        $chef->save();
        return redirect()->route('chef.index')->with('success', 'student added successfully ');
    }
    public function destroy($id)
    {
        $chef = ChefModel::findOrFail($id);
        $chef->delete();
        return redirect()->route('chef.index')->with('success', 'data deleted successfully');
    }
    // public function save(){
    //     $chefs = ChefModel::get();
    //     return view('frontend.index',compact('chefs'));
    // }
    public function image() {}
}
