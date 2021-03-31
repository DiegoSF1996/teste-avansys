<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescricao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descricao', function (Blueprint $table) {
            $table->bigIncrements('desc_codigo');
            $table->string('desc_descricao', 20);

            $table->unsignedBigInteger('ope_codigo');
            $table->foreign('ope_codigo')->references('ope_codigo')->on('operadora')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('descricao');
    }
}
