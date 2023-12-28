<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CO.DX</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel ="stylesheet" href="{{ asset('css/inicio.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
  

    <!-- Enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<!-- HTML sin navbar -->
<div class="container text-right">
    <a href="/">
        <img src="./img/codx.png" alt="Logo" width="90" height="auto" class="logo-profesional">
    </a>
</div>

<!-- Contenido de la vista -->
@yield('content')
<!-- Scripts de Bootstrap (asegúrate de cargar jQuery y Popper.js si es necesario) -->

<!-- Modal -->
<div class="modal fade" id="formaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tabla Forma Pago</h5>
      </div>
      <div class="modal-body">
        <!-- Contenido de la tabla dentro del modal -->
        <table class="table">
          <thead>
            <tr>
              <th>Clave</th>
              <th>Descripción</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>01</td>
              <td>Efectivo</td>
            </tr>
            <tr>
              <td>02</td>
              <td>Cheque Nominativo</td>
            </tr>
            <tr>
              <td>03</td>
              <td>Transferencias Electronica De Fondos</td>
            </tr>
            <tr>
              <td>04</td>
              <td>Targeta De Credito</td>
            </tr>
            <tr>
              <td>28</td>
              <td>Tarjeta de Debito</td>
            </tr>
            <tr>
              <td>29</td>
              <td>Tarjeta De servicios</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>






<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">

</script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>





<script src = "{{asset('js/tablaflotante.js')}}"></script>
<script src="{{asset('js/INPC.js')}}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/inicio.js') }}"></script>

</body>
</html>
