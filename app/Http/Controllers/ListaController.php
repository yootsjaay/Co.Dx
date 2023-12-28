<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Factura;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Ingreso;
use App\Models\Pago;
use Illuminate\Support\Facades\DB;


class ListaController extends Controller
{
    public function consultarIngresosYPagos(){
    // Ejecutar la consulta SQL
    $resultados = DB::table('Ingresos as i')
        ->leftJoin('Pagos as p', 'i.uuid', '=', 'p.uuid_ingreso')
        ->select(
            'i.folio as Folio_Ingresos',
            DB::raw("DATE_FORMAT(i.fecha, '%d-%m-%Y') as Fecha_Ingresos"),
            'p.folio_pago',
            DB::raw("DATE_FORMAT(p.fecha_pago, '%d-%m-%Y') as fecha_pago"),
            'i.folio',
            DB::raw("CONCAT(UPPER(SUBSTRING(i.nombre_receptor, 1, 1)), LOWER(SUBSTRING(i.nombre_receptor, 2))) as nombre_receptor"), // Capitalizar nombre del receptor
            DB::raw("FORMAT(i.sub_total, 2) as sub_total"), // Formatear sub_total
            //DB::raw("FORMAT(i.total_impuesto_trasladado, 2) as total_impuesto_trasladado"), // Formatear iva
            DB::raw("FORMAT(i.total, 2) as total"), // Formatear total
            'i.metodo_de_pago',
            'i.forma_de_pago',
            'i.traslado_iva_16'
        )->get();

    foreach ($resultados as $ingreso) {
        // Lógica condicional para la columna de Cuenta y Descripción
        if ($ingreso->traslado_iva_16 == 0) {
            $ingreso->cuenta = '404-Actividades 0%';
        } else {
            $ingreso->cuenta = '401-Actividades 16%';
        }
        // Lógica para las columnas de 'folio_rep' y 'fecha_rep'
        if ($ingreso->metodo_de_pago == 'PPD - Pago en parcialidades o diferido' && $ingreso->folio_pago) {
    // Si es PPD y tiene datos, asigna los valores correspondientes
    $ingreso->folio_rep = $ingreso->folio_pago;
    $ingreso->fecha_rep = $ingreso->fecha_pago;
} elseif ($ingreso->metodo_de_pago == 'PUE - Pago en una sola exhibición') {
    // Si es PUE, asigna 'N/A'
    $ingreso->folio_rep = 'N/A';
    $ingreso->fecha_rep = 'N/A';
} else {
    // Si no cumple ninguna de las condiciones anteriores, asigna un mensaje de solicitar
    $ingreso->folio_rep = 'Solicitar';
    $ingreso->fecha_rep = 'Solicitar';
}

  
 $metodo_pago = str_word_count($ingreso->metodo_de_pago, 1);
 $ingreso->metodo_de_pago_tres_letras = implode('', array_slice($metodo_pago, 0, 1));
        

        // Lógica para la columna 'forma_de_pago'
        $palabras_forma_pago = preg_split("/\s+/", $ingreso->forma_de_pago);
        $ingreso->forma_de_pago = implode(' ', array_slice($palabras_forma_pago, 0, 1));
    }

    // Retorna los resultados a la vista
    return view('listar', ['resultados' => $resultados]);
}



    public function DevengacionImprimir(Request $request) {
        /*$filasSeleccionadas = $request->input('filasSeleccionadas');
        $filasSeleccionadas = is_string($filasSeleccionadas) ? explode(',', $filasSeleccionadas) : $filasSeleccionadas;
        $detallesFacturas = Pago::whereIn('Folio', $filasSeleccionadas)->get();
        return view('devengacion', ['detallesFacturas' => $detallesFacturas]);*/

    } 
    public function devengar(Request $request)
    {
        // Validación de datos (puedes ajustar las reglas según tus necesidades)
        $request->validate([
            'filasSeleccionadas' => 'required|array',
            'referencias' => 'required|array',
            'fechas_pago' => 'required|array',
        ]);

        // Obtiene las filas seleccionadas, referencias y fechas de pago del formulario
        $filasSeleccionadas = $request->input('filasSeleccionadas');
        $referencias = $request->input('referencias');
        $fechasPago = $request->input('fechas_pago');

        // Itera sobre las filas seleccionadas y guarda los datos en la base de datos
        foreach ($filasSeleccionadas as $index => $folio) {
            $tuModelo = TuModelo::find($folio);

            if ($tuModelo) {
                $tuModelo->referencia = $referencias[$index];
                $tuModelo->fecha_pago = $fechasPago[$index];
                $tuModelo->save();
            }
        }

        return redirect()->back()->with('success', 'Datos guardados correctamente');
    }

    

}