@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h3>Denuncias</h3>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-warning" href="{{ route('denunciation.create') }}" role="button">Dar de Alta una denuncia</a>
                </div>
            </div>
        </div>


        <div class="panel-body">
            <p>Listado completo de las {{ $amount }} denuncias actualmente en el sistema</p>

            <table class="table table-header-bg table-striped js-dataTable-full-pagination">
                <thead>
                    <tr>
                        <th>Licencia</th>
                        <th>Fecha de registro</th>
                        <th>Número de expediente</th>
                        <th>Razón</th>
                        <th>Estatus</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($denunciations as $denunciation)
                        <tr>

                            <td>{{ $denunciation->license->number }}</td>
                            <td>{{ $denunciation->register_date_output }}</td>
                            <td>{{ $denunciation->expedient_number }}</td>
                            <td>
                                @if($denunciation->reason)
                                    {{ $denunciation->reason }}
                                @endif
                            </td>
                            <td>{{ $denunciation->status }}</td>
                            <td><a class="btn btn-warning" href="{{ route('denunciation.show', ['id' => $denunciation->id]) }}" role="button">Ver</a> <a class="btn btn-warning" href="{{ route('denunciation.edit', ['id' => $denunciation->id]) }}" role="button">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $denunciations->render() !!}
        </div>
    </div>
@endsection