<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->integer('employee_id')->unsigned()->change();
            $table->foreign('employee_id')->references('id')->on('employees')
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

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_employee_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('orders_employee_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->integer('employee_id')->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_outlet_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('orders_outlet_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->integer('outlet_id')->change();
        });
    }
}
