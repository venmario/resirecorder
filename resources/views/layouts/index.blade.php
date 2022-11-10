<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resi Recorder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="{{ asset("js/jquery-3.5.1.min.js") }}"></script>
    {{-- datatables --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('js/DataTables-1.12.1/css/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('js/Buttons-2.2.3/css/buttons.bootstrap5.min.css') }}" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">RjK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                </ul>
                <div class="dropdown ms-auto">
                    <a class="btn  dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->nama }}
                    </a>

                    <ul class="dropdown-menu">
                        @if (Auth::user()->role->nama == 'admin')
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.index') }}">Daftar PIC</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('register') }}">Tambah PIC</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('merchant.create') }}">Tambah Merchant</a>
                        </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('logs.index') }}">History</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="dropdown-item " href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('js/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/DataTables-1.12.1/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/DataTables-1.12.1/js/dataTables.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/Buttons-2.2.3/js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/Buttons-2.2.3/js/buttons.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/Buttons-2.2.3/js/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/Buttons-2.2.3/js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/Buttons-2.2.3/js/buttons.print.min.js') }}"></script>
    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js">
    </script>
    <script src="{{ asset('js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @yield('javascript')
</body>


</html>
