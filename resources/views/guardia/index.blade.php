@extends('adminlte::page')

@section('title', 'NutriCoc | Guardia')

@section('content_header')

@stop

@section('css')
    <!-- datatables -->
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.10.24/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.10.24/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- ./datatables -->
@stop


@section('content')
        <div class="card">
            <form action="{{ route('dietaGuardiaFiltrar') }}" method="get">
                @csrf
                <div class="card-header">
                    @include('layouts.session_message')
                    <div class="row">
                        <div class="col">
                            <h3>Listado de Dietas Pacientes en Guardia</h3>
                        </div>
                        <div class="col  d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
                                <i class='fas fa-utensils fa-fw'></i> Pedir Dieta
                            </button>
                        </div>
                        <div class="col-md-2">
                            <labe for="dateSearch">Fecha Buscar</labe>
                            <input type="date" name="dateSearch" id="dateSearch" class="form-control" value="{{ $dateSearch }}">
                        </div>
                        <div class="col-md-2">
                            <label>Accion</label><br>
                            <button type="submit" class="btn btn-info"><i class='fas fa-search-plus'></i> Buscar</button>
                            <a href="{{ route('dietaGuardia') }}" class="btn btn-warning"><i class="fa fa-refresh"></i> Refrescar</a>
                        </div>
                    </div>

                </div>
            </form>
            <div class="card-body">
                <table id="dietas" class="table table-striped table-bordered small" style="width:100%">
                    <thead>
                        <tr>
                            <th>Cocina</th>
                            <th>Guardia</th>
                            <th >Paciente</th>
                            <th >Lugar guardia</th>
                            <th >Lugar Obst</th>
                            <th >Dieta</th>
                            <th >Frec</th>
                            <th >Colación</th>
                            <th >Colacion Frec</th>
                            <th >Acompañante</th>
                            <th >Cant</th>
                            <th >Solicitado Por</th>
                            <th>Hora</th>
                            <th>Est</th>
                            <th>Cocina</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $r)
                            @switch($r->estado_id)
                                @case(1)
                                    @php($color='')
                                    @break
                                @case(2)
                                    @php($color = "color:#000000; background-color:#f5b204")
                                    @break
                                @case(4)
                                    @php($color = "color:#ffffff; background-color:#0cad2d")
                                    @break
                                @default
                                    @php($color = "color:#ffffff; background-color:#de0022")
                                    @break
                            @endswitch

                            <tr style="{{ $color }}">
                                <!-- cocina -->
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            @switch($r->estado_id)
                                                @case(1)
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoCocina(this.id);' id='C|0|{{ $r->id }}' data-toggle='modal' data-target='#modal-lg-clave'><i class='fas fa-check-circle'></i> Cocina|Confirmar Pedido</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoCocina(this.id);' id='A|5|{{ $r->id }}' data-toggle='modal' data-target='#modal-lg-clave'><i class='fas fa-exchange-alt'></i> Cocina|Anular Pedido por Pase</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoCocina(this.id);' id='A|6|{{ $r->id }}' data-toggle='modal' data-target='#modal-lg-clave'><i class='fas fa-door-open'></i> Cocina|Anular Pedido por Alta Paciente</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoCocina(this.id);' id='A|7|{{ $r->id }}' data-toggle='modal' data-target='#modal-lg-clave'><i class='fas fa-notes-medical'></i> Cocina|Anular Pedido por Tratamiento</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='{{ route('logdieta', $r->id) }}' target="_blank"><i class='fas fa-user-secret'></i> Log Dieta</a>
                                                    @break
                                                @case(2)
                                                    <a class="dropdown-item" href="#" onclick='accionPedidoCocina(this.id);' id='E|0|{{ $r->id }}' data-toggle="modal" data-target="#modal-lg-clave"><i class='fas fa-dolly fa-fw'></i> Cocina|Entregar a Guardia</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoCocina(this.id);' id='A|5|{{ $r->id }}' data-toggle='modal' data-target='#modal-lg-clave'><i class='fas fa-exchange-alt'></i> Cocina|Anular Pedido por Pase</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoCocina(this.id);' id='A|6|{{ $r->id }}' data-toggle='modal' data-target='#modal-lg-clave'><i class='fas fa-door-open'></i> Cocina|Anular Pedido por Alta Paciente</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoCocina(this.id);' id='A|7|{{ $r->id }}' data-toggle='modal' data-target='#modal-lg-clave'><i class='fas fa-notes-medical'></i> Cocina|Anular Pedido por Tratamiento</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='{{ route('logdieta', $r->id) }}' target="_blank"><i class='fas fa-user-secret'></i> Log Dieta</a>
                                                    @break
                                                @default
                                                    <a class='dropdown-item' href='{{ route('logdieta', $r->id) }}' target="_blank"><i class='fas fa-user-secret'></i> Log Dieta</a>
                                                    @break
                                            @endswitch


                                        </div>
                                    </div>


                                </td>
                                <!-- guardia intranet -->
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            @switch($r->estado_id)
                                                @case(1)
                                                    <!-- acciones para guardia -->
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoGuardia(this.id);' id='X|0|{{ $r->id }}' data-toggle="modal" data-target="#modal-lg-clave-guardia"><i class='fas fa-trash-alt fa-fw'></i> Guardia|Eliminar Pedido</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoGuardia(this.id);' id='A|5|{{ $r->id }}' data-toggle='modal' data-target='#modal-lg-clave-guardia'><i class='fas fa-exchange-alt'></i> Guardia|Anular Pedido por Pase</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoGuardia(this.id);' id='A|6|{{ $r->id }}' data-toggle='modal' data-target='#modal-lg-clave-guardia'><i class='fas fa-door-open'></i> Guardia|Anular Pedido por Alta Paciente</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='#' onclick='accionPedidoGuardia(this.id);' id='A|7|{{ $r->id }}' data-toggle='modal' data-target='#modal-lg-clave-guardia'><i class='fas fa-notes-medical'></i> Guardia|Anular Pedido por Tratamiento</a><div class='dropdown-divider'></div>
                                                    <a class='dropdown-item' href='{{ route('logdieta', $r->id) }}' target="_blank"><i class='fas fa-user-secret'></i> Log Dieta</a>

                                                    @break
                                                @default
                                                    <a class='dropdown-item' href='{{ route('logdieta', $r->id) }}' target="_blank"><i class='fas fa-user-secret'></i> Log Dieta</a>
                                                    @break
                                            @endswitch
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $r->apenom }}</td>
                                <td>{{ $r->destino_guardia }}</td>
                                <td>{{ $r->destino_obstetricia }}</td>
                                <td>{{ $r->dieta }}</td>
                                <td class="text-center"><i class="{{ $r->frecIcon }} fa-2x" title="{{ $r->dietafrec }}"></i></td>
                                <td class="text-center"><i class="{{ $r->colacionIcon }} fa-2x" title="{{ $r->colacion }}"></i></td>
                                <td>{{ $r->colacionfrec }}</td>
                                <td>{{ $r->dietaAcomp }}</td>
                                <td>{{ $r->cantidad }}</td>
                                <td>{{ $r->nic_intranet }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->created_at)->format('H:i')}} </td>
                                <td class="text-center"><i class="{{ $r->icon }} fa-2x" title="{{ $r->estado }}"></i></td>
                                <td>{{ $r->usuario }}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>

        </div>


