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
        //
        Schema::dropIfExists('book_downloads');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::create('book_downloads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            $table->string('device_type')->nullable()->after('user_agent');
            $table->string('browser')->nullable()->after('device_type');
            $table->string('os')->nullable()->after('browser');
            $table->string('location')->nullable()->after('os');

            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }
};
