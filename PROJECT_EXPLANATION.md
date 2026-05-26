# Food Ordering Website Explanation

This is a simple Laravel MVC food ordering website.

## Routes

Routes are written in `routes/web.php`.

- Frontend routes show pages like home, about, menu, food details, cart, checkout, gallery and offers.
- Admin routes manage categories, foods, sliders, offers, testimonials, gallery, orders, customers and website settings.
- Cart routes save cart items in session.
- Order routes save checkout details into the database.

## Controllers

Controllers are inside `app/Http/Controllers`.

- `FrontendController` gets frontend data from the database and sends it to Blade pages.
- `EditController` manages food items in the admin panel.
- `AdminContentController` manages categories, sliders, offers, testimonials, gallery, settings, orders and customers.
- `CartController` manages cart, checkout and order placing.

Example flow:

User opens homepage →
`FrontendController@create` gets foods, categories, sliders, offers and testimonials from DB →
data is sent to `resources/views/frontend/index.blade.php` →
Blade shows the content dynamically.

## Models

Models are inside `app/Models`.

- `EditFoodModel` is used for food items.
- `Category` is used for food categories.
- `Slider` is used for homepage banners.
- `Offer` is used for offers.
- `Testimonial` is used for customer reviews.
- `Gallery` is used for gallery images.
- `WebsiteSetting` is used for logo, site name, footer and social links.
- `Order` and `OrderItem` are used for customer orders.

## Frontend Flow

The frontend does not use hardcoded food data.

- Home page shows categories, about content, foods, offers, chefs and testimonials from database.
- Menu page shows foods from database.
- User can search foods and filter by category.
- Food details page shows one food item.
- Gallery and offers pages show content from admin panel.
- Header, footer, logo, contact and social links come from website settings.

## Admin Flow

Admin opens the admin panel and manages content.

- Add category from Categories page.
- Add food from Food page.
- Add banner from Sliders/Banners page.
- Add offer from Offers page.
- Add testimonial from Testimonials page.
- Add gallery image from Gallery page.
- Update footer, logo and contact info from Website Settings page.

## Cart Flow

User opens menu →
clicks Add To Cart →
food is saved in Laravel session →
cart page shows item quantity and total →
user can update quantity or remove item.

## Order Flow

User adds food to cart →
opens checkout page →
fills name, phone, address and note →
clicks Place Order →
order is saved in `orders` table →
order foods are saved in `order_items` table →
admin can view and update order status.

Order statuses are:

- pending
- preparing
- completed
- delivered

## Database

Database tables are created using migrations in `database/migrations`.

Important tables:

- `editfood`
- `categories`
- `sliders`
- `offers`
- `testimonials`
- `galleries`
- `website_settings`
- `orders`
- `order_items`

## CRUD Flow

Simple CRUD means:

Create form →
controller validates basic data →
model saves data →
admin list page shows saved data →
edit/delete actions update or remove data.

The code uses simple Eloquent queries like:

```php
$foods = EditFoodModel::where('status', 1)->latest()->get();
```

This keeps the project easy to understand for beginner and intermediate Laravel developers.
