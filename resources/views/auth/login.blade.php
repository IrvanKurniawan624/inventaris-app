<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <title>INVENTARIS-APP</title>

    <link rel="stylesheet" href="{{ asset('assets/vendor/plugin-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/style-bundle.css') }}">
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    <style>
        .g-recaptcha{
            display: flex;
            justify-content: center;
        }

        #toggle_password{
            position: absolute;
            top: 15px;
            right: 18px;
            font-size: 1.35rem;
            cursor: pointer;
        }
    </style>

</head>
<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/dozzy-1/14.png">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="" class="mb-10">
                    <img alt="Logo" src="{{ asset('assets/img/logo.png') }}" class="h-65px" />
                </a>
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <form class="form w-100" method="POST" id="form_login" action="{{ route('login') }}">
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">LOGIN</h1>
                            <div class="text-gray-400 fw-bold fs-4">Inventaris Management App</div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <div class="d-flex flex-stack mb-2">
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                {{-- <a href="../../demo4/dist/authentication/flows/basic/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a> --}}
                            </div>
                            <div class="position-relative">
                                <input class="form-control form-control-lg form-control-solid" type="password" id="password" name="password" autocomplete="off" />
                                <i class="bi bi-eye-slash" onclick="togglePasswordVisibility()" id="toggle_password"></i>
                            </div>
                        </div>
                        <div class="fv-row mb-10">
                            <div class="form-group row">
                                <div class="col-12"> {!! htmlFormSnippet() !!} </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" id="button_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">Continue</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>var hostUrl = "assets/";</script>
    <script src="{{ asset('assets/vendor/plugins-bundle.js') }}"></script>
	<script src="{{ asset('assets/vendor/scripts-bundle.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function togglePasswordVisibility() {
            let passwordInput = document.getElementById('password');
            let toggleIcon = document.querySelector('#toggle_password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-eye';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-eye-slash';
            }
        }

        let is_captcha = false;

        $('#form_login').submit(function(e){
            e.preventDefault();
            
            let this_form = this;
            $("#button_submit").attr('data-kt-indicator', "on");
            $("#button_submit").attr('disabled', "true");
            $.ajax({
                url:  $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response){
                    setTimeout(function () { 
                        $("#button_submit").removeAttr('data-kt-indicator');
                        $("#button_submit").removeAttr('disabled');
                    }, 500);
                    if(response.code == 200){
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Okay..!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function () {
                            window.location.href = '/dashboard';
                        });
                    }
                },error: function (jqXHR, textStatus, errorThrown) {
                    setTimeout(function () { 
                        $("#button_submit").removeAttr('data-kt-indicator');
                        $("#button_submit").removeAttr('disabled');
                    }, 500);
                    if(jqXHR.status == 400){
                        $('.invalid-feedback').remove();
                        $('input, textarea, select').removeClass('is-invalid');
                        Object.keys(jqXHR.responseJSON.errors).forEach(function (key) {
                            var responseError = jqXHR.responseJSON.errors[key];
                            var elem_name = $(this_form).find('[name=' + responseError['field'] + ']');
                            if(responseError['field'] == 'g-recaptcha-response' && jqXHR.responseJSON.errors.length > 1){
                                Swal.fire('Oops!',"CAPTCHA verification failed and there are some errors detected, please try again..",'error');
                                is_captcha = true;
                            } else if (responseError['field'] == 'g-recaptcha-response'){
                                Swal.fire('Oops!',"CAPTCHA verification failed, please try again.. Please try again.",'error');
                                is_captcha = true;
                            } else {
                                elem_name.after(`<span class="d-flex text-danger invalid-feedback">${responseError['message']}</span>`);
                                elem_name.addClass('is-invalid');
                            }
                        });
                        if(is_captcha !== true){
                            Swal.fire('Oops!',jqXHR.responseJSON.message,'error');
                        } else {
                            is_captcha = false;
                        }
                    }
                    else {
                        Swal.fire({
                            text: jqXHR.responseJSON.message,
                            icon: "error",
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>