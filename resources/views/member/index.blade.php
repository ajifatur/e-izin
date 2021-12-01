<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/'.setting('icon')) }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

    <!-- Style -->
    <style type="text/css">
        a {text-decoration: none;}
        .card-absent:hover {text-decoration: none;}
        .card-absent:hover .card {background-color: #eeeeee;}
    </style>

    <title>Beranda | E-Izin</title>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('member.dashboard') }}">E-Izin</a>
            <div class="btn-group">
                <a class="btn btn-warning" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                    <i class="bi-power"></i> Log Out
                </a>
            </div>
            <form class="d-none" id="form-logout" method="post" action="{{ route('member.logout') }}">
                @csrf
            </form>
        </div>
    </nav>

    @if(Auth::user()->end_date == null)
    <div class="container mt-5">
        <!-- Welcome Text -->
        <div class="alert alert-info text-center" role="alert">
            Selamat datang <strong>{{ Auth::user()->name }}</strong> di E-Izin. Anda login sebagai Member <strong>({{ Auth::user()->position ? Auth::user()->position->name : '-' }})</strong>.
        </div>

        <div class="card">
            <div class="card-header"><h5 class="text-center mb-0">Hari ini tidak hadir kenapa?</h5></div>
            <div class="card-body">
                @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible text-center fade show" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="row justify-content-center">
                    <a href="{{ route('member.absent', ['id' => 1]) }}" class="col-md-4 col-6 card-absent" data-bs-toggle="tooltip" title="Klik untuk melakukan izin">
                        <div class="card h-100 card-hover text-center">
                            <div class="card-body p-3">
                                <p class="h2"><i class="bi-thermometer-half"></i></p>
                                <h5 class="card-title mb-0">Sakit</h5>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('member.absent', ['id' => 2]) }}" class="col-md-4 col-6 card-absent" data-bs-toggle="tooltip" title="Klik untuk melakukan izin">
                        <div class="card h-100 card-hover text-center">
                            <div class="card-body p-3">
                                <p class="h2"><i class="bi-tornado"></i></p>
                                <h5 class="card-title mb-0">Izin</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container mt-5">
        <!-- Welcome Text -->
        <div class="alert alert-danger text-center" role="alert">
            Selamat datang <strong>{{ Auth::user()->name }}</strong> di {{ setting('name') }}. Mohon maaf untuk memberitahukan bahwa status Anda disini sudah <strong>Tidak Aktif</strong>.
        </div>
    </div>
    @endif

    <!-- JQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        // Enable tooltip everywhere
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>