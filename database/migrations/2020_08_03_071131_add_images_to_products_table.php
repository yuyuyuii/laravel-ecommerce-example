<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('products', function(BluePrint $table){
        $table->text('images')->nullable()->after('image'); //画像を複数枚追加用のカラム
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('products', function(Bluepring $table){
        $table->dropColumn('images');
      });
    }
}
