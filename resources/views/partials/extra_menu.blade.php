

    <div class="col-9">
        <select id='triggerEdit' class="custom-select">
            @foreach($menus as $menu)
                <option value="{{$menu->id}}">{{$menu->naam}}</option>
            @endforeach
        </select>
    </div>
    <div class="col">
        <input id="triggerEditHoeveelheid" type="number" class="form-control ">
    </div>
    <div class="col-1">
        <a href="">Verwijder extra -</a>
    </div>


