<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeHeroController;
use App\Http\Controllers\ReservationFormController;
use App\Http\Controllers\ServiceProviderController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'create')->name('frontend.home');
    Route::get('/adminpage', 'createadmin')->middleware('admin')->name('admin.page');
    Route::get('/frontend/create','homenavbarcreate')->name('homenavbarcreate');
    Route::post('/frontend/store','homenavbarstore')->name('homenavbarstore');
    Route::get('/user/pages/about', 'createAbout')->name('frontend.pages.about');
    Route::get('/user/pages/booking', 'createBooking')->name('frontend.pages.booking');
    Route::get('/user/pages/contact', 'createContact')->name('frontend.pages.contact');
    Route::get('/user/pages/menu', 'createMenu')->name('frontend.pages.menu');
    Route::get('/food/details/{id}', 'foodDetails')->name('frontend.food.details');
    Route::get('/user/pages/service', 'createService')->name('frontend.pages.service');
    Route::get('/user/pages/team', 'createTeam')->name('frontend.pages.team');
    Route::get('/user/pages/testimonial', 'createTestimonial')->name('frontend.pages.testimonial');
    Route::get('/gallery', 'gallery')->name('frontend.gallery');
    Route::get('/offers', 'offers')->name('frontend.offers');
    Route::get('/usersave', 'save')->name('frontend.page.save');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/add/{id}', 'add')->name('cart.add');
    Route::post('/cart/update/{id}', 'update')->name('cart.update');
    Route::get('/cart/remove/{id}', 'remove')->name('cart.remove');
    Route::middleware('auth')->group(function () {
        Route::get('/checkout', 'checkout')->name('checkout.index');
        Route::post('/place-order', 'placeOrder')->name('order.place');
        Route::get('/my-orders', 'myOrders')->name('orders.my');
    });
});

Route::middleware('auth')->controller(AccountController::class)->group(function () {
    Route::get('/account/settings', 'edit')->name('account.settings');
    Route::post('/account/settings', 'update')->name('account.settings.update');
});



// Route::prefix('admin')->middleware('admin')->name('admin.')->group(function(){
//     Route::get('/dashboard',function(){
//         return view('admin.index');
//     })->name('dashboard');
// });

// \\\\\\\\\\\\\\\\\\--------   Admin -------------- \\\\\\\\\\\\\\\\\\\\\\\\\\

// -------- food edit -------------------
Route::middleware('admin')->controller(EditController::class)->group(function () {
    Route::get('/food/index', 'index')->name('food.index');
    Route::get('/food/create', 'create')->name('food.create');
    Route::post('/food/store', 'store')->name('food.store');
    Route::get('/food/edit/{id}', 'food')->name('food.edit');
    Route::post('/food/update/{id}', 'update')->name('food.update');
    Route::get('/food/destroy/{id}', 'destroy')->name('food.destroy');
});

