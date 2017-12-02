<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_historicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aprendiz_id')->unsigned();
            $table->dateTime('fecha');
            $table->foreign('aprendiz_id')->references('id')->on('aprendices')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros_historicos');
    }
}
