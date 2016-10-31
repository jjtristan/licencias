@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-4">
                    <h3>Denuncia</h3>
                </div>
                <div class="col-md-8 text-right">
                    <a class="btn btn-warning" href="{{ route('denunciation.index') }}" role="button">Volver al listado</a>
                    <a class="btn btn-warning" href="{{ route('license.show', ['id' => $denunciation->license->id]) }}" role="button">Volver a la licencia</a>
                    <a class="btn btn-warning" href="{{ route('denunciation.edit', ['id' => $denunciation->id]) }}" role="button">Editar</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <p><strong>Fecha de registro:</strong> {{ $denunciation->register_date_output }}</p>
                <p><strong>Número de expediente:</strong> {{ $denunciation->expedient_number }}</p>

                @if($denunciation->reason)
                    <p><strong>Reason:</strong> {{ $denunciation->reason }}</p>
                @endif

                @if(env('FILE_UPLOAD'))
                    <p><strong>Fichero:</strong> <a href="{{ route('file.download', ['file' => $denunciation->file->id]) }}" target="_blank">Descargar {{ $denunciation->file->filename }}</a></p>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3>Licencia</h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a class="btn btn-info pull-right" href="{{ route('license.show', ['id' => $denunciation->license->id]) }}" role="button">Ir a licencia</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <p><strong>Número de expediente:</strong> {{ $denunciation->license->expedient_number }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Fecha de registro:</strong> {{ $denunciation->license->register_date_output }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Número de registro:</strong> {{ $denunciation->license->register_number }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-12">
                        <p><strong>Actividad:</strong> {{ $denunciation->license->activity->name }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        <p><strong>Dirección:</strong> {{ $denunciation->license->street->name }} , {{ $denunciation->license->street_number }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Código Postal:</strong> {{ $denunciation->license->postcode }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Municipio:</strong> {{ $denunciation->license->city }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        <p><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Titular:</strong> {{ $denunciation->license->titular->first_name }} {{ $denunciation->license->titular->last_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>DNI/CIF:</strong> {{ $denunciation->license->titular->nif }}</p>
                    </div>
                </div>
            </div>
            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                <div class="col-lg-12">
                    <div class="col-md-6">
                        @if(isset($denunciation->license->titular->email))
                            <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <strong>Email:</strong> {{ $denunciation->license->titular->email }}</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if(isset($denunciation->license->titular->phone_number))
                            <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>Teléfono:</strong> {{ $denunciation->license->titular->phone_number }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                <div class="col-lg-12">
                    <div class="col-md-4">
                        <p><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <strong>Nombre Archivador:</strong> {{ isset($denunciation->license->archive->name) ? $denunciation->license->archive->name : '' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Lugar Archivador:</strong> {{ isset($denunciation->license->archive->place) ? $denunciation->license->archive->place : '' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Localización Archivador:</strong> {{ isset($denunciation->license->archive_location) ? $denunciation->license->archive_location : '' }}</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

