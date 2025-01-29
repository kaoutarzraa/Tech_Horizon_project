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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image_url');
            $table->unsignedBigInteger('theme_id')->nullable();
            $table->unsignedBigInteger('issue_id')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->enum('status', ['propose', 'en_cours', 'retenu', 'publie', 'refuse']);
            $table->timestamp('submission_date')->useCurrent();
            $table->timestamp('publication_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('theme_id')->references('id')->on('themes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('issue_id')->references('id')->on('issues')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
