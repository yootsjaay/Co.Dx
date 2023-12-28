<?php

namespace App\Http\Controllers;

use App\Imports\IngresosImport;
use App\Imports\PagosImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Events\AfterImport;

class ExcelImportController extends Controller
{
    public function import(Request $request)
    {
        try {
            // Iniciar transacción de la base de datos
            DB::beginTransaction();

            $file = $request->file('file');
            $updateExisting = $request->input('update_existing', false);

            // Verificar la extensión del archivo permitida
            $allowedExtensions = ['xls', 'csv'];

            $extension = $file->getClientOriginalExtension();
            if (!in_array($extension, $allowedExtensions)) {
                return response()->json(['error' => 'Formato de archivo no válido. Se esperaba un archivo .xls o .csv'], 400);
            }

            // Eliminar datos antiguos y actualizar registros existentes si se selecciona la opción de actualizar
            if ($updateExisting) {
                $this->deleteAndInsertData(new PagosImport, $file, 'pagos');
                $this->updateOrInsertData(new IngresosImport, $file, 'ingresos', 'uuid');
                $this->updateOrInsertPagosData(new PagosImport, $file, 'pagos','uuid');
            } else {
                // Importar todas las hojas desde Excel utilizando la clase ExcelImport
                Excel::import(new ExcelImport, $file);
            }

            // Confirmar transacción
            DB::commit();

            // Respuesta de éxito
            return response()->json(['message' => 'Importación completada exitosamente']);
        } catch (\Exception $e) {
            // Deshacer transacción en caso de error
            DB::rollBack();

            // Respuesta de error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function deleteAndInsertData($import, $file, $table)
    {
        // Eliminar datos antiguos de la tabla
        DB::table($table)->delete();

        // Importar datos utilizando la clase de importación específica
        Excel::import($import, $file);
    }

    private function updateOrInsertData($import, $file, $table, $uniqueKey)
    {
        $data = Excel::toArray($import, $file)[0];

        foreach ($data as $row) {
          
            //Realizar la insercion o actulizacion de la base de datos 
            DB::table($table)->updateOrInsertData([$uniqueKey=>$row[$uniqueKey]], $row);

          
        }

    }

    private function updateOrInsertPagosData($import, $file,$table,$uniqueKey)
    {
        $data= Excel::toArray($import, $file)[1]; //la hoja de pagos es la segunda hoja (indice 1 ).

        foreach ($data as $row){
            //verifica si existe la columna correspondiente en la tabla 
            $ingresoExists = DB::table('ingresos')->where('uuid', $row[16])->exists(); 
        
        if(!$ingresoExists){
            $row[16]=null;

        }
        //convertir fecha_pago a un formato valido



        //Realizar la insercion o actulizacion en la base de datos 
        DB::table($table)->updateOrInser([$uniqueKey=>$row[$uniqueKey]],$row);
    
        }
    }
}

