<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<head>

    <meta charset="utf-8" />
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="D8 Cinema" name="description" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    @include('admin.includes.styles')

</head>

<body>


<section class="auth-page-wrapper-2 py-4 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-5">
                <div class="auth-card card bg-primary h-100 rounded-0 rounded-start border-0 d-flex align-items-center justify-content-center overflow-hidden p-4">
                    <div class="auth-image">
                        <img src="{{asset('user_assets/img/logo.png')}}" height="24"  alt="">
                        <img src="{{asset('assets/images/effect-pattern/auth-effect-2.png')}}" alt="" class="auth-effect-2" />
                        <img src="{{asset('assets/images/effect-pattern/auth-effect.png')}}" alt="" class="auth-effect" />
                        <img src="{{asset('assets/images/effect-pattern/auth-effect.png')}}" alt="" class="auth-effect-3" />
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card mb-0 rounded-0 rounded-end border-0">
                    <div class="card-body p-4 p-sm-5 m-lg-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary fs-20">Sign In to Your  Account</h5>
                        </div>
                        <div class="p-2 mt-5">
                            <div class="prompt"></div>
                            <form class="needs-validation" id="loginForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="ri-mail-line"></i></span>
                                        <input type="email" class="form-control" id="useremail" name="email" placeholder="Enter email address" required>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter email
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password</label>
                                    <div class="position-relative auth-pass-inputgroup overflow-hidden">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="ri-lock-2-line"></i></span>
                                            <input type="password" class="form-control pe-5 password-input" name="password" onpaste="return false" placeholder="Enter password" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                        </div>
                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter password
                                    </div>
                                </div>



                                <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                    <h5 class="fs-13">Password must contain:</h5>
                                    <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                    <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                    <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                    <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                                </div>

                                <div class="mt-4">
                                    <button  class="btn btn-primary w-100" type="submit" id="submitForm">Sign In</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>

    $("#loginForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#loginForm")[0]);
        formData = new FormData($("#loginForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('login_request') }}",
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            beforeSend: function() {
                $("#submitForm").prop('disabled', true);
                $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
            },
            success: function(res) {
                if (res.success == true) {
                    $("#submitForm").prop('disabled', false);
                    $("#submitForm").html('Sign In');
                    $('.prompt').show();
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');

                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.href = "{{ route('index') }}";
                    }, 2000);

                } else {
                    $("#submitForm").prop('disabled', false);
                    $('.prompt').show();
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');

                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 2000);

                }
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                $("#submitForm").html('Sign In');
            }
        });
    });
</script>

<!-- JAVASCRIPT -->
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('assets/js/plugins.js')}}"></script>

<!-- validation init -->
<script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
<!-- password create init -->
<script src="{{asset('assets/js/pages/passowrd-create.init.js')}}"></script>

</body>


</html>
