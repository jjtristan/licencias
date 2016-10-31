@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h3>Reparo</h3>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-warning" href="{{ route('objection.index') }}" role="button">Volver al listado</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <p><strong>Primera Posición Persona:</strong> {{$objection->firstPersonPosition->name }}</p>

                @if($objection->secondPersonPosition)
                        <p><strong>Segunda Posición Persona:</strong> {{$objection->secondPersonPosition->name }}</p>
                @endif

                <p><strong>Fecha de reporte:</strong> {{ $objection->report_date_output }}</p>
                <p><strong>Fecha de corrección:</strong> {{ $objection->correction_date_output }}</p>
                @if(env('FILE_UPLOAD'))
                    <p><strong>Fichero:</strong> <a href="{{ route('file.download', ['file' => $objection->file->id]) }}" target="_blank">Descargar {{ $objection->file->filename }}</a></p>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3>Licencia</h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-info pull-right" href="{{ route('license.show', ['id' => $objection->license->id]) }}" role="button">Ir a licencia</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <p><strong>Número de expediente:</strong> {{ $objection->license->expedient_number }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Fecha de registro:</strong> {{ $objection->license->register_date_output }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Número de registro:</strong> {{ $objection->license->register_number }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-12">
                        <p><strong>Actividad:</strong> {{ $objection->license->activity->name }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        <p><strong>Dirección:</strong> {{ $objection->license->street->name }} , {{ $objection->license->street_number }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Código Postal:</strong> {{ $objection->license->postcode }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Municipio:</strong> {{ $objection->license->city }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        <p><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Titular:</strong> {{ $objection->license->titular->first_name }} {{ $objection->license->titular->last_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>DNI/CIF:</strong> {{ $objection->license->titular->nif }}</p>
                    </div>
                </div>
            </div>
            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        @if(isset($objection->license->titular->email))
                            <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <strong>Email:</strong> {{ $objection->license->titular->email }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if(isset($objection->license->titular->phone_number))
                            <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>Teléfono:</strong> {{ $objection->license->titular->phone_number }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <p><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <strong>Nombre Archivador:</strong> {{ isset($objection->license->archive->name) ? $objection->license->archive->name : '' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Lugar Archivador:</strong> {{ isset($objection->license->archive->place) ? $objection->license->archive->place : '' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Localización Archivador:</strong> {{ isset($objection->license->archive_location) ? $objection->license->archive_location : '' }}</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection