@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-reservering')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle reservering </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Achternaam klant</th>
                                <th scope="col">Tijd</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Telefoonnummer</th>
                                <th>asd</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($reserveringen as $reservering)
                                <tr>
                                    <td>
                                        {{$reservering->klant->achternaam}}
                                    </td>
                                    <td>
                                        {{$reservering->klant->achternaam}}
                                    </td>
                                    <td>
                                        {{$reservering->menu->naam}}
                                    </td>
                                    <td>
                                        {{$reservering->klant->telefoonnummer}}
                                    </td>
                                    <td>
                                       {{-- <a href="{{route('editKlant', $klant->id)}}" class="btn btn-primary">Bewerk Reservering</a>
                                        <a href="{{route('deleteKlant', $klant->id)}}" class="btn btn-primary">Verwijder Reservering</a>--}}
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
