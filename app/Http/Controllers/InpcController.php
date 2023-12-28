<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Cache;

class InpcController extends Controller
{
    public function mostrarDatos()
    {
        // Paso 1: Obtener los datos del INPC
        $inpcData = Cache::remember('inpc', 60, function () {
            return $this->obtenerDatosINPC();
        });


        // Paso 2: Mostrar los datos en la vista
        return view('inpc', ['inpcData' => $inpcData]);
    }

    public function obtenerDatosINPC()
    {
        // Configuración de Guzzle
        $client = new Client();
        $response = $client->request('GET', 'https://tools.idconline.mx/indicadores/inpc');
    
        // Obtener el contenido HTML
        $html = $response->getBody()->getContents();
    
        // Crear un objeto Crawler para analizar el HTML
        $crawler = new Crawler($html);
    
        // Extraer los datos de la tabla
        $inpcData = $crawler->filter('table tr')->each(function ($row) {
            // Obtener los datos de cada celda
            return $row->filter('td')->each(function ($cell) {
                return $cell->text();
            });
        });
        // Eliminar la primera fila (encabezados de la tabla)
        array_shift($inpcData);
    
        // Imprimir los datos
        return $inpcData;
    }
    
}
