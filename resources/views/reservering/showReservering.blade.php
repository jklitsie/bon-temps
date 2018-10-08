@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-reservering')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle menu's  <a href="{{route('deleteReservering', $reservering->id)}}" class=" pull-right btn btn-primary">Verwijder Reservering</a></div>
                    <div class="card-body">
                        {!! Form::model($reservering ,['route' => ['editReservering', $reservering->id ],null, 'class' =>'form-group', 'method' => 'put']) !!}
                        {!!  Form::label('klantAchternaam', 'Klant Achternaam',['class' => 'form-label'])!!}
                        <div class="row">
                            <div class="col-9">
                                {!! Form::select('klant_id',$klanten,null,['class' =>'form-control custom-select']) !!}
                            </div>
                            <div class="col">
                                <a  href="{{route('newKlant')}}">Nieuwe Klant?</a>
                            </div>
                        </div>
                        {!!  Form::label('menu_id', 'Selecteer menu')!!}
                        <div class="row">
                            <div class="col-9">
                                {!! Form::select('menu_id',$menus,null,['class' =>'custom-select']) !!}
                            </div>
                            <div class="col">
                                {!! Form::number('menu_hoeveelheid',null,['class' =>'form-control ']) !!}
                            </div>
                            <div class="col-1">
                                <a href="">Extra menu +</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                {!!  Form::label('datum', 'Datum')!!}
                                {!! Form::date('datum',null,['class' =>'form-control']) !!}
                            </div>
                            <div class="col">
                                {!!  Form::label('start_tijd', 'Start Tijd')!!}
                                {!! Form::time('start_tijd',null,['class' =>'form-control']) !!}
                            </div>
                            <div class="col">
                                {!!  Form::label('eind_tijd', 'eind Tijd')!!}
                                {!! Form::time('eind_tijd',null,['class' =>'form-control']) !!}
                            </div>
                        </div>
                        {!!  Form::label('groepsgroote', 'Groepsgroote')!!}
                        <div class="row">
                            <div class="col">
                                {!! Form::number('groepsgroote',null,['class' =>'form-control']) !!}
                            </div>
                        </div>
                        {!!  Form::label('notitie', 'Notitie')!!}
                        <div class="row">
                            <div class="col">
                                {!! Form::textarea('notitie',null,['rows'=>'2','class' =>'form-control']) !!}
                            </div>
                        </div>
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
