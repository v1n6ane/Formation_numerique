<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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