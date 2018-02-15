@extends('layouts.master')

@section('content')

{{$posts->links()}}

<div class="row">
    <ul class="list-group">
        @forelse($posts as $post)
        <li class="list-group-item">
        <h2><a href="{{route('show_post', [$post->id, $post->slug])}}">{{$post->title}}</a></h2>
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
        
            </div>
        @empty
        <li>Désolé pour l'instant aucun livre n'est publié sur le site</li>
        @endforelse
    </ul>
</div>
{{$posts->links()}}
@endsection 