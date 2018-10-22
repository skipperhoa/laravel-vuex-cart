<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonhangChitietdonhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chitietdonhangs', function (Blueprint $table) {
            $table->integer('donhangs_id')->unsigned()->after('id');
            $table->foreign('donhangs_id')->references('id')->on('donhangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chitietdonhangs',function(Blueprint $table){
            $table->dropForeign('donhangs_id'); //
        });
    }
}
