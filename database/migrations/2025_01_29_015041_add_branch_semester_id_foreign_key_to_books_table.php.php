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
        Schema::table('books', function (Blueprint $table) {

            $table->unsignedBigInteger('branch_semester_id')->after('id');
            $table->foreign('branch_semester_id')
                        ->references('id')
                        ->on('branch_semester')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['branch_semester_id']);
            $table->dropColumn('branch_semester_id');
        });
    }
};
