<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
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
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('employees_outlet_id_foreign');
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->dropIndex('employees_outlet_id_foreign');
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('outlet_id')->change();
        });
    }
}
