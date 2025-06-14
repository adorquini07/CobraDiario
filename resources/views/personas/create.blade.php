@extends('layouts.main')
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Crear Persona
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombres:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellidos:</label>
                            <input type="text" name="apellido" id="apellido" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cedula">Cédula:</label>
                            <input type="text" name="cedula" id="cedula" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Celular:</label>
                            <input type="number" name="celular" id="celular" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" class="form-control">
                        </div>
                        <div class="my-2">
                            <button type="submit" class="btn btn-primary">Guardar Persona</button>
                            <a href="{{ route('personas.index') }}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection