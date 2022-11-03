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
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <script src="https://kit.fontawesome.com/768f649122.js" crossorigin="anonymous"></script>


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

<body class="bg-dark">
    @yield('contentAuth')
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
    <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
    <script>
        iziToast.settings({
            timeout: 2000,
            titleSize: '25',
            closeOnEscape: true,
            resetOnHover: true,
            position: "topRight",
            closeOnClick: true,
            close: false,
            image: 'https://cdn3.iconfinder.com/data/icons/race-1-color-with-outline/300/Racing_circuit-512.png',
            layout: 2,
            icon: '',
            progressBarColor: 'rgb(0, 0, 0)',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
        });
        $(document).ready(() => {
            iziToast.info({
                title: 'Hello',
                message: 'Welcome!',
            });
        })

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
</body>
