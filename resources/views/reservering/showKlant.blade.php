@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-reservering')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle menu's</div>
                    <div class="card-body">
                        {!! Form::model($klant ,['editKlant', $klant->id ,null, 'class' =>'form-group', 'method' => 'put']) !!}
                            {!!  Form::label('naam', 'Klant voornaam', null, ['class' =>'form-control'] )!!}
                            {!! Form::text('voornaam',null,['class' =>'form-control']) !!}
                            {!!  Form::label('achternaam', 'Klant achternaam')!!}
                            {!! Form::text('achternaam',null,['class' =>'form-control']) !!}
                            {!!  Form::label('email', 'Email')!!}
                            {!! Form::text('email',null,['class' =>'form-control']) !!}
                            {!!  Form::label('telefoonnummer', 'Telefoonnummer')!!}
                            {!! Form::number('telefoonnummer',null,['class' =>'form-control','rows' => 2]) !!}
                            {!! Form::submit('+ Bewerk', ['class'=>'btn btn-red']) !!}
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
