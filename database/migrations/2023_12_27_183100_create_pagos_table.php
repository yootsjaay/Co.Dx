<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('xml')->nullable();
            $table->string('rfc_emisor', 512)->nullable();
            $table->string('nombre_emisor', 512)->nullable();
            $table->string('rfc_receptor', 512)->nullable();
            $table->string('tipo', 512)->nullable();
            $table->string('serie_pago', 512)->nullable();
            $table->string('folio_pago', 512)->nullable();
            $table->date('fecha_emision')->nullable();
            $table->string('uuid_ingreso', 36)->nullable()->unique('uuid_ingreso');
            $table->string('estado', 512)->nullable();
            $table->string('estatus', 512)->nullable();
            $table->string('validacion_efos', 512)->nullable();
            $table->date('fecha_validacion')->nullable();
            $table->decimal('monto_total', 18)->nullable();
            $table->string('moneda', 512)->nullable();
            $table->string('forma_de_pago', 512)->nullable();
            $table->date('fecha_pago')->nullable();
            $table->string('serie_ingreso', 512)->nullable();
            $table->string('folio_ingreso', 512)->nullable();
            $table->decimal('saldo_insoluto', 18)->nullable();
            $table->decimal('imp_pagado', 18)->nullable();
            $table->decimal('imp_saldo_ant', 18)->nullable();
            $table->decimal('parcialidad', 18)->nullable();
            $table->string('metodo_de_pago_dr', 512)->nullable();
            $table->string('moneda_dr', 512)->nullable();
            $table->string('id_documento', 512)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};
