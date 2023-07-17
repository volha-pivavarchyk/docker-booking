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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('hotel_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->decimal('sales_price', 10, 2);
            $table->decimal('purchase_price', 10, 2);
            $table->date('arrival_date')->nullable();
            $table->date('purchase_day')->nullable();
            $table->integer('nights')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
