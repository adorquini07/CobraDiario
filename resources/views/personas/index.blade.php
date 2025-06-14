@extends('layouts.main')
@section('contenido')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Personas
                            <a href="{{ route('personas.create') }}" class="btn btn-success btn-sm float-end">Crear Persona</a>
                        </div>
                        <div class="card-body">
                            @if (session('info'))
                                <div class="alert alert-success">
                                    {{ session('info') }}
                                </div>
                            @endif
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cédula</th>
                                        <th>Celular</th>
                                        <th>Dirección</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($personas as $persona)
                                        <tr>
                                            <td>{{ $persona->nombre }}</td>
                                            <td>{{ $persona->apellido }}</td>
                                            <td>{{ $persona->nuip }}</td>
                                            <td>{{ $persona->telefono }}</td>
                                            <td>{{ $persona->direccion }}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection