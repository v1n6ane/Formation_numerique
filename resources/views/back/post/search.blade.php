@extends('layouts.master')

@section('content')

        <div class="row">
            <div class="col-sm-12">
                <div class="row align-items-end">
                    <div class="col-sm-7">
                        <a class="btn btn-primary" href="{{route('post.create')}}" role="button">Ajouter un post</a>
                    </div>

                    <div class="col-sm-5 text-right">
                        @include('back.post.partials.searchBar')
                    </div>
                </div>
            </div>
        </div>
        
        @include('back.post.partials.flash')
        
        @if(isset($details))

        <h2>Détails de votre recherche "<b>{{ $query }}"</b></h2>

        <div class="panel panel-default">

            <!-- Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Catégorie</th>
                        <th class="text-center">Date de début</th>
                        <th class="text-center">Date de fin</th>
                        <th class="text-center">Nombre d'étudiant</th>
                        <th class="text-center">Price €</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Editer</th>
                        <th class="text-center">Montrer</th>
                        <th class="text-center">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($details as $post)
                <tr>
                    <td>{{$post->title}}</td>
                    <td>{{$post->post_type}}</td>
                    @if(isset($post->category->name))
                    <td>{{$post->category->name}}</td>
                    @else
                    <td><em>Null</em></td>
                    @endif
                    <td>{{$post->start_date}}</td>
                    <td>{{$post->end_date}}</td>
                    <td class="text-center">{{$post->nb_max_student}}</td>
                    <td>{{$post->price}}</td>
                    @if($post->status=='published')
                    <td><span class="label label-success">{{$post->status}}</span></td>
                    @else
                    <td><span class="label label-warning">{{$post->status}}</span></td>
                    @endif
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
                @endforeach
                </tbody>
            </table>
        </div>
        
        {{$details->appends(request()->only('q'))->links()}}

    @elseif(isset($message))
    <div class="jumbotron">
        <p>{{$message}}</p>
    </div>
    @endif

@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection