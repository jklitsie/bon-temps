@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-reservering')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1 class="pull-left">Factuur</h1>
                        <div class="switch pull-right">
                            <label>
                                @if($reservering->betaald)
                                    <a class="btn btn-green">Betaald</a>
                                @else
                                    <a id="statustrigger" class="btn btn-red">Nog niet betaald</a>
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-6">
                                <p> {{$reservering->klant->voornaam}}{{$reservering->klant->achternaam}}</p>
                                <p> {{$reservering->klant->email}}</p>
                                <p>{{$reservering->klant->telefoonnummer}}</p>
                                <p>{{$reservering->datum}}</p>
                            </div>
                            <div class=" col-6">
                                <div class="pull-right">
                                <p>Bon temps</p>
                                <p>Adress 1</p>
                                <p>Postcode</p>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col">
                                <p class="pull-left col-3">Productnaam</p>
                                <p class="pull-left col-3">Hoeveelheid</p>
                                <p class="pull-left col-3">prijs</p>
                                <p class="pull-right ">Totaal</p>
                            </div>
                        </div>
                        @foreach($reservering->menus as $menu)
                        <div class="row">
                            <div class="col">
                                <p class="pull-left col-3">{{$menu->naam}}</p>
                                <p class="pull-left col-3">{{$menu->pivot->menu_hoeveelheid}}</p>
                                <p class="pull-left col-3">{{$menu->prijs}}</p>
                                <p class="pull-right">&euro;{{$menu->prijs * $menu->pivot->menu_hoeveelheid}}</p>

                            </div>
                        </div>
                        @endforeach

                        @foreach($reservering->factuurregels as $regel)
                            <div class="row">
                                <div class="col">
                                    <p class="pull-left col-3">{{$regel->product}}</p>
                                    <p class="pull-left  col-3">{{$regel->prijs}} </p>
                                    <p class="pull-left  col-3"> {{$regel->hoeveelheid}}</p>

                                    <p class="pull-right  ">&euro;{{$regel->prijs * $regel->hoeveelheid}}</p>

                                </div>
                            </div>
                        @endforeach
                        <hr />
                        @if(!$reservering->betaald)
                        <div class="row">
                            <div class="col">

                                {!! Form::open(['route' => ['newFactuur_regel',$reservering->id],null, 'class' =>'form-inline']) !!}
                                    {!! Form::text('product','Product',['class'=>'form-control']) !!}
                                    {!! Form::number('prijs',0,['class'=>'form-control']) !!}
                                    {!! Form::number('hoeveelheid',0,['class'=>'form-control']) !!}
                                    {!! Form::submit('voeg toe',['class'=> 'btn btn-green form-control']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                            <hr />
                        @endif
                        <div class="row">
                            <div class="col">
                                <h1 class="pull-right">
                                    @if(!$reservering->betaald)
                                        te betalen :
                                    @endif
                                        &euro;{{$totaalprijs}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('footer-scripts')
        {{--@TODO--}}
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function(){
                const el = document.getElementById('statustrigger');
                el.onclick = function(){
                    axios.get( '{{route('factuurStatus',$reservering->id)}}').then(function(response){
                        el.remove();
                    });
                }

            });



        </script>
    @endpush
@endsection
