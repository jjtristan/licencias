@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    Paso de Licencia: {{ $licenseStage->name }}
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-warning" href="{{ route('licensestage.index') }}" role="button">Volver al listado</a>
                    <a class="btn btn-warning" href="{{ route('licensestage.edit', ['id' => $licenseStage->id]) }}" role="button">Editar</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <h2><strong>Nombre: {{ $licenseStage->name }}</strong></h2>

            @if($licenseStage->optional)
                <p><strong>Paso Opcional</strong></p>
            @endif

            <p><a class="btn btn-warning" href="{{ route('licensestage.show', ['id' => $licenseStage->id]) }}" role="button">Ver</a> <a class="btn btn-warning" href="{{ route('licensestage.edit', ['id' => $licenseStage->id]) }}" role="button">Editar</a></p>
            <p><strong>Campos:</strong></p>

            @if($licenseStage->date)
                <p>Fecha
                @if($licenseStage->date_required)
                    Requerido</p>
                @else
                    Opcional</p>
                @endif
            @endif

            @if($licenseStage->person)
                <p>Persona
                @if($licenseStage->person_required)
                    Requerido</p>
                @else
                    Opcional</p>
                @endif
            @endif

            @if($licenseStage->number)
                <p>Número
                @if($licenseStage->number_required)
                    Requerido</p>
                @else
                    Opcional</p>
                @endif
            @endif

            @if(env('FILE_UPLOAD'))
                @if($licenseStage->file)
                    <p>Fichero
                    @if($licenseStage->file_required)
                        Requerido</p>
                    @else
                        Opcional</p>
                    @endif
                @endif
            @endif

            @if($licenseStage->objection)
                <p>Fichero
                @if($licenseStage->objection_required)
                    Requerido</p>
                @else
                    Opcional</p>
                @endif
            @endif
            <!-- JGT: Se crean las vistas de los nuevos datos-->
            @if($licenseStage->proceeds_visit)
                <p>Procede Visita</p>
            @endif

            @if($licenseStage->date_commition)
                <p>Fecha de Encargo
                @if($licenseStage->date_commition_required)
                    Requerido</p>
                @else
                    Opcional</p>
                @endif
            @endif

            @if($licenseStage->date_report)
                <p>Fecha de Informe
                @if($licenseStage->date_report_required)
                    Requerido</p>
                @else
                    Opcional</p>
                @endif
            @endif

            @if($licenseStage->date_firsh_visit)
                <p>Fecha de Primera Visita
                @if($licenseStage->date_firsh_visit_required)
                    Requerido</p>
                @else
                    Opcional</p>
                @endif
            @endif

            @if($licenseStage->sanctions)
                <p>Sanción
                @if($licenseStage->sanctions_required)
                    Requerido</p>
                @else
                    Opcional</p>
                @endif
            @endif

            @if($licenseStage->act)
                <p>Acta
                @if($licenseStage->act_required)
                    Requerido</p>
                @else
                    Opcional</p>
                @endif
            @endif
        </div>
    </div>
@endsection

