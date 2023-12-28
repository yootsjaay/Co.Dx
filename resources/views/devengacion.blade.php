@extends('biblioteca')

@section('content')
<div class="container mt-6">
    <h2 class="text-center mb-4">Detalle Devengacion</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cuenta</th>
                <th>Nombre del Receptor</th>
                <th>Subtotal</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detallesFacturas as $detallesFactura)
                <tr>
                    <td> {{ $detallesFactura->Fecha ? \Carbon\Carbon::parse($detallesFactura->Fecha)->format('d-m-Y') : '' }} </td>
                    <td></td>
                    <td>{{$detallesFactura->NombreReceptor }}</td>
                    <td>{{number_format( $detallesFactura->SubTotal,2) }}</td>
                    
                    <td>{{ number_format ($detallesFactura->Total,2)}}</td>
                    <td>
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
  Devengar
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">DetallesDevengar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-dialog modal-xl">
                <div class="row">
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <td>Fecha</td>
                    <td>{{ $detallesFactura->Fecha ? \Carbon\Carbon::parse($detallesFactura->Fecha)->format('d-m-Y') : '' }}</td>
                </tr>
                <tr>
                    <td>Cuenta</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Nombre del Receptor</td>
                    <td>{{ $detallesFactura->NombreReceptor }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <td>Subtotal</td>
                    <td>{{ number_format($detallesFactura->SubTotal, 2) }}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{ number_format($detallesFactura->Total, 2) }}</td>
                </tr>
                <!-- Puedes agregar más detalles aquí según sea necesario -->
            </table>
        </div>
    </div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">descargas pdf</button>
      </div>
    </div>
  </div>
</div>
</td>
    </tr>
    <tr>
        <td colspan="2"></td>
                   <td></td>
                    <th>IVA :  {{number_format ($detallesFactura->TotalImpuestoTrasladado,2)  }}</th>
                    <th> Total : {{ number_format ($detallesFactura->Total,2) }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center mt-3">
        <button type="button" class="btn btn-primary">Regresar</button>
        <button type="button" class="btn btn-success">Descargar Excel</button>
        <button type="button" class="btn btn-secondary">Descargar PDF</button>
    </div>
</div>
@endsection
