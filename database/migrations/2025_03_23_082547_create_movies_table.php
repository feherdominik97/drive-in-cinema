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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->enum('age_rating', [
                'G',
                'PG',
                'PG-13',
                'R',
                'NC-17'
            ]);
            $table->enum('language', [
                'English',
                'Spanish',
                'French',
                'German',
                'Chinese',
                'Japanese',
                'Hindi',
                'Russian',
                'Arabic',
                'Italian',
            ]);
            $table->string('cover_img_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
