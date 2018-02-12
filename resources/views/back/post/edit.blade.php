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
                <input type="text" name="title" id="title" class="form-control" value="{{ !empty(old('title')) ? old('title') : $post->title }}" placeholder="Titre de l'article">
                @if($errors->has('title'))<p class="error bg-warning text-warning">{{$errors->first('title')}}</p>@endif
            </div>
            <div class="form-group">
                <label for="description" class="control-label">Description : </label>
                <textarea name="description" id="description" cols="30" rows="2" class="form-control">{{ !empty(old('description')) ? old('description') : $post->description }}</textarea>
                @if($errors->has('description'))<p class="error bg-warning text-warning">{{$errors->first('description')}}</p>@endif
            </div>

            <div class="form-group">
                <label for="category_id" class="control-label">Categorie
                 : </label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="0" {{ is_null(old('category_id')) or is_null($post->category_id)? 'selected' : '' }}>Choisir une categorie</option>
                    @foreach($categories as $id => $name)
                        @if(!empty(old('type')))
                        <option value="{{$id}}" {{ old('category_id')==$id ? 'selected' : '' }}>{{$name}}</option>
                        @else
                        <option value="{{$id}}" {{ $post->category_id==$id ? 'selected' : '' }}>{{$name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="type" class="control-label">Type d'article : </label>
                <select name="type" id="type" class="form-control">
                    <option value="0" {{ is_null(old('type')) ? 'selected' : '' }}>Choisir un type</option>
                    @foreach($types as $type)
                        @if(!empty(old('type')))
                        <option value="{{$type}}" {{ old('type')==$type ? 'selected' : '' }}>{{$type}}</option>
                        @else
                        <option value="{{$type}}" {{ $post->post_type==$type ? 'selected' : '' }}>{{$type}}</option>
                        @endif
                @endforeach
                </select>
                @if($errors->has('type'))<p class="error bg-warning text-warning">{{$errors->first('type')}}</p>@endif
            </div>
            
            <div class="form-group">
                <label for="title_image" class="control-label">Titre de l'image: </label>
                <input type="text" name="title_image" id="title_image" class="form-control"  value="{{ !empty(old('title_image')) ? old('title_image') : $post->picture->title }}" placeholder="Titre de l'image">
                <input type="file" class="form-control-file" id="picture" name="picture">
                @if($errors->has('picture'))<p class="error bg-warning text-warning">{{$errors->first('picture')}}</p>@endif
            </div>
        </div>  

        <div class="col-sm-6">
            <div class="form-group">
                <label for="start_date" class="control-label">Date de début : </label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ !empty(old('start_date')) ? old('start_date') : $post->start_date }}">
                @if($errors->has('start_date'))<p class="error bg-warning text-warning">{{$errors->first('start_date')}}</p>@endif
            </div>

            <div class="form-group">
                <label for="end_date" class="control-label">Date de fin : </label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ !empty(old('end_date')) ? old('end_date') : $post->end_date }}">
                @if($errors->has('end_date'))<p class="error bg-warning text-warning">{{$errors->first('end_date')}}</p>@endif
            </div>

            <div class="form-group">
                <label for="price" class="control-label">Prix : </label>
                <input type="number" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" name="price" id="price" class="form-control currency" value="{{ !empty(old('price')) ? old('price') : $post->price }}">
                @if($errors->has('price'))<p class="error bg-warning text-warning">{{$errors->first('price')}}</p>@endif
            </div>

            <div class="form-group">
                <label for="nb_max_student" class="control-label">Nombre d'étudiant max : </label>
                <input type="number" name="nb_max_student" id="nb_max_student" class="form-control" value="{{ !empty(old('nb_max_student')) ? old('nb_max_student') : $post->nb_max_student }}">
                @if($errors->has('nb_max_student'))<p class="error bg-warning text-warning">{{$errors->first('nb_max_student')}}</p>@endif
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="status" class="control-label">Status : </label>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status_published" value="published" 
                            @if(!empty(old('status')))
                                {{ old('status')=="published" ? 'checked' : '' }}
                            @else
                                {{ $post->status=="published" ? 'checked' : '' }}
                            @endif
                            >
                            Publier
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status_unpublished" value="unpublished" 
                            @if(!empty(old('status')))
                                {{ old('status')=="unpublished" ? 'checked' : '' }}
                            @else
                                {{ $post->status=="unpublished" ? 'checked' : '' }} 
                            @endif
                            >
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