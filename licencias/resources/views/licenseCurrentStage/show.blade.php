@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h3>Etapa de Licencia</h3>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-warning" href="{{ route('licensecurrentstage.index') }}" role="button">Volver al listado</a>
                    <a class="btn btn-warning" href="{{ route('licensecurrentstage.edit', ['id' => $licenseCurrentStage->id]) }}" role="button">Editar</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <p><strong>Paso:</strong> {{ $licenseCurrentStage->licenseStage->id }}</p>
                <p><strong>Fecha:</strong> {{ $licenseCurrentStage->date_output }}</p>
                <p><strong>Persona:</strong>
                    @if($licenseCurrentStage and $licenseCurrentStage->person)
                        {{ $licenseCurrentStage->person->id}}
                    @endif
                </p>
                <p><strong>Número:</strong> {{ $licenseCurrentStage->number }}</p>
                @if(env('FILE_UPLOAD'))
                    <p><strong>Fichero:</strong> <a href="{{ route('file.download', ['file' => $licenseCurrentStage->file->id]) }}" target="_blank">Descargar {{ $licenseCurrentStage->file->filename }}</a></p>
                @endif
                <p><strong>Reparo:</strong>
                    @if($licenseCurrentStage and $licenseCurrentStage->objection)
                        {{ $licenseCurrentStage->objection->id}}
                    @endif
                </p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3>Licencia</h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-info pull-right" href="{{ route('license.show', ['id' => $licenseCurrentStage->license->id]) }}" role="button">Ir a licencia</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <p><strong>Número de expediente:</strong> {{ $licenseCurrentStage->license->expedient_number }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Fecha de registro:</strong> {{ $licenseCurrentStage->license->register_date_output }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Número de registro:</strong> {{ $licenseCurrentStage->license->register_number }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-12">
                        <p><strong>Actividad:</strong> {{ $licenseCurrentStage->license->activity->name }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        <p><strong>Dirección:</strong> {{ $licenseCurrentStage->license->street->name }} , {{ $licenseCurrentStage->license->street_number }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Código Postal:</strong> {{ $licenseCurrentStage->license->postcode }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Municipio:</strong> {{ $licenseCurrentStage->license->city }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        <p><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Titular:</strong> {{ $licenseCurrentStage->license->titular->first_name }} {{ $licenseCurrentStage->license->titular->last_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>DNI/CIF:</strong> {{ $licenseCurrentStage->license->titular->nif }}</p>
                    </div>
                </div>
            </div>
            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        @if(isset($licenseCurrentStage->license->titular->email))
                            <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <strong>Email:</strong> {{ $licenseCurrentStage->license->titular->email }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if(isset($licenseCurrentStage->license->titular->phone_number))
                            <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>Teléfono:</strong> {{ $licenseCurrentStage->license->titular->phone_number }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <p><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <strong>Nombre Archivador:</strong> {{ isset($licenseCurrentStage->license->archive->name) ? $licenseCurrentStage->license->archive->name : '' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Lugar Archivador:</strong> {{ isset($licenseCurrentStage->license->archive->place) ? $licenseCurrentStage->license->archive->place : '' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Localización Archivador:</strong> {{ isset($licenseCurrentStage->license->archive_location) ? $licenseCurrentStage->license->archive_location : '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

