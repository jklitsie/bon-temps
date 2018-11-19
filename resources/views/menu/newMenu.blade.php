@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-menu')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle menu's</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'createMenu',null, 'class' =>'form-group']) !!}
                            {!!  Form::label('naam', 'Menu naam', null, ['class' =>'form-control'] )!!}
                            {!! Form::text('naam',null,['class' =>'form-control']) !!}
                            {!!  Form::label('omschrijving', 'Menu omschrijving')!!}
                            {!! Form::textarea('omschrijving',null,['class' =>'form-control','rows' => 2]) !!}
                            {!!  Form::label('gangen', 'Gangen')!!}
                            {!! Form::number('gangen',null,['class' =>'form-control','rows' => 2]) !!}
                            {!!  Form::label('prijs', 'Menu prijs')!!}
                        {!!  Form::number('prijs', null,['class' =>'form-control','step' => '0.01','min' => '0'])!!}
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
