<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * 多対多のリレーションを設定するには、user, user_tag, tagというように、間に中間テーブルが必要になるらしい
     * そのためtagsテーブルに存在するuser_idを削除し、これをuser_tagテーブルに移す
     * 
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropcolumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->string('user_id');
        });
    }
}
