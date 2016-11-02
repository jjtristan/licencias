@extends('layout')

@section('pageTitle')
    Mapa Licencias
@endsection

@section('title')
    <div class="col-lg-12">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <i class="fa fa-book"></i> Mapa Licencias
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">
            <a class="btn btn-success" href="{{ route('license.create') }}" role="button"><i class="fa fa-plus"></i> Alta de licencia</a>
        </div>
    </div>
@endsection

@section('content')
    <span ng-app="licenseApp" ng-controller="licenseController" ng-cloak>
    <div class="row">
        <div class="block">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group" ng-class="stageError.status ? 'has-error' : ''">
                            {!! Form::label('status', 'Licencia estatus', ['class' => 'control-label']) !!}
                            <select class="form-control" id="status" name="status"
                                    ng-model="mapaData.status">
                                <option value="">Selecciona una estatus...</option>
                                <option ng-repeat="statusObj in status" value="@{{ statusObj.id }}">
                                    @{{ statusObj.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group" ng-class="stageError.status ? 'has-error' : ''">
                            {!! Form::label('actividad_id', 'Actividad', ['class' => 'control-label']) !!}
                            <select class="form-control" id="actividad_id" name="actividad_id"
                                    ng-model="mapaData.actividad_id">
                                <option value="">Selecciona una actividad...</option>
                                <option ng-repeat="actividad in getAllActivities" value="@{{ actividad.id }}">
                                    @{{ actividad.name }}</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <br>
                            <button id="obtenerInformacion" name="obtenerInformacion" class="btn btn-info" ng-click="obtenerInformacion()"><i class="fa fa-search"></i> Filtar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Markers Map Container -->
            <div id="js-map-markers" style="height: 600px;"></div>
        </div>
    </div>
</span>
@endsection

@section('scripts_at_body')

    <script>
        var licenseApp = angular.module('licenseApp', ['ngFileUpload',
            'ui.bootstrap',
            'angular-advanced-searchbox',
            'angularUtils.directives.dirPagination']);

        licenseApp.controller('licenseController', ['$scope', '$http', function ($scope, $http) {

            $scope.getAllActivities = [];
            $scope.getAllStreets = [];
            $scope.nifs = [];
            $scope.status = [];
            $scope.types = [];
            $scope.allTypes = [];
            $scope.markers = [];
            $scope.mapaData = {};

            $http.get('../api/v1/getAllLicenseType')
                    .success(function (response){
                        $scope.allTypes = response.data;
                        angular.forEach(response.data, function(value, key) {
                            $scope.types.push(value.name);
                        });
                    });

            $http.get('../api/v1/getAllLicenseStatus')
                    .success(function (response){
                        angular.forEach(response.data, function(value, key) {
                            $scope.status.push(value);
                        });
                    });

            $http.get('../api/v1/getAllStreets')
                    .success(function (response){
                        angular.forEach(response.data, function(value, key) {
                            $scope.getAllStreets.push(value.name);
                        });
                    });

            $http.get('../api/v1/getAllActivities')
                    .success(function (response){
                        angular.forEach(response.data, function(value, key) {
                            $scope.getAllActivities.push(value);
                        });
                    });

            $http.get('../api/v1/getlicenses')
            .success(function (response){
                $scope.licenses = response.data;
                angular.forEach($scope.licenses, function(value, key) {

                    var icono = '';

                    if(value.license_type_id ==1){
                        icono = '../img/markers/rojo.svg';
                    }
                    if(value.license_type_id ==2){
                        icono = '../img/markers/azul.svg';
                    }
                    if(value.license_type_id ==3){
                        icono = '../img/markers/verde.svg';
                    }

                    $scope.markers.push( {
                        lat: value.lat ,
                        lng: value.lng,
                        title: value.expedient_number,
                        animation: google.maps.Animation.DROP,
                        icon  : icono,
                        infoWindow: {content: '<strong>'+value.expedient_number+'</strong>'}});

                    $scope.nifs.push(value.titular.nif);
                    value.nif = value.titular.nif;
                    value.activity_name = value.activity.name;
                    value.street_name = value.street.name;
                    value.status = value.license_status.name;
                    angular.forEach($scope.allTypes, function(value2, key2) {
                        if(value2.id =+ value.license_type_id){
                            value.type = value2.name;
                        }
                    });
                });
                new GMaps({
                    div: '#js-map-markers',
                    lat: 38.2413027,
                    lng: -1.42233,
                    zoom: 15,
                    scrollwheel: false
                }).addMarkers($scope.markers);
            });

            $scope.obtenerInformacion = function(){
                $scope.markers = [];
                $http.post('../api/v1/getlicensesFiltroMapa', $scope.mapaData)
                .success(function (response){
                    $scope.licenses = response.data;
                    angular.forEach($scope.licenses, function(value, key) {

                        var icono = '';

                        if(value.license_type_id ==1){
                            icono = '../img/markers/rojo.svg';
                        }
                        if(value.license_type_id ==2){
                            icono = '../img/markers/azul.svg';
                        }
                        if(value.license_type_id ==3){
                            icono = '../img/markers/verde.svg';
                        }

                        $scope.markers.push( {
                            lat: value.lat ,
                            lng: value.lng,
                            title: value.expedient_number,
                            animation: google.maps.Animation.DROP,
                            icon  : icono,
                            infoWindow: {content: '<strong>'+value.expedient_number+'</strong>'}});
                    });
                    new GMaps({
                        div: '#js-map-markers',
                        lat: 38.2413027,
                        lng: -1.42233,
                        zoom: 15,
                        scrollwheel: false
                    }).addMarkers($scope.markers);
                });
            }


            $scope.activitySearch = function () {
                $scope.activity_id = null;
                $http.get('activity/search/' + $scope.activity_name).then(pushActivities);
            };

            function pushActivities(response) {
                $scope.activities = response.data.activities;
            }

            $scope.activitySelect = function () {
                $scope.activity_name = this.activity.name;
                $scope.activity_id = this.activity.id;
                $scope.activities = {};
            };

            $scope.streetSearch = function () {
                $scope.street_id = null;
                $http.get('street/search/' + $scope.street_name).then(pushStreets);
            };

            function pushStreets(response) {
                $scope.streets = response.data.streets;
            }

            $scope.streetSelect = function () {
                $scope.street_name = this.street.name;
                $scope.street_id = this.street.id;
                $scope.streets = {};
            };

            $scope.titularSearch = function () {
                $scope.titular_id = null;
                $scope.titular_first_name = null;
                $scope.titular_last_name = null;
                $scope.titular_phone_number = null;
                $scope.titular_email = null;
                $http.get('../titular/search/' + $scope.titular_nif).then(pushTitulars);
            };

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
