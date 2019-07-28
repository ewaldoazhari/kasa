<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->change();
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('outlet_id')->unsigned()->change();
            $table->foreign('outlet_id')->references('id')->on('outlets')
                ->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_category_id_foreign');
        });

        Schema::table('products', function (Blueprint $table){
            $table->dropIndex('products_category_id_foreign');
        });

        Schema::table('products', function (Blueprint $table){
            $table->integer('category_id')->change();
        });



        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_outlet_id_foreign');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_outlet_id_foreign');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->integer('outlet_id')->change();
        });
    }
}
