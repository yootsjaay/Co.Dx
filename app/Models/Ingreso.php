<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ingreso
 * 
 * @property int $id
 * @property string|null $xml
 * @property string|null $rfc_emisor
 * @property string|null $nombre_emisor
 * @property string|null $rfc_receptor
 * @property string|null $nombre_receptor
 * @property string|null $tipo
 * @property string|null $serie
 * @property string|null $folio
 * @property Carbon|null $fecha
 * @property float|null $sub_total
 * @property float|null $descuento
 * @property float|null $total_impuesto_trasladado
 * @property string|null $nombre_impuesto_trasladado
 * @property float|null $total_impuesto_retenido
 * @property string|null $nombre_impuesto_retenido
 * @property float|null $total
 * @property string|null $uuid
 * @property string|null $metodo_de_pago
 * @property string|null $forma_de_pago
 * @property string|null $moneda
 * @property float|null $tipo_de_cambio
 * @property string|null $version
 * @property string|null $uso_cfdi
 * @property string|null $regimen_fiscal
 * @property string|null $estado
 * @property string|null $estatus
 * @property string|null $validacion_efos
 * @property string|null $fecha_consulta
 * @property string|null $conceptos
 * @property string|null $relacionados
 * @property float|null $traslado_iva_16
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Pago $pago
 *
 * @package App\Models
 */
class Ingreso extends Model
{
	protected $table = 'ingresos';

	protected $casts = [
		'fecha' => 'datetime',
		'sub_total' => 'float',
		'descuento' => 'float',
		'total_impuesto_trasladado' => 'float',
		'total_impuesto_retenido' => 'float',
		'total' => 'float',
		'tipo_de_cambio' => 'float',
		'traslado_iva_16' => 'float'
	];

	protected $fillable = [
		'xml',
		'rfc_emisor',
		'nombre_emisor',
		'rfc_receptor',
		'nombre_receptor',
		'tipo',
		'serie',
		'folio',
		'fecha',
		'sub_total',
		'descuento',
		'total_impuesto_trasladado',
		'nombre_impuesto_trasladado',
		'total_impuesto_retenido',
		'nombre_impuesto_retenido',
		'total',
		'uuid',
		'metodo_de_pago',
		'forma_de_pago',
		'moneda',
		'tipo_de_cambio',
		'version',
		'uso_cfdi',
		'regimen_fiscal',
		'estado',
		'estatus',
		'validacion_efos',
		'fecha_consulta',
		'conceptos',
		'relacionados',
		'traslado_iva_16'
	];

	public function pago()
	{
		return $this->hasOne(Pago::class, 'uuid_ingreso', 'uuid');
	}
}
