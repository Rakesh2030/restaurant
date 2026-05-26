<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('contact')) {

            Schema::table('contact', function (Blueprint $table) {

                if (!Schema::hasColumn('contact', 'facebook')) {
                    $table->string('facebook')->nullable()->after('email');
                }

                if (!Schema::hasColumn('contact', 'twitter')) {
                    $table->string('twitter')->nullable();
                }

                if (!Schema::hasColumn('contact', 'instagram')) {
                    $table->string('instagram')->nullable();
                }

                if (!Schema::hasColumn('contact', 'linkedin')) {
                    $table->string('linkedin')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('contact')) {

            Schema::table('contact', function (Blueprint $table) {

                $columns = [];

                if (Schema::hasColumn('contact', 'facebook')) {
                    $columns[] = 'facebook';
                }

                if (Schema::hasColumn('contact', 'twitter')) {
                    $columns[] = 'twitter';
                }

                if (Schema::hasColumn('contact', 'instagram')) {
                    $columns[] = 'instagram';
                }

                if (Schema::hasColumn('contact', 'linkedin')) {
                    $columns[] = 'linkedin';
                }

                if (!empty($columns)) {
                    $table->dropColumn($columns);
                }
            });
        }
    }
};
