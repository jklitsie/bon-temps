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
                            {!!  Form::label('menu_id', 'Selecteer menu')!!}
                            <div class="row">
                                <div class="col-9">
                                    {!! Form::select('pocket[1]["menu_id"]',$menus,null,['class' =>'custom-select']) !!}
                                </div>
                                <div class="col">
                                    {!! Form::number('pocket[1]["menu_hoeveelheid"]',null,['class' =>'form-control ']) !!}
                                </div>
                                <div class="col-1">
                                    <a id="extramenusselect">Extra menu +</a>
                                </div>
                            </div>
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
                            {!! Form::submit('Maak aan!!', ['class'=>'btn btn-red']) !!}
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
        {{--@TODO--}}
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
                let el = document.getElementById('extramenus');
                let elSel = document.getElementById('extramenusselect');

                el.preventDefault
                elSel.onclick = function(){

                    axios.get('{{route('extraMenuRegel')}}').then(function (response) {
                        let element = document.createElement('div');
                        element.className = 'row';
                        console.log(response.data)
                        element.innerHTML = response.data.html
                        el.appendChild(element)
                    })
                }
            });





        </script>
    @endpush
@endsection
