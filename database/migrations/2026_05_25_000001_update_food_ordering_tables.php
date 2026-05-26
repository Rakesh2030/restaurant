<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('editfood', function (Blueprint $table) {
            if (!Schema::hasColumn('editfood', 'discount_price')) {
                $table->decimal('discount_price', 8, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('editfood', 'ingredients')) {
                $table->text('ingredients')->nullable()->after('desc');
            }
            if (!Schema::hasColumn('editfood', 'status')) {
                $table->tinyInteger('status')->default(1)->after('image');
            }
            if (!Schema::hasColumn('editfood', 'featured')) {
                $table->tinyInteger('featured')->default(0)->after('status');
            }
            if (!Schema::hasColumn('editfood', 'popular')) {
                $table->tinyInteger('popular')->default(0)->after('featured');
            }
        });

        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            });
        }

        if (!Schema::hasTable('offers')) {
            Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('discount_text')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            });
        }

        if (!Schema::hasTable('sliders')) {
            Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            });
        }

        if (!Schema::hasTable('testimonials')) {
            Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profession')->nullable();
            $table->text('message');
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            });
        }

        if (!Schema::hasTable('galleries')) {
            Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            });
        }

        if (!Schema::hasTable('website_settings')) {
            Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('Restoran');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->text('footer_text')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
            });
        }

        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->text('note')->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();
            });
        }

        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('food_id')->nullable();
            $table->string('food_name');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('website_settings');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('offers');
        Schema::dropIfExists('categories');
    }
};
