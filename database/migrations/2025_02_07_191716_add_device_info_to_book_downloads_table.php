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
        Schema::table('book_downloads', function (Blueprint $table) {
            //
            Schema::table('book_downloads', function (Blueprint $table) {
                $table->string('device_type')->nullable()->after('user_agent');
                $table->string('browser')->nullable()->after('device_type');
                $table->string('os')->nullable()->after('browser');
                $table->string('location')->nullable()->after('os');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_downloads', function (Blueprint $table) {
            //
            $table->dropColumn(['device_type', 'browser', 'os', 'location']);
        });
    }
};
