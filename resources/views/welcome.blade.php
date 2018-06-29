<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 12px;
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
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif


                {!!  Form::open(array('route' => 'import.file','method'=>'POST','files'=>'true','enctype'=>"multipart/form-data")) !!}
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('sample_file','Select File to Import:',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                                {!!  $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                                @if (session()->has('error'))
                                    <p class="alert alert-danger">
                                        {{ session()->get('error') }}<br>
                                    </p>
                                @endif
                                @if(session()->has('success'))
                                    <p class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}




        </div>
    </body>
</html>
