<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_type_room_type', function (Blueprint $table) {
            $table->integer('Pet_Room_typeID',5)->autoIncrement(); 
            $table->unsignedInteger('Rooms_type_id',2);
            $table->foreign('Rooms_type_id')->references('Rooms_type_id')->on('rooms_type')->onDelete('cascade');
            
            $table->unsignedInteger('Pet_type_id',2);
            $table->foreign('Pet_type_id')->references('Pet_type_id')->on('pet_type')->onDelete('cascade');
            $table->text('Rooms_type_description'); 
            $table->integer('Room_price'); 
            $table->unsignedBigInteger('ImagesID'); 
            $table->foreign('ImagesID')->references('ImagesID')->on('images')->onDelete('cascade');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_type_room_type');
    }
};
