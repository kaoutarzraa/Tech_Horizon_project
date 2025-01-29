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
        Schema::create('view_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('article_id')->nullable();
            $table->unsignedInteger('theme_id')->nullable();
            $table->integer('view_count')->default(0);
            $table->timestamp('last_updated')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_statistics');
    }
};
