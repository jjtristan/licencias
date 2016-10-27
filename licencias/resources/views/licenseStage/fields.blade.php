<div class="form-group @if($errors->first('name')) has-error @endif">
    {!! Form::label('name', 'Nombre', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name_input', 'placeholder' => 'Nombre del paso']) !!}
</div>
<div class="checkbox @if($errors->first('optional')) has-error @endif">
    <label>
        {!! Form::checkbox('optional', 'Paso Opcional') !!} Paso Opcional
    </label>
</div>
<div class="checkbox @if($errors->first('date')) has-error @endif">
    <label>
        {!! Form::checkbox('date', 'Campo Fecha') !!} Campo Fecha
    </label>
</div>

<div class="checkbox @if($errors->first('date_required')) has-error @endif">
    <label>
        {!! Form::checkbox('date_required', 'Campo Fecha Requerido') !!} Campo Fecha Requerido
    </label>
</div>

<div class="checkbox @if($errors->first('person')) has-error @endif">
    <label>
        {!! Form::checkbox('person', 'Campo Persona') !!} Campo Persona
    </label>
</div>

<div class="checkbox @if($errors->first('person_required')) has-error @endif">
    <label>
        {!! Form::checkbox('person_required', 'Campo Persona Requerido') !!} Campo Persona Requerido
    </label>
</div>

<div class="form-group">
    {!! Form::label('person_position_id', 'Selecciona tipo de persona', ['class' => 'control-label']) !!}
    {!! Form::select('person_position_id', $person_position_id, null,
        ['class' => 'form-control', 'placeholder' => 'Selecciona tipo de persona...']) !!}
</div>

<div class="checkbox @if($errors->first('number')) has-error @endif">
    <label>
        {!! Form::checkbox('number', 'Campo Número') !!} Campo Número
    </label>
</div>

<div class="checkbox @if($errors->first('number_required')) has-error @endif">
    <label>
        {!! Form::checkbox('number_required', 'Campo Número Requerido') !!} Campo Número Requerido
    </label>
</div>

<div class="checkbox @if($errors->first('file')) has-error @endif">
    <label>
        {!! Form::checkbox('file', 'Campo Fichero') !!} Campo Fichero
    </label>
</div>

<div class="checkbox @if($errors->first('file_required')) has-error @endif">
    <label>
        {!! Form::checkbox('file_required', 'Campo Fichero Requerido') !!} Campo Fichero Requerido
    </label>
</div>

<div class="checkbox @if($errors->first('objection')) has-error @endif">
    <label>
        {!! Form::checkbox('objection', 'Campo Reparo') !!} Campo Reparo
    </label>
</div>

<div class="checkbox @if($errors->first('objection_required')) has-error @endif">
    <label>
        {!! Form::checkbox('objection_required', 'Campo Reparo Requerido') !!} Campo Reparo Requerido
    </label>
</div>
<!-- JGT: Se agregan los nuevos campos para  el paso-->
<!-- JGT: Procede visita-->
<div class="checkbox @if($errors->first('proceeds_visit')) has-error @endif">
    <label>
        {!! Form::checkbox('proceeds_visit', 'Campo Procede Visita') !!} Campo Procede Visita
    </label>
</div>
<!-- JGT: Fecha de Encargo-->
<div class="checkbox @if($errors->first('date_commition')) has-error @endif">
    <label>
        {!! Form::checkbox('date_commition', 'Campo Fecha de Encargo') !!} Campo Fecha de Encargo
    </label>
</div>
<!-- JGT: Fecha de Encargo Requerida -->
<div class="checkbox @if($errors->first('date_commition_required')) has-error @endif">
    <label>
        {!! Form::checkbox('date_commition_required', 'Campo Fecha de Encargo Requerido') !!} Campo Fecha de Encargo Requerido
    </label>
</div>
<!-- JGT: Fecha de Informe-->
<div class="checkbox @if($errors->first('date_report')) has-error @endif">
    <label>
        {!! Form::checkbox('date_report', 'Campo Fecha de Informe') !!} Campo Fecha de Informe
    </label>
</div>
<!-- JGT: Fecha de Informe Requerido -->
<div class="checkbox @if($errors->first('date_report_required')) has-error @endif">
    <label>
        {!! Form::checkbox('date_report_required', 'Campo Fecha de Informe Requerido') !!} Campo Fecha de Informe Requerido
    </label>
</div>
<!-- JGT: Fecha de Primera Visita -->
<div class="checkbox @if($errors->first('date_firsh_visit')) has-error @endif">
    <label>
        {!! Form::checkbox('date_firsh_visit', 'Campo Fecha de Primera Visita') !!} Campo Fecha de Primera Visita
    </label>
</div>
<!-- JGT: Fecha de Primera Visita Requerida -->
<div class="checkbox @if($errors->first('date_firsh_visit_required')) has-error @endif">
    <label>
        {!! Form::checkbox('date_firsh_visit_required', 'Campo Fecha de Primera Visita Requerida') !!} Campo Fecha de Primera Visita Requerida
    </label>
</div>
<!-- JGT: Sanciones -->
<div class="checkbox @if($errors->first('sanctions')) has-error @endif">
    <label>
        {!! Form::checkbox('sanctions', 'Campo Sancion') !!} Campo Sanción
    </label>
</div>
<!-- JGT: Sanciones Requerida -->
<div class="checkbox @if($errors->first('sanctions_required')) has-error @endif">
    <label>
        {!! Form::checkbox('sanctions_required', 'Campo Sancion Requerida') !!} Campo Sanción Requerida
    </label>
</div>
<!-- JGT: acta -->
<div class="checkbox @if($errors->first('act')) has-error @endif">
    <label>
        {!! Form::checkbox('act', 'Campo Acta') !!} Campo Acta
    </label>
</div>
<!-- JGT: Acta Requerida -->
<div class="checkbox @if($errors->first('act_required')) has-error @endif">
    <label>
        {!! Form::checkbox('act_required', 'Campo Acta Requerida') !!} Campo Acta Requerida
    </label>
</div>

@include('licenseStage.exposed.angular')