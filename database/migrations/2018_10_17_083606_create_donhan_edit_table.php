<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonhanEditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donhangs', function (Blueprint $table) {
            $table->string('tenkh')->after('madonhang');
            $table->string('diachi')->after('tenkh');;
            $table->integer('sodienthoai')->after('diachi');
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
            $table->dropColumn('tenkh');
            $table->dropColumn('diachi');
            $table->dropColumn('sodienthoai');
        });
    }
}
