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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/fontawesome.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastify.min.js') }}"></script>
    <title>Point of Sale | Dashboard </title>
</head>

<body class="bg-light">
    {{-- Loader --}}
    <div id="loaderContainer" class="loader-container d-none">
        <div class="full-wraper"></div>
        <div class="linear-loader"></div>
    </div>
    {{-- Loader --}}

    <!-- Sidebar -->
    <header class="bg-white shadow">
        <div class="container-fluid">
            <div class="d-flex justify-content-between pl-3 pr-3">
                <!-- Logo -->
                <div class="logo pl-4 d-flex align-items-center justify-content-center">
                    <button id="toggleButton" class="border-0 fs-20">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    {{-- <img src="assets/demos-logo-png-transparent.png" height="40px" /> --}}
                    <h1 class="text-bold h1">Point Of Sale</h1>
                </div>
                <!-- seacrh box -->
                <div class="search-box">
                    {{-- <div class="">
                        <input type="text" class="form-control" id="formGroupExampleInput"
                            placeholder="Enter Your Email Address">
                    </div> --}}
                </div>
                <!-- top right -->
                <div class="tor-right">
                    <div class="dropdown">
                        <button class="border-none" type="button" id="dropdownMenu2" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a href="/user-profile" class="dropdown-item" type="button">Profile</a></li>
                            <li><a href="/logout" class="dropdown-item" type="button">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- main section -->
    <main class="d-flex gap-3">
        <!-- sidebar -->
        <aside class="shadow sidebar" id="sidebar">
            <ul>
                <li class="border-bottom">
                    <a href="/dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                </li>

                <li class="border-bottom">
                    <a href="/user-profile"><i class="fa-solid fa-user"></i> Profile</a>
                </li>

                <li class="border-bottom">
                    <a href="/customers"><i class="fa-solid fa-user"></i> Customers</a>
                </li>
                <li class="border-bottom">
                    <a href="/products"><i class="fa-solid fa-list"></i> Products</a>
                </li>

                <li class="border-bottom">
                    <a href="/products-category"><i class="fa-solid fa-tag"></i> Product Category</a>
                </li>

                <li class="border-bottom">
                    <a href="/invoices"><i class="fa-solid fa-tag"></i> Invoices</a>
                </li>

                <li class="border-bottom">
                    <a href="/reports"><i class="fa-solid fa-list"></i> Reports</a>
                </li>

                <li class="border-bottom">
                    <a href="/logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </li>
            </ul>
        </aside>
        <div class="container-fluid" id="mainContent">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </main>


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

        function showloader() {
            let loader = document.getElementById('loaderContainer');
            loader.classList.remove('d-none');
        }

        function hideloader() {
            let loader = document.getElementById('loaderContainer');
            loader.classList.add('d-none');
        }

        document.getElementById('toggleButton').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('hidden');
            if (sidebar.classList.contains('hidden')) {
                mainContent.classList.add('full-width');
            } else {
                mainContent.classList.remove('full-width');
            }
        });
    </script>
    @yield('js')
</body>

</html>
