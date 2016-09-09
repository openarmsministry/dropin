<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dropin</title>

    <!-- Styles -->
    {{--<link href="/css/app.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css"
          integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY" crossorigin="anonymous">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<nav class="navbar navbar-light bg-faded">
    <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2"
            aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation">
        &#9776;
    </button>
    <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
        <a class="navbar-brand" href="{{ url('/') }}">OAM Dropin</a>
        <ul class="nav navbar-nav">
            @if( Auth::check() and Auth::user()->can('create', \App\Guest::class))
                <li class="nav-item">
                    <a href="/guests" class="nav-link">Guests</a>
                </li>
            @endif
            @if( Auth::check() and Auth::user()->can('checkin', \App\Guest::class))
                <li class="nav-item">
                    <a href="/checkin" class="nav-link">Check In</a>
                </li>
            @endif
            @if( Auth::check() and Auth::user()->can('manage', \App\OpenarmsSession::class))
                <li class="nav-item">
                    <a href="/admin/current" class="nav-link">Current Session</a>
                </li>
            @endif
        </ul>
        <ul class="nav navbar-nav pull-xs-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
            @else
                <li class="dropdown nav-item">
                    <a ref="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li>
                            <a class="nav-link dropdown-item" href="{{ url('/logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>

@yield('content')

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"
        integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"
        integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js"
        integrity="sha384-ux8v3A6CPtOTqOzMKiuo3d/DomGaaClxFYdCu2HPMBEkf6x2xiDyJ7gkXU0MWwaD"
        crossorigin="anonymous"></script>
@yield('body-script')
</body>
</html>
