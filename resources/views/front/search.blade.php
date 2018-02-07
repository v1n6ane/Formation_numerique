@extends('layouts.master')

@section('content')

<div class="row">
    <ul class="list-group">

        @if(isset($details))
            <h2>Détails de votre recherche "<b>{{ $query }}"</b></h2>
            {{$details->links()}}
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
                        <p>Categorie : {{$post->category->name}}</p>
                    </div>

                    <div class="col-xs-6 col-md-9">
                        <p>Type : {{$post->post_type}}</p>
                    </div>
                
                    <div class="col-xs-6 col-md-4">
                        <p>Date de début : {{$post->start_date}}</p>
                    </div>
                
                    <div class="col-xs-6 col-md-4">
                        <p>Date de fin : {{$post->end_date}}</p>
                    </div>
                </div>
            </li>
            @endforeach
            {{$details->links()}}
        @elseif(isset($message))
            <p>{{$message}}</p>
        @endif

    </ul>
</div>

@endsection 