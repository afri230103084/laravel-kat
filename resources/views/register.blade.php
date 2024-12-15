<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Register</title>
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
                            <form class="theme-form" method="POST" action="{{ route('register-process') }}">
                                @csrf
                                <h4>Create your account</h4>
                                <p>Enter your personal details to create account</p>
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Name</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" type="text" name="nama" placeholder="Full Name" autocomplete="off">
                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" type="email" name="email" placeholder="Enter your email" autocomplete="off">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter your password" autocomplete="off">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Phone Number</label>
                                    <input class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}" type="number" name="telepon" placeholder="Enter your phone number" autocomplete="off">
                                    @error('telepon')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Address</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Enter your full address">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">City</label>
                                    <input class="form-control @error('kota') is-invalid @enderror" value="{{ old('kota') }}" type="text" name="kota" placeholder="Enter your city" autocomplete="off">
                                    @error('kota')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Postal Code</label>
                                    <input class="form-control @error('kode_pos') is-invalid @enderror" value="{{ old('kode_pos') }}" type="text" name="kode_pos" placeholder="Enter postal code (Max: 10 digit)" autocomplete="off">
                                    @error('kode_pos')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Province</label>
                                    <input class="form-control @error('provinsi') is-invalid @enderror" value="{{ old('provinsi') }}" type="text" name="provinsi" placeholder="Enter your province" autocomplete="off">
                                    @error('provinsi')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Account Type</label>
                                    <select class="form-control" name="tipe_akun">
                                        <option value="individu" {{ old('tipe_akun') == 'individu' ? 'selected' : '' }}>Individual</option>
                                        <option value="perusahaan" {{ old('tipe_akun') == 'perusahaan' ? 'selected' : '' }}>Company</option>
                                        <option value="instansi" {{ old('tipe_akun') == 'instansi' ? 'selected' : '' }}>Institution</option>
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                                </div>
                                <p class="mt-4 mb-0">Already have an account?<a class="ml-2" href="{{ route('login') }}">Sign in</a></p>
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