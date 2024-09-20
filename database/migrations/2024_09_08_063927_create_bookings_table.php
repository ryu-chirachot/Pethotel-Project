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
            $table->id('BookingOrderID');

            $table->unsignedBigInteger('User_id');
            $table->foreign('User_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('Pet_id');
            $table->foreign('Pet_id')->references('Pet_id')->on('pets')->onDelete('cascade');

            $table->unsignedBigInteger('Rooms_id');
            $table->foreign('Rooms_id')->references('Rooms_id')->on('rooms')->onDelete('cascade');

            $table->date('Start_date');
            $table->date('End_date');
            $table->dateTime('Booking_date');
            $table->boolean('Booking_status');
            $table->integer('Price');

            $table->unsignedBigInteger('PaymentMethodID');
            $table->foreign('PaymentMethodID')->references('PaymentMethodID')->on('payment_methods')->onDelete('cascade');            
            $table->dateTime('PaymentDate');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes();
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
