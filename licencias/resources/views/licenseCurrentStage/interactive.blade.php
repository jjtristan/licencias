
<div class="panel panel-default" ng-show="license.identifier === null && (license.license_status_id == {!! $reopenStatus->id !!} || license.license_status_id == {!! $initialStatus->id !!})" style="background-color:aliceblue">
        <div class="row">
            <div class="col-lg-12" style="padding-top:8px">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding-top:8px">
                    {!! Form::label('rejectReason', 'Razón', ['class' => 'control-label']) !!}
                </div>
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-inline form-group">
                        {!! Form::text('rejectReason', null, ['class' => 'form-control', 'id' => 'reason', 'placeholder' => 'Razón para rechazar la licencia', 'ng-model' => 'rejectReason', 'ng-change' => 'rejectActionButton = rejectReason.length ? (rejectAction.length ? true : false) : false']) !!}
                        {!! Form::select('rejectAction', $rejectStatuses, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un tipo de rechazo', 'ng-model' => 'rejectAction', 'ng-change' => 'rejectActionButton = rejectReason.length ? (rejectAction.length? true : false) : false', 'ng-init' => 'rejectAction="' . (($license->license_status_id == $initialStatus->id) || ($license->license_status_id == $reopenStatus->id)) ? null : $license->license_status_id . '"']) !!}
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <button class="btn btn-danger" type="button" ng-click="changeStatusLicense()" ng-show="rejectActionButton">Rechazar Licencia</button>
                </div>
            </div>
        </div>
</div>

@if($license->license_status_id === 1 || $license->license_status_id === 2)
<div class="panel panel-default" ng-show="license.identifier !== null && (license.license_status_id != {!! $reopenStatus->id !!} && license.license_status_id != {!! $initialStatus->id !!})" style="background-color:aliceblue">
    <div class="row">
        <div class="col-lg-12" style="padding-top:8px">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="padding-top:8px">
                {!! Form::label('successReason', 'Razón', ['class' => 'control-label']) !!}
            </div>
            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                <div class="form-inline form-group">
                    {!! Form::text('successReason', null, ['class' => 'form-control', 'id' => 'reason', 'placeholder' => 'Razón para cambiar el estado', 'ng-model' => 'successReason', 'ng-change' => 'successActionButton = successReason.length ? (successAction.length? true : false) : false']) !!}
                    {!! Form::select('successAction', $successStatuses, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un estado', 'ng-model' => 'successAction', 'ng-change' => 'successActionButton = successReason.length ? (successAction.length? true : false) : false', 'ng-init' => 'successAction="' . $license->license_status_id . '"']) !!}
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <button class="btn btn-danger" type="button" ng-click="changeStatusLicense()" ng-show="successActionButton">Cambiar estado</button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="panel panel-default" ng-show="license.finished" style="background-color:wheat">
    <div class="row" style="margin:10px">
        <div class="col-md-6 text-left">
            <h2 ng-show="license.identifier !== null">Número de licencia: @{{ license.identifier }}</h2>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-danger" type="button" ng-click="openLicense()">Reabrir Licencia</button>
        </div>
    </div>
    
    <div class="row" style="margin:10px">
        @if($license->licenseType->visit)
            <div class="col-md-6 ">
                <div class="form-group">
                    {!! Form::label('visit_date', 'Fecha de visita', ['class' => 'control-label']) !!}
                    @if(isset($license->visit_date))
                        {!! Form::date('visit_date', $license->visit_date, ['class' => 'form-control', 'ng-model' => 'visitDate', 'ng-init' => 'visitDate="' . $license->visit_date . '"']) !!}
                    @else
                        {!! Form::date('visit_date', \Carbon\Carbon::now(), ['class' => 'form-control', 'ng-model' => 'visitDate', 'ng-init' => 'visitDate="' . $license->visit_date . '"']) !!}
                    @endif
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="form-group">
                    {!! Form::label('visit_status', 'Selecciona una estado de la visita', ['class' => 'control-label']) !!}
                    {!! Form::select('visit_status', $visitStatuses, null, ['class' => 'form-control', 'placeholder' => 'Selecciona un estado de la visita', 'ng-model' => 'visitStatus', 'ng-change' => 'saveVisitStatus()', 'ng-init' => 'visitStatus="' . $license->visit_status . '"']) !!}

                </div>
            </div>
            <div class="col-md-4 ">
                <div class="form-group">
                    <button class="btn btn-warning" type="button" ng-show="saveVisitButton">Salvando</button>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="panel panel-default" ng-hide="license.finished">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <h3>Licencia @{{ license.number }}/@{{ license.year }}</h3>
            </div>
        </div>
    </div>

    <div class="panel-body" ng-show="requiredFields.length">
        <div class="btn-group" role="group" style="margin-bottom:10px; margin-left:10px;" ng-repeat="requiredField in requiredFields">
                <button type="button" class="btn btn-danger" ng-click="goToStage(requiredField.id)"  >
                Error: @{{ requiredField.field }} en @{{ requiredField.stage }} vacío
                </button>
        </div>
    </div>

    <div id="stage-form" class="panel-body">
        <span ng-init="initArry('{{ $license->licenseCurrentStages }}')"></span>
        @foreach($license->licenseCurrentStages as $currentStage)
            <div class="btn-group" role="group" style="margin-bottom:10px;">
                <button type="button" id="{{ $currentStage->license_stage_id }}" class="btn"
                        ng-class="{ 'btn-default' : requiredStages[{{ $currentStage->license_stage_id }}],
                                    'btn-success' : !requiredStages[{{ $currentStage->license_stage_id }}],
                                    'current-stage' : stageData.license_stage_id == {{ $currentStage->license_stage_id }},
                                    'other-stage' : stageData.license_stage_id != {{ $currentStage->license_stage_id }} }"
                        ng-click="goToStage({{ $currentStage->license_stage_id }})">{{ $currentStage->licenseStage->name }}</button>
            </div>
        @endforeach
    </div>

    <div class="panel-body">
        <div class="block block-themed" style="border: 1px #F0F0F0 solid">
            <div class="block-header bg-info" style="background-color: #44b4a6">
                <h3 class="block-title" ng-show="stageFields.id">@{{ stageFields.name }}</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group" ng-class="stageError.date ? 'has-error' : ''" ng-show="stageFields.date">
                                {!! Form::label('date', 'Fecha', ['class' => 'control-label']) !!}
                                {!! Form::date('date', null, [ 'class' => 'form-control' , 'ng-model' => 'stageData.date', 'ng-change' => 'stageSave = true']) !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group" ng-class="stageError.person_id ? 'has-error' : ''" ng-show="stageFields.person">
                                {!! Form::label('person_id', 'Selecciona una persona', ['class' => 'control-label']) !!}
                                <select class="form-control" id="person_id" name="person_id"
                                        ng-model="stageData.person_id" ng-change="stageSave = true"
                                        convert-to-number>
                                    <option value="">Selecciona una persona...</option>
                                    <option ng-repeat="per in people" value="@{{ per.id }}"
                                            ng-selected="@{{per.id == stageData.person_id}}">
                                        @{{ per.first_name }} @{{ per.last_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group" ng-class="stageError.number ? 'has-error' : ''" ng-show="stageFields.number">
                                {!! Form::label('number', 'Número', ['class' => 'control-label']) !!}
                                {!! Form::text('number', null, ['class' => 'form-control', 'id' => 'number_input', 'placeholder' => 'Número', 'ng-model' => 'stageData.number', 'ng-change' => 'stageSave = true']) !!}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <!-- JGT: Se agrega el nuevo campo procede visita-->
                            <div class="form-group" ng-class="stageError.proceeds_visit ? 'has-error' : ''" ng-show="stageFields.proceeds_visit">
                                {!! Form::label('proceeds_visit', '¿Procede visita?', ['class' => 'control-label']) !!} <br>
                                {!! Form::select('act', ['true' => 'Si', 'false' => 'No'], null, ['class' => 'form-control', 'ng-model' => 'stageData.proceeds_visit', 'ng-change' => 'stageSave = true', 'placeholder' => 'Respuesta..']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <!-- JGT: Campo de fecha de primera visita -->
                            <div class="col-lg-12" ng-show="stageFields.date_firsh_visit">

                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group" ng-class="stageError.date_firsh_visit ? 'has-error' : ''">
                                    {!! Form::label('date_firsh_visit', 'Fecha de visita', ['class' => 'control-label']) !!}
                                    {!! Form::date('date_firsh_visit', null, ['class' => 'form-control', 'ng-model' => 'visit.date_visit']) !!}
                                </div>

                                <!-- JGT: Campo de acta -->
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 form-group" ng-class="stageError.act ? 'has-error' : ''" >
                                    {!! Form::label('act', 'Tipo de acta:', ['class' => 'control-label']) !!}
                                    {!! Form::select('act', ['1' => 'Favorable', '0' => 'Desfavorable'], null, ['class' => 'form-control', 'ng-model' => 'visit.act', 'placeholder'=> 'Selecciona...']) !!}
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group" ng-class="stageError.penalties ? 'has-error' : ''" >
                                    {!! Form::label('sanctions', 'Indique la sanción', ['class' => 'control-label']) !!}
                                    {!! Form::text('sanctions', null, ['class' => 'form-control', 'id' => 'sanctions_input', 'placeholder' => 'Sanción', 'ng-model' => 'visit.sanctions']) !!}
                                </div>

                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 form-group">
                                    {!! Form::label(null, null, ['class' => 'control-label']) !!}
                                    <button type="buton" class="btn btn-success pull-right" ng-click="saveVisit()"><i class="fa fa-user-plus"></i> Añadir visita</button>
                                </div>
                                <!-- JGT: Tabla de historico de visitas -->
                                <div class="col-lg-12" ng-show="true">
                                    <br />
                                    <div class="text-center"><h4><strong>Historico De Visitas</strong></h4></div>
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
                        @if(env('FILE_UPLOAD'))
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                @{{errorMsg}}
                                @if(env('FILE_UPLOAD'))
                                    <div class="form-group" ng-class="stageError.file_id ? 'has-error' : ''" ng-show="stageFields.file">
                                        {!! Form::label('filename', 'Fichero', ['class' => 'control-label']) !!}
                                        <div ng-show="stageFile.id">
                                            <a href="../file/download/@{{ stageFile.id }}" target="_blank">Descargar @{{ stageFile.filename }}</a>
                                            {!! Form::hidden('file_id', null, ['ng-model' => 'stageFile.id', 'ng-change' => 'stageSave = true']) !!}
                                        </div>
                                        <div class="btn btn-warning" ngf-select="upload($file)">Subir un fichero</div>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <span ng-show="AddObjectionButton">
                                <button class="btn btn-success pull-left" type="button" ng-click="hideAddObjectionButton()" style="margin-bottom: 15px"><i class="glyphicon glyphicon-screenshot"></i> Añadir Reparo</button>
                            </span>
                        </div>

{{--
                        <div ng-hide="AddObjectionButton" class="block block-themed" style="border: 1px #F0F0F0 solid">
--}}
                        <div ng-hide="AddObjectionButton" class="block block-themed">
                            <div ng-class="stageError['stageObjection.first_person_position_id'] ? 'has-error' : ''"
                                 ng-show="stageFields.objection">
                                <div class="block-header bg-warning">
                                    <h3 class="block-title text-white" ng-show="stageFields.id">Reparos</h3>
                                </div>
                                <div class="block-content">
                                        {!! Form::hidden('objection_id', null, ['ng-model' => 'stageData.objection_id', 'ng-change' => 'stageSave = true']) !!}
                                        {!! Form::hidden('license_id', null, ['ng-model' => 'stageObjection.license_id', 'ng-init' => 'stageObjection.license_id=' . $license->id]) !!}
                                        {!! Form::hidden('license_stage_id', null, ['ng-model' => 'stageObjection.license_stage_id']) !!}
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group" ng-class="stageError.objection.first_person_position_id ? 'has-error' : ''">
                                                {!! Form::label('first_person_position_id', 'Primera Posición de persona', ['class' => 'control-label']) !!}
                                                <div ng-show="stageObjection.first_person_position_id">
                                                    {!! Form::select('first_person_position_id', $personPositions, null, ['class' => 'form-control', 'placeholder' => 'Selecciona una Posición...', 'ng-model' => 'stageObjection.first_person_position_id', 'ng-change' => 'changeFirstPersonPosition()', 'convert-to-number' => '']) !!}
                                                </div>
                                                <div ng-hide="stageObjection.first_person_position_id">
                                                    {!! Form::select('first_person_position_id', $personPositions, null, ['class' => 'form-control', 'placeholder' => 'Selecciona una Posición...', 'ng-model' => 'stageObjection.first_person_position_id', 'ng-change' => 'changeFirstPersonPosition()']) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" ng-show="stageFields.name === 'Encargo Informe Ambiental'">
                                            <div class="form-group" ng-class="stageError.objection.second_person_position_id ? 'has-error' : ''" ng-show="stageFields.name === 'Encargo Informe Ambiental'">
                                                {!! Form::label('second_person_position_id', 'Segunda Posición de persona', ['class' => 'control-label']) !!}
                                                <div ng-show="stageObjection.second_person_position_id">
                                                    {!! Form::select('second_person_position_id', $personPositions, null, ['class' => 'form-control', 'placeholder' => 'Selecciona una Posición de persona...', 'ng-model' => 'stageObjection.second_person_position_id', 'ng-change' => 'changeFirstPersonPosition()', 'convert-to-number' => '']) !!}
                                                </div>
                                                <div ng-hide="stageObjection.second_person_position_id">
                                                    {!! Form::select('second_person_position_id', $personPositions, null, ['class' => 'form-control', 'placeholder' => 'Selecciona una Posición de persona...', 'ng-model' => 'stageObjection.second_person_position_id', 'ng-change' => 'changeFirstPersonPosition()']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <span ng-show="showObjectionDate">
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group" ng-class="stageError.objection.report_date ? 'has-error' : ''">
                                                    {!! Form::label('report_date', 'Fecha Informe', ['class' => 'control-label']) !!}
                                                    {!! Form::date('report_date', null, ['class' => 'form-control', 'ng-model' => 'stageObjection.report_date', 'ng-change' => 'stageSave = true']) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">
                                                {!! Form::label(null, '', ['class' => 'control-label']) !!}
                                                <button style="margin-top:25px;" class="btn btn-success" type="boton" ng-click="saveObjection()"><i class="fa fa-save"></i> Guardar reparo</button>
                                            </div>
                                        </span>
                                    </div>
                                    <span ng-show="showObjectionDate">
                                        <div class="row">
                                            <div ng-show="stageObjectionNotifications.length" class="col-lg-12">
                                                <h4 class="text-center">Notificaciones De Reparos</h4>
                                                <table class="table table-hover table-header-bg">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha de notificación</th>
                                                            <th>Fin de plazo</th>
                                                            <th width="10%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="objectionNotification in stageObjectionNotifications">
                                                            <td>@{{ objectionNotification.notification_date | date:'dd-MM-yyyy'}}</td>
                                                            <td>@{{ objectionNotification.finish_date | date:'dd-MM-yyyy'}}</td>
                                                            <td><button class="btn btn-danger" type="button" ng-click="deleteObjectionNotification(objectionNotification.id)"><i class="fa fa-trash-o"></i> Borrar</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group" ng-class="stageError.objection.notification_date ? 'has-error' : ''" ng-show="showNotificationDate">
                                                    {!! Form::label('notification_date', 'Fecha Notificación', ['class' => 'control-label']) !!}
                                                    {!! Form::date('notification_date', null, ['class' => 'form-control', 'ng-model' => 'stageObjection.notification_date', 'ng-change' => 'stageSave = true']) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group" ng-show="showNotificationDate">
                                                <button style="margin-top:25px;" class="btn btn-success" type="button" ng-click="nextObjectionNotification()" ng-show="stageObjectionNotificationNext"><i class="fa fa-bell"></i> Notificación plazo @{{ stageObjectionNotificationNext.weight }}</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group" ng-class="stageError.objection.correction_date ? 'has-error' : ''" ng-show="showNotificationDate">
                                                    {!! Form::label('correction_date', 'Fecha Subsanación', ['class' => 'control-label']) !!}
                                                    {!! Form::date('correction_date', null, ['class' => 'form-control', 'ng-model' => 'stageObjection.correction_date', 'ng-change' => 'stageSave = true']) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group" ng-class="stageError.objection.correction_date ? 'has-error' : ''" ng-show="showNotificationDate">
                                                    <button style="margin-top:25px;" class="btn btn-danger" type="button" ng-click="closeObjection()"  ng-hide="AddObjectionButton"><i class="fa fa-close"></i> Cerrar Reparo</button>
                                                </div>
                                            </div>
                                        </div>
                                    </span>

                                        <button class="btn btn-warning" type="button" ng-click="openObjection()"  ng-show="AddObjectionButton">Abrir Reparo</button>
                                        @if(env('FILE_UPLOAD'))
                                            <div class="form-group" ng-class="stageError.objection.file_id ? 'has-error' : ''">
                                                {!! Form::label('objectionFilename', 'Fichero del Reparo', ['class' => 'control-label']) !!}
                                                <div ng-show="stageObjectionFile.id">
                                                    <a href="../file/download/@{{ stageObjectionFile.id }}" target="_blank">Descargar @{{ stageObjectionFile.filename }}</a>
                                                    {!! Form::hidden('objection_file_id', null, ['ng-model' => 'stageObjectionFile.id', 'ng-change' => 'stageSave = true']) !!}
                                                </div>
                                                <div class="btn btn-warning" ngf-select="uploadObjection($file)">Subir un fichero al reparo</div>
                                            </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div ng-show="stageObjections.length" class="col-lg-12">
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
                                    <tr ng-repeat="objection in stageObjections">
                                        <td>@{{ objection.id }}</td>
                                        <td>@{{ objection.first_person_position.name }}</td>
                                        <td>@{{ objection.second_person_position.name }}</td>
                                        <td>@{{ objection.report_date | date:'dd-MM-yyyy'}}</td>
                                        <td>@{{ objection.correction_date | date:'dd-MM-yyyy' }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-mini block-content-full border-t">
                <div class="row">
                    <div class="col-md-4 text-left">
                        <button class="btn btn-warning" type="button" ng-click="previousStage()" ng-show="stagePrevious"><i class="si si-action-undo"></i> Paso Anterior</button>
                    </div>
                    <div class="col-md-4 text-center">
                        <button class="btn btn-danger" type="button" ng-click="saveStage()" ng-show="stageSave"><i class="fa fa-save"></i> Guardar cambios</button>
                    </div>
                    <div class="col-md-4 text-right" ng-hide="ver">
                        <button class="btn btn-warning" type="button" ng-click="nextStage()" ng-show="stageNext"><i class="si si-action-redo"></i> Siguiente paso</button>
                        <button class="btn btn-success" type="button" ng-click="finishLicense()" ng-hide="stageNext"><i class="si si-flag"></i> Finalizar licencia</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
