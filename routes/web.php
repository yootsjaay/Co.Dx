<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\InpcController;
use App\Http\Controllers\IndexController;


Route::post('/import', [ExcelImportController::class, 'import'])->name('import');

Route::get('/listar', [ListaController::class, 'consultarIngresosYPagos'])->name('views.listar');

Route::post('/devengacion',[ListaController::class,'DevengacionImprimir'])->name('views.devengacion');
 
Route::get('/inpc', [InpcController::class, 'mostrarDatos'])->name('views.inpc');

Route::get('/', [IndexController::class, 'Inicio'])->name('inicio');

Route::post('/alta', [IndexController::class, 'alta'])->name('alta');

Route::get('/visualizar-pdf/{id}', [IndexController::class, 'visualizarPDF'])->name('visualizar_pdf');

Route::delete('/eliminar-fila/{id}',[IndexController::class, 'eliminarFila'])->name('eliminarFila');



