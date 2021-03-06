@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-menu')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle menu's</div>
                    <div class="card-body">
                        <div class="row">
                            {!! Form::model($menu ,['editMenu', $menu->id ,null, 'class' =>'form-group col-6', 'method' => 'put']) !!}
                                {!!  Form::label('naam', 'Menu naam', null, ['class' =>'form-control'] )!!}
                                {!! Form::text('naam',null,['class' =>'form-control']) !!}
                                {!!  Form::label('omschrijving', 'Menu omschrijving')!!}
                                {!! Form::textarea('omschrijving',null,['class' =>'form-control','rows' => 2]) !!}
                                {!!  Form::label('gangen', 'Gangen')!!}
                                {!! Form::number('gangen',null,['class' =>'form-control','rows' => 2]) !!}
                                {!!  Form::label('prijs', 'Menu prijs')!!}
                                {!!  Form::number('prijs', null,['class' =>'form-control','step' => '0.01','min' => '0'])!!}
                                {!! Form::submit('+ bewerk', ['class'=>'btn btn-red']) !!}
                            <a href="{!! route('showAddProductMenu',$menu->id) !!}" class="btn btn-green"> + voeg producten toe</a>
                            {!! Form::close() !!}
                            <div class="col-6">
                                @for($i = 1; $i <= $gangen;$i++)
                                    <p class="text-center">gang {!! $i; !!}</p>
                                    @foreach($menu_products as $product)
                                        @if($product->pivot->gang == $i)
                                            <a href="{{route('showProduct', $product->id)}}" >{{$product->naam}}</a>
                                        @endif
                                    @endforeach
                                @endfor
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <h1>de volgende allergieën komen voor in dit menu</h1>
                            </div>
                            <div class="col-12">
                                <ul>
                                    @foreach($allergieën as $allergie)
                                        <li>{{$allergie}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
