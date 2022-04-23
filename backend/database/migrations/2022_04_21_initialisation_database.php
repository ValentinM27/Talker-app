<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migration
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('label', 30);

            $table->timestamps();
        });

        Schema::create('suscribes', function (Blueprint $table) {
            $table->uuid('id_category');
            $table->uuid('id_user');

            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['id_category', 'id_user']);

            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('content', 255);

            $table->uuid('id_category');
            $table->uuid('id_user');

            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('content', 255);

            $table->uuid('id_post');
            $table->uuid('id_user');

            $table->foreign('id_post')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }
};