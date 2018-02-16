@extends('layouts.master')

@section('content')

<ul class="list-group">
<td class="text-center">

    <li class="list-group-item">
        <div class="row">
            <div class="col-md-10">
            <h2>{{$post->title}}</h2>
            </div>
            <div class="col-md-2">
                <form class="delete" action="{{route('post.destroy', $post->id)}}" method="post" >
                    <a href="{{route('post.index')}}" class="btn btn-primary" aria-hidden="true">Back</a>
                    <a href="{{route('post.edit', $post->id)}}" class="btn btn-primary" aria-hidden="true">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </a>
                    {{method_field('DELETE')}} <!-- méthode delete -->
                    {{ csrf_field() }}
                <button class="btn btn-danger" type="submit">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>
            </div>
        </div>
        
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
                    <li>Date de début : {{$post->start_date}}</li>
                    <li>Date de fin : {{$post->end_date}}</li>
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