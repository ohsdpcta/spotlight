<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->unsignedBigInteger('target_id')->change();
            $table->unsignedBigInteger('follower_id')->change();

            $table->foreign('target_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['target_id', 'follower_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->integer('target_id')->change();
            $table->integer('follower_id')->change();
            $table->dropForeign('target_id');
            $table->dropForeign('follower_id');
            $table->dropUnique(['target_id', 'follower_id']);
        });
    }
}
