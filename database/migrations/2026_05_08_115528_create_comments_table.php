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
        Schema::create('comments', function (Blueprint $table) {
           $table->id();
    $table->foreignId('post_id')->constrained()->onDelete('cascade');
    $table->string('user_name'); // Nom du visiteur
    $table->string('user_email');
    $table->text('content');
    $table->boolean('is_visible')->default(false); // Pour la modération
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
