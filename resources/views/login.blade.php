
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/icofont.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/themify.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/flag-icon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ asset('cuba') }}/assets/css/color-1.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('cuba') }}/assets/css/responsive.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{ asset('cuba') }}/assets/images/login/tess.jpg" alt="looginpage"></div>
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <div>
                        <div class="login-main"> 
                            <form class="theme-form" action="{{ route('login-process') }}" method="POST">
                                @csrf
                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="Test@gmail.com" autocomplete="off" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required placeholder="*********" autocomplete="off">
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                                <p class="mt-4 mb-0">Don't have account?<a class="ml-2" href="{{ route('register') }}">Create Account</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
      </div>

        <script src="{{ asset('cuba') }}/assets/js/jquery-3.5.1.min.js"></script>
        <script src="{{ asset('cuba') }}/assets/js/bootstrap/popper.min.js"></script>
        <script src="{{ asset('cuba') }}/assets/js/bootstrap/bootstrap.js"></script>
        <script src="{{ asset('cuba') }}/assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="{{ asset('cuba') }}/assets/js/icons/feather-icon/feather-icon.js"></script>
        <script src="{{ asset('cuba') }}/assets/js/config.js"></script>
        <script src="{{ asset('cuba') }}/assets/js/script.js"></script>
    </div>
</body>
</html>