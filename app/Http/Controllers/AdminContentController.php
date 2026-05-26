<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class AdminContentController extends Controller
{
    public function categories()
    {
        $categories = Category::latest()->get();
        return view('admin.dynamic.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'image' => $image,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'status' => $request->status ? 1 : 0,
        ]);

        return back()->with('success', 'Category saved successfully');
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category deleted successfully');
    }

    public function offers()
    {
        $offers = Offer::latest()->get();
        return view('admin.dynamic.offers', compact('offers'));
    }

    public function storeOffer(Request $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('offers', 'public');
        }

        Offer::create([
            'title' => $request->title,
            'description' => $request->description,
            'discount_text' => $request->discount_text,
            'image' => $image,
            'status' => $request->status ? 1 : 0,
        ]);

        return back()->with('success', 'Offer saved successfully');
    }

    public function deleteOffer($id)
    {
        Offer::findOrFail($id)->delete();
        return back()->with('success', 'Offer deleted successfully');
    }

    public function sliders()
    {
        $sliders = Slider::latest()->get();
        return view('admin.dynamic.sliders', compact('sliders'));
    }

    public function storeSlider(Request $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('sliders', 'public');
        }

        Slider::create([
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'image' => $image,
            'status' => $request->status ? 1 : 0,
        ]);

        return back()->with('success', 'Slider saved successfully');
    }

    public function deleteSlider($id)
    {
        Slider::findOrFail($id)->delete();
        return back()->with('success', 'Slider deleted successfully');
    }

    public function testimonials()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.dynamic.testimonials', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial::create([
            'name' => $request->name,
            'profession' => $request->profession,
            'message' => $request->message,
            'image' => $image,
            'status' => $request->status ? 1 : 0,
        ]);

        return back()->with('success', 'Testimonial saved successfully');
    }

    public function deleteTestimonial($id)
    {
        Testimonial::findOrFail($id)->delete();
        return back()->with('success', 'Testimonial deleted successfully');
    }

    public function gallery()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.dynamic.gallery', compact('galleries'));
    }

    public function storeGallery(Request $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create([
            'title' => $request->title,
            'image' => $image,
            'status' => $request->status ? 1 : 0,
        ]);

        return back()->with('success', 'Gallery image saved successfully');
    }

    public function deleteGallery($id)
    {
        Gallery::findOrFail($id)->delete();
        return back()->with('success', 'Gallery image deleted successfully');
    }

    public function settings()
    {
        $setting = WebsiteSetting::first();
        return view('admin.dynamic.settings', compact('setting'));
    }

    public function updateSettings(Request $request)
    {
        $setting = WebsiteSetting::first();

        if (!$setting) {
            $setting = new WebsiteSetting();
        }

        $setting->site_name = $request->site_name;
        $setting->footer_text = $request->footer_text;
        $setting->address = $request->address;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        $setting->linkedin = $request->linkedin;
        $setting->youtube = $request->youtube;

        if ($request->hasFile('logo')) {
            $setting->logo = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $setting->favicon = $request->file('favicon')->store('settings', 'public');
        }

        $setting->save();

        return back()->with('success', 'Website settings updated successfully');
    }

    public function orders()
    {
        $orders = Order::latest()->get();
        return view('admin.dynamic.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('admin.dynamic.order-details', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,out_for_delivery,delivered',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated successfully');
    }

    public function customers()
    {
        $customers = Order::select('customer_name', 'customer_email', 'customer_phone', 'customer_address')
            ->latest()
            ->get()
            ->unique('customer_phone');

        return view('admin.dynamic.customers', compact('customers'));
    }
}
