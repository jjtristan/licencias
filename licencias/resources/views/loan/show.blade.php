@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h3>Préstamo</h3>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-warning" href="{{ route('loan.index') }}" role="button">Volver al listado</a>
                    <a class="btn btn-warning" href="{{ route('loan.edit', ['id' => $loan->id]) }}" role="button">Editar</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <p><strong>Licencia:</strong> {{ $loan->license->number }}</p>
                <p><strong>Persona:</strong> {{ $loan->person->first_name }} {{ $loan->person->last_name }}</p>
                <p><strong>Fecha de préstamo:</strong> {{ $loan->loan_date_output }}</p>
                <p><strong>Fecha de devolución:</strong> {{ $loan->giving_back_date_output }}</p>
                <p><strong>Estatus:</strong>
                    @if($loan->giving_back_date_output)
                        Entregado
                    @else
                        Prestado
                    @endif
                </p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3>Licencia</h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-info pull-right" href="{{ route('license.show', ['id' => $loan->license->id]) }}" role="button">Ir a licencia</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <p><strong>Número de expediente:</strong> {{ $loan->license->expedient_number }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Fecha de registro:</strong> {{ $loan->license->register_date_output }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Número de registro:</strong> {{ $loan->license->register_number }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-12">
                        <p><strong>Actividad:</strong> {{ $loan->license->activity->name }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        <p><strong>Dirección:</strong> {{ $loan->license->street->name }} , {{ $loan->license->street_number }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Código Postal:</strong> {{ $loan->license->postcode }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Municipio:</strong> {{ $loan->license->city }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        <p><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Titular:</strong> {{ $loan->license->titular->first_name }} {{ $loan->license->titular->last_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>DNI/CIF:</strong> {{ $loan->license->titular->nif }}</p>
                    </div>
                </div>
            </div>
            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        @if(isset($loan->license->titular->email))
                            <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <strong>Email:</strong> {{ $loan->license->titular->email }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if(isset($loan->license->titular->phone_number))
                            <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>Teléfono:</strong> {{ $loan->license->titular->phone_number }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <p><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <strong>Nombre Archivador:</strong> {{ isset($loan->license->archive->name) ? $loan->license->archive->name : '' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Lugar Archivador:</strong> {{ isset($loan->license->archive->place) ? $loan->license->archive->place : '' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Localización Archivador:</strong> {{ isset($loan->license->archive_location) ? $loan->license->archive_location : '' }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection