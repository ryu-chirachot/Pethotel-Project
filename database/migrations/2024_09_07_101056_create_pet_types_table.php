<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_type', function (Blueprint $table) {
            $table->unsignedBigInteger('Pet_type_id')->autoIncrement(); // Ensure it is an unsignedBigInteger
            $table->string('Pet_nametype', 60); // Pet type name
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes(); // Adds deleted_at column for soft deletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_type');
    }
};
