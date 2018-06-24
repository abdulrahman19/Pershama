<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">

    <a class="navbar-brand @guest mr-auto @endguest" href="{{ url('/') }}"><strong>Blog</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    @if (Route::has('login'))
        @auth
        {{-- main menu --}}
        <div class="collapse navbar-collapse mr-auto" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts') }}">{{ __('Posts') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tasks') }}">{{ __('Tasks') }}</a>
                </li>
            </ul>
        </div>
        {{-- Logout menu --}}
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        @else
        {{-- guest menu --}}
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        </ul>
        @endauth
    @endif
</nav>
