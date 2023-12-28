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
        Schema::create('ingresos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('xml')->nullable();
            $table->string('rfc_emisor', 13)->nullable();
            $table->string('nombre_emisor')->nullable();
            $table->string('rfc_receptor', 13)->nullable();
            $table->string('nombre_receptor')->nullable();
            $table->string('tipo', 50)->nullable();
            $table->string('serie', 10)->nullable();
            $table->string('folio', 50)->nullable();
            $table->date('fecha')->nullable();
            $table->decimal('sub_total', 10)->nullable();
            $table->decimal('descuento', 10)->nullable();
            $table->decimal('total_impuesto_trasladado', 10)->nullable();
            $table->string('nombre_impuesto_trasladado', 50)->nullable();
            $table->decimal('total_impuesto_retenido', 10)->nullable();
            $table->string('nombre_impuesto_retenido', 50)->nullable();
            $table->decimal('total', 10)->nullable();
            $table->string('uuid', 36)->nullable()->unique('uuid');
            $table->string('metodo_de_pago', 50)->nullable();
            $table->string('forma_de_pago', 50)->nullable();
            $table->string('moneda', 3)->nullable();
            $table->decimal('tipo_de_cambio', 10)->nullable();
            $table->string('version', 10)->nullable();
            $table->string('uso_cfdi', 50)->nullable();
            $table->string('regimen_fiscal', 50)->nullable();
            $table->string('estado', 50)->nullable();
            $table->string('estatus', 50)->nullable();
            $table->string('validacion_efos', 50)->nullable();
            $table->string('fecha_consulta', 512)->nullable();
            $table->text('conceptos')->nullable();
            $table->text('relacionados')->nullable();
            $table->decimal('traslado_iva_16', 10)->nullable();
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
        Schema::dropIfExists('ingresos');
    }
};
