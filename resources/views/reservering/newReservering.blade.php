@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-reservering')
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Nieuw product</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'newReservering',null, 'class' =>'form-group']) !!}

                            {!!  Form::label('achternaam', 'Klant achternaam')!!}
                            {!! Form::text('achternaam',null,['class' =>'form-control naam','onkeyup' =>'searchUsers()']) !!}
                            <div class='col searchusers ' style="display:hidden; position:absolute; background:white;">
                            </div>
                            {!!  Form::label('naam', 'Klant voornaam', null, ['class' =>'form-control'] )!!}
                            {!! Form::text('voornaam',null,['class' =>'form-control']) !!}
                            {!!  Form::label('email', 'Email')!!}
                            {!! Form::text('email',null,['class' =>'form-control']) !!}

                            {!!  Form::label('asd', 'Email')!!}
                            {!! Form::select('asd',array($klanten),['class' =>'form-control']) !!}

                            {!!  Form::label('telefoonnummer', 'Telefoonnummer')!!}
                            {!! Form::date('telefoonnummer',null,['class' =>'form-control','rows' => 2]) !!}


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
                

            });



        </script>
    @endpush
@endsection
