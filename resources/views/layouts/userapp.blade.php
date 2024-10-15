<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $info['meta_description'] }}">
    <meta name="keywords" content="{{ $info['meta_keyword'] }}">
    <meta name="author" content="{{ $info['name'] }}">
    <link rel="icon" href="{{ asset('/') }}public/storage/{{ $info['favicon'] }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/') }}public/storage/{{ $info['favicon'] }}" type="image/x-icon">
    <title>{{ $info['name'] }}</title>
    <!-- Google font-->
    <link rel="stylesheet"
        href="{{ asset('/') }}admin/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&display=swap">

    <link rel="stylesheet"
        href="{{ asset('/') }}admin/css2-1?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">


    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/css/vendors/font-awesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/css/vendors/themify-icons.css">

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/css/vendors/slick-theme.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/css/vendors/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
    <style>
        body {
            font-family: Nunito;
            /* Change the font family to your desired font stack */
        }

        .custom-theme {
            display: none !important;
        }

        .error {
            color: red;
        }

        .invalid-feedback {
            display: block !important;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-2 ">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('index') }}">From</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <form class="d-flex">
                    <a href="{{ route('from.index') }}">Advisory form</a>
                </form>
            </div>
        </div>
    </nav>
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                {{-- <div class="row">
                    <div class="col-md-6">Forms</div>
                    <div class="col-md-6">Advisory form</div>
                </div> --}}
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('/') }}admin/js/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('/') }}admin/js/bootstrap.bundle.min.js"></script>

    <!-- feather icon js-->
    <script src="{{ asset('/') }}admin/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('/') }}admin/js/icons/feather-icon/feather-icon.js"></script>

    <!-- Sidebar jquery-->
    <script src="{{ asset('/') }}admin/js/sidebar-menu.js"></script>
    <script src="{{ asset('/') }}admin/js/slick.js"></script>

    <!-- lazyload js-->
    <script src="{{ asset('/') }}admin/js/lazysizes.min.js"></script>

    <!--right sidebar js-->
    <script src="{{ asset('/') }}admin/js/chat-menu.js"></script>

    <!--script admin-->
    <script src="{{ asset('/') }}admin/js/admin-script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <script>
        $('.single-item').slick({
            arrows: false,
            dots: true
        });
    </script>

    @if (Session::get('error'))
        <script>
            iziToast.error({
                title: 'Error',
                message: '{{ Session::get('error') }}',
            });
        </script>
    @endif
</body>

</html>
