@extends('layouts.master')

@section('content')
<form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
{{method_field('PUT')}} <!-- méthode update -->
{{ csrf_field() }} <!-- Token pour éviter que le formulaire soit envoyé par la bonne personne, verouiller le token dans les variables POST -->
    <div class="row">
        <div class="col-sm-6">
            <h2>Editer un article : </h2>
        </div>
        <!-- <div class="col-sm-6">
            <button class="btn btn-primary" type="submit">Ajouter le nouvel article</button>
        </div> -->
    </div>
        
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="title" class="control-label">Titre : </label>
                <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}" placeholder="Titre de l'article">
                @if($errors->has('title'))<p class="error bg-warning text-warning">{{$errors->first('title')}}</p>@endif
            </div>
            <div class="form-group">
                <label for="description" class="control-label">Description : </label>
                <textarea name="description" id="description" cols="30" rows="2" class="form-control">{{$post->description}}</textarea>
                @if($errors->has('description'))<p class="error bg-warning text-warning">{{$errors->first('description')}}</p>@endif
            </div>

            <div class="form-group">
                <label for="category_id" class="control-label">Category : </label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="0" {{ is_null(old('category_id'))? 'selected' : '' }}>Pas de categorie</option>
                    @foreach($categories as $id => $name)
                    <option value="{{$id}}" {{ $post->category_id==$id ? 'selected' : '' }}>{{$name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type" class="control-label">Type d'article : </label>
                <select name="type" id="type" class="form-control">
                    <option value="0" {{ is_null(old('type'))? 'selected' : '' }}>Pas de type</option>
                    @foreach($types as $type)
                    <option value="{{$type}}" {{ $post->post_type==$type ? 'selected' : '' }}>{{$type}}</option>
                @endforeach
                </select>
                @if($errors->has('type'))<p class="error bg-warning text-warning">{{$errors->first('type')}}</p>@endif
            </div>
            
            <div class="form-group">
                <label for="title_image" class="control-label">Titre de l'image: </label>
                <input type="text" name="title_image" id="title_image" class="form-control" value="{{$post->picture->title}}" placeholder="Titre de l'image">
                <input type="file" class="form-control-file" id="picture" name="picture">
                @if($errors->has('picture'))<p class="error bg-warning text-warning">{{$errors->first('picture')}}</p>@endif
            </div>
        </div>  

        <div class="col-sm-6">
            <div class="form-group">
                <label for="start_date" class="control-label">Date de début : </label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{$post->end_date}}">
                @if($errors->has('start_date'))<p class="error bg-warning text-warning">{{$errors->first('start_date')}}</p>@endif
            </div>

            <div class="form-group">
                <label for="end_date" class="control-label">Date de fin : </label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{$post->end_date}}">
                @if($errors->has('end_date'))<p class="error bg-warning text-warning">{{$errors->first('end_date')}}</p>@endif
            </div>

            <div class="form-group">
                <label for="price" class="control-label">Prix : </label>
                <input type="number" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" name="price" id="price" class="form-control currency" value="{{$post->price}}"/>
                @if($errors->has('price'))<p class="error bg-warning text-warning">{{$errors->first('price')}}</p>@endif
            </div>

            <div class="form-group">
                <label for="price" class="control-label">Nombre d'étudiant max : </label>
                <input type="number" name="nb_max_student" id="price" class="form-control" value="{{$post->nb_max_student}}">
                @if($errors->has('nb_max_student'))<p class="error bg-warning text-warning">{{$errors->first('nb_max_student')}}</p>@endif
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="status" class="control-label">Status : </label>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status_published" value="published" {{ $post->status=="published" ? 'checked' : '' }}>
                            Publier
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status_unpublished" value="unpublished" {{ $post->status=="unpublished" ? 'checked' : '' }}>
                            Dépublier
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group text-right">
                <button class="btn btn-primary" type="submit">Editer l'article</button>
            </div>
        </div>
    </div>
    
</form>

@endsection