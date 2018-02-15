<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Lien pour la fonctionnalité deleteAll-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Post</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Formations/Stages</h1>
        <div class="row">
            <div class="col-md-12">
                @include('partials.menu')
            </div>
        </div>

        @if(Route::is('post.**') == false)
        <div class="row">
            <div class="col-md-8">
                @yield('content')
            </div>

            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        @include('partials.searchBar')
                    </li>
                </ul>
            </div>
        </div>
        
        @else
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                @include('partials.menu')
            </div>
        </div>
        
    </div>

@section('scripts')
<script src="{{asset('js/app.js')}}"></script>
@show

</body>
</html>