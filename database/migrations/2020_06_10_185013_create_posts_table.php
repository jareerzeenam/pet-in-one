<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('price');
            $table->string('location');
            $table->string('description');
            $table->string('phone');
            $table->string('category');
            $table->string('rating')->nullable();
            $table->string('photo')->default('product.png')->nullable();
            $table->string('meeting_date_start')->nullable();
            $table->string('meeting_date_end')->nullable();
            $table->string('meeting_time')->nullable();
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
