<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Electron</title>
    <link href="css/client/bootstrap.min.css" rel="stylesheet">
    <link href="css/client/font-awesome.min.css" rel="stylesheet">
    <link href="css/client/prettyPhoto.css" rel="stylesheet">
    <link href="css/client/price-range.css" rel="stylesheet">
    <link href="css/client/animate.css" rel="stylesheet">
    <link href="css/client/main.css" rel="stylesheet">
    <link href="css/client/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
@include('client.header')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                    @endif
                    <form method="post" action="{{route('user-login')}}" >
                        @csrf
                        <input type="text" name="email_login" placeholder="Email" />
                        <span class="text-danger">@error('email_login'){{$message}}@enderror</span>
                        <input type="password" name="password_login" placeholder="Password" />
                        <span class="text-danger">@error('password_login'){{$message}}@enderror</span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="{{route('register')}}" method="post">
                        @csrf
                        <input type="text" value="{{old('name')}}" name="name" placeholder="Name"/>
                        <span class="text-danger">@error('name'){{$message}}@enderror</span>
                        <input type="text" value="{{old('phone')}}" name="phone" placeholder="Phone"/>
                        <span class="text-danger">@error('phone'){{$message}}@enderror</span>
                        <input type="text" value="{{old('address')}}" name="address" placeholder="Address"/>
                        <span class="text-danger">@error('address'){{$message}}@enderror</span>
                        <input type="text" value="{{old('email')}}" name="email" placeholder="Email Address"/>
                        <span class="text-danger">@error('email'){{$message}}@enderror</span>
                        <input type="password" value="{{old('password')}}" name="password" placeholder="Password"/>
                        <span class="text-danger">@error('password'){{$message}}@enderror</span>
                        <button type="submit" class="btn btn-default">Register</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section>
</body>
</html>
