<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnLocatesColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locates', function (Blueprint $table) {
            $table->dropColumn('prefecture');
            $table->dropColumn('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locates', function (Blueprint $table) {
            $table->boolean('prefecture')->default(false);
            $table->boolean('city')->default(false);
        });
    }
}
