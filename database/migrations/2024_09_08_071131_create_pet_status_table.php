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
        Schema::create('pet_status', function (Blueprint $table) {
            $table->id('PetStatusID');
            $table->unsignedBigInteger('BookingOrderID');
            $table->foreign('BookingOrderID')->references('BookingOrderID')->on('bookings')->onDelete('cascade');
            $table->text('Report');
            $table->string('status')->default('ยังไม่รายงาน');
            $table->unsignedBigInteger('Admin_id');
            $table->foreign('Admin_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('pet_statuses');
    }
};
