@extends('layout')
@section('content')
<div class="block">
    <div class="block-content">
        <div ng-app="currentStageApp" ng-controller="currentStageController" ng-cloak>

            {!! Form::hidden('license_id', null, ['ng-model' => 'license.id', 'ng-init' => 'license.id=' . $license->id]) !!}

            {!! Form::hidden('license_stage_id', null, ['ng-model' => 'stageFields.id']) !!}
            
            @if($license->license_status_id != 4)
                @include('licenseCurrentStage.interactive')
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Localizacion</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <ul class="nav nav-tabs" role="tablist" id="location-tabs">
                        <li role="presentation" class="active"><a href="#location-location" aria-controls="location-location" role="tab" data-toggle="tab">Armarios</a></li>
                        <li role="presentation"><a href="#location-library" aria-controls="location-library" role="tab" data-toggle="tab">Libros</a></li>
                        <li role="presentation"><a href="#location-files" aria-controls="location-files" role="tab" data-toggle="tab">Archivo</a></li>
                        <li role="presentation"><a href="#location-prest" aria-controls="location-prest" role="tab" data-toggle="tab">Prestamos</a></li>
                    </ul>
                    <!-- El cuerpo de las pestañas -->
                    <div class="tab-content">
                        <!-- ARMARIOS -->
                        <div role="tabpanel" class="tab-pane active panel panel-body" id="location-location">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                    <strong>Armario: </strong>
                                    <span ng-hide="licenseClosetEdit">@{{ license.closet }}</span>
                                    <span ng-hide="license.closet">Ninguno</span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <span ng-show="licenseClosetEdit">
                                        <select class="form-control pull-left"
                                                ng-model="license.closet"
                                                name="closet"
                                                ng-options="closet for closet in closets">
                                        </select>
                                    </span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <button class="btn btn-warning pull-right" ng-click="licenseClosetEdit=true;license.closet = (license.closet === null ? 'A' : license.closet)" ng-hide="licenseClosetEdit">
                                        Editar
                                    </button>
                                    <button class="btn btn-warning" ng-click="saveLicenseCloset()" ng-show="licenseClosetEdit">
                                        Guardar Cambios
                                    </button>
                                    <button class="btn btn-danger pull-right" ng-click="deleteLicenseCloset()" ng-show="licenseClosetEdit">
                                        Borrar dato
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- LIBROS -->
                        <div role="tabpanel" class="tab-pane active panel panel-body" id="location-library">
                            <div ng-show="license.finished">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <strong>Tomo/Año:</strong>
                                    <span ng-show="licenseVolumeYearEdit || license.volume_year">
                                        <span ng-hide="licenseVolumeYearEdit">@{{ license.volume_year }}</span>
                                        <span ng-show="licenseVolumeYearEdit">
                                            <input class="form-control" name="volume_year" ng-model="license.volume_year">
                                        </span>
                                    </span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn btn-success pull-right" ng-click="licenseVolumeYearEdit=true" ng-hide="license.volume_year">
                                            Archivar
                                        </button>
                                    <span ng-show="licenseVolumeYearEdit || license.volume_year">
                                        <button
                                                class="btn btn-warning pull-right"
                                                ng-click="licenseVolumeYearEdit=true"
                                                ng-hide="licenseVolumeYearEdit">
                                            Editar
                                        </button>
                                        <button class="btn btn-success pull-right" ng-click="saveLicenseVolumeYear()" ng-show="licenseVolumeYearEdit">
                                            Guardar
                                        </button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ARCHIVOS -->
                        <div role="tabpanel" class="tab-pane active panel panel-body" id="location-files">
                            <div ng-show="license.finished">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <span ng-hide="license.on_query">
                                        <button class="btn btn-danger pull-right" ng-click="saveLicenseOnQuery(true)" ng-hide="license.on_query">
                                            Consulta
                                        </button>
                                    </span>
                                    <span ng-show="license.on_query">
                                        <button class="btn btn-success pull-right" ng-click="saveLicenseOnQuery(false)" ng-show="license.on_query">
                                            Devolver a archivo
                                        </button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PRESTAMOS -->
                        <div role="tabpanel" class="tab-pane active panel panel-body" id="location-prest">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
                                    <span ng-show="licenseLoanEdit || license.on_loan">
                                        <strong for="loan_person" ng-show="license.on_loan">Prestado a : </strong> <span ng-hide="licenseLoanEdit">@{{ license.active_loan.person.first_name }} @{{ license.active_loan.person.last_name }} <span ng-show="license.active_loan.person.email"><@{{ license.active_loan.person.email }}></span></span>
                                    </span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
                                    @if($license->license_status_id != 4)
                                        <button class="btn btn-success pull-right" ng-click="licenseLoanEdit=true" ng-hide="licenseLoanEdit || license.on_loan">
                                            Prestar
                                        </button>
                                    @endif
                                    <span ng-show="licenseLoanEdit || license.on_loan">
                                        <button
                                                class="btn btn-warning pull-right"
                                                ng-click="licenseLoanEdit=true"
                                                ng-hide="licenseLoanEdit">
                                            Editar
                                        </button>
                                        <button class="btn btn-success pull-right" ng-click="saveLicenseLoan()" ng-show="licenseLoanEdit && license.active_loan.person.first_name && license.active_loan.person.last_name">
                                            Guardar
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div ng-show="licenseLoanEdit || license.on_loan" class="row">
                                <h4 for="loan_person" ng-hide="license.on_loan">
                                    Prestar a
                                </h4>
                                <input class="form-control" type="hidden" name="person_id" id="active_loan_person_id" ng-model="license.active_loan.person.id">
                                <span ng-if="licenseLoanEdit">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="first_name" class="control-label">
                                                Nombre:
                                            </label>
                                            <input class="form-control" type="text" name="first_name" id="active_loan_first_name" placeholder="Nombre" ng-model="license.active_loan.person.first_name" ng-init="autocompleteLoanPerson()">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="last_name" class="control-label">
                                                Apellidos:
                                            </label>
                                            <input class="form-control" type="text" name="last_name" id="active_loan_last_name" placeholder="Apellidos" ng-model="license.active_loan.person.last_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="email" class="control-label">
                                                Correo electrónico:
                                            </label>
                                            <input type="text" class="form-control" name="email" id="active_loan_email" placeholder="Correo Electrónico" ng-model="license.active_loan.person.email">
                                        </div>
                                    </div>
                                    <div ng-show="license.active_loan.person.first_name && license.active_loan.person.last_name">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="loan_date" class="control-label">
                                                    Fecha de préstamo
                                                </label>
                                                <input name="loan_date" class="form-control"  type="date" ng-model="license.active_loan.loan_date" ng-init="license.active_loan.loan_date = formatDate(license.active_loan.loan_date)">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" ng-hide="licenseLoanDate || license.on_loan">
                                            <div class="form-group">
                                                <button style="margin-top:25px;" class="btn btn-success" ng-click="savePersonDateActiveLoan()" ng-hide="licenseLoanDate || license.on_loan">
                                                    Prestar
                                                </button>
                                            </div>
                                        </div>

                                        <div ng-show="licenseLoanDate || license.on_loan" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="giving_back_date" class="control-label">
                                                    Fecha de devolución
                                                </label>
                                                <input  class="form-control" name="giving_back_date" type="date" ng-model="license.active_loan.giving_back_date" ng-init="license.active_loan.giving_back_date = formatDate(license.active_loan.giving_back_date)">
                                            </div>
                                        </div>
                                        <div ng-show="licenseLoanDate || license.on_loan" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <button style="margin-top:25px;" class="btn btn-danger" ng-click="closeActiveLoan()">
                                                Cerrar préstamo
                                            </button>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>{{ $license->licenseType->name }} {{ $license->number }}/{{ $license->year }}</h3>
                        </div>
                        <div class="col-md-4 text-right">
                            <a class="btn btn-warning" href="{{ route('license.index') }}" role="button">Volver al listado</a>
                            @if($license->license_status_id != 4)
                            <a class="btn btn-warning" href="{{ route('license.edit', ['id' => $license->id]) }}" role="button">Editar</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs" role="tablist" id="license-tabs">
                        <li role="presentation" class="active"><a href="#license-data" aria-controls="license-data" role="tab" data-toggle="tab">Datos</a></li>
                        <li role="presentation"><a href="#license-details" aria-controls="license-details" role="tab" data-toggle="tab">Detalles</a></li>
                        <li role="presentation"><a href="#license-titulars" aria-controls="license-titulars" role="tab" data-toggle="tab">Cambios de titularidad</a></li>
                        <li role="presentation"><a href="#license-denunciations" aria-controls="license-denunciations" role="tab" data-toggle="tab">Denuncias</a></li>
                        <li role="presentation"><a href="#license-avisos" aria-controls="license-avisos" role="tab" data-toggle="tab">Avisos/Alertas</a></li>
                        @if($license->license_status_id != 4)
                        <li role="presentation"><a href="#license-caducidad" aria-controls="license-caducidad" role="tab" data-toggle="tab">Caducidad</a></li>
                        @endif
                        <li role="presentation"><a href="#license-visitas" aria-controls="license-visitas" role="tab" data-toggle="tab">Visitas</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active panel panel-body" id="license-data">
                            <!-- Datos -->
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Número de expediente:</strong> {{ $license->expedient_number }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Fecha de registro:</strong> {{ $license->register_date_output }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Número de registro:</strong> {{ $license->register_number }}</p>
                                </div>

                            </div>
                            <div class="row">
                                @if($license->is_law)
                                    <div class="col-md-4">
                                        <p><strong>Incluida en Ley 12/2012</strong></p>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <p><strong>Actividad:</strong> {{ $license->activity->name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Dirección:</strong> {{ $license->street->name }} , {{ $license->street_number }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><strong>Código Postal:</strong> {{ $license->postcode }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p><strong>Municipio:</strong> {{ $license->city }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Titular:</strong> {{ $license->titular->first_name }} {{ $license->titular->last_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>DNI/CIF:</strong> {{ $license->titular->nif }}</p>
                                </div>
                            </div>
                            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                                <div class="col-md-6">
                                    @if(isset($license->titular->email))
                                    <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <strong>Email:</strong> {{ $license->titular->email }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if(isset($license->titular->phone_number))
                                    <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>Teléfono:</strong> {{ $license->titular->phone_number }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                                <div class="col-md-4">
                                    <p><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <strong>Nombre Archivador:</strong> {{ isset($license->archive->name) ? $license->archive->name : '' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Lugar Archivador:</strong> {{ isset($license->archive->place) ? $license->archive->place : '' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Localización Archivador:</strong> {{ isset($license->archive_location) ? $license->archive_location : '' }}</p>
                                </div>
                            </div>
                            @if($license->licenseType->visit)
                            <div class="row" style="border-top:1px solid lightgrey;padding-top:10px">
                                <div class="col-md-4">
                                    <p><i class="fa fa-arrows" aria-hidden="true"></i> <strong>Visita de ingeniero:</strong></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Estatus:</strong> {{ isset($license->visit_status) ? $license->visit_status : '' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Fecha de visita:</strong> {{ isset($license->visit_date) ? date('d-m-Y', strtotime($license->visit_date)) : '' }}</p>
                                </div>
                            </div>
                            @endif
                            <!-- <p><strong>Finalizado:</strong> {{ isset($license->finished) ?  $license->finished : '' }}</p>
                            <p><strong>Identificador licencia:</strong> {{ isset($license->identifier) ?  $license->identifier : '' }}</p>-->
                        </div>
                        <div role="tabpanel" class="tab-pane panel panel-body" id="license-details">
                            <!-- Detalles -->
                            <div class="list-group">
                                <div class="list-group-item" ng-repeat="value in licenseObject">
                                    <h3>@{{ value.license_stage.name }}</h3>
                                    <div ng-if="value.date">
                                        <p><strong>Fecha:</strong> @{{ value.date | date:'dd-MM-yyyy' }}</p>
                                    </div>
                                    <div ng-if="value.person_id">
                                        <p><strong>Persona:</strong> @{{ value.person.first_name }} @{{value.person.first_name}}</p>
                                    </div>
                                    <div ng-if="value.number">
                                        <p><strong>Número:</strong> @{{ value.number }}</p>
                                    </div>
                                    <div ng-if="value.file_id">
                                        <p><strong>Fichero:</strong> <a ng-href="../file/download/@{{ value.file_id }}" target="_blank">Descargar @{{  value.file.filename }}</a></p>
                                    </div>
                                    <div ng-if="value.objections.length">
                                        <h3>Historico de Reparos</h3>
                                        <table class="table table-hover table-header-bg">
                                            <thead>
                                            <tr>
                                                <th>Reparo</th>
                                                <th>Cargo 1</th>
                                                <th>Cargo 2</th>
                                                <th>Fecha de informe</th>
                                                <th>Fecha de subsanación</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="objection in value.objections">
                                                <td>@{{ objection.id }}</td>
                                                <td>@{{ objection.first_person_position.name }}</td>
                                                <td>@{{ objection.second_person_position.name }}</td>
                                                <td>@{{ objection.report_date | date:'dd-MM-yyyy'}}</td>
                                                <td>@{{ objection.correction_date | date:'dd-MM-yyyy' }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <!-- JGT: Se agregan los nuevos campos-->
                                    <div ng-if="value.proceeds_visit">
                                        <p>
                                            <div ng-switch="value.proceeds_visit">
                                                <div ng-switch-when="1">
                                                    Si
                                                </div>
                                                <div ng-switch-when="0">
                                                    No
                                                </div>
                                                <div ng-switch-default></div>
                                            </div>
                                        </p>
                                    </div>
                                    <div ng-if="value.license_stage.date_firsh_visit">
                                        <br>
                                        <div ng-if="visitObject.length">
                                            <table class="table table-hover table-header-bg">
                                                <thead>
                                                    <tr>
                                                        <th width="15%">Fecha</th>
                                                        <th>Sanción</th>
                                                        <th width="30%">Acta</th>
                                                    </tr>
                                                </thead>
                                                <tbody ng-repeat="visits in visitObject">
                                                    <tr>
                                                        <td>@{{visits.date_visit | date:'dd-MM-yyyy'}}</td>
                                                        <td>@{{visits.sanctions}}</td>
                                                        <td>
                                                            <div ng-switch="@{{visits.act}}">
                                                                <div ng-switch-when="1">Favorable</div>
                                                                <div ng-switch-when="0">Desfavorable</div>
                                                                <div ng-switch-default></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane panel panel-body" id="license-titulars">
                            <!-- Cambios de titularidad -->
                            @if(! is_null($license->identifier))
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-8">
                                            Titulares para {{ $license->licenseType->name }} {{ $license->number }}/{{ $license->year }}
                                        </div>
                                        <div class="col-md-4 text-right">
                                            @if(! $license->titularity_change_active)
                                            <a class="btn btn-warning" href="{{ route('license.titularitychange', ['id' => $license->id]) }}" role="button">Nuevo Cambio de Titularidad</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach($license->titularChanges as $titularChange)
                                <div class="panel-heading"
                                    @if($titularChange->status == "Solicitado")
                                    style="background-color: #f7ecb5;"
                                    @elseif($titularChange->status == "Desistido")
                                    style="background-color: #d9534f;"
                                    @else
                                    style="background-color: #dff0d8;"
                                    @endif
                                    >
                                    <div class="row">
                                        <div class="col-md-2">
                                            <!--Solicitud {{ $titularChange->register_number }}-->
                                        </div>
                                        @if( ! $titularChange->finished)
                                        {!! Form::model($titularChange, array('route' => array('titularitychange.change', $titularChange->id), 'method' => 'put', 'files' => true, 'autocomplete' => 'off')) !!}
                                        <div class="col-md-10 text-right">
                                            <div class="col-md-4 text-right">
                                                {!! Form::label('titular_change_date', 'Fecha del cambio de estado', ['class' => 'control-label']) !!}
                                                {!! Form::date('titular_change_date', new \DateTime()) !!}
                                            </div>
                                            <div class="col-md-6 text-right">
                                                {!! Form::label('titularChange_status', 'Selecciona una estado', ['class' => 'control-label']) !!}
                                                {!! Form::select('titularChange_status', $titularChangeStatuses, $titularChange->status, ['class' => 'form-control', 'placeholder' => 'Selecciona un estado...', 'ng-change' => 'showChangeButton[' . $titularChange->id .'] = true', 'ng-model' => 'titular_change_date[' . $titularChange->id . ']', 'ng-init' => 'titular_change_date[' . $titularChange->id . '] = "' . $titularChange->status . '"']) !!}
                                                {!! Form::button('Cambiar estado', ['class'=> 'btn btn-danger', 'type' => 'submit', 'ng-show' => 'showChangeButton[' . $titularChange->id .']']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <a class="btn btn-warning" href="{{ route('license.titularitychange.edit', ['license_id' => $license->id, 'id' => $titularChange->id]) }}" role="button">Editar</a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="panel panel-body panel-default">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p><strong>Número de registro de entrada:</strong> {{ $titularChange->register_number }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><strong>Fecha de registro:</strong> {{ $titularChange->register_date_output }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><strong>Número de expediente:</strong> {{ $titularChange->expedient_number }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if($titularChange->titularBefore)
                                                <p><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Anterior titular:</strong> {{ $titularChange->titularBefore->first_name}} {{ $titularChange->titularBefore->last_name }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <p><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Nuevo Titular:</strong> {{ $titularChange->titular->first_name }} {{ $titularChange->titular->last_name }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Estado:</strong> {{ isset($titularChange->status) ?  $titularChange->status : '' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                @if(isset($titularChange->finished_date_output) && $titularChange->finished_date_output != "")
                                                <p><strong>Fecha de finalización:</strong> {{ date('Y-m-d', strtotime($titularChange->finished_date_output)) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        @if(env('FILE_UPLOAD'))
                                        @if(isset($titularChange->file->filename))
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><strong>Fichero:</strong><a href="{{ route('file.download', ['file' => $titularChange->file->id]) }}">{{ $titularChange->file->filename }}</a></p>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane panel panel-body" id="license-denunciations">
                            <!-- Denuncias -->
                            @if(! is_null($license->identifier))
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-8">
                                            Denuncias para {{ $license->licenseType->name }} {{ $license->number }}/{{ $license->year }}
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#modal-denuncia" type="button">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Nueva Denuncia
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-hover table-header-bg">
                                    <thead>
                                        <tr>
                                            <th>Número expediente</th>
                                            <th>Fecha de denuncia</th>
                                            <th>Razón</th>
                                            <th>Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody ng-repeat="d in denuncias">
                                        <tr>
                                            <td>@{{d.expedient_number}}</td>
                                            <td>@{{d.register_date | date:'dd-MM-yyyy'}}</td>
                                            <td>@{{d.reason}}</td>
                                            <td>
                                                <div ng-switch on="d.status">
                                                    <div ng-switch-when="Abierta">
                                                        <select ng-model="d.status" name="d.id" class="form-control" ng-change="updateStatus(d)">
                                                            <option data-ng-repeat="record in estatus" value="@{{ record.valor }}"> @{{record.label}}  </option>
                                                        </select>
                                                    </div>
                                                    <div ng-switch-when="Cerrada">  @{{d.status}} </div>
                                                    <div ng-switch-default></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @include('license.exposed.modal2')
                            </div>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane panel panel-body" id="license-avisos">
                            <!-- Avisos/Alertas-->
                            <div class="col-md-12 text-right">
                                <button style="margin-bottom: 10px" class="btn btn-success" data-toggle="modal" data-target="#modal-alert" type="button">
                                <i class="fa fa-plus" aria-hidden="true"></i> Agregar alerta
                                </button>
                            </div>
                            <table class="table table-hover table-header-bg">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Tipo de alerta</th>
                                    </tr>
                                </thead>
                                <tbody ng-repeat="alert in alertTable">
                                    <tr>
                                        <td>@{{alert.title}}</td>
                                        <td>@{{alert.date | date:'dd-MM-yyyy'}}</td>
                                        <td>@{{alert.description}}</td>
                                        <td>@{{alert.type}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @include('license.exposed.modal')
                        </div>
                        @if($license->license_status_id != 4)
                        <div role="tabpanel" class="tab-pane panel panel-body" id="license-caducidad">
                            <!-- Caducidad-->
                            <div class="col-md-12 text-right">
                                <button style="margin-bottom: 10px" class="btn btn-success" type="button" ng-click="caducarlicenciaShow()">
                                <i class="fa fa-plus" aria-hidden="true"></i> Iniciar Caducidad
                                </button>
                            </div>
                            <table class="table table-hover table-header-bg">
                                <thead>
                                    <tr>
                                        <th>Registro interno</th>
                                        <th>Estado</th>
                                        <th>Titular</th>
                                        <th>Actividad</th>
                                        <th>Emplazamiento</th>
                                        <th>Estatus de caducidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody ng-repeat="license in licensesCaducar">
                                    <tr >
                                        <td>@{{ license.register_number }}</td>
                                        <td>@{{ license.license_status.name }}</td>
                                        <td>@{{ license.titular.first_name }} @{{ license.titular.last_name }}</td>
                                        <td>@{{ license.activity.name }}</td>
                                        <td>@{{ license.street.name }}, @{{ license.street_number}} <!-- - @{{ license.city}} @{{ license.postcode}} --></td>
                                        <td>@{{ license.expiration }}</td>
                                        <td>
                                            <a class="btn btn-warning" ng-click="caducarLicenseShow(license.id)" role="button">Caducar</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        <div role="tabpanel" class="tab-pane panel panel-body" id="license-visitas">
                            <!-- Visitas-->
                            @if(! is_null($license->identifier))
                            <div class="col-md-12 text-right">
                                <button style="margin-bottom: 10px" class="btn btn-success" data-toggle="modal" data-target="#modal-visit" type="button">
                                <i class="fa fa-plus" aria-hidden="true"></i> Agregar visita
                                </button>
                            </div>
                            <table class="table table-hover table-header-bg">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Sanción</th>
                                        <th>Acta</th>
                                    </tr>
                                </thead>
                                <tbody ng-repeat="visit in closeVisists">
                                    <tr>
                                        <td>@{{visit.date_visit | date:'dd-MM-yyyy'}}</td>
                                        <td>@{{visit.sanctions}}</td>
                                        <td>
                                            <div ng-switch="@{{visit.act}}">
                                                <div ng-switch-when="1">Favorable</div>
                                                <div ng-switch-when="0">Desfavorable</div>
                                                <div ng-switch-default></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @include('license.exposed.modalVisit')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts_at_body')
<script src="{{ asset('js/license/show.js') }}"></script>
@endsection