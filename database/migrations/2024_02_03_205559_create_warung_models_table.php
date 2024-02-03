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
        Schema::create('tbl_warungs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('motto')->nullable();
            $table->bigInteger('owner')->unsigned();
            //--User Id:
            // $table->foreignId('owner')->constrained('users')->onDelete('cascade');
            $table->foreign('owner')->references('id')->on('users')->onDelete('cascade');
            // $table->string('owner');//--user_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_warungs');
    }
};
