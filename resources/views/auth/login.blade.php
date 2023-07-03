<!DOCTYPE html>
<html lang="en">
    <!-- Mon, 12 Jun 2023 09:19:54 GMT -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Login :: kz beverages </title>
        <link rel="shortcut icon" href="{{ asset('backend/assets/img/favicon.png') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome/css/all.min.css') }}">
        <link href="{{ asset('backend/assets/toaster/toastr.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    </head>
    <body>
        <div class="main-wrapper login-body">
            <div class="login-wrapper">
                <div class="container">
                    <img class="img-fluid logo-dark mb-2" src="{{ asset('backend/assets/img/logo2.png') }}" alt="Logo">
                    <div class="loginbox">
                        <div class="login-right">
                            <div class="login-right-wrap">
                                <h1>Login</h1>
                                <p class="account-subtitle">Access your dashboard</p>
                                <small class="form-control-feedback">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </small>
                                <small class="form-control-feedback">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </small>
                                @if(session('remainingSeconds'))
                                <div id="remaining-time">{{ session('remainingSeconds') }}</div>
                                @endif
                                <script>
                                    // Countdown timer
                                    const remainingTimeElement = document.getElementById('remaining-time');
                                    let remainingSeconds = parseInt(remainingTimeElement.innerText);
                                    const countdownInterval = setInterval(() => {
                                        if (remainingSeconds > 0) {
                                            remainingSeconds--;
                                            remainingTimeElement.innerText = remainingSeconds;
                                        } else {
                                            clearInterval(countdownInterval);
                                        }
                                    }, 1000);
                                </script>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-control-label">Email Address</label>
                                        <input type="email" name="email"  id="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Password</label>
                                        <div class="pass-group">
                                            <input type="password" name="password"  id="password" class="form-control pass-input" required>
                                            <span class="fas fa-eye toggle-password"></span>
                                            <small class="form-control-feedback">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="cb1">
                                                    <label class="custom-control-label" for="cb1">Remember me</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-lg btn-block btn-primary w-100" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('backend/assets/js/jquery-3.6.3.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/script.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- sweetalert2 --}}
        {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
        <script src="{{ asset('backend/assets/sweetalert-code/code.js') }}"></script>
        <!-- Toaster js -->
        <script src="{{ asset('backend/assets/toaster/toastr.min.js') }}"></script>
        <script>
            @if (Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch (type) {
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }

            @endif
        </script>
    </body>
    <!-- Mon, 12 Jun 2023 09:19:55 GMT -->
</html>
