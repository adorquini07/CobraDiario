@extends('layouts.main')
@section('title', 'Editar Prestamo')
@section('contenidossss')
<div class="container"><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Editar Prestamo
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('prestamos.update', $prestamo->id) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="id_persona">Persona:</label>
                                <input type="text" name="id" id="id" class="form-control" value="{{ $prestamo->persona->nombre . ' ' . $prestamo->persona->apellido }}" disabled>
                                <input type="hidden" name="id_persona" id="id_persona" value="{{ $prestamo->id_persona }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="monto_prestado">Monto Prestado:</label>
                                <input type="number" name="monto_prestado" id="monto_prestado" class="form-control" value="{{ $prestamo->monto_prestado }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cuota">Cuota:</label>
                                <input type="number" name="cuota" id="cuota" class="form-control" value="{{ $prestamo->cuota }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fecha_prestamo">Fecha de Prestamo:</label>
                                <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" value="{{ $prestamo->fecha_prestamo }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Días a Pagar:</label>
                                @php
                                $dias = [
                                'Lunes' => 'Lunes',
                                'Martes' => 'Martes',
                                'Miércoles' => 'Miércoles',
                                'Jueves' => 'Jueves',
                                'Viernes' => 'Viernes',
                                'Sábado' => 'Sábado',
                                'Domingo' => 'Domingo',
                                ];
                                $seleccionados = json_decode($prestamo->dias_apagar);
                                @endphp

                                @foreach ($dias as $valor => $dia)
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="dias_apagar[]"
                                        value="{{ $valor }}"
                                        id="dia_{{ $valor }}"
                                        {{ in_array($valor, $seleccionados) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="dia_{{ $valor }}">{{ $dia }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="my-2">
                            <button type="submit" class="btn btn-primary">Guardar Prestamo</button>
                            <a href="{{ route('prestamos.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection