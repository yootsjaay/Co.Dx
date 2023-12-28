@extends('biblioteca')

@section('content')
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Éxito:</strong> {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(Session::has('pago_pendiente'))
    <div class="alert alert-info">
        {{ Session::get('pago_pendiente') }}
    </div>
@endif


<div class="container mt-4">
    <h1>NombreEmpresa</h1>
    <h2>CFDI.emitidos</h2>

    <!-- Barra de Herramientas -->
    <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
        <!-- Barra de Búsqueda -->
        <div class="input-group mr-2">
            <input type="text" id="busqueda" class="form-control" placeholder="Buscar...">
            <div class="input-group-append">
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="btn-group" role="group" aria-label="Botones de Acción">
            <button type="button" class="btn btn-success" onclick="enviarADevengacion()">Enviar a Devengación</button>
            <button type="button" class="btn btn-secondary">Descarga Masiva CFDI4</button>
            <button type="button" class="btn btn-warning">Realización</button>
            <button type="button" class="btn btn-info">Póliza</button>
            <button type="button" class="btn btn-secondary" onclick="vistaINPC()">Tabla INPC</button>
            
            
       </div>
<!-- Importar -->
<div class="btn-group ml-auto" role="group" aria-label="Botones de Importar/Exportar">
    <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" accept=".xls, .xlsx" required>
                <label class="custom-file-label">Seleccionar archivo</label>
            </div>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Actualizar los datos</button>
            </div>
        </div>
    </form>
</div>


   
        <table class="table table-bordered border-dark table-sm">
              <thead class="thead-dark">
    <tr>
    <th  data-toggle="tooltip" data-placement="top" title="Se Trata del Folio Interno" scope="col" style="white-space: nowrap;" onclick="sortTable(0)">
    Folio
    <span id="arrow0" class="arrow">&#9650;&#9660;</span>
</th>


        <th   data-toggle="tooltip" data-placement="top" scope="col" title="Se Trata de la Fecha de Timbrado" onclick="sortTable(1)">Fecha
            <span id="arrow1" class="arrow">&#9650;&#9660;</span>
        </th>
        <th  data-toggle="tooltip" data-placement="top" scope="col" title="Nombre Receptor" style="white-space: nowrap;" onclick="sortTable(2)">NombreCliente
            <span id="arrow2" class="arrow">&#9660;&#9650;</span>
        </th>
        <th scope="col" style="white-space: nowrap;">SubTotal
            <span id="arrow3" class="arrow"></span>
        </th>
        <th scope="col" style="white-space: nowrap;" onclick="sortTable(4)">IVA</th>
        <th scope="col" style="white-space: nowrap;" onclick="sortTable(5)">Total</th>
        <th scope="col" style="white-space: nowrap;" onclick="sortTable(6)">CuentaAbono</th>
        <th scope="col" style="white-space: nowrap;" onclick="sortTable(7)">Método</th>
        <th scope="col" style="white-space: nowrap;" data-toggle="modal" data-target="#formaModal"  data-placement="top" title="CLICK PARA VER TABLA">Forma</th>
       <th scope="col"  data-toggle="tooltip" data-placement="top" title=" Captura el número del cheque o de transferencia. Blanco significa que está pendiente capturar esta información.
         En caso de pagos en efectivo u otros, captura la palabra OTROS"
         style="white-space: nowrap; background-color: #fffacd;" onclick="sortTable(9)">Referencia</th>
        <th scope="col"  data-toggle="tooltip" data-placement="top" title=" Captura la fecha de depósito a bancos cuando se trate de CFDI PPD o captura la fecha de cobro en CFDI PUE, aunque no se haya depositado a bancos" style="white-space: nowrap; background-color: #fffacd;" onclick="sortTable(10)">FechaCobro</th>
        <th scope="col"  data-toggle="tooltip" data-placement="top" title="Se trata del folio interno" style="white-space: nowrap;" onclick="sortTable(11)">FolioREP</th>
        <th scope="col"  data-toggle="tooltip" data-placement="top" title="Se trata de la fecha de pago" style="white-space: nowrap;" onclick="sortTable(12)">FechaREP</th>
        <th scope="col" style="white-space: nowrap;">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input seleccionar-todo">
                <label class="custom-control-label" for="seleccionarTodo"></label>
            </div>
        </th>
        </thead>
<tbody>
    @foreach($resultados as $ingreso)
        <tr>
            <td>{{ $ingreso->folio }}</td>
            <td>{{ \Carbon\Carbon::parse($ingreso->Fecha_Ingresos)->format('d-m-Y') }}</td>
            <td style="text-align: left;">{{ ucfirst($ingreso->nombre_receptor) }}</td>
            <td>{{ $ingreso->sub_total }}</td>
            <td>{{ $ingreso->traslado_iva_16 }}</td>
            <td>{{ $ingreso->total }}</td>
            <td>{{$ingreso->cuenta}}</td>
            <td>{{ $ingreso->metodo_de_pago_tres_letras }}</td>
            <td>{{ $ingreso->forma_de_pago }}</td>
            
            <!-- Agregar lógica para la columna Descripción -->
            <td>
               @csrf
                    <input type="text" name="descripcion" placeholder="Escriba aquí">

            </td>
            <!-- Agregar lógica para la columna Fecha cobro -->
            <td>
            @csrf
            <input type="date" name="fechaCobro" required>
        </td>
        <td>{{$ingreso->folio_rep}}</td>
        <td>{{$ingreso->fecha_rep}}</td>

        <td><div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="seleccionar">
            <label class="custom-control-label" for="seleccionar"></label>
        </div>
     </td>
    </tr>
        @endforeach
    </tbody>
</table>
<div id="tooltip" class="tooltip">Detalles de la Forma</div>

</div>
</div>
@endsection