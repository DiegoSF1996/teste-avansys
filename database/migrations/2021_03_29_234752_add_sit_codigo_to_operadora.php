<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSitCodigoToOperadora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operadora', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('sit_codigo')->after('ope_observacao');
            $table->foreign('sit_codigo')->references('sit_codigo')->on('situacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operadora', function (Blueprint $table) {
            //
            $table->dropForeign(['sit_codigo']);
            $table->dropColumn('sit_codigo');
        });
    }
}
