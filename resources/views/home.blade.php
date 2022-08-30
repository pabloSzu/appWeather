
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Weather</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="{{asset('images/logo.png')}}" width="120" alt="" loading="lazy" style="position: relative;  left: 100px;  display: block;">
    <ul class="navbar-nav ms-auto">
        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
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
</nav>

    <h1 class="text-center">Bienvenido a WeatherApp</h1>
    <!-- Contenido -->

    <div style="background-color: #ADCED6">
        <h3 class="text-center" style="margin-top:100px;">Consulta el clima de tu ciudad</h3>
        <div class="row text-center p-4">
            <form action="{{ route('weather') }}" method="POST">
                @csrf
                <input type="text" name="location" placeholder="Consulta tu ciudad..">
                <button>Consultar</button>
            </form>
        </div>
    </div>

 
    <div style="margin-top:70px; background-color:#F1E5D5; padding:1%;">
    @isset($consulta_ciudad)   
    <h2 class="text-center">
        {{$consulta_ciudad['location']['name']}} 
        <br>
        {{$consulta_ciudad['current']['temperature']}} °C
        <br>
        <img src="{{$consulta_ciudad['current']['weather_icons'][0]}}" width="120" alt="" loading="lazy" style="border-radius:150px;">
    </h2>
    @endisset
    </div>
    
  
    @if (session('mensaje'))  
    <div class="alert alert-success">
        {{session('mensaje')}}
    </div>
    @endif


    @isset($id)   
        <h1>{{$id}}</h1>
    @endisset
    

    <!-- Footer -->
    <footer class="container-fluid bg-main" style="position:absolute; bottom:30px;">
        <div class="row text-center p-4">
            <div class="mb-3">
                <img src="{{asset('images/logo.png')}}" alt="YouDevs logo" width="50" id="logofooter">
            </div>
            <div id="col-md-10">
                <a href="https://github.com/pabloSzu">
                    <img src="{{asset('images/github.png')}}" class="img-fluid" width="30px" alt="Github">
                </a>
                <a href="https://www.linkedin.com/in/pablo-szulman/">
                    <img src="{{asset('images/linkedin.png')}}" class="img-fluid" width="30px" alt="Linkedin">
                </a>
                <a href="https://www.instagram.com/pablo.szulman/?hl=es-la">
                    <img src="{{asset('images/instagram.png')}}" class="img-fluid" width="40px" alt="instagram">
                </a>
                <p class="mt-3">WeatherApp 2022 - Pablo Szulman. <br> </p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


       



