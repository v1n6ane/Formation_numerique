@extends('layouts.master')

@section('content')

<div class="row">
    <ul class="list-group">

        @if(isset($details))
            <h2>Détails de votre recherche "<b>{{ $query }}"</b></h2>
            {{$details->appends(request()->only('q'))->links()}}
            @foreach($details as $post)
            <li class="list-group-item">
                <h2><a href="{{url('post', $post->id)}}">{{$post->title}}</a></h2>
                <div class="row">
            
                    @if(count($post->picture) > 0)
                    <div class="col-xs-6 col-md-3">
                        <a href="#" class="thumbnail">
                            <img width="171" src="{{asset('images/'.$post->picture->link)}}" alt="{{$post->picture->title}}">
                        </a>
                    </div>
                    @endif
                
                    <div class="col-xs-6 col-md-9">
                        <p>{{$post->description}}</p>
                    </div>

                    <div class="col-xs-6 col-md-9">
                        @if(isset($post->category->name))
                        <p>Categorie : {{$post->category->name}}</p>
                        @else
                        <p>Categorie : <em>Null</em></p>
                        @endif
                    </div>

                    <div class="col-xs-6 col-md-9">
                        <p>Type : {{$post->post_type}}</p>
                    </div>
                
                    <div class="col-xs-6 col-md-4">
                        <p>Date de début : {{$post->start_date_fr}}</p>
                    </div>
                
                    <div class="col-xs-6 col-md-4">
                        <p>Date de fin : {{$post->end_date_fr}}</p>
                    </div>
                </div>
            </li>
            @endforeach
            {{$details->appends(request()->only('q'))->links()}}
        @elseif(isset($message))
        <div class="jumbotron">
            <p>{{$message}}</p>
        </div>        
        @endif
    </ul>
</div>

@endsection 