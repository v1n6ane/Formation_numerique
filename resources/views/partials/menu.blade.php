<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Book</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
            <li class="active"><a href="{{url('/')}}">Accueil</a></li>
            @if(Route::is('post.**') == false)
                @forelse($types as $id => $name)
                <li><a href="{{url('post', $name)}}">{{$name}}</a></li>
                    @empty
                    <li>Aucun type</li>
                @endforelse
                <li><a href="{{url('/contact')}}">Contact</a></li>
            @endif
            
      </ul>
      <ul class="nav navbar-nav navbar-right">
      @if(Auth::check()) <!-- retourne true si authentification-->
        <li><a href="{{route('post.index')}}">Admin</a></li>
        <li><a href="{{route('post.trash')}}">Corbeille</a></li>
        <li>
          <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
              Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
      @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>