<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{env('APP_NAME')}}</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap-italia.min.css')}}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/bootstrap-italia.min.js')}}"></script>
    </head>
    <body>
            <div class="it-header-slim-wrapper">
                <div class="container">
                  <div class="row">
                    <div class="col-12">
                      <div class="it-header-slim-wrapper-content">
                        <a class="d-lg-block navbar-brand" href="#">D.I.G.O.S. Trento - Anarchiv</a>
                        <div class="it-header-slim-right-zone">
                          <div class="nav-item dropdown">


                          </div>
                          <a href="{{route('login')}}" class="btn btn-primary btn-icon btn-full">
                            <span class="rounded-icon">
                              <svg class="icon icon-primary">
                                <use
                                  xlink:href="{{asset('svg/sprite.svg#it-user')}}"
                                ></use>
                              </svg>
                            </span>
                            <span class="d-none d-lg-block">Accedi</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="it-hero-wrapper">
                <div class="img-responsive-wrapper">
                   <div class="img-responsive">
                      <div class="img-wrapper"><img src="{{asset('svg/logo_welcome_polizia.jpg')}}" title="img title" alt="imagealt"></div>
                   </div>
                </div>
             </div>
        </div>
        <div class='content'>
            @yield('content')
        </div>
    </body>
</html>
