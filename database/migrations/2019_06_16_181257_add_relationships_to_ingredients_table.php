<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->integer('raw_material_id')->unsigned()->change();
            $table->foreign('raw_material_id')->references('id')->on('raw_materials')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('outlet_id')->unsigned()->change();
            $table->foreign('outlet_id')->references('id')->on('outlets')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('product_id')->unsigned()->change();
            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign('ingredients_raw_material_id_foreign');
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropIndex('ingredients_raw_material_id_foreign');
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->integer('raw_material_id')->change();
        });

        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign('ingredients_outlet_id_foreign');
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropIndex('ingredients_outlet_id_foreign');
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->integer('outlet_id')->change();
        });

        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign('ingredients_product_id_foreign');
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropIndex('ingredients_product_id_foreign');
        });
        Schema::table('ingredients', function (Blueprint $table) {
            $table->integer('product_id')->change();
        });
    }
}
