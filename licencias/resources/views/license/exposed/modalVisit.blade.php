<div class="modal fade" id="modal-visit" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed remove-margin-b">
                <div class="block-header ">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="fa fa-times" aria-hidden="true" style="color: #151515 !important;"></i></button>
                        </li>
                    </ul>
                    <h3 >Visitas</h3>
                </div>
                <div class="block-content">
                    <form class="form-horizontal push-10-t" >
                        <div class="form-group">
                            <div class="col-sm-6">
                                <div class="form-material">
                                    <label for="fecha">Fecha de visita</label>
                                </div>
                                <div class='input-group dategeneric' >
                                    <input type='text' class="form-control" id='date_visit' name="date_visit" ng-model="closeVisitModal.date_visit"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <div class="form-material">
                                        <label for="numero">Acta</label>
                                        <select class="form-control" id="act" name="act" ng-model="closeVisitModal.act">
                                            <option value="">Selecciona una acta...</option>
                                            <option value="1">Favorable</option>
                                            <option value="0">Desfavorable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material floating">
                                        <textarea class="form-control" id="razon" name="razon" ng-model="closeVisitModal.sanctions" rows="3"></textarea>
                                        <label for="razon">Sanción</label>
                                    </div>
                                </div>
                            </div>
                   </form>
                </div>
            </div>
            <div class="modal-footer">
                <!-- data-dismiss="modal" -->
                <button class="btn btn-sm btn-primary" type="button" ng-click="createVisitClose()"><i class="fa fa-check"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>