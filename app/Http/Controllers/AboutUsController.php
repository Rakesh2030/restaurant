<?php

namespace App\Http\Controllers;

use App\Models\AboutUsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    //
    public function create(){
    return view('admin.aboutUs.create');   
    }
    public function store(Request $request){
    $request->validate([
        "heading"=>"required|string|max:255",
        "description"=>"required|string|max:1000",
        "YOE"=> "required|string|max:255",
        "PMC"=>"required|string|max:255",
        "image1"=>"required|image|mimes:jpg,jpeg,png,webp|max:2048",
        "image2"=>"required|image|mimes:jpg,jpeg,png,webp|max:2048",
        "image3"=>"required|image|mimes:jpg,jpeg,png,webp|max:2048",
        "image4"=>"required|image|mimes:jpg,jpeg,png,webp|max:2048"
    ]);

    $about = new AboutUsModel();

    if($request->hasFile('image1')){
        $imageName1 = uniqid().'.'.$request->image1->extension();
        $request->image1->storeAs('aboutus',$imageName1,'public');
        $about->image1 = $imageName1;
        }
        if($request->hasFile('image2')){
            $imageName2 = uniqid().'.'.$request->image2->extension();
            $request->image2->storeAs('aboutus',$imageName2,'public');
            $about->image2= $imageName2;
            }
            if($request->hasFile('image3')){
                $imageName3 = uniqid().'.'.$request->image3->extension();
                $request->image3->storeAs('aboutus',$imageName3,'public');
                $about->image3 = $imageName3;
            }
                if($request->hasFile('image4')){
                    $imageName4 = uniqid().'.'.$request->image4->extension();
                    $request->image4->storeAs('aboutus',$imageName4,'public');
                    $about->image4 = $imageName4;
                    }

    $about->heading = $request->heading;
    $about->description = $request->description;
    $about->YOE = $request->YOE;
    $about->PMC = $request->PMC;

    $about->save();
    return redirect()->route('aboutus.edit', $about->id)->with('success', 'About Us saved successfully');
    }
    public function index(Request $request){
        $about = AboutUsModel::get();
        return view('admin.aboutUs.index',compact('about'));
    }
    public function edit($id){
        $about = AboutUsModel::find($id) ?? AboutUsModel::latest()->first();

        if (!$about) {
            return redirect()->route('aboutus.create')->with('error', 'Please add About Us content first');
        }

        return view('admin.aboutUs.edit',compact('about'));
    }
    public function update(Request $request,$id){
        $request->validate([
            "heading"=>"required|string|max:255",
            "description"=>"required|string|max:1000",
            "YOE"=> "required|string|max:255",
            "PMC"=>"required|string|max:255",
            "image1"=>"nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            "image2"=>"nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            "image3"=>"nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            "image4"=>"nullable|image|mimes:jpg,jpeg,png,webp|max:2048"
        ]);
        $about = AboutUsModel::findOrFail($id);

        $about->heading = $request->heading;
        $about->description = $request->description;
        $about->YOE = $request->YOE;
        $about->PMC = $request->PMC;

        foreach (['image1', 'image2', 'image3', 'image4'] as $image) {
            if($request->hasFile($image)){
                if($about->$image && Storage::exists('public/aboutus/'.$about->$image)){
                    Storage::delete('public/aboutus/'.$about->$image);
                }

                $imageName = uniqid().'.'.$request->$image->extension();
                $request->$image->storeAs('aboutus',$imageName,'public');
                $about->$image = $imageName;
            }
        }

        $about->save();

        return back()->with('success', 'About Us updated successfully');
    }
}
