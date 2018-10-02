@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-klant')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle menu's <a class="pull-right btn btn-green" href="{{route('exportKlant')}}">Exporteer alle klanten</a></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Voormaam</th>
                                <th scope="col">Achternaam</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefoonnummer</th>
                                <th>asd</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($klanten as $klant)
                                <tr>
                                    <td>
                                        {{$klant->voornaam}}
                                    </td>
                                    <td>
                                        {{$klant->achternaam}}
                                    </td>
                                    <td>
                                        {{$klant->email}}
                                    </td>
                                    <td>
                                        {{$klant->telefoonnummer}}
                                    </td>
                                    <td>
                                        <a href="{{route('editKlant', $klant->id)}}" class="btn btn-primary">Bewerk Klant</a>
                                        <a href="{{route('deleteKlant', $klant->id)}}" class="btn btn-primary">Verwijder Klant</a>
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