Route::middleware('admin')->controller(AdminContentController::class)->group(function () {
    Route::get('/admin/categories', 'categories')->name('admin.categories');
    Route::post('/admin/categories/store', 'storeCategory')->name('admin.categories.store');
    Route::get('/admin/categories/delete/{id}', 'deleteCategory')->name('admin.categories.delete');

    Route::get('/admin/offers', 'offers')->name('admin.offers');
    Route::post('/admin/offers/store', 'storeOffer')->name('admin.offers.store');
    Route::get('/admin/offers/delete/{id}', 'deleteOffer')->name('admin.offers.delete');

    Route::get('/admin/sliders', 'sliders')->name('admin.sliders');
    Route::post('/admin/sliders/store', 'storeSlider')->name('admin.sliders.store');
    Route::get('/admin/sliders/delete/{id}', 'deleteSlider')->name('admin.sliders.delete');

    Route::get('/admin/testimonials', 'testimonials')->name('admin.testimonials');
    Route::post('/admin/testimonials/store', 'storeTestimonial')->name('admin.testimonials.store');
    Route::get('/admin/testimonials/delete/{id}', 'deleteTestimonial')->name('admin.testimonials.delete');

    Route::get('/admin/gallery', 'gallery')->name('admin.gallery');
    Route::post('/admin/gallery/store', 'storeGallery')->name('admin.gallery.store');
    Route::get('/admin/gallery/delete/{id}', 'deleteGallery')->name('admin.gallery.delete');

    Route::get('/admin/settings', 'settings')->name('admin.settings');
    Route::post('/admin/settings/update', 'updateSettings')->name('admin.settings.update');

    Route::get('/admin/orders', 'orders')->name('admin.orders');
    Route::get('/admin/orders/{id}', 'orderDetails')->name('admin.orders.details');
    Route::post('/admin/orders/status/{id}', 'updateOrderStatus')->name('admin.orders.status');
    Route::get('/admin/customers', 'customers')->name('admin.customers');
});
// -------------------- chef ---------------------
Route::middleware('admin')->controller(ChefController::class)->group(function () {
    Route::get('/chef/page', 'create')->name('chef.create');
    Route::get('/chef/index', 'index')->name('chef.index');
    Route::post('/chef/store', 'store')->name('chef.store');
    Route::get('/chef/edit/{id}', 'edit')->name('chef.edit');
    Route::post('/chef/update/{id}', 'update')->name('chef.update');
    Route::get('/chef/destroy/{id}', 'destroy')->name('chef.destroy');
});
//------------------- reservation form data -----------------------------------
Route::controller(ReservationFormController::class)->group(function () {
    Route::post('/reservation/store', 'reservationFormStore')->name('reservation.store');
    Route::post('/reservationForm/store', 'reservationFormStore')->name('reservaion.store');
});

Route::middleware('admin')->controller(ReservationFormController::class)->group(function () {
    Route::get('/reservation/index', 'index')->name('reservation.index');
    Route::get('/reservation/status/{id}/{status}', 'updateStatus')->name('reservation.status');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/admin/login', 'loginform')->name('login.form');
    Route::get('/login', 'loginform')->name('login');
    Route::get('/registerform', 'registerform')->name('register.form');
    Route::post('/registerstore', 'registerstore')->name('register.store');
    Route::post('/loginpost', 'loginpost')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});
// -------------------- contact controller ----------------------------
Route::middleware('admin')->controller(ContactController::class)->group(function () {
    Route::get('/contact/create', 'create')->name('contact.create');
    Route::get('/contact/index', 'index')->name('contact.index');
    Route::post('/contact/store', 'store')->name('contact.store');
    Route::get('/contact/edit/{id}', 'edit')->name('contact.edit');
    Route::post('/contact/update/{id}', 'update')->name('contact.update');
    Route::get('/contact/destroy/{id}', 'destroy')->name('contact.destroy');
});
// -------------------- about us controller ----------------------------
Route::middleware('admin')->controller(AboutUsController::class)->group(function(){
    Route::get('/aboutus/create','create')->name('aboutus.create');
    Route::post('/aboutus/store','store')->name('aboutus.store');
    Route::get('/aboutus/index','index')->name('aboutus.index');
    Route::get('/aboutus/edit/{id}','edit')->name('aboutus.edit');
    Route::post('/aboutus/update/{id}','update')->name('aboutus.update');
});

// --------------- home hero section -------------------------
Route::middleware('admin')->controller(HomeHeroController::class)->group(function(){
    Route::get('/homehero','create')->name('homehero.create');
    Route::post('/homehero/store','store')->name('homehero.store');
});




// ++++++++++++++++ service provider code controller +++++++++++++++++
Route::controller(ServiceProviderController::class)->group(function(){
    Route::get('serviceprovider','index');
});

Route::get('/logs', function () {
    return nl2br(file_get_contents(storage_path('logs/laravel.log')));
});
