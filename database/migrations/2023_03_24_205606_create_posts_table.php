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
            $table->string('name',100)->nullable()->default('text');/* column:string */
            $table->biginteger('category_id')->unsigned()->nullable();/* column:integer foranea de tabla categories*/
            $table->text('description')->nullable();/* column:text para texarea */
            $table->foreignId('author_id')->constrained('users');/* anexo  autor trabajo final */
            $table->enum('state', ['post', 'no_post'])->default('no_post');/* opciones select */ 
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
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
