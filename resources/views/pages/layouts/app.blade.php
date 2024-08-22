<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/toastify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <title>Point of Sale | Login </title>
</head>

<body class="bg-light">
    {{-- Loader --}}
    <div id="loaderContainer" class="loader-container d-none">
        <div class="full-wraper"></div>
        <div class="linear-loader"></div>
    </div>
    {{-- Loader --}}
    <div class="d-flex align-items-center justify-content-center vh-100">
        @yield('content')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastify.min.js') }}"></script>
    @yield('js')
    <script>
        function successToast(msg) {
            Toastify({
                text: msg,
                duration: 2000,
                newWindow: true,
                gravity: 'bottom',
                position: 'center',
                backgroundColor: 'green',
                stopOnFocus: true,
            }).showToast();
        }

        function errorToast(msg) {
            Toastify({
                text: msg,
                duration: 2000,
                newWindow: true,
                gravity: 'bottom',
                position: 'center',
                backgroundColor: 'red',
                stopOnFocus: true,
            }).showToast();
        }

        let loader = document.getElementById('loaderContainer');

        function showloader() {
            loader.classList.remove('d-none')
        }

        function hideloader() {
            loader.classList.add('d-none')
        }
    </script>
</body>

</html>
