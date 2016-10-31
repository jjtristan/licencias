@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h3>Etapa de Licencia</h3>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-warning" href="{{ route('licensecurrentstage.create') }}" role="button">Dar de Alta una Etapa de Licencia</a>
                </div>
            </div>
        </div>


        <div class="panel-body">
            <p>Listado completo de las {{ $amount }} etapas de licencia actualmente en el sistema</p>

            <table class="table table-header-bg table-striped js-dataTable-full-pagination">
                <thead>
                    <tr>
                        <th>Licencia</th>
                        <th>Paso</th>
                        <th>Fecha</th>
                        <th>Persona</th>
                        <th>Número</th>
                        <th>Reparo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($licenseCurrentStages as $licenseCurrentStage)
                        <tr>
                            <td>{{ $licenseCurrentStage->license->number }}</td>
                            <td>{{ $licenseCurrentStage->licenseStage->id }}</td>
                            <td>{{ $licenseCurrentStage->date_output }}</td>
                            <td>
                                @if($licenseCurrentStage and $licenseCurrentStage->person)
                                    {{ $licenseCurrentStage->person->id}}
                                @endif
                            </td>
                            <td>{{ $licenseCurrentStage->number }}</td>
                            <td>
                                @if($licenseCurrentStage and $licenseCurrentStage->objection)
                                    {{ $licenseCurrentStage->objection->id}}
                                @endif
                            </td>
                            <td><a class="btn btn-warning" href="{{ route('licensecurrentstage.show', ['id' => $licenseCurrentStage->id]) }}" role="button">Ver</a> <a class="btn btn-warning" href="{{ route('licensecurrentstage.edit', ['id' => $licenseCurrentStage->id]) }}" role="button">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $licenseCurrentStages->render() !!}
        </div>
    </div>
@endsection

