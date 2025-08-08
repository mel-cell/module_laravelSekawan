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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('username', 150)->unique();
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
            $table->rememberToken();
            $table->softDeletes();
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
