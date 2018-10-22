<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonhangMagiamgiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donhangs', function (Blueprint $table) {
            $table->integer('magiamgias_id')->unsigned()->after('users_id');
            $table->foreign('magiamgias_id')->references('id')->on('magiamgias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donhangs',function(Blueprint $table){
            $table->dropForeign('magiamgias_id'); //
        });
    }
}
