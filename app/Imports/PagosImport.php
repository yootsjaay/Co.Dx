<?php

namespace App\Imports;
use App\Models\Pago;
use App\Models\Ingreso;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\ExcelImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class PagosImport implements ToModel
{
    public function model(array $row)
    {
        try {
       
            //verifica si el uui_ingresos existe en la tabla de ingreso 
            $ingresosExists = Ingreso::where('uuid', $row[9])->exists();

            //si el uuid ingreso{} no existe entonces manda un mensaje de solicitar o realizar 
            if(!$ingresosExists){
                $mensaje = 'Favor de realizar el pago: ' . $row[9];
                Log::info($mensaje);
                // Almacena el mensaje en una variable de sesión para mostrarlo en la vista
                Session::flash('pago_pendiente', $mensaje);
                // Actualizar "En espera del pago" en la base de datos utilizando firstOrCreate
            
              Pago::create([
                'uuid_ingreso' => $row[9],
                'estado' => 'En Espera del Pago',
            ]);
  
               return new Pago([
                    'xml' => $row[0],
                    'rfc_emisor' => $row[1],
                    'nombre_emisor' => $row[2],
                    'rfc_receptor' => $row[3],
                    'nombre_receptor' => $row[4],
                    'tipo' => $row[5],
                    'serie_pago' => $row[6],
                    'folio_pago' => $row[7],
                    'fecha_emision' => $row[8],
                    'uuid_ingreso' => $row[9],
                    'estado' => $row[10],
                    'estatus' => $row[11],
                    'validacion_efos' => $row[12],
                    'fecha_validacion' => $row[13],
                    'monto_total' => $row[14],
                    'moneda' => $row[15],
                    'forma_de_pago' => $row[16],
                    'fecha_pago' => $row[17],
                    'serie_ingreso' => $row[18],
                    'folio_ingreso' => $row[19],
                    'saldo_insoluto' => $row[20],
                    'imp_pagado' => $row[21],
                    'imp_saldo_ant' => $row[22],
                    'parcialidad' => $row[23],
                    'metodo_de_pago_dr' => $row[24],
                    'moneda_dr' => $row[25],
               ]);
            }
        } catch (\Exception $e) {
            // Manejar el error, por ejemplo, registrar un mensaje de error
            Log::error('Error al importar Pago: ' . $e->getMessage());
        }
    }
   
}
