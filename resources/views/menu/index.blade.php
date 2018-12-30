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
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Naam</th>
                                <th scope="col">Omschrijving</th>
                                <th scope="col">Prijs</th>
                                <th scope="col">Actief</th>
                                <th scope="col">Gangen</th>
                                <th>opties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>
                                        {!! $menu->id !!}
                                    </td>
                                    <td>
                                        {{$menu->naam}}
                                    </td>
                                    <td>
                                        {{$menu->omschrijving}}
                                    </td>
                                    <td>
                                        {{$menu->prijs}}
                                    </td>
                                    <td>
                                        <div class="switch asd" id="switch">
                                            <label>

                                                {!! Form::open(['route' => ['menuToggle',$menu->id],null,'class' => 'toggle']) !!}
                                                <input class='checkbox' type="checkbox" value="{{$menu->id}}"
                                                       @if($menu->actief == 1)
                                                       checked/>
                                                @else
                                                    unchecked />
                                                @endif

                                                <span onclick="onClick({{$menu->id}})" class="lever"></span>
                                                {!! Form::close() !!}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        {{$menu->gangen}}
                                    </td>
                                    <td>
                                        <a href="{{route('editMenu', $menu->id)}}" class="btn btn-primary">Bewerk
                                            menu</a>
                                        <a href="{{route('deleteMenu', $menu->id)}}" class="btn btn-primary">Verwijder
                                            menu</a>
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




    @push('footer-scripts')
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function () {

            });


            function onClick(e) {
                axios.get('menu/' + e + '/toggle')
                    .then(function (response) {
                        location.reload();
                    })
            }
        </script>
    @endpush
@endsection
