<nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: rgb(224, 221, 221);">
    <div class="container-fluid">
        <img src="{{ asset('img/luckydrawlogo.png') }}" alt="" width="100px" height="45px" style="  ">
        <a class="navbar-brand" href="{{ url('/') }}">
            <b>
                <i>
                    {{ config('app.name', 'Lucky Draw System') }}
                </i>
            </b>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

                @auth

                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">
                            <b>
                                {{ __('Home') }}
                            </b>
                        </a>
                    </li>

                    @if ( Auth::user()->email != 'admin@ucsm.com' )

                        <li class="nav-item">
                            <a href="{{ url('/luckydraw') }}" class="nav-link">
                                <b>
                                    {{ __('Lucky Draw') }}
                                </b>
                            </a>
                        </li>

                    @endif

                    @if ( Auth::user()->email == 'admin@ucsm.com' )

                        <li class="nav-item">
                            <a href="{{ url('/adminluckydraw') }}" class="nav-link">
                                <b>
                                    {{ __('Lucky Draw') }}
                                </b>
                            </a>
                        </li>

                    @endif

                @endauth

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                <!-- Authentication Links -->
                @guest

                    @if ( Route::has('login') )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if ( Route::has('register') )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif

                @else

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                @endguest

            </ul>

        </div>

    </div>

</nav>
