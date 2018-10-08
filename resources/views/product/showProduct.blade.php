@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-menu')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle producten</div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-6">
                        {!! Form::model($product ,['editMenu', $product->id ,null, 'class' =>'form-group', 'method' => 'put']) !!}
                            {!!  Form::label('naam', 'Menu naam', null, ['class' =>'form-control'] )!!}
                            {!! Form::text('naam',null,['class' =>'form-control']) !!}
                            {!!  Form::label('omschrijving', 'Menu omschrijving')!!}
                            {!! Form::textarea('omschrijving',null,['class' =>'form-control','rows' => 2]) !!}
                            {!!  Form::label('prijs', 'Menu prijs')!!}
                            {!! Form::number('prijs',null,['class' =>'form-control','rows' => 2]) !!}
                            {{--<h3>Bestaande allergieen</h3>
                            <ul>
                                @foreach($bestaandeAllergieën as $bestaandeAllergie)
                                    <li>{{$bestaandeAllergie->naam}}</li>
                                @endforeach
                            </ul>--}}
                        </div>
                        <div class="col-6">
                            <h4>Allergieën</h4>
                            {{--@TODO--}}
                            @foreach($allergieën as $allergie)
                                <div class="row">
                                    {!!  Form::label('Allergie', $allergie->naam,['class'=>'col-6'])!!}
                                    <input type="checkbox" name="allergieën[]" value="{{$allergie->id}}" class="col-6 input-alternate"@if(in_array($allergie->id, $checkArray))
                                            checked
                                            @else
                                            unchecked
                                            @endif><br>
                                    {{--{!! Form::checkbox('allergieën[]',$allergie->id,false,['class'=>'col-6 input-alternate']) !!}--}}
                                </div>
                            @endforeach
                        </div>
                            {!! Form::submit('Bewerk', ['class'=>'btn btn-red']) !!}
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
    </div>
@endsection
