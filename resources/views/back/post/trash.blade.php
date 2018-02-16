@extends('layouts.master')

@section('content')

<div class="row" id="app">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-7">
                <a class="btn btn-primary" href="{{route('post.create')}}" role="button">Ajouter un post</a>
                <button class="btn btn-primary delete_all" data-url="{{ route('post.forceDeleteAll') }}">Supprime les sélections</button>
            </div>

            <div class="col-sm-5 text-right">
                @include('back.post.partials.searchBar')
            </div>
        </div>

        <div class="row">
            
        </div>
    </div>
</div>

@include('back.post.partials.flash')

{!! $posts->appends(\Request::except('page'))->render() !!}

<div class="panel panel-default">
  <!-- Table -->
  <table class="table">
    <thead>
        <tr>
            <th width="50px">
                <input type="checkbox" id="master">
            </th>
            <th class="text-center">@sortablelink('id', 'ID' )</th>
            <th class="text-center">@sortablelink('title', 'Titre' )</th>
            <th class="text-center">@sortablelink('post_type', 'Type')</th>
            <th class="text-center">@sortablelink('category.name', 'Catégory')</th>
            <th class="text-center">@sortablelink('created_at', 'Date de création')</th>
            <th class="text-center">@sortablelink('deleted_at', 'Date de suppression')</th>
            <th class="text-center">Status</th>
            <th class="text-center">Restaurer</th>
            <th class="text-center">Supprimer</th>
        </tr>
    </thead>
    <tbody>
    @forelse($posts as $post)
    <tr>
        <td><input type="checkbox" class="sub_chk" data-id="{{$post->id}}"></td>
        <td>{{$post->id}}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->post_type}}</td>
        @if(isset($post->category->name))
            <td>{{$post->category->name}}</td>
        @else
            <td><em>Null</em></td>
        @endif
        <td>{{$post->created_at}}</td>
        <td>{{$post->deleted_at}}</td>        
        <td>
            <span class="label label-default">Supprimé</span>
        </td>
        
        <td class="text-center">
            <form action="{{route('post.restore', $post->id)}}" method="post" >
                {{method_field('PUT')}} <!-- méthode delete -->
                {{ csrf_field() }}
                <button class="btn btn-link glyphicon glyphicon-upload" type="submit"></button>
            </form>
        </td>

        <td class="text-center">
            <form class="delete" action="{{route('post.forceDelete', $post->id)}}" method="post" >
                {{method_field('DELETE')}} <!-- méthode delete -->
                {{ csrf_field() }}
                <button class="btn btn-link glyphicon glyphicon-trash" type="submit"></button>
            </form>
        </td>
    
    </tr>
    @empty
	<tr>
        <td colspan=13>Pour l'instant aucun post n'est publié sur le site</td>
    </tr>
    @endforelse

    </tbody>
  </table>
  
</div>

{!! $posts->appends(\Request::except('page'))->render() !!}

@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script> <!-- Ne pas oublier de le mettre dans le webpack.mix.pj aussi !! -->
    <script src="{{asset('js/deleteAll.js')}}"></script>
@endsection

