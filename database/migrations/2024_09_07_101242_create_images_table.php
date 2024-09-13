<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id('ImagesID'); // Primary key
            $table->string('ImagesName', 100); // Image name
            $table->string('ImagesPath', 255); // Image path
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes(); // Adds deleted_at column for soft deletes
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
