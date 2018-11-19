@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-reservering')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle reserveringen </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Achternaam klant</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Start Tijd</th>
                                <th scope="col">Eind Tijd</th>
                                <th scope="col">Groepsformaat</th>
                                <th scope="col"></th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach($reserveringen as $reservering)
                                <tr>
                                    <td>
                                        {{$reservering->klant->achternaam}}
                                    </td>
                                    <td>
                                        {{$reservering->datum}}
                                    </td>
                                    <td>
                                        {{$reservering->start_tijd}}
                                    </td>
                                    <td>
                                        {{$reservering->eind_tijd}}
                                    </td>
                                    <td>
                                        {{$reservering->groepsgroote}}
                                    </td>
                                    <td>
                                        <a href="{{route('reserveringen', $reservering->id)}}" class="btn btn-primary">Bekijk Reservering</a>

                                        <a href="{{route('showFactuur', $reservering->id)}}" class=" btn btn-primary">Factuur</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
