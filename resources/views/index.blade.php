@extends('biblioteca')
@section('content')

<div class="container mt-2">
    <!-- Barra de Herramientas -->
    <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
        <!-- Barra de Búsqueda -->
        <div class="input-group mr-2">
            <input type="text" id="busqueda" class="form-control" placeholder="Buscar...">
            <div class="input-group-append"></div>
        </div>
    </div> 
    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#altaModal">Altas</button>

              
             
            
    <!-- Tabla Bootstrap -->
    <table class="table table-bordered">
        <!-- Encabezado de la tabla -->
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Logo</th>
                <th scope="col">ID</th>
                <th><img width="48" height="48" src="https://img.icons8.com/color/48/whatsapp--v1.png" alt="whatsapp--v1"/></th>
                <th><img width="50" height="50" src="https://img.icons8.com/ios/50/email-open.png" alt="email-open"/></th>
                <th><img src="./img/sat.png" alt="Logo" width="90" height="auto" class="logo-profesional"></th>
                <th><img width="48" height="48" src="https://img.icons8.com/color/48/facebook-new.png" alt="facebook-new"/></th>
                <th>Acciones</th>
                <th>Accion</th>
                <th><img width="50" height="50" src="https://img.icons8.com/ios/50/total-sales-1.png" alt="total-sales-1"/></th>
                
            </tr>
        </thead>
        <!-- Cuerpo de la tabla -->
        <tbody>
        @foreach($empresas as $empresa)
            <tr>
                <td>{{ $empresa->id }}</td>
                <td><img src="data:image/png;base64,{{ base64_encode($empresa->logo_blob) }}" alt="Logo Empresa" style="max-width: 50px; max-height: 50px;"></td>
                <td>{{ $empresa->nombre }}</td>
                <td>{{ $empresa->whatsapp_numero }}</td>
                <td>{{ $empresa->gmail_correo }}</td>
                <td>
                    @if($empresa->sat_pdf_blob)
                        <a href="{{ route('visualizar_pdf', ['id' => $empresa->id]) }}" target="_blank">Visualizar PDF</a>
                    @else
                        No hay PDF disponible
                    @endif
                </td>
                <td>{{$empresa->facebook_url}}</td>
                <td><button class="btn btn-danger btn-sm" onclick="eliminarFila({{ $empresa->id }})">Bajas</button></td>
                <td>    <button class="btn btn-warning btn-sm">Cambios</button></td>
               
              
      
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal de Altas -->
<div class="modal fade" id="altaModal" tabindex="-1" role="dialog" aria-labelledby="altaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="altaModalLabel">Dar de Alta una Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar nuevas empresas -->
                <form action="{{ route('alta') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Campos de entrada para un nuevo registro -->
                    <div class="form-group">
                        <label for="nombre">Nombre de la empresa:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="whatsapp_numero">Contacto:</label>
                        <input type="text" class="form-control" id="whatsapp_numero" name="whatsapp_numero" required>
                    </div>

                    <div class="form-group">
                        <label for="gmail_correo">Correo Electrónico:</label>
                        <input type="text" class="form-control" id="gmail_correo" name="gmail_correo" required>
                    </div>

                    <div class="form-group">
                        <label for="sat_pdf">SAT PDF:</label>
                        <input type="file" class="form-control-file" id="sat_pdf" name="sat_pdf" accept=".pdf" required>
                    </div>

                    <div class="form-group">
                        <label for="facebook_url">Facebook:</label>
                        <input type="text" class="form-control" id="facebook_url" name="facebook_url" required>
                    </div>

                    <div class="form-group">
                        <label for="logo_blob">Logo:</label>
                        <input type="file" class="form-control-file" id="logo_blob" name="logo_blob" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-success">Agregar Empresa</button>
                </form>
            </div>
        </div>
    </div>
</div>


<footer class="footer mt-5">
    <p>© 2023 CO.DX. Todos los derechos reservados.</p>
</footer>

@endsection
