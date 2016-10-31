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
            <p><strong>NIF:</strong> {{ $titular->nif }}</p>
            <p><strong>Nombre:</strong> {{ $titular->first_name }}</p>
            <p><strong>Apellidos:</strong> {{ $titular->last_name }}</p>
            <p><strong>Número de teléfono:</strong> {{ $titular->phone_number }}</p>
            <p><strong>Correo electrónico:</strong> {{ $titular->email }}</p>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Licencia</h3>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-info pull-right" href="{{ route('license.show', ['id' => $titular->license->id]) }}" role="button">Ir a licencia</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-4">
                    <p><strong>Número de expediente:</strong> {{ $titular->license->expedient_number }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Fecha de registro:</strong> {{ $titular->license->register_date_output }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Número de registro:</strong> {{ $titular->license->register_number }}</p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-md-12">
                    <p><strong>Actividad:</strong> {{ $titular->license->activity->name }}</p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-md-6">
                    <p><strong>Dirección:</strong> {{ $titular->license->street->name }} , {{ $titular->license->street_number }}</p>
                </div>
                <div class="col-md-3">
                    <p><strong>Código Postal:</strong> {{ $titular->license->postcode }}</p>
                </div>
                <div class="col-md-3">
                    <p><strong>Municipio:</strong> {{ $titular->license->city }}</p>
                </div>
            </div>
            <div class="col-lg-12" style="border-top:1px solid lightgrey;padding-top:10px">
                <div class="col-md-4">
                    <p><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <strong>Nombre Archivador:</strong> {{ isset($titular->license->archive->name) ? $titular->license->archive->name : '' }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Lugar Archivador:</strong> {{ isset($titular->license->archive->place) ? $titular->license->archive->place : '' }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Localización Archivador:</strong> {{ isset($titular->license->archive_location) ? $titular->license->archive_location : '' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

