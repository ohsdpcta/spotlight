<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDropUniqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('newemail', function (Blueprint $table) {
            Schema::table('newemail', function (Blueprint $table) {
                $table->dropUnique(['email'])->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('newemail', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
}
