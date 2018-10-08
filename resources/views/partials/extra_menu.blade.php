

    <div class="col-9">
        <select id="menu_id" name="menu_id" class="custom-select">
            @foreach($menus as $menu)
                <option value="{{$menu->id}}">{{$menu->naam}}</option>
            @endforeach
        </select>
    </div>
    <div class="col">
        <input name="menu_hoeveelheid" type="number" class="form-control ">
    </div>
    <div class="col-1">
        <a href="">Verwijder extra -</a>
    </div>


