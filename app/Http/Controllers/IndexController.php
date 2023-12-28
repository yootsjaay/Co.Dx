<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use Illuminate\Support\Facades\Response;


class IndexController extends Controller
{
    public function Inicio()
    {
        $empresas = Empresa::all();  // Suponiendo que tengas un modelo Empresa
        return view('Index', compact('empresas'));
    }

    public function Alta(Request $request){
        // Validación de Datos
        $request->validate([
            'nombre' => 'required|max:255',
            'whatsapp_numero' => 'required|max:255',
            'gmail_correo' => 'required|max:255',
            'sat_pdf' => 'required|file|mimes:pdf|max:2048', // Ajusta las reglas de validación según tus necesidades
            'facebook_url' => 'required|max:255',
            'logo_blob' => 'required|file|max:2048',
        ]);
    
        // Obtener el contenido del archivo PDF como blob
        $pdfBlob = file_get_contents($request->file('sat_pdf')->getRealPath());
    
        // Obtener el contenido del archivo de imagen como blob
        $logoBlob = file_get_contents($request->file('logo_blob')->getRealPath());
    
        // Crear nueva empresa en la base de datos
        Empresa::create([
            'nombre' => $request->nombre,
            'whatsapp_numero' => $request->whatsapp_numero,
            'gmail_correo' => $request->gmail_correo,
            'sat_pdf_blob' => $pdfBlob,
            'facebook_url' => $request->facebook_url,
            'logo_blob' => $logoBlob,
        ]);
    
        // Redirecciona a la vista de inicio con un mensaje de éxito
        return redirect()->route('inicio')->with('success', 'Empresa agregada exitosamente');
    }


    public function eliminarFila($id) {
        try {
            // Encuentra la empresa por su ID
            $empresa = Empresa::find($id);
    
            // Verifica si la empresa existe
            if ($empresa) {
                // Elimina la empresa
                $empresa->delete();
    
                // Puedes devolver una respuesta JSON indicando el éxito
                return response()->json(['message' => 'La fila fue dada de baja correctamente']);
            }
    
            // Puedes devolver una respuesta diferente si la empresa no se encuentra
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        } catch (\Exception $e) {
            // Captura cualquier excepción y devuelve una respuesta de error
            return response()->json(['message' => 'Error al eliminar la fila: ' . $e->getMessage()], 500);
        }
    }


    public function visualizarPDF($id)
{
    $empresa = Empresa::find($id);

    if ($empresa && $empresa->sat_pdf_blob) {
        // Configura la respuesta del archivo PDF
        $response = Response::make($empresa->sat_pdf_blob, 200);
        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'inline; filename="archivo.pdf"');

        return $response;
    } else {
        // Maneja el caso en que no haya PDF disponible
        return response()->json(['message' => 'PDF no disponible'], 404);
    }
}
}