<!-- modal validacion cocina -->
        <form action="{{ route('accionPedidoDieta') }}" method="POST">
            @csrf
            @method('POST')
            <div class="modal fade " id="modal-lg-clave">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Validación Usuario cocina</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="keyRegchequear" id="keyRegchequear" >

                            <div class="form-floating">
                                <input type="text" class="form-control text-right" id="dni" name="dni" placeholder="sin puntos, ni comas, solo numeros" maxlength="8" autocomplete="off" required>
                                <label for="floatingInput">Número de Documento</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control text-right" id="clave" name="clave" placeholder="Clave" autocomplete="off" required >
                                <label for="floatingPassword">Clave</label>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fas fa-door-closed fa-fw'></i>Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class='fas fa-user-lock'></i> Validar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!-- ./modal validacion cocina -->

<!-- modal validacion guardia -->
        <form action="{{ route('accionPedidoIntranet') }}" method="POST">
            @csrf
            @method('POST')
            <div class="modal fade " id="modal-lg-clave-guardia">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Validación Usuario Intranet</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="keyRegchequearGuardia" id="keyRegchequearGuardia" >

                            <div class="form-floating">
                                <input type="password" class="form-control text-right" id="claveGuardia" name="claveGuardia" placeholder="Clave" autocomplete="off" required >
                                <label for="floatingPassword">Clave</label>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fas fa-door-closed fa-fw'></i>Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class='fas fa-user-lock'></i> Validar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!-- ./modal validacion guardia -->

@stop



@section('js')
    <!-- envio en id para confirmar -->
    <script>
        function accionPedidoCocina(id){
             document.getElementById('keyRegchequear').value = id;
        }
    </script>
    <!-- envio id para acciones guardia -->
    <script>
        function accionPedidoGuardia(id){
            document.getElementById('keyRegchequearGuardia').value = id;
        }
    </script>
    <!-- ./envio id para acciones guardia -->
    {{-- solo numeros --}}
    <script src="{{ asset('js/onlynumber.js') }}"></script>
    {{-- message --}}
    <script src="{{ asset('js/close_message_session.js') }}"></script>

    <!-- datatable -->
    <script src="{{ asset('DataTables/DataTables-1.10.24/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.24/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.24/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#dietas').DataTable({
                order: [[ 11, "desc" ]],
                responsive:true,
                autoWidth:false,
                pageLength: 25,
                dom: 'B<"clear">lfrtip',

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
            table.buttons().container().appendTo( '#dietas .col-md-6:eq(0)' );
        } );

    </script>
@stop
