@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-menu')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Voeg producten toe aan menu {{$menu->naam}}</div>
                    <div class="card-body">

                        @include('partials.menu_overzicht')


                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Naam</th>
                                <th scope="col">Omschrijving</th>
                                <th scope="col">Prijs</th>
                                <th>Opties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($available as $available_product)
                                <tr>
                                    <td>
                                        {{$available_product->naam}}
                                    </td>
                                    <td>
                                        {{$available_product->omschrijving}}
                                    </td>
                                    <td>
                                        {{$available_product->prijs}}
                                    </td>
                                    <td>

                                        {!! Form::open(['route' => ['addProductMenu',$menu->id, $available_product->id],null,'class' => 'form-group']) !!}
                                        {!! Form::label('gang','Voeg toe aan gang') !!}
                                        {!! Form::select('gang',$gangen
                                        ,null,['class' => 'browser-default']); !!}
                                        {!! Form::submit('+ Voeg toe', ['class'=>'btn btn-red']) !!}
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{ $available->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
