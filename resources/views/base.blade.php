<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap-italia.min.css')}}">
    <script src="{{asset('js/bootstrap-italia.bundle.min.js')}}"></script>

</head>
<body>

    {{-- HEADER --}}
    <div class="it-header-slim-wrapper">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="it-header-slim-wrapper-content">
                <a class="d-none d-lg-block navbar-brand" href="{{route('dashboard')}}">D.I.G.O.S. Trento - Anarchiv</a>
                <div class="nav-mobile">
                  <nav>

                  </nav>
                </div>
                <div class="it-header-slim-right-zone">
                  @auth('')
                  @can('edit_settings')
                  <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              AMMINISTRAZIONE APP
                              <svg class="icon d-none d-lg-block"><use xlink:href="{{asset('/svg/sprite.svg#it-expand')}}"></use></svg>
                        </a>
                            <div class="dropdown-menu">
                            <div class="row">
                            <div class="col-12">
                              <div class="link-list-wrapper">
                                <ul class="link-list">
                                  <li>
                                    <h3 class="no_toc" id="heading-es-1">Utenti</h4>
                                  </li>
                                  <li><a class="list-item" href="{{route('user.index')}}"><span>Gestione Utenti</span></a></li>
                                  <li>
                                    <h3 class="no_toc" id="heading-es-1">Database</h4>
                                  </li>
                                  <li><a class="list-item" href="{{route('group.index')}}"><span>Gestione Gruppi</span></a></li>
                                </ul>
                              </div>
                            </div>
                            </div>
                            </div>
                          </div>
                          @endcan
                  @endauth
                    @auth
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
                                @auth
                                <li><a class="list-item" href="{{route('changepassword',Auth::user()->perid)}}"><span>Cambio Password</span></a></li>
                                @endauth
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                     @endauth
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- CONTAINER --}}
      <div class='container'>
          {{-- ALERT --}}
            @if(session('alerttype'))
            <div class="alert alert-{{session('alerttype')}} mt-2" role="alert">
            {{session('alertmessage')}}
            </div>
            @endif
      <div>
        @yield('content')
      </div>
    </div>






    <script type="text/javascript">

        $(document).ready(function() {
        $('.it-date-datepicker').datepicker({
          inputFormat: ["dd/MM/yyyy"],
          outputFormat: 'dd/MM/yyyy',
        });
        });

    </script>

</body>
</html>
