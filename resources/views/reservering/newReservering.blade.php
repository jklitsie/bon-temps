@extends('layouts.app')
@section('content')
    <div class="container">
        @include('partials.nav-reservering')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Bekijk reservering</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'newReservering',null, 'class' =>'form-group']) !!}
                            {!!  Form::label('klantAchternaam', 'Klant Achternaam',['class' => 'form-label'])!!}
                            <div class="row">
                                <div class="col-9">
                                    {!! Form::select('klant_id',$klanten,null,['class' =>'form-control custom-select']) !!}
                                </div>
                                <div class="col">
                                    <a  href="{{route('newKlant')}}">Nieuwe Klant?</a>
                                </div>
                            </div>
                        <visueel-tafels></visueel-tafels>
                        {!!  Form::label('menu_id', 'Selecteer menu')!!}
                        <div class="row">
                            <div class="col-9">
                                {!! Form::select('pocket[0][menu_id]',$menus,null,['class' =>'custom-select']) !!}
                            </div>
                            <div class="col">
                                {!! Form::number('pocket[0][menu_hoeveelheid]',null,['class' =>'form-control ']) !!}
                            </div>
                            <div class="col-1">
                                <a href='#'id="extramenusselect">Extra menu +</a>
                            </div>
                        </div>
                        <div id="extramenus">

                        </div>
                            {!!  Form::label('notitie', 'Notitie')!!}
                            <div class="row">
                                <div class="col">
                                    {!! Form::textarea('notitie',null,['rows'=>'2','class' =>'form-control']) !!}
                                </div>
                            </div>
                            {!! Form::submit('Maak aan!!', ['class'=>'btn btn-red', 'id' => 'submitIets']) !!}
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
    @push('footer-scripts')
        <script type="text/javascript">
            function searchUsers(){
                const search = document.getElementsByClassName('naam')[0].value;
                const path = document.getElementsByClassName('searchusers')[0];
                
                while (path.firstChild) {
                    path.removeChild(path.firstChild);
                }
                axios.get('searchKlanten/' + search)
                    .then(response => {

                            response.data.klanten.forEach((item) => {
                                let newP = document.createElement('p')
                                newP.id = item.id
                                newP.className = 'form-control klikiets'

                                newP.innerHTML = item.voornaam
                                newP.setAttribute('onmousedown','postUserValue('+ item.id +')')
                                path.appendChild(newP)
                                });
                        });

            }
            function postUserValue(value){
                console.log(value)
            }
            document.addEventListener('DOMContentLoaded', function(){

                //Tafel selectie script
                let extraTafels = 1;
                let tafelSelect = document.getElementById('groepsgrootte');
                let tafelHoeveelheid = document.getElementById('tafelCount');
                tafelSelect.addEventListener("focusout", () => {
                  if(tafelSelect.value >= 6){
                    let extraTafels = tafelSelect.value/6
                    tafelHoeveelheid.innerText = 'Tafel Hoeveelheid : ' +Math.ceil(extraTafels);

                  }else{
                    tafelHoeveelheid.innerText = 'Tafel Hoeveelheid : ' + extraTafels;
                  }
                });
                // Eind tafel selectiescript

                //Extramenu script
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
              //eind extra menu script


            });





        </script>
    @endpush
@endsection
