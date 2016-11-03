@extends('layout')

@section('content')
    <div ng-app="titularChangeApp" ng-controller="titularChangeController" ng-cloak>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-4">
                        Editar Cambio de Titularidad de la Licencia {{ $titularityChange->license->number }}/{{ $titularityChange->license->year }}
                    </div>
                    <div class="col-md-8 text-right">
                        <a class="btn btn-warning" href="{{ route('titularitychange.index') }}" role="button">Volver al listado</a>
                        @if(isset($license))
                            <a class="btn btn-warning" href="{{ route('license.show', ['id' => $license->id]) }}" role="button">Volver a la Licencia</a>
                        @else
                            <a class="btn btn-warning" href="{{ route('titularitychange.show', ['id' => $titularityChange->id]) }}" role="button">Volver a Solicitud de Cambio de Titularidad</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel-body">
                @if(isset($titularityChange) && ! $titularityChange->finished)
                    {!! Form::model($titularityChange, array('route' => array('titularitychange.change', $titularityChange->id), 'method' => 'put', 'files' => true, 'autocomplete' => 'off')) !!}
                    <div class="col-md-4">
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

                @include('errors.form')

                {!! Form::model($titularityChange, array('route' => array('titularitychange.update', $titularityChange->id), 'method' => 'put', 'files' => true, 'autocomplete' => 'off')) !!}

                    @include('titularityChange.fields')

                    <div class="text-center">
                        {!! Form::button('Guardar cambios en la Solicitud de Cambio de Titularidad para la licencia ' . $titularityChange->license->number . "/" . $titularityChange->license->year, ['class'=> 'btn btn-warning', 'type' => 'submit']) !!}
                    </div>

                {!! Form::close() !!}
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