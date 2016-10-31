@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h3>Titulares</h3>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-warning" href="{{ route('titular.create') }}" role="button">Dar de Alta un titular</a>
                </div>
            </div>
        </div>


        <div class="panel-body">
            <p>Listado completo de los {{ $amount }} titulares actualmente en el sistema</p>

            <table class="table table-header-bg table-striped js-dataTable-full-pagination">
                <thead>
                    <tr>
                        <th>NIF</th>
                        <th>Titular</th>
                        <th>Licencia</th>
                        <th>Número de teléfono</th>
                        <th>Correo electrónico</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($titulars as $titular)
                    <tr>
                        <td>{{ $titular->nif }}</td>
                        <td>{{ $titular->full_name }}</td>
                        <td>{{ $titular->license['number'] }}</td>
                        <td>{{ $titular->phone_number }}</td>
                        <td>{{ $titular->email }}</td>
                        <td><a class="btn btn-warning" href="{{ route('titular.show', ['id' => $titular->id]) }}" role="button">Ver</a> <a class="btn btn-warning" href="{{ route('titular.edit', ['id' => $titular->id]) }}" role="button">Editar</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $titulars->render() !!}
        </div>
    </div>
@endsection

