<?php

namespace App\Http\Controllers;

use App\Models\ChefModel;
use App\Models\ContactModel;
use App\Models\EditFoodModel;
use App\Models\FrontendModel;
use App\Models\AboutUsModel;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\HomeNavbarModel;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ReservationFormModel;
use App\Models\Slider;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class FrontendController extends Controller
{
    //
    public function homenavbarcreate(){
        return view('frontend.homeNavbar.create');
    }
    public function homenavbarstore(Request $request){
        $navbar = new HomeNavbarModel();
        if($request->hasFile('image')){

            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('homeNavbar',$imageName,'public');
        }
            $navbar->heading = $request->input('heading');
        $navbar->description = $request->input('description');
        $navbar->image = $imageName;
        $navbar->save();
        return redirect()->route('frontend.home');
        
    }
    
    public function create()
    {
        // Get frontend data from database
        $sliders = Schema::hasTable('sliders') ? Slider::where('status', 1)->latest()->get() : collect();
        $categories = Schema::hasTable('categories') ? Category::where('status', 1)->latest()->get() : collect();
        $foods = Schema::hasTable('editfood') ? EditFoodModel::where('status', 1)->latest()->get() : collect();
        $featuredFoods = Schema::hasTable('editfood') ? EditFoodModel::where('status', 1)->where('featured', 1)->latest()->get() : collect();
        $popularFoods = Schema::hasTable('editfood') ? EditFoodModel::where('status', 1)->where('popular', 1)->latest()->get() : collect();
        $offers = Schema::hasTable('offers') ? Offer::where('status', 1)->latest()->get() : collect();
        $testimonials = Schema::hasTable('testimonials') ? Testimonial::where('status', 1)->latest()->get() : collect();
        $chefs = Schema::hasTable('chef') ? ChefModel::latest()->get() : collect();
        $about = Schema::hasTable('aboutus') ? AboutUsModel::latest()->first() : null;
        $galleries = Schema::hasTable('galleries') ? Gallery::where('status', 1)->latest()->take(4)->get() : collect();

        return view('frontend.index', compact(
            'sliders',
            'categories',
            'foods',
            'featuredFoods',
            'popularFoods',
            'offers',
            'testimonials',
            'chefs',
            'about',
            'galleries'
        ));
    }
    public function createAbout()
    {
        $chefs = Schema::hasTable('chef') ? ChefModel::all() : collect();
        $about = Schema::hasTable('aboutus') ? AboutUsModel::latest()->first() : null;
        $title = "About Us";
        return view('frontend.pages.about', compact('chefs', 'about', 'title'));
    }
    public function createService()
    {
        $title = "Services";
        return view('frontend.pages.service', compact('title'));
    }
    public function createMenu()
    {
        $query = Schema::hasTable('editfood') ? EditFoodModel::where('status', 1) : null;

        if ($query && request('category')) {
            $query->where('category', request('category'));
        }

        if ($query && request('search')) {
            $query->where('head', 'like', '%' . request('search') . '%');
        }

        // Get foods, categories and offers for menu page
        $foods = $query ? $query->latest()->get() : collect();
        $categories = Schema::hasTable('categories') ? Category::where('status', 1)->get() : collect();
        $offers = Schema::hasTable('offers') ? Offer::where('status', 1)->latest()->get() : collect();
        $title = "Food Menu";
        return view('frontend.pages.menu', compact('title', 'foods', 'categories', 'offers'));
    }
    public function createContact()
    {
        $contacts = Schema::hasTable('contact') ? ContactModel::latest()->get() : collect();
        $title = "Contact Us";
        return view('frontend.pages.contact', compact('title', 'contacts'));
    }
    public function createBooking()
    {
        $title = "Booking";
        return view('frontend.pages.booking', compact('title'));
    }
    public function createTeam()
    {
        $chefs = Schema::hasTable('chef') ? ChefModel::all() : collect();
        $title = "Our Team";
        return view('frontend.pages.team', compact('title', 'chefs'));
    }
    public function createTestimonial()
    {
        $testimonials = Schema::hasTable('testimonials') ? Testimonial::where('status', 1)->latest()->get() : collect();
        $title = "Testimonial";
        return view('frontend.pages.testimonial', compact('title', 'testimonials'));
    }

    public function foodDetails($id)
    {
        $food = EditFoodModel::findOrFail($id);
        $title = $food->head;
        return view('frontend.pages.food-details', compact('food', 'title'));
    }

    public function gallery()
    {
        $galleries = Schema::hasTable('galleries') ? Gallery::where('status', 1)->latest()->get() : collect();
        $title = "Gallery";
        return view('frontend.pages.gallery', compact('galleries', 'title'));
    }

    public function offers()
    {
        $offers = Schema::hasTable('offers') ? Offer::where('status', 1)->latest()->get() : collect();
        $title = "Offers";
        return view('frontend.pages.offers', compact('offers', 'title'));
    }

    public function store(Request $request)
    {
        $frontend = new FrontendModel();
        $frontend->head = $request->input('head');
        $frontend->para = $request->input('para');
        $frontend->save();
        return redirect()->route('frontend.home')->with("frontend", "text added successful");
    }
    public function createadmin()
    {
        // Get total number of orders
        $totalOrders = Order::count();

        // Get total number of customers from orders
        $totalCustomers = Order::whereNotNull('customer_phone')->distinct('customer_phone')->count('customer_phone');

        // Get total number of food items
        $totalFoodItems = EditFoodModel::count();

        // Get total number of categories
        $totalCategories = Category::count();

        // Get total number of table reservations
        $totalReservations = ReservationFormModel::count();

        // Get pending and completed order counts
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::whereIn('status', ['delivered', 'completed'])->count();

        // Get total revenue from orders
        $totalRevenue = Order::sum('total');

        // Get latest orders and reservations
        $recentOrders = Order::latest()->take(5)->get();
        $recentReservations = ReservationFormModel::latest()->take(5)->get();

        // Get monthly orders and revenue for simple charts
        $monthLabels = [];
        $monthlyOrders = [];
        $monthlyRevenue = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthLabels[] = Carbon::create(null, $month, 1)->format('M');
            $monthlyOrders[] = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->count();
            $monthlyRevenue[] = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->sum('total');
        }

        // Get top ordered food items
        $topSellingFoods = OrderItem::leftJoin('editfood', 'order_items.food_id', '=', 'editfood.id')
            ->select(
                'order_items.food_id',
                'order_items.food_name',
                'editfood.image',
                'editfood.category',
                DB::raw('SUM(order_items.quantity) as total_orders')
            )
            ->groupBy('order_items.food_id', 'order_items.food_name', 'editfood.image', 'editfood.category')
            ->orderByDesc('total_orders')
            ->take(5)
            ->get();

        // Show low stock items only when stock column exists
        $lowStockFoods = collect();

        if (Schema::hasColumn('editfood', 'stock')) {
            $lowStockFoods = EditFoodModel::where('stock', '<=', 5)->latest()->take(5)->get();
        }

        return view('admin.index', compact(
            'totalOrders',
            'totalCustomers',
            'totalFoodItems',
            'totalCategories',
            'totalReservations',
            'pendingOrders',
            'completedOrders',
            'totalRevenue',
            'recentOrders',
            'recentReservations',
            'monthLabels',
            'monthlyOrders',
            'monthlyRevenue',
            'topSellingFoods',
            'lowStockFoods'
        ));
    }
}
