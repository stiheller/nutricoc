@extends('adminlte::page')

@section('title', 'NutriCoc | Seguimiento Dieta')

@section('content_header')

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.10.24/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.10.24/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop


@section('content')
        <div class="card">

            <div class="card-body">
                <table id="logs" class="table table-striped table-bordered small" style="width:100%">
                    <thead>
                        <tr>

                            <th >Fecha Hora</th>
                            <th >Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i')}}</td>
                                <td>{{ $log->log }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


@stop



@section('js')

    <!-- datatable -->
    <script src="{{ asset('DataTables/DataTables-1.10.24/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.24/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.24/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('DataTables/pdfmake-0.1.36/pdfmake.js') }}"></script>
    <script src="{{ asset('DataTables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
    <script src="{{ asset('DataTables/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('DataTables/Buttons-1.7.0/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('DataTables/Buttons-1.7.0/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('DataTables/Buttons-1.7.0/js/buttons.print.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#logs').DataTable({
                order: [[ 11, "desc" ]],
                responsive:true,
                autoWidth:false,
                pageLength: 25,
                dom: 'B<"clear">lfrtip',
                buttons: [

                    {
                        extend: 'excelHtml5',
                        text: 'Exportar a Excel',
                        className: 'red',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Generar PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                        }
                    },
                    {
                        extend:    'print',
                        text:      'Imprimir',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                        }

                    },

                ],

                "language": {
                    "lengthMenu": "Mostrando " +
                        `
                        <select class="custom-select custom-select-sm form-control form-control-sm">
                            <option value='10'>10</option>
                            <option value='25'>25</option>
                            <option value='50'>50</option>
                            <option value='100'>100</option>
                            <option value='-1'>Todos</option>
                        </select>
                        `
                        + " registros por pagina",
                    "zeroRecords": "No se encontró nada - lo siento",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate":{
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }

            });
            table.buttons().container().appendTo( '#logs .col-md-6:eq(0)' );
        } );

    </script>
@stop
