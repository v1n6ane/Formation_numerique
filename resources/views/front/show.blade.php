@extends('layouts.master')

@section('content')

<ul class="list-group">
    <li class="list-group-item">
        
        <h2><a href="{{url('post', $post->id)}}">{{$post->title}}</a></h2>
        
        <div class="row">
        @if(count($post->picture) > 0)
            <div class="col-xs-3 col-md-4">
                <a href="{{url('post', $post->id)}}" class="thumbnail">
                    <img width="171" src="{{asset('images/'.$post->picture->link)}}" alt="{{$post->picture->title}}">
                </a>
            </div>
            @endif
               
            <div class="col-xs-9 col-md-8">
                <p>{{$post->description}}</p>
            </div>

        </div> 

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <p>{{$post->post_type}}</p>
            </div>
            <div class="col-xs-9 col-md-4">
                <ul>
                    <li>Date de début : {{$post->start_date_fr}}</li>
                    <li>Date de fin : {{$post->end_date_fr}}</li>
                    <li>Prix : {{$post->price}} €</li>
                </ul>
            </div>
            <div class="col-xs-9 col-md-4">
                <ul>
                    <li>Nombre d'élève : {{$post->nb_max_student}}</li>
                </ul>
            </div>
        </div>       
        
    </li>
</ul>

@endsection