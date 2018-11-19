@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.nav-menu')
    </div>
    <menu-overzicht></menu-overzicht>

    @push('footer-scripts')
        {{--@TODO--}}
        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', function(){

            });
        </script>
    @endpush
@endsection
