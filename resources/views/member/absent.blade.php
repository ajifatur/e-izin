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

    <title>Izin Tidak Hadir | E-Izin</title>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('member.dashboard') }}">E-Izin</a>
            <div class="btn-group">
                <a class="btn btn-info" href="{{ route('member.dashboard') }}">
                    <i class="bi-arrow-left"></i> Kembali
                </a>
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
            <div class="card-header"><h5 class="text-center mb-0">Izin Tidak Hadir</h5></div>
            <div class="card-body">
                @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible text-center fade show" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form method="post" action="{{ route('member.absent.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="mb-3">
                        <label class="form-label">Alasan: <span class="text-danger">*</span></label>
                        <input class="form-control" value="{{ $name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penjelasan karena tidak hadir: <span class="text-danger">*</span></label>
                        <textarea name="note" class="form-control {{ $errors->has('note') ? 'border-danger' : '' }}" rows="3" placeholder="Tulis sesuatu...">{!! old('note') !!}</textarea>
                        @if($errors->has('note'))
                            <div class="text-danger">{{ ucfirst($errors->first('note')) }}</div>
                        @endif
                    </div>
                    @if($id == 1)
                    <div class="mb-3">
                        <label class="form-label">Bukti:</label>
                        <br>
                        <input type="file" name="attachment" accept="image/*">
                    </div>
                    @endif
                    <hr>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Submit</button>
                </form>
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