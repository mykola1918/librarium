<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();  // Auto-incrementing ID
        $table->string('title');
        $table->string('author');
        $table->text('description');
        $table->string('file_path')->nullable();  // Path to the uploaded file
        $table->timestamp('time_uploaded')->nullable();
        $table->timestamp('time_edited')->nullable();
        $table->string('language')->nullable();
        $table->string('file_type')->nullable();
        $table->string('cover_image')->nullable();  // Cover image of the book
        $table->timestamps();  // created_at and updated_at
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
