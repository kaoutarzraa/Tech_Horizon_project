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
        Schema::create('article_ratings', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('article_id');
            $table->integer('rating')->check('rating >= 1 AND rating <= 5')->nullable();
            $table->timestamp('rating_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_ratings');
    }
};
