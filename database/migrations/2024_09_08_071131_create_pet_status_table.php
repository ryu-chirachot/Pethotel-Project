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
            $table->integer('PetStatusID',5);
            $table->unsignedInteger('BookingOrderID',5);
            $table->foreign('BookingOrderID')->references('BookingOrderID')->on('bookings')->onDelete('cascade');
            $table->text('Report');
            $table->unsignedInteger('Admin_id',7)->nullable();
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
