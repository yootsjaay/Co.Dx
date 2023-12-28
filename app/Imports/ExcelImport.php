<?php

namespace App\Imports;

use App\Models\Pago;
use App\Models\Ingreso;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;



class ExcelImport implements WithMultipleSheets
{
   
    public function sheets(): array
    {
 
        return [
           'Sheet1' => new IngresosImport(),
             'RecibosDePago' => new PagosImport(),
         
           
            
        ];
        
    }

   

}
