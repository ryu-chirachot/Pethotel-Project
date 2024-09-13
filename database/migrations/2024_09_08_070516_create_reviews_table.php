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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('Review_id');
            $table->unsignedBigInteger('BookingOrderID');
            $table->foreign('BookingOrderID')->references('BookingOrderID')->on('bookings')->onDelete('cascade');
            
            $table->text('content');
            $table->unsignedTinyInteger('rating'); // Assuming a rating out of 5
            $table->morphs('reviewable'); // Creates 'reviewable_id' and 'reviewable_type'
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
        Schema::dropIfExists('reviews');
    }
};
