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
            $table->text('notes')->nullable()->after('transaction_number');
        });
    }

    /**
     * Reverse the mi//grations.
     */
    public function down(): void
    {
        Schema::table('tbl_orders', function(Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
};
