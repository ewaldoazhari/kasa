<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->integer('business_category_id')->unsigned()->change();
            $table->foreign('business_category_id')->references('id')->on('business_categories')
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


        Schema::table('businesses', function (Blueprint $table) {
            $table->dropForeign('businesses_business_category_id_foreign');
        });
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropIndex('businesses_business_category_id_foreign');
        });
        Schema::table('businesses', function (Blueprint $table) {
            $table->integer('business_category_id')->change();
        });
    }
}
