<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->after('password');
            }
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable()->after('role');
            }
        });

        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (!Schema::hasColumn('orders', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                }
            });
        }

        if (Schema::hasTable('reservationform')) {
            Schema::table('reservationform', function (Blueprint $table) {
                if (!Schema::hasColumn('reservationform', 'phone')) {
                    $table->string('phone')->nullable()->after('email');
                }
                if (!Schema::hasColumn('reservationform', 'date')) {
                    $table->date('date')->nullable()->after('phone');
                }
                if (!Schema::hasColumn('reservationform', 'time')) {
                    $table->string('time')->nullable()->after('date');
                }
                if (!Schema::hasColumn('reservationform', 'guests')) {
                    $table->integer('guests')->nullable()->after('time');
                }
                if (!Schema::hasColumn('reservationform', 'status')) {
                    $table->string('status')->default('pending')->after('message');
                }
            });
        }
    }

    public function down(): void
    {
        //
    }
};
