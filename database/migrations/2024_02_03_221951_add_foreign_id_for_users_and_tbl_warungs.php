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
        Schema::table('tbl_products', function($table) 
        {
            $table->bigInteger('seller_id')->unsigned()->nullable();
            $table->bigInteger('warung_id')->unsigned()->nullable();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('warung_id')->references('id')->on('tbl_warungs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_products', function (Blueprint $table) {
            $table->dropForeign('tbl_products_seller_id_foreign');
            $table->dropForeign('tbl_products_warung_id_foreign');

        });
    }
};
