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
        Schema::create('pets', function (Blueprint $table) {
            $table->id('Pet_id');
            $table->unsignedBigInteger('User_id');
            $table->foreign('User_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('Pet_name', 60);
            $table->unsignedBigInteger('Pet_type_id');
            $table->foreign('Pet_type_id')->references('Pet_type_id')->on('Pet_type')->onDelete('cascade');
            $table->integer('Pet_age');
            $table->string('Pet_breed', 45);
            $table->integer('Pet_weight');
            $table->char('Pet_Gender', 1);
            $table->text('additional_info')->nullable();
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
        Schema::dropIfExists('pets');
    }
};
