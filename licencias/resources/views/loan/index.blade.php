@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h3>Préstamos</h3>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-warning" href="{{ route('loan.create') }}" role="button">Dar de Alta un préstamo</a>
                </div>
            </div>
        </div>


        <div class="panel-body">
            <p>Listado completo de los {{ $amount }} prestamos actualmente en el sistema</p>

            <table class="table table-header-bg table-striped js-dataTable-full-pagination">
                <thead>
                    <tr>
                        <th>Licencia</th>
                        <th>Persona</th>
                        <th>Fecha de préstamo</th>
                        <th>Fecha de devolución</th>
                        <th>Estatus</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loans as $loan)
                        <tr>
                            <td>{{ $loan->license->number }}</td>
                            <td>{{ $loan->person->first_name }} {{ $loan->person->last_name }}</td>
                            <td>{{ $loan->loan_date_output }}</td>
                            <td>{{ $loan->giving_back_date_output }}</td>
                            <td>
                                @if($loan->giving_back_date_output)
                                    Entregado
                                @else
                                    Prestado
                                @endif
                            </td>
                            <td><a class="btn btn-warning" href="{{ route('loan.show', ['id' => $loan->id]) }}" role="button">Ver</a> <a class="btn btn-warning" href="{{ route('loan.edit', ['id' => $loan->id]) }}" role="button">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $loans->render() !!}
        </div>
    </div>
@endsection

