<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained('album');
            $table->foreignId('location_id')->constrained('location');
            $table->foreignId('member_id')->constrained('member');
            $table->foreignId('user_id')->constrained('users');
            $table->string('title', 120);
            $table->string('description', 255);
            $table->string('privacy', 20);
            $table->dateTime('uploaddate', 0);
            $table->integer('view');
            $table->string('imagepath', 50);
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
        Schema::dropIfExists('photo');
    }
}
