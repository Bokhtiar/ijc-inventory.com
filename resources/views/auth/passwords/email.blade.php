<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Login - IJC Management</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('/admin/assets') }}/img/favicon.png" rel="icon">
    <link href="{{ asset('/admin/assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('/admin/assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/admin/assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('/admin/assets') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('/admin/assets') }}/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('/admin/assets') }}/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{ asset('/admin/assets') }}/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('/admin/assets') }}/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('/admin/assets') }}/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: bokhtiar.swe@gmail.com
  ======================================================== -->
</head>

<body>

    <main>

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center my-4">
                    <div class="col-lg-10 col-md-8 d-flex flex-column align-items-center justify-content-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">{{ __('Reset Password') }}</div>

                                        <div class="card-body">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            <form method="POST" action="{{ route('password.email') }}">
                                                @csrf

                                                <div class="row mb-3">
                                                    <label for="email"
                                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email"
                                                            class="form-control mt-3 @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required
                                                            autocomplete="email" autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        
                                                        <a href="@route('login')" class="">Back to login page</a>
                                                        
                                                    </div>
                                                </div>
                                                <div class="row mb-0">
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Send Password Reset Link') }}
                                                        </button>
                                                      
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/admin/assets') }}/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('/admin/assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/admin/assets') }}/vendor/chart.js/chart.umd.js"></script>
    <script src="{{ asset('/admin/assets') }}/vendor/echarts/echarts.min.js"></script>
    <script src="{{ asset('/admin/assets') }}/vendor/quill/quill.min.js"></script>
    <script src="{{ asset('/admin/assets') }}/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('/admin/assets') }}/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('/admin/assets') }}/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('/admin/assets') }}/js/main.js"></script>

</body>

</html>
