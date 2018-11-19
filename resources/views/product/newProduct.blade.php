@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-product')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Nieuw product</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'createProduct',null, 'class' =>'form-group row']) !!}
                        <div class="col-6">
                            {!!  Form::label('naam', 'product naam', null, ['class' =>'form-control'] )!!}
                            {!! Form::text('naam',null,['class' =>'form-control']) !!}
                            {!!  Form::label('omschrijving', 'product omschrijving')!!}
                            {!! Form::textarea('omschrijving',null,['class' =>'form-control','rows' => 2]) !!}
                            {!!  Form::label('prijs', 'product prijs')!!}
                            {!!  Form::number('prijs', null,['class' =>'form-control','step' => '0.01','min' => '0'])!!}
                        </div>
                        <div class="col-6">
                            <h4>Allergieën</h4>
                            @foreach($allergieën as $allergie)
                            <div class="row">
                                {!!  Form::label('Allergie', $allergie->naam,['class'=>'col-6'])!!}
                                {!! Form::checkbox('allergieën[]',$allergie->id,false,['class'=>'col-6 input-alternate']) !!}
                             </div>
                            @endforeach
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
