<!DOCTYPE html>
<html>
    <head>
        @include('template/_head')
        <title>Login | {{ setting('name') }}</title>
        <style>
            .btn .fa {margin-right: 0;}
        </style>
    </head>
    <body>
        <section class="material-half-bg">
            <div class="cover"></div>
        </section>
        <section class="login-content">
            <div class="logo">
                <img src="{{ asset('assets/images/logo/'.setting('logo')) }}" height="150">
            </div>
            <div class="login-box">
                <form class="login-form" action="{{ route('auth.post-login') }}" method="post">
                    @csrf
                    <h3 class="login-head">Selamat Datang!</h3>
                    @if($errors->has('message'))
                    <div class="alert alert-danger text-center">{{ $errors->first('message') }}</div>
                    @endif
                    <div class="form-group">
                        <label class="control-label">EMAIL / USERNAME</label>
                        <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" type="text" placeholder="Masukkan Email / Username" value="{{ old('username') }}" autofocus>
                        @if($errors->has('username'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('username')) }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">PASSWORD</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Masukkan Password">
                            <div class="input-group-append">
                              <a href="#" class="btn btn-toggle-password input-group-text {{ $errors->has('password') ? 'border-danger' : '' }}"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        @if($errors->has('password'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('password')) }}</div>
                        @endif
                    </div>
                    <!-- <div class="form-group">
                        <div class="utility">
                            <div class="animated-checkbox">
                                <label>
                                    <input type="checkbox"><span class="label-text">Stay Signed in</span>
                                </label>
                            </div>
                            <p class="semibold-text mb-2"><a href="#">Forgot Password ?</a></p>
                        </div>
                    </div> -->
                    <div class="form-group btn-container">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw mr-2"></i> Masuk</button>
                    </div>
                </form>
            </div>
        </section>
    </body>
    @include('template/_js')
</html>