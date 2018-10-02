@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-klant')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Nieuw product</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'createKlant',null, 'class' =>'form-group']) !!}
                            {!!  Form::label('naam', 'Klant voornaam', null, ['class' =>'form-control'] )!!}
                            {!! Form::text('voornaam',null,['class' =>'form-control']) !!}
                            {!!  Form::label('achternaam', 'Klant achternaam')!!}
                            {!! Form::text('achternaam',null,['class' =>'form-control']) !!}
                            {!!  Form::label('email', 'Email')!!}
                            {!! Form::text('email',null,['class' =>'form-control']) !!}
                            {!!  Form::label('telefoonnummer', 'Telefoonnummer')!!}
                            {!! Form::number('telefoonnummer',null,['class' =>'form-control','rows' => 2]) !!}
                            {!! Form::submit('Maak aan!!', ['class'=>'btn btn-red']) !!}
                        {!! Form::close() !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
