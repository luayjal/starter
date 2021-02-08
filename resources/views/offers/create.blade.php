<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item active">
                        <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </nav>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    {{__('offer.header')}}
                </div>
                @if(Session::has('success'))
                <div class="container">
                    <div class="alert alert-success" role="alert">
                        <strong>{{Session::get('success')}}</strong>
                    </div>
                @endif
                    <form method="POST" action="{{route('offers.store')}}" enctype="multipart/form-data" >
                        @csrf
                        {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                        <div class="form-group row">
                            <label for="inputName">{{__('offer.offer name ar')}}</label>
                            <input type="text" class="form-control" name="name_ar" placeholder="">
                            @error('name_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror

                        </div>
                        <div class="form-group row">
                            <label for="inputName">{{__('offer.offer name en')}}</label>
                            <input type="text" class="form-control" name="name_en" placeholder="">
                            @error('name_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror

                        </div>
                        <div class="form-group row">
                            <label for="inputName" >{{__('offer.offer price')}}</label>
                            <input type="text" class="form-control" name="price" placeholder="">
                             @error('price')
                            <small class="form-text text-danger">{{$message}}</small>
                             @enderror
                        </div>

                        <div class="form-group row">
                            <label for="inputName">{{__('offer.offer details ar')}}</label>
                            <input type="text" class="form-control" name="details_ar"  placeholder="">
                            @error('details_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="inputName">{{__('offer.offer details en')}}</label>
                            <input type="text" class="form-control" name="details_en"  placeholder="">
                            @error('details_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="inputName">{{__('offer.offer img')}}</label>
                            <input type="file" class="form-control" name="offer_img" >
                            @error('offer_img')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">{{__('offer.btn')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
