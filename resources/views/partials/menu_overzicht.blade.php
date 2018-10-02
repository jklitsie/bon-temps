@for($i = 1; $i <= $menu->gangen;$i++)
    <table class="table">
        Gang {!! $i !!}
        <thead>
            <tr>
                <th>Naam</th>
                <th>Omschrijving</th>
                <th>Prijs</th>
            </tr>
        </thead>
        <tbody>
    @foreach($menu_products as $product)
        @if($product->pivot->gang == $i)
                <tr>
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

                        <a href="{{route('deleteProductFromMenu',[$menu->id , $product->id]) }}" class="btn btn-primary">Verwijder product</a>
                    </td>
                </tr>
        @endif
    @endforeach
        </tbody>
    </table>
@endfor

