<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title', 200);
        $table->string('isbn', 13)->unique();
        $table->string('author_name', 150);
        $table->integer('published_year')->nullable();
        $table->boolean('available')->default(true);
        $table->timestamps();
    });
}
};
