<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditSmallprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('smallprofile', function (Blueprint $table) {
            
            $table->string('scomment')->default('よろしく')->change();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('smallprofile', function (Blueprint $table) {
            $table->string('scomment')->default('aaaaa')->change();
        });
    }
}
