@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h3>Titular: {{ $titular->first_name }} {{ $titular->last_name }}</h3>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-warning" href="{{ route('titular.index') }}" role="button">Volver al listado</a>
                    <a class="btn btn-warning" href="{{ route('titular.edit', ['id' => $titular->id]) }}" role="button">Editar</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <p><strong>NIF:</strong> {{ $titular->nif }}</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <p><strong>Nombre:</strong> {{ $titular->first_name }}</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <p><strong>Apellidos:</strong> {{ $titular->last_name }}</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <p><strong>Número de teléfono:</strong> {{ $titular->phone_number }}</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <p><strong>Correo electrónico:</strong> {{ $titular->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3>Licencias</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped table-hover table-header-bg js-dataTable-full-pagination">
                        <thead>
                        <tr>
                            <th>Número de expediente</th>
                            <th>Fecha de registro</th>
                            <th>Número de registro</th>
                            <th>Actividad</th>
                            <th>Archivo</th>
                            <th>Armario</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($titular->licenses as $license)
                            <tr>
                                <td>{{ $license->expedient_number }}</td>
                                <td>{{ $license->register_date_output }}</td>
                                <td>{{ $license->register_number }}</td>
                                <td>{{ $license->activity->name }}</td>
                                <td>{{ isset($license->archive->name) ? $license->archive->name : '' }}</td>
                                <td>{{ isset($license->archive->place) ? $license->archive->place : '' }}</td>
                                <td><a class="btn btn-info pull-right" href="{{ route('license.show', ['id' => $license->id]) }}" role="button">Ir a licencia</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

