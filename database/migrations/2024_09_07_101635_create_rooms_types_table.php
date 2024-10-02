<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms_type', function (Blueprint $table) {
            $table->integer('Rooms_type_id')->autoIncrement(); 
            $table->string('Rooms_type_name', 60); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms_type');
    }
};
