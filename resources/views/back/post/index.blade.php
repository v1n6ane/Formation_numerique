@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-7">
                <a class="btn btn-primary" href="{{route('post.create')}}" role="button">Ajouter un post</a>
                <button class="btn btn-primary delete_all" data-url="{{ route('deleteAll') }}">Supprime les sélections</button>
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
            <th class="text-center">@sortablelink('title', 'Titre' )</th>
            <th class="text-center">@sortablelink('post_type', 'Type')</th>
            <th class="text-center">@sortablelink('category.name', 'Catégory')</th>
            <th class="text-center">@sortablelink('start_date', 'Date de début')</th>
            <th class="text-center">@sortablelink('end_date', 'Date de fin')</th>
            <th class="text-center">@sortablelink('nb_max_student', "Nombre max")</th>
            <th class="text-center">@sortablelink('price', 'Prix €')</th>
            <th class="text-center">@sortablelink('status', 'Status')</th>
            <th class="text-center">Editer</th>
            <th class="text-center">Montrer</th>
            <th class="text-center">Supprimer</th>
        </tr>
    </thead>
    <tbody>
    @forelse($posts as $post)
    <tr>
        <td><input type="checkbox" class="sub_chk" data-id="{{$post->id}}"></td>
        <td>{{$post->title}}</td>
        <td>{{$post->post_type}}</td>
        @if(isset($post->category->name))
        <td>{{$post->category->name}}</td>
        @else
        <td><em>Null</em></td>
        @endif
        <td>{{$post->start_date_fr}}</td>
        <td>{{$post->end_date_fr}}</td>
        <td class="text-center">{{$post->nb_max_student}}</td>
        <td>{{$post->price}}</td>
        
        <td>
            <!-- <span class="label label-success">{{$post->status}}</span> -->
            <form action="{{route('post.updateStatus', $post->id)}}" method="post" >
                {{method_field('PUT')}} <!-- méthode update -->
                {{ csrf_field() }}
                @if($post->status=='published')
                <input type="hidden" name="status" class="form-control" value="unpublished">
                <button class="btn btn-success btn-sm" type="submit">{{$post->status}}</button>
                @else
                <input type="hidden" name="status" class="form-control" value="published">
                <button class="btn btn-warning btn-sm" type="submit">{{$post->status}}</button>
                @endif
            </form>
        </td>
        
        <td class="text-center">
            <a href="{{route('post.edit', $post->id)}}" class="glyphicon glyphicon-edit" aria-hidden="true"></a>
        </td>
        <td class="text-center">
            <a href="{{route('post.show', $post->id)}}" class="glyphicon glyphicon-eye-open" aria-hidden="true"></a>
        </td>
        <td class="text-center">
            <form class="delete" action="{{route('post.destroy', $post->id)}}" method="post" >
                {{method_field('DELETE')}} <!-- méthode delete -->
                {{ csrf_field() }}
                <button class="btn btn-link glyphicon glyphicon-trash" type="submit"></button>
            </form>
        </td>
    
    </tr>
    @empty
	<tr>
        <td>Pour l'instant aucun post n'est publié sur le site</td>
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

