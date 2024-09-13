<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms_type', function (Blueprint $table) {
            $table->unsignedBigInteger('Rooms_type_id')->autoIncrement(); // Ensure it is an unsignedBigInteger
            $table->string('Rooms_type_name', 60); // Room type name
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes(); // Adds deleted_at column for soft deletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms_type');
    }
};
