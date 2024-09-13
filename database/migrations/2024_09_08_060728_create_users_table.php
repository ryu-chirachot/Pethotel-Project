<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_pethotel', function (Blueprint $table) {
            $table->id('User_id');
            $table->string('Name', 100);
            $table->string('User_email', 225)->unique();
            $table->string('User_password', 255);
            $table->char('Tel', 10);
            $table->char('User_Role', 2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes(); // Adds deleted_at column for soft deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
