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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'auteur
    $table->foreignId('category_id')->constrained()->onDelete('cascade'); // La catégorie
    $table->string('title');
    $table->string('slug', 191)->unique();
    $table->longText('content');
    $table->string('image_cover')->nullable(); // Image principale
    $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
     $table->boolean('is_featured')->default(false);
    $table->integer('views_count')->default(0); // Pour les stats de popularité
   
    $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
