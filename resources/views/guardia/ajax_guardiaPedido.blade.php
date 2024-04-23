@extends('adminlte::page')

@section('title', 'NutriCoc | Guardia')

@section('content_header')

@stop

@section('css')

@stop


@section('content')
    <div class="card">
        <form action="" method="get">
            @csrf
            <div class="card-header">
                @include('layouts.session_message')
                <div class="row">
                    <div class="col">
                        <h3>Solicitar Dieta para Paciente Internado en Guardua</h3>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-body">

            <div class="row">
                <div class="col-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Seleccion del Paciente en Guardia</h3>
                        </div>

                        <form class="form-horizontal">

                            <div class="card-body">
                                <label for="paciente"><p class="text-danger"><small><strong>Ingrese el DNI del paciente, luego haga clic en el paciente indicado</strong></small></p></label>
                                <input type="text" id="paciente" name="paciente" onkeypress="return valideKey(event);"  placeholder="Ingrese Número de Documento Paciente" class="form-control" autocomplete="off" required/>
                            </div>
                            <div class="card-footer">
                                <a href="javascript:close_window();" class="btn btn-danger float-right ml-2"><i class='fas fa-window-close'></i> Cerrar </a>
                                <a href="{{ route('guardiaPedir') }}"  class="btn btn-warning float-right ml-2"><i class='fas fa-sync'></i> Resetear</a>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Dieta Paciente</h3>
                        </div>

                        <form class="form-horizontal" method="post" action="{{ route('obstetriciaPaciente.store') }}">
                            @method('POST')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <input type="text" name="pacsend" id="pacsend" value="">
                                    <div class="col">
                                        <label for="dieta">Dieta</label>
                                        <select name="dieta" id="dieta" class="form-control">

                                            @foreach($dietas as $item)
                                                <option value="{{ $item->id }}">{{ $item->name." ".strip_tags($item->observacion) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="dieta">Frecuencia</label>
                                        <select name="fd" id="fd" class="form-control">

                                            @foreach($frecuencia as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- ./row -->
                                <div class="row">
                                    <div class="col">
                                        <label for="dieta">Colación</label>
                                        <select name="colacion" id="colacion" class="form-control">

                                            @foreach($colacion as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="dieta">Frecuencia</label>
                                        <select name="cf" id="cf" class="form-control">

                                            @foreach($cf as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- ./row -->
                                <div class="row">
                                    <div class="col">
                                        <label for="dieta">Lugar Obstetricia</label>
                                        <select name="lugarg" id="lugarg" class="form-control">
                                            <option value="0|SIN DATO"> ... </option>
                                            @foreach($boxes as $item)
                                                <option value="{{ $item->id_box."|".$item->nombre_box }}">{{ $item->nombre_box }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="dieta">Dieta Acompañante</label>
                                        <select name="dacomp" id="dacomp" class="form-control" required>

                                            @foreach($dietas as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="cacomp">Cantidad</label>
                                        <input type="number" step="1" min="0" max="999" name="cacomp" id="cacomp" class="form-control" value="0">
                                    </div>
                                </div>
                                <!-- row -->
                                <div class="row">
                                    <div class="col">
                                        <label for="observacion">Observación</label>
                                        <textarea id="observacion" name="observacion" class="form-control"></textarea>
                                    </div>
                                </div>
                                <!-- ./row -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="cacomp">Clave Intranet</label>
                                        <input type="password" name="password" id="password" class="form-control text-right" value="" maxlength="8" required>                            </div>

                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class='fas fa-save'></i> Grabar</button>
                            </div>

                        </form>
                    </div>
                </div>{{-- col-8 --}}
            </div>{{-- row --}}
        </div> {{-- card-body --}}
    </div>{{-- card --}}
@stop

@section('js')
    <!-- ajax busqueda paciente -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script type="text/javascript">
        let route = "{{ url('/searchGuardiaPacientes') }}";
        $('#paciente').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
    <!-- js para cerrar la ventana -->
    <script>
        function close_window() {
            if (confirm("Seguro que quieres salir?")) {
                window.close();
            }
        }
    </script>
    <!-- ./envio id para acciones guardia -->
    {{-- solo numeros --}}
    <script src="{{ asset('js/onlynumber.js') }}"></script>
    {{-- message --}}
    <script src="{{ asset('js/close_message_session.js') }}"></script>


@stop

