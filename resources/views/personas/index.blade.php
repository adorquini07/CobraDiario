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
                            <table class="table table-bordered">
                                <thead>
                                    
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection