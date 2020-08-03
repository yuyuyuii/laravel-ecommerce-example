<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('products', function(BluePrint $table){
        $table->string('image')->nullable()->after('featured'); //productテーブルのfeaturedの後に画像のカラムを追加
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
        $table->dropColumn('image');
      });
    }
}
