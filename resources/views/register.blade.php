<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('cuba') }}/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('cuba') }}/assets/images/favicon.png" type="image/x-icon">
    <title>Cuba - Premium Admin Template</title>
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
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{ asset('cuba') }}/assets/images/login/tes.svg" alt="loginpage"></div>
            <div class="col-xl-7 p-0"> 
                <div class="login-card">
                    <div>
                        <div class="login-main"> 
                            <form class="theme-form" method="POST" action="{{ route('register-process') }}">
                                @csrf
                                <h4>Create your account</h4>
                                <p>Enter your personal details to create account</p>
                                
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Name</label>
                                    <input class="form-control" type="text" name="nama" required placeholder="Full Name">
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" required placeholder="Enter your email">
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required placeholder="Enter your password">
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Phone Number</label>
                                    <input class="form-control" type="text" name="telepon" required placeholder="Enter your phone number">
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Address</label>
                                    <textarea class="form-control" name="alamat" required placeholder="Enter your full address"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label">City</label>
                                    <input class="form-control" type="text" name="kota" required placeholder="Enter your city">
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Postal Code</label>
                                    <input class="form-control" type="text" name="kode_pos" required placeholder="Enter postal code" maxlength="10">
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Province</label>
                                    <input class="form-control" type="text" name="provinsi" required placeholder="Enter your province">
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label">Account Type</label>
                                    <select class="form-control" name="tipe_akun">
                                        <option value="individu">Individual</option>
                                        <option value="perusahaan">Company</option>
                                        <option value="instansi">Institution</option>
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
    </div>
</body>
</html>