@extends('biblioteca')
@section('content')

<body>
    <h1>INPC (Índice Nacional de Precios al Consumidor) </h1>

    @if(!empty($inpcData))
        <table   class="table table-bordered border-dark">
            <thead>
                <tr>
                    <th>Año</th>
                    <th>Enero</th>
                    <th>Febrero</th>
                    <th>Marzo</th>
                    <th>Abril</th>
                    <th>Mayo</th>
                    <th>Junio</th>
                    <th>Julio</th>
                    <th>Agosto</th>
                    <th>Septiembre</th>
                    <th>Octubre</th>
                    <th>Noviembre</th>
                    <th>Diciembre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inpcData as $row)
                    @if(count($row) == 13) {{-- Asegúrate de que hay 13 elementos en el array --}}
                        <tr>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }}</td>
                            <td>{{ $row[2] }}</td>
                            <td>{{ $row[3] }}</td>
                            <td>{{ $row[4] }}</td>
                            <td>{{ $row[5] }}</td>
                            <td>{{ $row[6] }}</td>
                            <td>{{ $row[7] }}</td>
                            <td>{{ $row[8] }}</td>
                            <td>{{ $row[9] }}</td>
                            <td>{{ $row[10] }}</td>
                            <td>{{ $row[11] }}</td>
                            <td>{{ $row[12] }}</td> {{-- Añade esta línea para mostrar el último dato --}}
                        </tr>
                    @else
                        <tr>
                            <td colspan="13">Datos incompletos para este año</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table> 
    @else
        <p>No hay datos disponibles.</p>
    @endif

</body>
@endsection
