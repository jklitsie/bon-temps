@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-reservering')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Alle menu's  <a href="{{route('deleteReservering', $reservering->id)}}" class=" pull-right btn btn-primary">Verwijder Reservering</a></div>
                    <div class="card-body">
                        {!! Form::model($reservering ,['route' => ['editReservering', $reservering->id ],null, 'class' =>'form-group', 'method' => 'put']) !!}
                        {!!  Form::label('klantAchternaam', 'Klant Achternaam',['class' => 'form-label'])!!}
                        <div class="row">
                            <div class="col-9">
                                {!! Form::select('klant_id',$klanten,null,['class' =>'form-control custom-select']) !!}
                            </div>
                        </div>
                        {!!  Form::label('menu_id', 'Selecteer menu')!!}
                        <a href='#'id="extramenusselect">Extra menu +</a>
                        @foreach($reservering_menu as $menu)

                            <div id="m-{{$count}}" class="row">
                                <div class="col-9">
                                    <select name="pocket[{{$count}}][menu_id]" class='custom-select'>
                                        <option value="{{$menu->id}}">{{$menu->naam}}</option>
                                    </select>

                                </div>
                                <div class="col">
                                    <input class="form-control" name="pocket[{{$count}}][menu_hoeveelheid]" value="{{$menu->pivot->menu_hoeveelheid}}" required />
                                </div>
                                <div class="col-1">
                                    <a href="{{route('deleteMenu_Reservering',[$reservering->id,$menu->id])}}">delete menu +</a>
                                </div>
                            </div>
                        @endforeach
                        <div id="extramenus">

                        </div>
                        <div class="row">
                            <div class="col">
                                {!!  Form::label('datum', 'Datum')!!}
                                {!! Form::date('datum',null,['class' =>'form-control']) !!}
                            </div>
                            <div class="col">
                                {!!  Form::label('start_tijd', 'Start Tijd')!!}
                                {!! Form::time('start_tijd',null,['class' =>'form-control']) !!}
                            </div>
                            <div class="col">
                                {!!  Form::label('eind_tijd', 'eind Tijd')!!}
                                {!! Form::time('eind_tijd',null,['class' =>'form-control']) !!}
                                </div>
                            </div>
                        {!!  Form::label('groepsgroote', 'Groepsgroote')!!}
                        <div class="row">
                            <div class="col">
                                {!! Form::number('groepsgroote',null,['class' =>'form-control']) !!}
                            </div>
                        </div>
                        {!!  Form::label('notitie', 'Notitie')!!}
                        <div class="row">
                            <div class="col">
                                {!! Form::textarea('notitie',null,['rows'=>'2','class' =>'form-control']) !!}
                            </div>
                        </div>
                        {!! Form::submit('Bewerk!!', ['class'=>'btn btn-green']) !!}
                        {!! Form::close() !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('footer-scripts')
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function(){
        let el = document.getElementById('extramenus');
        let elSel = document.getElementById('extramenusselect');
        let count = 1;
        elSel.onclick = function(e){
          e.preventDefault();
          axios.get('{{route('extraMenuRegel')}}').then(function (response) {
            let element = document.createElement('div');
            element.className = 'row';
            element.setAttribute("id", count);
            console.log(response.data)
            element.innerHTML = response.data.html

            // element grab by class
            let btnRemove = element.getElementsByClassName('btn-remove')[0];
            btnRemove.dataset['id'] = count;
            btnRemove.onclick = function(event){
              event.preventDefault();
              let rowSelect = document.getElementById(btnRemove.dataset.id);
              rowSelect.remove();
              btnRemove.preventDefault();
            }
            el.appendChild(element)
            let loadChange = document.getElementById('triggerEdit');
            let loadChange2 = document.getElementById('triggerEditHoeveelheid');
            loadChange.name = 'pocket[' + count + '][menu_id]';
            loadChange.removeAttribute('id');
            loadChange2.name = 'pocket[' + count + '][menu_hoeveelheid]';
            loadChange2.removeAttribute('id');
            count++;
          })
        }
      });




    </script>
@endpush