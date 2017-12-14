<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAprendicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aprendices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_completo', 128);
        	$table->string('tipo_documento', 32);
        	$table->bigInteger('numero_documento')->unique()->unsigned();
        	$table->string('direccion', 91);
        	$table->string('barrio', 64);
        	$table->smallInteger('estrato');
        	$table->bigInteger('telefono')->nullable();
        	$table->string('email')->unique();
        	$table->string('programa_formacion', 128);
        	$table->integer('numero_ficha');
        	$table->string('jornada', 32);
        	$table->longText('pregunta1');
        	$table->longText('pregunta3');
        	$table->string('otro_apoyo', 128);
        	$table->string('compromiso_informar', 2)->nullable()->default('no');
        	$table->string('compromiso_normas', 2)->nullable()->default('no');
            $table->longText('justificacion_suplemento');
            $table->longText('novedad_solicitud')->nullable();
            $table->boolean('estado_beneficio')->nullable();
            $table->boolean('estado_solicitud')->nullable();
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
        Schema::dropIfExists('aprendices');
    }
}
