<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Empresa
 * 
 * @property int $id
 * @property string $nombre
 * @property string $logo_blob
 * @property string|null $facebook_url
 * @property string|null $whatsapp_numero
 * @property string|null $gmail_correo
 * @property string|null $sat_pdf_blob
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Empresa extends Model
{
	protected $table = 'empresas';

	protected $fillable = [
		'nombre',
		'logo_blob',
		'facebook_url',
		'whatsapp_numero',
		'gmail_correo',
		'sat_pdf_blob'
	];
}
