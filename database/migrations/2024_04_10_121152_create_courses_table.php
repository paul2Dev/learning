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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('instructor_id');
            $table->text('name')->nullable();
            $table->text('title')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('video')->nullable();
            $table->string('level')->nullable();
            $table->string('duration')->nullable();
            $table->string('resources')->nullable();
            $table->string('certificate')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->text('prerequisites')->nullable();
            $table->string('best_seller')->nullable();
            $table->string('featured')->nullable();
            $table->string('highest_rated')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
