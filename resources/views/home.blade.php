@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            Reserveringen van vandaag
                        </div>
                        <div class="col">
                            <form method="post" action="/changereserveringdate">
                                @csrf
                                <input type="date" name="datum "/>
                                <button type="submit" class="btn btn-success">Verander datum</button>
                            </form>
                        </div>
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
            </div>
        </div>
    </div>
</div>
@endsection
