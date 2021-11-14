<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anarchiv</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap-italia.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap-italia.min.js')}}"></script>
</head>
<body>

    {{-- HEADER --}}
    <div class="it-header-slim-wrapper">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="it-header-slim-wrapper-content">
                <a class="d-none d-lg-block navbar-brand" href="#">D.I.G.O.S. Trento - Anarchiv</a>
                <div class="nav-mobile">
                  <nav>
                    <a class="it-opener d-lg-none" data-toggle="collapse" href="#menu1" role="button" aria-expanded="false" aria-controls="menu1">
                      <span>D.I.G.O.S. Trento - Anarchiv</span>
                      <svg class="icon">
                        <use xlink:href="/bootstrap-italia/dist/svg/sprite.svg#it-expand"></use>
                      </svg>
                    </a>
                    <div class="link-list-wrapper collapse" id="menu1">
                      <ul class="link-list">
                        @auth('admin')<li><a class="list-item" href="#">Link 1</a></li>@endauth
                        <li><a class="list-item active" href="#">Link 2 Active</a></li>
                      </ul>
                    </div>
                  </nav>
                </div>
                <div class="it-header-slim-right-zone">
                  <div class="it-access-top-wrapper">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span>{{Auth::user()->name}}</span>
                        <svg class="icon d-none d-lg-block">
                          <use xlink:href="{{asset('/svg/sprite.svg#it-expand')}}"></use>
                        </svg>
                      </a>
                    <div class="dropdown-menu">
                        <div class="row">
                          <div class="col-12">
                            <div class="link-list-wrapper">
                              <ul class="link-list">
                                <li><a class="list-item" href="{{route('logout')}}"><span>Logout</span></a></li>
                                @auth('authuser')
                                <li><a class="list-item" href="{{route('changepassword',Auth::user()->perid)}}"><span>Cambio Password</span></a></li>
                                @endauth
                                @auth('admin')
                                <li><a class="list-item" href="{{route('adminchangepassword',Auth::user()->perid)}}"><span>Cambio Password</span></a></li>
                                @endauth
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class='container'>
        @yield('content')
    </div>

</body>
</html>
