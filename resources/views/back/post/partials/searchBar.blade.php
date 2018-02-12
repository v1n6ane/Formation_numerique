<form action="{{route('post.search')}}" method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Search users">        
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</form>
<div>
    @if($errors->has('q'))
    <p class="error" style="color : red;">{{$errors->first('q')}}</p>
    @endif
</div>