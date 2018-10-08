@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-product')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle menu's</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Naam</th>
                                <th scope="col">Omschrijving</th>
                                <th scope="col">Prijs</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        {!! $product->id !!}
                                    </td>
                                    <td>
                                        {{$product->naam}}
                                    </td>
                                    <td>
                                        {{$product->omschrijving}}
                                    </td>
                                    <td>
                                        {{$product->prijs}}
                                    </td>
                                    <td>
                                        <a href="{{route('editProduct', $product->id)}}" class="btn btn-primary">Bewerk product</a>
                                        <a href="{{route('deleteProduct', $product->id)}}" class="btn btn-primary">Verwijder product</a>
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
