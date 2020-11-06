<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('user_id');
            $table->string('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
