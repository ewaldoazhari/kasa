<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('raw_materials', function (Blueprint $table) {
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
        Schema::table('raw_materials', function (Blueprint $table) {
            $table->dropForeign('raw_materials_outlet_id_foreign');
        });
        Schema::table('raw_materials', function (Blueprint $table) {
            $table->dropIndex('raw_materials_outlet_id_foreign');
        });
        Schema::table('raw_materials', function (Blueprint $table) {
            $table->integer('outlet_id')->change();
        });
    }
}
