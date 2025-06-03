<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role', 20);
            $table->string('name', 100);
            $table->string('surname', 200);
            $table->string('nickname', 100)->nullable()->unique();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('image', 255)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->default(now());
            $table->string('remember_token', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
