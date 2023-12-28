<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pago
 * 
 * @property int $id
 * @property string|null $xml
 * @property string|null $rfc_emisor
 * @property string|null $nombre_emisor
 * @property string|null $rfc_receptor
 * @property string|null $tipo
 * @property string|null $serie_pago
 * @property string|null $folio_pago
 * @property Carbon|null $fecha_emision
 * @property string|null $uuid_ingreso
 * @property string|null $estado
 * @property string|null $estatus
 * @property string|null $validacion_efos
 * @property Carbon|null $fecha_validacion
 * @property float|null $monto_total
 * @property string|null $moneda
 * @property string|null $forma_de_pago
 * @property Carbon|null $fecha_pago
 * @property string|null $serie_ingreso
 * @property string|null $folio_ingreso
 * @property float|null $saldo_insoluto
 * @property float|null $imp_pagado
 * @property float|null $imp_saldo_ant
 * @property float|null $parcialidad
 * @property string|null $metodo_de_pago_dr
 * @property string|null $moneda_dr
 * @property string|null $id_documento
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Ingreso|null $ingreso
 *
 * @package App\Models
 */
class Pago extends Model
{
	protected $table = 'pagos';

	protected $casts = [
		'fecha_emision' => 'datetime',
		'fecha_validacion' => 'datetime',
		'monto_total' => 'float',
		'fecha_pago' => 'datetime',
		'saldo_insoluto' => 'float',
		'imp_pagado' => 'float',
		'imp_saldo_ant' => 'float',
		'parcialidad' => 'float'
	];

	protected $fillable = [
		'xml',
		'rfc_emisor',
		'nombre_emisor',
		'rfc_receptor',
		'tipo',
		'serie_pago',
		'folio_pago',
		'fecha_emision',
		'uuid_ingreso',
		'estado',
		'estatus',
		'validacion_efos',
		'fecha_validacion',
		'monto_total',
		'moneda',
		'forma_de_pago',
		'fecha_pago',
		'serie_ingreso',
		'folio_ingreso',
		'saldo_insoluto',
		'imp_pagado',
		'imp_saldo_ant',
		'parcialidad',
		'metodo_de_pago_dr',
		'moneda_dr',
		'id_documento'
	];

	public function ingreso()
	{
		return $this->belongsTo(Ingreso::class, 'uuid_ingreso', 'uuid');
	}
}
