<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css" rel="stylesheet') }}" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-n d-lg-block">
                                <img src="{{asset('img/image.png')}}"  style="height: 550px"; width="450px"; >
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                 
                                    <main>
                                        <div class="ms-auto mt-auto mt-5" style="width: 350px">
                                            <div class="mt-5">
                                                @if($errors->any())
                                                <div class="col-12">
                                                  

                                                    @if(session()->has('error'))
                                                        <div class="alert alert-danger">{{'error'}}</div>
                                                    @endif

                                                    @if(session()->has('success'))
                                                    <div class="alert alert-success">{{'success'}}</div>
                                                @endif
                                                </div>
                                                    
                                                @endif
                                            <p>We Will send a link to your email, use that link to reset password.</p>
                                    <form action="{{ route('reset.password.post') }}" method="POST">
                                        @csrf
                                        <input type="text" name="token" hidden value="{{$token}}">
                                        <div class="mb-3">
                                          <label class="form-label">Email Address</label>
                                          <input type="email" class="form-control" name="email">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="password">
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                          </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    </div>
                                    </main>
                                    <hr>
                                 
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>