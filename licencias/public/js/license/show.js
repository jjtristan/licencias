$('#license-tabs a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
});

var stageApp = angular.module('currentStageApp', ['ngFileUpload']);

stageApp.directive('convertToNumber', function() {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, ngModel) {
            ngModel.$parsers.push(function(val) {
                return parseInt(val, 10);
            });
            ngModel.$formatters.push(function (val) {
                return '' + val;
            });
        }
    };
});

stageApp.controller('currentStageController', ['$scope', '$http', 'Upload', '$timeout', '$location', '$anchorScroll', function ($scope, $http, Upload, $timeout, $location, $anchorScroll) {
    $scope.sanctions = false;
    $scope.ver = null; //JGT: Variable con la cual se puede ver los botones de finalizar licencia en caso de que la acta sea desfavorable.
    $scope.alert = {};
    $scope.typeAlert = {};
    $scope.alertTable = {};
    $scope.visitObject = {};
    $scope.visit = {};
    $scope.stepFianl = {};
    $scope.denuncia = {};
    $scope.denuncias = {};
    $scope.expedient_number;//JGT: Se guardara el valor del número de expediente de la licencia
    $scope.licensesCaducar = {};//JGT: Almacena las licencias pendientes a caducar
    $scope.closeVisists = {};
    $scope.closeVisitModal = {};

    angular.element(document).ready(function () {
        $http.get('../currentstage/' + $scope.license.id).then(currentStage);
        $http.get('../getlicense/' + $scope.license.id).then(readObjectLicense);
        $http.get('../getalertlicense/' + $scope.license.id).then(readAlertLicense);
        $http.get('../gettypealert')
        .success(function (response){
            $scope.typeAlert = response;
        });
        $http.get('../getvisit/' + $scope.license.id).then(readVisitLicense);
        $('.date').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD HH:mm:ss'
        });

        $('.dategeneric').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });

        $http.get('../getdenuncia/' + $scope.license.id).then(readObjectDenuncia);
        $scope.estatus = [{valor:'Abierta',label:'Abierta'},{valor:'Cerrada',label:'Cerrada'}];
        $http.get('../api/v1/getlicensespendietescadu/'+ $scope.license.id).then(readLicencesCaducar);//JGT: Trae las licencias pendientes a caducar
        $http.get('../getvisitclose/' + $scope.license.id).then(readCloseVisit);
    });

    function readObjectDenuncia (response){
        $scope.denuncias = response.data;

    }

    // guardar las alertas por modal
    $scope.guardarAlerta = function () {
        $scope.alert.license_id = $scope.license.id;
        $scope.alert.type_alert_id = 4;
        $scope.alert.date = $('#datetimepicker2').val();
        swal({
            title: "Creación de alertas",
            text: "Desea guardar la alerta?",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                $http.post('../alertmodal', $scope.alert)
                .success(function (data){
                    $http.get('../getalertlicense/' + $scope.license.id).then(readAlertLicense);
                    $scope.alert = {};
                    swal("Exito", "La alerta se ha creado correctamente.", "success");
                    jQuery('#modal-alert').modal('hide');    
                })
                .error(function (error){
                    swal("Error", "Ha ocurrido un error!!!", "error");
                    $scope.alert = {};
                    jQuery('#modal-alert').modal('hide');
                });
                
            } else {
                $scope.alert = {};
                jQuery('#modal-alert').modal('hide');
            }
        });
    }

    /*
    * JGT: Función para inicar el titulo de la alerta
    */
    $scope.initTitleAlert = function () {
        $scope.alert.title = $scope.expedient_number; 
    }
    /*
    * Modificación: Se pone una confirmación antes de cerrar la denuncia.
    * Autor modificación: JGT.
    */
    $scope.updateStatus = function(Object) {
        swal(
            {
                title: "Cerrado de denuncia",
                text: "Desea cerrar la denuncia?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            },function(isConfirm){
                if(isConfirm){
                    $http.post('../postUpdateDenuncia', Object)
                    .success(function(data){
                        swal("Exito", "La denuncia se ha cerrado correctamente.", "success");
                    }).error(function(error){
                        swal("Error", "Ha ocurrido un error!!!", "error");
                    });
                }else{
                    $scope.denuncias = {};
                    $http.get('../getdenuncia/' + $scope.license.id).then(readObjectDenuncia);
                    
                }

            }
        );
        
    }

    // guardar las denuncias por modal
    $scope.guardarDenuncia = function () {
        $scope.denuncia.license_id = $scope.license.id;
        $scope.denuncia.register_date=$("#datepicker2").val().split(' ')[0];
        $scope.denuncia.expedient_number = $('#numero').val();
        $scope.denuncia.reason = $('#razon').val();
        swal({
                title: "Creación de denuncias",
                text: "Desea guardar la denuncia?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
        },function(isConfirm){
            if(isConfirm){
                $http.post('../denunciamodal', $scope.denuncia)
                    .success(function (data){
                        $http.get('../getdenuncia/' + $scope.license.id).then(readObjectDenuncia);
                        $scope.denuncia = {};
                        swal("Exito", "La denuncia se ha creado correctamente.", "success");
                        jQuery('#modal-denuncia').modal('hide');
                    })
                    .error(function (error){
                        swal("Error", "Ha ocurrido un error!!!", "error");
                        $scope.denuncia = {};
                        jQuery('#modal-denuncia').modal('hide');
                    });
            }else{
                $scope.denuncia = {};
                jQuery('#modal-denuncia').modal('hide');
            }
        });
    }

    function readdenunciaLicense (response) {
        $scope.denunciaTable = response.data;
    }

    function readAlertLicense (response) {
        $scope.alertTable = response.data;
    }

    function scrollTo(id) {
        $location.hash(id);
        $anchorScroll();
    }

    $scope.upload = function (file) {
        Upload.upload({
            url: '../currentstage/' + $scope.license.id + '/stage/' + $scope.stageFields.id,
            data: {file: file},
            method: 'POST',
            sendFieldsAs: 'form',
            fields: {}
        }).then(uploadSuccess, uploadFail, uploadProgress);
    };

   function uploadSuccess(response) {
        if(response.data.stageFile !== undefined) {
            $scope.stageFile = {};
            $scope.stageFile.id = response.data.stageFile.id;
            $scope.stageFile.filename = response.data.stageFile.filename;
            $scope.stageData.file_id = response.data.stageFile.id;
        }
    }

    function uploadFail(response) {
        if (response.status > 0)
            $scope.errorMsg = response.status + ': ' + response.data;
    }

    function uploadProgress(evt) {
        $scope.stageData.progressBar = Math.min(100, parseInt(100.0 *
            evt.loaded / evt.total));
    }

    $scope.uploadObjection = function (file) {
        Upload.upload({
            url: '../currentstage/' + $scope.license.id + '/stage/' + $scope.stageFields.id,
            data: {objectionFile: file},
            method: 'POST',
            sendFieldsAs: 'form',
            fields: {}
        }).then(uploadObjectionSuccess, uploadObjectionFail, uploadObjectionProgress);
    };

    function uploadObjectionSuccess(response) {
        if(response.data.stageObjectionFile !== undefined) {
            $scope.stageObjectionFile = {};
            $scope.stageObjectionFile.id = response.data.stageObjectionFile.id;
            $scope.stageObjectionFile.filename = response.data.stageObjectionFile.filename;
            $scope.stageObjection.file_id = response.data.stageObjectionFile.id;
        }
    }

    function uploadObjectionFail(response) {
        if (response.status > 0)
            $scope.errorMsg = response.status + ': ' + response.data;
    }

    function uploadObjectionProgress(evt) {
        $scope.stageObjection.progressBar = Math.min(100, parseInt(100.0 *
            evt.loaded / evt.total));
    }

    $scope.hideAddObjectionButton = function () {
        $scope.AddObjectionButton = false;
        $scope.showObjectionDate = false;
        $scope.showNotificationDate = false;
        $scope.stageObjection = {};
        $scope.stageObjectionFile = {};
        $scope.stageObjectionNotifications = {};
        $scope.stageObjectionNotificationNext = {};
    };

    $scope.changeFirstPersonPosition = function () {
        $scope.stageSave = true;
        $scope.showObjectionDate = true;
        if ($scope.stageObjection.first_person_position_id != null) {
            initializeObjection();
        }
    };

    $scope.saveObjection = function () {
        $scope.showNotificationDate = true;
        $scope.saveStage();
    };

    $scope.nextObjectionNotification = function () {
        if ($scope.stageFields.objection === true) {
            $scope.stageData.stageObjection = $scope.stageObjection;
        }
        $http.post('../nextobjectionnotification/' + $scope.stageData.objection_id, $scope.stageObjection).then(retrieveObjectionNotifications, ObjectionNotificationError);
        $http.post('../notificationalert', $scope.stageObjection)
        .success(function (data){
            
        });
    };

    function retrieveObjectionNotifications(response) {
        if (response.data.stageObjectionNotifications !== undefined) {
            $scope.stageObjectionNotifications = response.data.stageObjectionNotifications;
            $scope.stageObjectionNotificationNext = response.data.stageObjectionNotificationNext;
        }
    }

    $scope.closeObjection = function () {
        $scope.AddObjectionButton = true;
        $scope.AddObjectionButton = true;

        $http.post('../closeobjection/' + $scope.stageData.objection_id, $scope.stageObjection).then(ChangeObjectionStatus, ChangeObjectionStatusError);
    };

    $scope.openObjection = function () {
        $http.post('../openobjection/' + $scope.stageData.objection_id, $scope.stageObjection).then(ChangeObjectionStatus, ChangeObjectionStatusError);
    };

    $scope.deleteObjectionNotification = function (notificationId) {
        $http.delete('../objection/' + $scope.stageData.objection_id + '/notification/' + notificationId).then(retrieveObjectionNotifications, ObjectionNotificationError);
    };

    function ChangeObjectionStatus(response) {
        if(response.data.stageObjections !== null) {
            $scope.stageObjections  = response.data.stageObjections;

        }
        $scope.stageObjection = {};
        $scope.stageObjectionFile = {};
        $scope.stageObjectionNotifications = {};
        $scope.stageObjectionNotificationNext = {};
    }

    function ChangeObjectionStatusError(response) {
        $scope.AddObjectionButton = false;
        $scope.stageError = response.data;
    }

    function ObjectionNotificationError(response) {
        $scope.stageError = response.data;
    }

    $scope.nextStage = function () {
        $scope.stageError = {};
        if ($scope.stageFields.objection === true) {
            $scope.stageData.stageObjection = $scope.stageObjection;
        }
        retrieveNextStageForLicenseId();
    };

    $scope.previousStage = function () {
        $scope.stageError = {};
        if ($scope.stageFields.objection === true) {
            $scope.stageData.stageObjection = $scope.stageObjection;
        }
        retrievePreviousStageForLicenseId();
    };

    $scope.goToStage = function (stage) {
        $scope.stageError = {};
        hideSaveStageButton();
        $http.get('../license/' + $scope.license.id + '/stage/' + stage).then(currentStage);
    };

    $scope.saveStage = function () {
        $scope.stageError = {};
        if ($scope.stageFields.objection === true) {
            $scope.stageData.stageObjection = $scope.stageObjection;
        }
        $http.post('../currentstage/' + $scope.license.id + '/stage/' + $scope.stageFields.id, $scope.stageData).then(retrieveRequiredStages, stageChangeError);
        if ($scope.stageData.license_stage_id == 4) {
            $http.post('../currentstage/' + $scope.license.id + '/alert', $scope.stageData)
            .success(function (data){});
        };
    };

    function retrieveRequiredStages(response) {
        $scope.requiredStages = response.data.requiredStages;
        $scope.stageData.objection_id = response.data.objection_id;
        $scope.stageObjections = response.data.stageObjections
        $scope.stageObjectionNotifications = response.data.stageObjectionNotifications;
        $scope.stageObjectionNotificationNext = response.data.stageObjectionNotificationNext;
        if($scope.stageObjection.first_position_person_id !== null) {
            $scope.showNotificationDate = true;
        }
        hideSaveStageButton();
        if ($scope.stageFromList.license_stage_id == 17) {
            var objetosBuscados = $('#stage-form').find('button');
            if ($scope.stageData.proceeds_visit == 'false') {
                
                angular.forEach(objetosBuscados, function(value, key){
                    if (value.innerText != $scope.stepFianl.license_stage.name && key != 0) {
                        $('#'+value.id).css('display', 'none');
                    };
                    if (key == 0 ) {
                        $('#'+value.id).addClass('btn-success');
                    };
                });
                $scope.goToStage($scope.stepFianl.license_stage.id);
            }else {
                angular.forEach(objetosBuscados, function(value, key){
                    if (value.innerText != $scope.stepFianl.license_stage.name && key != 0) {
                        $('#'+value.id).css('display', 'block');
                    };
                    if (key == 0 ) {
                        $('#'+value.id).addClass('btn-success');
                    };
                });
            }
            
        };
        
    }

    $scope.initArry = function (object) {
        var json = JSON.parse(object);
        $scope.stepFianl = json.pop();
    }

    function hideSaveStageButton(response) {
        $scope.stageSave = false;
    }

    $scope.changeStatusLicense = function () {
        if($scope.license.identifier === null) {
            var status = {
                reason: $scope.rejectReason,
                status_id: $scope.rejectAction
            };
        } else if ($scope.license.identifier !== null) {
            var status = {
                reason: $scope.successReason,
                status_id: $scope.successAction
            };
        }
        $http.post('../changestatuslicense/' + $scope.license.id, status).then(changeStatusLicenseSuccess, changeStatusLicenseError);
    };

    function changeStatusLicenseSuccess(response) {
        $scope.stageError = {};
        $scope.license = response.data.license;

        if($scope.license.identifier === null) {
            $scope.rejectReason = null;
            $scope.rejectAction = $scope.license.license_status_id;
            $scope.rejectActionButton = null;
        } else if ($scope.license.identifier !== null) {
            $scope.successReason = null;
            $scope.successAction = $scope.license.license_status_id;
            $scope.successActionButton = null;
        }
    }

    function changeStatusLicenseError(response) {
        $scope.stageError = response.data;
    }

    $scope.finishLicense = function () {
        $scope.stageError = {};
        $http.post('../finishstage/' + $scope.license.id).then(finishStage, stageChangeError);
    };

    $scope.openLicense = function () {
        $scope.stageError = {};
        $http.post('../openlicense/' + $scope.license.id).then(openStage, stageChangeError);
    };

    $scope.saveVisitStatus = function () {
        $scope.saveVisitButton = true;
        data = {
            visitStatus: $scope.visitStatus,
            visitDate: $scope.visitDate
        };
        $http.post('../savevisitstatus/' + $scope.license.id, data).then(hideSaveVisitButton, stageChangeError);
    };

    function hideSaveVisitButton() {
        $scope.saveVisitButton = false;
    }

    function retrieveNextStageForLicenseId() {
        $scope.stageError = {};
        hideSaveStageButton();
        $http.get('../nextstage/' + $scope.license.id + '/stage/' + $scope.stageFields.id).then(currentStage);
        $http.get('../getlicense/' + $scope.license.id).then(readObjectLicense);
    }

    function readObjectLicense(response){
        $scope.licenseObject = response.data.object.license_current_stages;
        $scope.expedient_number = response.data.object.expedient_number;// JGT: Se obtiene el número de expediente de la licencia
        $scope.initTitleAlert();
    }

    function retrievePreviousStageForLicenseId() {
        $scope.stageError = {};
        hideSaveStageButton();
        $http.get('../previousstage/' + $scope.license.id + '/stage/' + $scope.stageFields.id).then(currentStage);
        $http.get('../getlicense/' + $scope.license.id).then(readObjectLicense);
    }

    function finishStage(response) {
        $scope.stageError = {};

        if(response.data.requiredFields.length == 0) {
            $scope.requiredFields = {};
            $scope.license.finished = true;
            $scope.license = response.data.license;
            $scope.successReason = null;
            $scope.successAction = $scope.license.license_status_id;
            $scope.successActionButton = null;
        }
        else {
            $scope.requiredFields = response.data.requiredFields;
            $scope.requiredStages = response.data.requiredStages;
        }
    }

    function openStage(response) {
        $scope.license = response.data.license;

        if($scope.license.identifier === null) {
            $scope.rejectReason = null;
            $scope.rejectAction = null;
            $scope.rejectActionButton = null;
        } else if ($scope.license.identifier !== null) {
            $scope.successReason = null;
            $scope.successAction = null;
            $scope.successActionButton = null;
        }

        $http.get('../currentstage/' + $scope.license.id).then(currentStage);
    }

    function stageChangeError(response) {
        $scope.stageError = response.data;
    }

    function currentStage(response) {
        //scrollTo('stage-form');
        initializeStageFields(response);
        if (response.data.stageData !== null) {
            $scope.stageData = response.data.stageData;
            $scope.stageData.proceeds_visit = $scope.stageData.proceeds_visit == 1? 'true' : 'false';

            sanitizeStageData();
        }

        if (response.data.stagePrevious !== null) {
            $scope.stageData.previous = response.data.stagePrevious.id;
        }

        if (response.data.stageNext != null) {
            $scope.stageData.next = response.data.stageNext.id;
        }

        if (response.data.stageObjection !== null) {
            $scope.AddObjectionButton = false;
            $scope.showObjectionDate = true;
            $scope.showNotificationDate = true;
            initializeObjection();
            $scope.stageObjection = response.data.stageObjection;
            sanitizeStageObjection();
        }

        $scope.stageFile = response.data.stageFile;
        $scope.stageObjectionFile = response.data.stageObjectionFile;
        $scope.stageObjectionNotifications = response.data.stageObjectionNotifications;
        $scope.stageObjectionNotificationNext = response.data.stageObjectionNotificationNext;
        $scope.stagePrevious = response.data.stagePrevious;
        $scope.stageNext = response.data.stageNext;
        $scope.requiredStages = response.data.requiredStages;
        $scope.closets = response.data.closets;
        $scope.people = [];

        if(response.data.stageFields.person){
            angular.forEach(response.data.people, function(value, key) {
                if(value.person_position_id == response.data.stageFields.person_position_id){
                    $scope.people.push(value);
                }
            });
        }
        if (typeof($scope.visit) != 'undefined') {
            if ($scope.visit.act == 0) {
                $scope.ver = true;
            };
        };
    }

    function initializeStageFields(response) {
        
        $scope.stageFields = response.data.stageFields;
        $scope.stageFromList = response.data.stageFromList;
        $scope.license = response.data.license;
        $scope.stageData = {};
        $scope.stageObjection = {};
        $scope.stageObjections = {};

        if (response.data.stageFromList !== null) {
            $scope.stageData.license_generate = response.data.stageFromList.license_generate;
        }

        if ($scope.stageFields.date === true) {
            $scope.stageData.date = new Date();
        }


        if ($scope.stageFields.objection === true) {
            $scope.stageObjections = {};
            $scope.stageObjections  = response.data.stageObjections;
        }


        if ($scope.stageFields.person === true){
            $scope.stageData.person_id = null;
        }

        if ($scope.stageFields.number === true) {
            $scope.stageData.number = null;
        }

        if ($scope.stageFields.file === true) {
            $scope.stageData.file_id = null;
        }

        if ($scope.stageFields.objection === true) {
            $scope.stageData.objection_id = null;
            $scope.AddObjectionButton = true;
        }

    }

    function initializeObjection(response) {
        $scope.visit.date_visit = new Date();// JGT: Se inicializa la fecha de visita con la fecha actual
        if ($scope.stageObjection === undefined) {
            $scope.stageObjection = {};
            $scope.stageObjection.first_person_position_id = null;
        }

        if ($scope.stageObjection.report_date === undefined) {
            $scope.stageObjection.report_date = new Date();
        }
        if ($scope.stageObjection.notification_date === undefined) {
            $scope.stageObjection.notification_date = new Date();
        }
        if ($scope.stageObjection.correction_date === undefined) {
            $scope.stageObjection.correction_date = new Date();
        }
        $scope.stageObjection.license_id = $scope.license.id;
        $scope.stageObjection.license_stage_id = $scope.stageFields.id;
    }

    function sanitizeStageData() {
        $scope.visit.date_visit = new Date();// JGT: Se inicializa la fecha de visita con la fecha actual
        if (! $scope.stageFields.date) {
            $scope.stageData.date = undefined;
            
        } else {
            if ($scope.stageData.date === null) {
                $scope.stageData.date = new Date();
                $scope.stageSave = true;
            }
            else {
                $scope.stageData.date = new Date($scope.stageData.date);
            }
            
        }

        if ((! $scope.stageFields.person) && ($scope.stageData.person_id === null)) {
            $scope.stageData.person_id = undefined;
        }

        if ((! $scope.stageFields.number) && ($scope.stageData.number === null)) {
            $scope.stageData.number = undefined;
        }

        if ((! $scope.stageFields.file) && ($scope.stageData.file_id === null)) {
            $scope.stageData.file_id = undefined;
        }

        if ((! $scope.stageFields.objection) && ($scope.stageData.objection_id === null)) {
            $scope.stageData.objection_id = undefined;
            $scope.AddObjectionButton = false;
        }
    }

    function sanitizeStageObjection() {
        if (! $scope.stageFields.objection) {
            $scope.stageObjection.report_date = undefined;
            $scope.stageObjection.notification_date = undefined;
            $scope.stageObjection.correction_date = undefined;
        } else {
            if ($scope.stageObjection.report_date === null) {
                $scope.stageObjection.report_date = new Date();
            }
            else {
                $scope.stageObjection.report_date = new Date($scope.stageObjection.report_date);
            }

            if ($scope.stageObjection.notification_date === null || $scope.stageObjection.notification_date === undefined) {
                $scope.stageObjection.notification_date = new Date();
            }
            else {
                $scope.stageObjection.notification_date = new Date($scope.stageObjection.notification_date);
            }

            if ($scope.stageObjection.correction_date === null || $scope.stageObjection.correction_date === undefined) {
                $scope.stageObjection.correction_date = new Date();
            }
            else {
                $scope.stageObjection.correction_date = new Date($scope.stageObjection.correction_date);
            }
        }
    }

    // Closet
    $scope.saveLicenseCloset = function () {
        $http.put('../license/' + $scope.license.id + '/closet', $scope.license.closet).then(saveLicenseClosetSuccess, saveLicenseClosetError);
    };

    function saveLicenseClosetSuccess(response) {
        $scope.licenseClosetEdit = false;
    }

    function saveLicenseClosetError(response) {
        $scope.licenseClosetEdit = true;
    }

    $scope.deleteLicenseCloset = function () {
        $http.delete('../license/' + $scope.license.id + '/closet').then(deleteLicenseClosetSuccess, deleteLicenseClosetError);
    };

    function deleteLicenseClosetSuccess(response) {
        $scope.license.closet = null;
        $scope.licenseClosetEdit = false;
    }

    function deleteLicenseClosetError(response) {
        $scope.licenseClosetEdit = true;
    }

    // OnQuery
    $scope.saveLicenseOnQuery = function (status) {
        $http.put('../license/' + $scope.license.id + '/onquery', status).then(saveLicenseOnQuerySuccess, saveLicenseOnQueryError);
    };

    function saveLicenseOnQuerySuccess(response) {
        $scope.license.on_query = response.data.status;
    }

    function saveLicenseOnQueryError(response) {
    }

    // VolumeYear
    $scope.saveLicenseVolumeYear = function() {
        $http.put('../license/' + $scope.license.id + '/volumeyear', $scope.license.volume_year).then(saveLicenseVolumeYearSuccess, saveLicenseVolumeYearError);
    };

    function saveLicenseVolumeYearSuccess(response) {
        $scope.licenseVolumeYearEdit = false;
        $scope.license.closet = null;
    }

    function saveLicenseVolumeYearError(response) {
        $scope.licenseVolumeYearEdit = true;
    }

    // Loan
    $scope.savePersonDateActiveLoan = function () {
        $http.put('../license/' + $scope.license.id + '/loan', $scope.license.active_loan).then(savePersonDateActiveLoanSuccess, savePersonDateActiveLoanError);
    };

    function savePersonDateActiveLoanSuccess(response) {
        $scope.license.active_loan.id = response.data.active_loan.id;
        $scope.people = response.data.people;
        $scope.licenseLoanDate = true;
    }

    function savePersonDateActiveLoanError(response) {
        $scope.licenseLoanDate = false;
    }

    $scope.saveLicenseLoan = function () {
        $http.put('../license/' + $scope.license.id + '/loan', $scope.license.active_loan).then(saveLicenseLoanSuccess, saveLicenseLoanError);
    };

    function saveLicenseLoanSuccess(response) {
        $scope.license.active_loan.id = response.data.active_loan.id;
        $scope.people = response.data.people;
        $scope.licenseLoanEdit = false;
        $scope.license.on_loan = true;
    }

    function saveLicenseLoanError(response) {
        $scope.licenseLoanEdit = true;
    }

    $scope.closeActiveLoan = function () {
        $http.put('../license/' + $scope.license.id + '/loan/close', $scope.license.active_loan).then(closeActiveLoanSuccess, closeActiveLoanError);
    };

    function closeActiveLoanSuccess(response){
        $scope.license = response.data.license;
        $scope.people = response.data.people;
        $scope.licenseLoanEdit = false;
        $scope.licenseLoanDate = false;
    }

    function closeActiveLoanError(response){
        $scope.licenseLoanEdit = true;
        $scope.license.on_loan = true;
    }

    $scope.autocompleteLoanPerson = function () {
        $(function() {
            var allPeople = $scope.people;
            $("#active_loan_first_name")
                .autocomplete({
                    minLength: 0,
                    source: allPeople,
                    focus: function (event, ui) {
                        $("#active_loan_first_name").val(ui.item.first_name);
                        return false;
                    },
                    select: function (event, ui) {
                        var active_loan_person_id = $("#active_loan_person_id");
                        var active_loan_first_name = $("#active_loan_first_name");
                        var active_loan_last_name = $("#active_loan_last_name");
                        var active_loan_email = $("#active_loan_email");

                        active_loan_person_id.val(ui.item.id);
                        $scope.license.active_loan.person.id = ui.item.id;

                        active_loan_first_name.val(ui.item.first_name);
                        active_loan_first_name.trigger('input');

                        active_loan_last_name.val(ui.item.last_name);
                        active_loan_last_name.trigger('input');

                        active_loan_email.val(ui.item.email);
                        active_loan_email.trigger('input');

                        return false;
                    }
                })
                .autocomplete().data("uiAutocomplete")._renderItem = function (ul, item) {
                return $("<li>")
                    .append("<a>" + item.label + "</a>")
                    .appendTo(ul);
            };
        });
    };

    $scope.formatDate = function(initial_date) {
        if (initial_date === undefined || initial_date === null) {
            return new Date();
        }
        return new Date(initial_date);
    };

    $scope.saveVisit = function() {
        $scope.visit.license_id = $scope.license.id;
        $http.post('../createvisit', $scope.visit)
        .success(function (data){
            $http.get('../getvisit/' + $scope.license.id).then(readVisitLicense);
            if ($scope.visit.act == 1) {
                $('#20').addClass('btn-success');
                $scope.ver = null;  
            };
            $scope.sanctions = true;
        })
        .error(function (error){
            console.log(error);
            swal("Error", "Ha ocurrido un error!!!", "error");
            $scope.visit = {};
        });
    }

    function readVisitLicense (response) {
        $scope.visitObject = response.data;
    }

    /*
    * JGT: Caducar la licencia en la ventana del show
    */
    $scope.caducarlicenciaShow = function () {
        swal({
            title: "Inicio de proceso",
            text: "Desea iniciar el proceso para caducar la licencia?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Iniciar proceso",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                $http.get('../caducarlicense/' + $scope.license.id)
                .success(function (data) {
                    swal("Se ha iniciado el proceso para caducar la licencia");
                    $http.get('../api/v1/getlicensespendietescadu/' + $scope.license.id).then(readLicencesCaducar);
                    
                });
            } 
        });
    };

    function readLicencesCaducar (response) {
        $scope.licensesCaducar = response.data.data;
    }

    $scope.caducarLicenseShow = function (id) {
        swal({
            title: "Caducar licencia",
            text: "Desea caducar la licencia?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Caducar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                $http.get('../caducarlicense/' + id)
                .success(function (data) {
                    swal("Se ha completado el proceso para caducar la licencia");
                    location.reload();
                });
            } 
        });
    }

    /*
    * JGT: Se guardan las visitas que se hagan con la licencia cerrada
    */
    $scope.createVisitClose = function () {
        $scope.closeVisitModal.license_id = $scope.license.id;
        $scope.closeVisitModal.type_visit = 'Cierre';
        $scope.closeVisitModal.date_visit = $('#date_visit').val();
        swal({
            title: "Registro de visista",
            text: "Se registrará la visita con los datos que a ingresado, desea continuar con el registro?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                
                $http.post('../createvisit', $scope.closeVisitModal)
                .success(function (data) {
                    swal("Éxito","Se Registrado la visita", "success");
                    $scope.closeVisitModal = {};
                    $http.get('../getvisitclose/' + $scope.license.id).then(readCloseVisit);
                    jQuery('#modal-visit').modal('hide');
                });
            } 
        });
    };

    function readCloseVisit (response) {
        $scope.closeVisists = response.data;
    }

}]);
