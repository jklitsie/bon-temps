@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">

                    <div class="float-left">
                        <h2>Reserveringen</h2>
                    </div>


                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            Achternaam klant
                        </div>
                        <div class="col">
                            Start tijd
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <hr />
                    @foreach($reserveringen as $reservering)
                        @if(!$reservering->betaald)
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('showKlant',$reservering->klant->id)}}">{{$reservering->klant->achternaam}}</a>
                                </div>
                                <div class="col">
                                    {{$reservering->start_tijd}}
                                </div>
                                <div class="col">
                                    <a href="{{route('showFactuur',$reservering->id)}}">Naar factuur</a>
                                </div>
                            </div>
                            <hr />
                        @endif
                    @endforeach

                </div>
                <div class="card-footer">
                    <form method="post" action="/changereserveringdate">
                        @csrf
                        <input class="d-inline-block form-control col-6" type="date" name="datum"/>
                        <button class="d-inline-block btn btn-success col-5" type="submit" class="">Verander datum</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <button class="d-inline-block btn btn-success col-5" type="submit" class="">Snelle opties 1</button>
                    <button class="d-inline-block btn btn-success col-5" type="submit" class="">Snelle opties 2</button>
                    <button class="d-inline-block btn btn-success col-5" type="submit" class="">Snelle opties 3</button>
                    <button class="d-inline-block btn btn-success col-5" type="submit" class="">Snelle opties 4</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
