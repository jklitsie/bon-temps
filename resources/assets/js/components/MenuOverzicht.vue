<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle menu's</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
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
                                            Nee
                                            {!! Form::open(['route' => ['menuToggle',$menu->id],null,'class' => 'toggle']) !!}
                                            <input class='checkbox' type="checkbox" value="{{$menu->id}}">
                                            <span class="lever" ></span> Aan
                                            {!! Form::close() !!}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{$menu->gangen}}
                                </td>
                                <td>
                                    <a href="{{route('editMenu', $menu->id)}}" class="btn btn-primary">Bewerk menu</a>
                                    <a href="{{route('deleteMenu', $menu->id)}}" class="btn btn-primary">Verwijder menu</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $menus->links() }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
</script>
