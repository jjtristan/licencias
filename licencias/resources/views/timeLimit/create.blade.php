@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    Alta de Limites de Entrega
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-warning" href="{{ route('timelimit.index') }}" role="button">Volver al listado</a>
                </div>
            </div>
        </div>

        <div class="panel-body">

            @include('errors.form')

            {!! Form::open(array('route' => 'timelimit.store')) !!}

                @include('timeLimit.fields')

                {!! Form::button('Crear Limite de Entrega', ['class'=> 'btn btn-warning', 'type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
