@extends('layouts.main')
@section('contenidossss')
<div class="container"><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Editar Persona
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
                    <form action="{{ route('personas.update', $persona->id) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombres:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $persona->nombre }}">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellidos:</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $persona->apellido }}">
                        </div>
                        <div class="form-group">
                            <label for="cedula">Cédula:</label>
                            <input type="text" name="nuip" id="nuip" class="form-control" value="{{ $persona->nuip }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Celular:</label>
                            <input type="number" name="telefono" id="telefono" class="form-control" value="{{ $persona->telefono }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $persona->direccion }}">
                        </div>
                        <div class="my-2">
                            <button type="submit" class="btn btn-primary">Actualizar Persona</button>
                            <a href="{{ route('personas.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection