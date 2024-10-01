<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_type', function (Blueprint $table) {
            $table->integer('Pet_type_id',2)->autoIncrement(); 
            $table->string('Pet_nametype', 60); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_type');
    }
};
