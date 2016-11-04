@extends('layout')

@section('content')
    <div ng-app="titularChangeApp" ng-controller="titularChangeController" ng-cloak>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        Solicitud de Cambio de titularidad {{ $titularityChange->license->number }}/{{ $titularityChange->license->year }}
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-warning" href="{{ route('titularitychange.index') }}" role="button">Volver al listado</a>
                        <a class="btn btn-info" href="{{ route('license.show', ['id' => $titularityChange->license->id]) }}" role="button">Ir a la licencia</a>
                        <a class="btn btn-warning" href="{{ route('titularitychange.edit', ['id' => $titularityChange->id]) }}" role="button">Editar</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                @if(isset($titularityChange) && ! $titularityChange->finished)
                    {!! Form::model($titularityChange, array('route' => array('titularitychange.change', $titularityChange->id), 'method' => 'put', 'files' => true, 'autocomplete' => 'off')) !!}
                    <div class="col-md-4 ">
                        {!! Form::label('titular_change_date', 'Fecha del cambio de estado', ['class' => 'control-label']) !!}
                        {!! Form::date('titular_change_date', new \DateTime(), ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('titularChange_status', 'Selecciona una estado', ['class' => 'control-label']) !!}
                        {!! Form::select('titularChange_status', $titularityChangeStatuses, $titularityChange->status, ['class' => 'form-control', 'placeholder' => 'Selecciona un estado...', 'ng-change' => 'showChangeButton[' . $titularityChange->id .'] = true', 'ng-model' => 'titular_change_date[' . $titularityChange->id . ']', 'ng-init' => 'titular_change_date[' . $titularityChange->id . '] = "' . $titularityChange->status . '"']) !!}

                        {!! Form::button('Cambiar estado', ['class'=> 'btn btn-danger', 'type' => 'submit', 'ng-show' => 'showChangeButton[' . $titularityChange->id .']']) !!}

                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
            <div class="panel-body">
                <p class="col-lg-12"><strong>Licencia:</strong> {{ $titularityChange->license->licenseType->name }} {{ $titularityChange->license->number }}/{{ $titularityChange->license->year }} </p>
                <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><strong>Número de expediente:</strong> {{ $titularityChange->expedient_number }}</p>
                <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><strong>Número de registro de entrada:</strong> {{ $titularityChange->register_number }}</p>
                <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><strong>Fecha de registro:</strong> {{ $titularityChange->register_date_output }}</p>
                @if(isset($titularityChange->lastTitular))
                    <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><strong>Último titular:</strong> {{ $titularityChange->lastTitular->first_name}} {{ $titularityChange->lastTitular->last_name }}</p>
                @endif
                <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><strong>Nuevo Titular:</strong> {{ $titularityChange->titular->first_name }} {{ $titularityChange->titular->last_name }}</p>
                <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><strong>Actividad:</strong> {{ $titularityChange->license->activity->name }}</p>
                <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><strong>Emplazamiento:</strong> {{ $titularityChange->license->street->name }} , {{ $titularityChange->license->street_number }} - {{ $titularityChange->license->postcode }} ({{ $titularityChange->license->city }})</p>
                <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><strong>Fecha de finalización:</strong>

                    @if (isset($titularityChange->finished_date_output))
                        {{ $titularityChange->finished_date_output }}
                    @endif

                </p>
                <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><strong>Estado:</strong>

                    @if (isset($titularityChange->status))
                        {{ $titularityChange->status }}
                    @endif

                </p>
                @if(env('FILE_UPLOAD'))
                    <p class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><strong>Fichero:</strong>

                        @if (isset($titularityChange->file->filename))
                             <a href="{{ route('file.download', ['file' => $titularityChange->file->id]) }}" target="_blank">Descargar {{ $titularityChange->file->filename }}</a>
                        @endif

                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts_at_body')
    <script>
        var titularChangeApp = angular.module('titularChangeApp', ['ngFileUpload']);

        titularChangeApp.controller('titularChangeController', ['$scope', '$http', function ($scope, $http) {
            $scope.titularSearch = function () {
                $scope.titular_id = null;
                $scope.titular_first_name = null;
                $scope.titular_last_name = null;
                $scope.titular_phone_number = null;
                $scope.titular_email = null;
                $http.get('../../../../titular/search/' + $scope.titular_nif).then(pushTitulars, getTitularFromLicense);
            };

            function getTitularFromLicense(response) {
                $http.get('../../titular/search/' + $scope.titular_nif).then(pushTitulars);
            }

            function pushTitulars(response) {
                $scope.titulars = response.data.titulars;
            }

            $scope.titularSelect = function () {
                $scope.titular_id = this.titular.id;
                $scope.titular_nif = this.titular.nif;
                $scope.titular_first_name = this.titular.first_name;
                $scope.titular_last_name = this.titular.last_name;
                $scope.titular_phone_number = this.titular.phone_number;
                $scope.titular_email = this.titular.email;
                $scope.titulars = {};
            };
        }]);
    </script>
@endsection