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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('book_id')->primary();
            $table->string('book_name', 255)->nullable();
            $table->char('book_isbn', 16)->nullable();
            $table->integer('book_stock')->nullable();
            $table->text('book_description')->nullable();
            $table->string('book_img', 255)->nullable();

            // Foreign Keys
            $table->uuid('book_category_id')->nullable();
            $table->uuid('book_publisher_id')->nullable();
            $table->uuid('book_author_id')->nullable();
            $table->uuid('book_shelf_id')->nullable();

            $table->timestamps();

            // Define Foreign Key Constraints
            $table->foreign('book_category_id')->references('category_id')->on('categories')->onDelete('set null');
            $table->foreign('book_publisher_id')->references('publisher_id')->on('publishers')->onDelete('set null');
            $table->foreign('book_author_id')->references('author_id')->on('authors')->onDelete('set null');
            $table->foreign('book_shelf_id')->references('shelf_id')->on('shelves')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
