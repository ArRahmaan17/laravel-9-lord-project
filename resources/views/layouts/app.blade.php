<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ isset($title) ? $title : $appTitle }} | Rahmaan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css ') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/css/select2.min.css') }}">


    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                    <h2 class="text-white mt-2">{{ $appTitle }}</h2>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-activities.html" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            @include('components.sidenavbar')
            {{-- <x-sidenavbar></x-sidenavbar> --}}
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022 <div class="bullet"></div> Develop By <a href="#">Maman Recing</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/js/select2.full.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/index.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        let requestAjax = (uri, method, payload, elementMessage, asyncVal = true, elementLoad = null) => {
            let csrfName = $('#csrf').attr('name'),
                csrfHash = $('#csrf').val();
            return $.ajax({
                url: uri,
                async: asyncVal,
                type: method,
                // data:{...payload, [csrfName]: csrfHash }, 
                data: {
                    ...payload
                },
                dataType: 'json',
                beforeSend: function() {
                    iziToast.info({
                        timeout: 500,
                        overlay: false,
                        title: '',
                        message: "Loading...",
                        position: 'topRight',
                        drag: false,
                    });
                },
                beforeSend: function() {},

                success: function(data) {
                    // (data?.hasil && data?.pesan) && TampilkanpesanX(elementMessage, data.pesan, data.hasil)
                    // (data?.hasil && data?.pesan) && toastSuccess(data.pesan)
                },
                error: function(err) {
                    iziToast.error({
                        timeout: 3000,
                        overlay: false,
                        title: 'Gagal',
                        message: err.responseText,
                        position: 'topRight',
                        drag: false,
                    });
                    console.log('error request', err.responseText)
                },
                complete: function(event, xhr, options) {
                    let resp = event.responseJSON
                    resp?.hasil && resp?.pesan && iziToast.success({
                        timeout: 2000,
                        icon: 'fa fa-chrome',
                        title: resp.hasil ? 'Success' : 'Failed',
                        message: resp.pesan,
                        position: 'topRight',
                        drag: false,
                        overlay: false,
                    });
                }
            });
        }
    </script>
    @yield('script')
</body>

</html>
