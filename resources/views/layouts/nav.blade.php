<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'InTransPortal') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->


            <ul class="nav navbar-nav flex">
                <li class="dropdown"><a href="#" tabindex="-1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false">Forum</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu"><a href="#" tabindex="-2" aria-haspopup="true">Browse</a>

                            <ul class="dropdown-menu">
                                <li><a href="{{page_url('forum', 'threads')}}">All threads</a></li>
                                @if(auth()->check())
                                    <li><a href="{{page_url('forum', 'threads?by='. Auth::user()->name)}}">My threads</a></li>
                                @endif
                                <li><a href="{{page_url('forum','threads?popular=1')}}">Popular threads</a></li>
                                <li><a href="{{page_url('forum', 'threads?unanswered=1')}}">Unanswered threads</a></li>
                            </ul>


                        <li class="dropdown-submenu">
                            <a href="#" tabindex="-2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Channels</a>
                            <ul class="dropdown-menu">
                                @foreach($channels as $channel)
                                    <li><a href="{{page_url('forum','/threads/'.$channel->slug)}}">{{$channel->name}}</a></li>
                                @endforeach

                            </ul>
                        </li>
                        @if(auth()->check())
                            <li class="list-group-item"><a href="{{page_url('forum','threads/create')}}">Create Thread</a></li>
                        @endif
                    </ul>


                <li class="dropdown flex"><a href="#" tabindex="-1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                          aria-expanded="false">Wiki</a>
                    <ul class="dropdown-menu">
                    
                        <li class="list-group-item"><a href="{{route('wiki.index')}}">Main page</a></li>
                    </ul>

               </li>

         </ul>

        </div>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <user-notifications></user-notifications>
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

                        <a class="dropdown-item" href="{{route('profile', Auth::user())}}">My Profile</a>



                    </div>
                </li>

            @endguest
        </ul>
    </div>
</nav>
