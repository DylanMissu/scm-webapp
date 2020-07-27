<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Tab icon -->
    <link rel="icon" href="{{asset('./images/icon/ms-icon-310x310.png')}}">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container-fluid">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        @if (!Route::is('home'))
                        <li class="nav-item">
                            <a class="nav-link" href="/home" role="button" v-pre>
                                home
                            </a>
                        </li>
                        @endif

                        @if (!Auth::guest())
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Reizigersinformatie <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/ris/board-info"><img class="inline-img" src="{{asset('./images/split/content.png')}}">status</a>
                                    <a class="dropdown-item" href="/ris/board-setup"><img class="inline-img" src="{{asset('./images/split/status.png')}}">setup</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/filemanager" role="button" target="_blank" v-pre>
                                    Files
                                </a>
                            </li>
                        @endif

                    </ul>

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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    <style>
        /* 
        * almost all the styling is located in 'public/css/app.css'
        * they were included in this laravel framework
        * but customized styles are located here and in some of the views
        * 
        * for ducumentation on how to use the included css, refer to the link below
        * https://getbootstrap.com/docs/3.4/css/
        */

        body {
            border: 0; margin: 0; padding: 0;
            background-attachment: fixed;
            font-family: Arial, Helvetica, sans-serif, sans-serif;
            text-align: center;
        }

        /* if you want to disable a card from being clicked, add this as a class to the element */
        .disabled {
            opacity: .5;
            pointer-events: none;
        }

        /* added a little more space between the nav links */
        .nav-link {
            margin-left: 10px;
            margin-right: 10px;
        }

        /* this is the styling for the menu-cards */
        #card-container {
            margin: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        }
        #my-card {
            transition: .15s all ease-in-out;
            text-decoration: none;
            color: black;
            margin: 20px 10%;
            background-color: lightgray;
            cursor: pointer;
        }
        #my-card:hover {
            box-shadow: 2px 6px 10px 0px rgba(0,0,0,0.75);
        }
        #my-card > h3 {
            margin: 15px auto;
            font-size: 1em;
        }
        #my-card > img {
            width: 92%;
            margin: 4%;
            margin-bottom: -2%;
        }

        /* makes an input lichtgray with a green underline */
        .basic-inputstyle {
            background-color: #e7e7e7;
            border: none;
            outline: none;
            border-bottom: 2px solid lightgreen;
        }

        /* style for the image in the nav bat drop down */
        .inline-img {
            display: inline;
            width: 1.5em;
            margin-right: 12px;
        }

        .basic-card {
            transition: .15s all ease-in-out;
            text-decoration: none;
            color: black;
            background-color: lightgray;
            cursor: pointer;
            display: block;
            margin: 0;
            padding: 0;
        }
    
        /* style for when the screen width is less than 768px */
        @media (max-width: 768px) {
            #card-container {
                grid-template-columns: repeat(1,1fr);
            }

            #my-card {
                margin: 20px 0%;
            }
        }
    </style>
</body>
</html>
