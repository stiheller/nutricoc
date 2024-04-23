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
                        <h3>Solicitar Dieta Paciente Internado en Guardia</h3>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-body">

            <div class="row">
                <div class="col-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Seleccion del Paciente</h3>
                        </div>

                        <form class="form-horizontal"  action="{{ route('guardiaPedir') }}" method="GET">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="dni" class="col-sm-3 col-form-label">DNI</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese DNI" value="{{ $dni  }}" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="paciente" class="col-sm-3 col-form-label">Paciente</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="paciente" value="{{ $apenom  }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Fecha Nac" class="col-sm-3 col-form-label">HC</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Fecha Nac" value="{{ $hc  }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Fecha Nac" class="col-sm-3 col-form-label">FN</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Fecha Nac" value="{{ $fechanac  }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">

                                <a href="javascript:close_window();" class="btn btn-danger float-right ml-2"><i class='fas fa-window-close'></i> Cerrar</a>
                                <a href="{{ route('guardiaPedir') }}"  class="btn btn-warning float-right ml-2"><i class='fas fa-sync'></i> Resetear</a>
                                <button type="submit" class="btn btn-info float-right"><i class='fas fa-search'></i> Buscar Paciente</button>

                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Dieta Paciente</h3>
                        </div>

                        <form class="form-horizontal" method="post" action="{{ route('grabarPedidoGuardia') }}">
                            @method('POST')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="pacsend" id="pacsend" value="{{ $dni."|".$apenom }}">
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
                                        <label for="dieta">Lugar Guardia</label>
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

                            <div class="card-footer pull-right text-right">
                                <input class="btn btn-success" onclick="this.disabled=true;this.value='Enviando.. .';this.form.submit();" name="commit" value="Enviar Pedido" type="submit">
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">

        </div>

    </div>
@stop

@section('js')
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

