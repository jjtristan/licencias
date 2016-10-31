@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h3>Reparos</h3>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <p>Listado completo de los {{ $amount }} reparos actualmente en el sistema</p>

            <table class="table table-header-bg table-striped js-dataTable-full-pagination">
                <thead>
                    <tr>
                        <th>Licencia</th>
                        <th>Primera Posición de Persona</th>
                        <th>Segunda Posición de Persona</th>
                        <th>Fecha de reporte</th>
                        <th>Fecha de corrección</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objections as $objection)
                        <tr>
                            <td>{{ $objection->license->id }}</td>
                            <td>{{ $objection->firstPersonPosition->name }}</td>
                            <td>
                                @if($objection->secondPersonPosition)
                                    {{ $objection->secondPersonPosition->name }}
                                @endif
                            </td>
                            <td>{{ $objection->report_date_output }}</td>
                            <td>{{ $objection->correction_date_output }}</td>
                            @if(env('FILE_UPLOAD'))
                                <td><a href="{{ route('file.download', ['file' => $objection->file->id]) }}" target="_blank">Descargar {{ $objection->file->filename }}</a></td>
                            @endif
                            <td><a class="btn btn-warning" href="{{ route('objection.show', ['id' => $objection->id]) }}" role="button">Ver</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $objections->render() !!}
        </div>
    </div>
@endsection

