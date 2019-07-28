<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outlets', function (Blueprint $table) {
            $table->integer('business_id')->unsigned()->change();
            $table->foreign('business_id')->references('id')->on('businesses')
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
        Schema::table('outlets', function (Blueprint $table) {
            $table->dropForeign('outlets_business_id_foreign');
        });
        Schema::table('outlets', function (Blueprint $table) {
            $table->dropIndex('outlets_business_id_foreign');
        });
        Schema::table('outlets', function (Blueprint $table) {
            $table->integer('business_id')->change();
        });
    }
}
