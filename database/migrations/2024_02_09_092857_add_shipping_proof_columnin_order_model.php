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
        Schema::table('tbl_orders', function (Blueprint $table) {
            $table->text('shipping_proof')->nullable()->after('shipping_resi');
        });
    }

    /**
     * Reverse the mi//grations.
     */
    public function down(): void
    {
        Schema::table('tbl_orders', function(Blueprint $table) {
            $table->dropColumn('shipping_proof');
        });
    }
};
