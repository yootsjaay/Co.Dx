<?php

namespace App\Imports;

use App\Models\Pago;
use App\Models\Ingreso;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\ExcelImport;


class IngresosImport implements ToModel
{
    public function model(array $row)
    {  
        try {
            // Verificar si el registro es de tipo "Ingreso"
           if (strtolower($row[5]) === 'ingreso') 
            {
                return new Ingreso([
                    'xml' => $row[0],
                    'rfc_emisor' => $row[1],
                    'nombre_emisor' => $row[2],
                    'rfc_receptor' => $row[3],
                    'nombre_receptor' => $row[4],
                    'tipo' => $row[5],
                    'serie' => $row[6],
                    'folio' => $row[7],
                    'fecha' => Carbon::parse($row[8]),
                    'sub_total' => $row[9],
                    'descuento' => $row[10],
                    'total_impuesto_traladado' => $row[11],
                    'nombre_impuesto_trasladado' => $row[12],
                    'total_impuesto_retenido' => $row[13],
                    'nombre_impuesto_retenido' => $row[14],
                    'total' => $row[15],
                    'uuid' => $row[16],
                    'metodo_de_pago' => $row[17],
                    'forma_de_pago' => $row[18],
                    'moneda' => $row[19],
                    'tipo_de_cambio' => $row[20],
                    'version' => $row[21],
                    'uso_cfdi' => $row[22],
                    'regimen_fiscal' => $row[23],
                    'estado' => $row[24],
                    'estatus' => $row[25],
                    'validacion_efos' => $row[26],
                    'fecha_consulta' => Carbon::parse($row[27]),
                    'conceptos' => $row[28],
                    'relacionados' => $row[29],
                    'traslado_iva_16' => $row[30],
                ]);
          }

           } catch (\Exception $e) {
            // Handle the error, for example, log an error message
            Log::error('Error al importar Ingreso: ' . $e->getMessage());
        }
    }
   
}


