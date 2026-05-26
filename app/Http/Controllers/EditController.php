<?php

namespace App\Http\Controllers;

use App\Models\EditFoodModel;
use App\Models\Category;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function index(Request $request)
    {
        $query = EditFoodModel::query();

        
        if ($request->category) {
            $query->where('category', $request->category);
        }

       
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        $foods = $query->latest()->get();
        $categories = Category::where('status', 1)->get();

        return view('admin.editfood.index', compact('foods', 'categories'));
    }
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.editfood.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'head' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foods', 'public');
        }

        EditFoodModel::create([
            'head' => $request->head,
            'desc' => $request->desc,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'ingredients' => $request->ingredients,
            'category' => $request->category,
            'image' => $imagePath,
            'status' => $request->status ? 1 : 0,
            'featured' => $request->featured ? 1 : 0,
            'popular' => $request->popular ? 1 : 0,
        ]);

        return redirect()->route('food.index')->with('success', 'Food added successfully');
    }

    public function food($id)
    {
        $food = EditFoodModel::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('admin.editfood.edit', compact('food', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $food = EditFoodModel::findOrFail($id);

        $food->head = $request->head;
        $food->desc = $request->desc;
        $food->price = $request->price;
        $food->discount_price = $request->discount_price;
        $food->ingredients = $request->ingredients;
        $food->category = $request->category;
        $food->status = $request->status ? 1 : 0;
        $food->featured = $request->featured ? 1 : 0;
        $food->popular = $request->popular ? 1 : 0;

        if ($request->hasFile('image')) {
            $food->image = $request->file('image')->store('foods', 'public');
        }

        $food->save();

        return redirect()->route('food.index')->with('success', 'Food updated successfully');
    }

    public function destroy($id)
    {
        EditFoodModel::findOrFail($id)->delete();
        return redirect()->route('food.index')->with('success', 'Food deleted successfully');
    }


    // --------------------chef edit ------------------------------------

    public function addChef(Request $request) {}

    // public function create() {
    //     return view('admin.edit.editmain');
    // }
    // public function foodCreate(){
    //     return view('admin.edit.foodCreate');
    // }
    // public function foodStore(Request $request){
    //     $frontend = new EditFoodModel();
    //     $frontend->head = $request->input('head');
    //     $frontend->desc = $request->input('desc');
    //     $frontend->price = $request->input('price');
    //     $frontend->save();
    //     return redirect()->route('edit.main')->with("editmain","added successfully ");
    // }
    // public function foodShow(){
    //     // $frontend = FrontendModel::latest()->paginate(10);
    //     $foods = EditFoodModel::all();
    //     return view('frontend.index',compact('foods'));    
    // }
}
