<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>INVENTARIS-APP</title>


    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">

    <!-- Include CSS files -->
    <link rel="stylesheet" href="{{ asset('assets\vendor\datatables\datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/plugin-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/style-bundle.css') }}">
    @vite(['resources/css/app.css'])
    @yield('css')

</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">

    <span class="loader-main"></span>

    <div class="d-flex flex-column flex-root blur-content">
        <div class="page d-flex flex-row flex-column-fluid">
            @include('layouts.sidebar')
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('layouts.header')
                @yield('header')
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="container-xxl" id="kt_content_container">
						@yield('content')
                    </div>
                </div>
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container-xxl d-flex justify-content-center">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-gray-400 fw-bold me-1"></span>
                            <a href="#"
                                class="text-muted text-hover-primary fw-bold me-2 fs-6">INVENTARIS-APP</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	@yield('modal')

	<!-- Modal Load-->
	<div class="modal fade" role="dialog" id="modal_loading" role="dialog" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body pt-0" style="background-color: rgb(245,247,249); border-radius: 6px;">
				<div class="text-center">
					<img style="border-radius: 4px; height: 140px;" src="{{ asset('assets/img/icon/loader_1.gif') }}" alt="Loading">
					<h6 style="position: absolute; bottom: 10%; left: 37%;" class="pb-2">Mohon Tunggu..</h6>
				</div>
			</div>
		</div>
		</div>
	</div>

    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                    fill="black" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="black" />
            </svg>
        </span>
    </div>
    <script src="{{ asset('assets/vendor/plugins-bundle.js') }}"></script>
	<script src="{{ asset('assets/vendor/scripts-bundle.js') }}"></script>
    
	<script src="{{ asset('assets\vendor\datatables\datatables.bundle.js') }}"></script>

    <!-- Include Vite-generated JS file -->
    @vite(['resources/js/app.js'])

	@include('build.scriptjs')
	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

        $(window).on('load', function(){
            setTimeout(() => {
                $('.loader-main').fadeOut(500);
                $('.blur-content').removeClass('blur-content');
            }, 500);
        });

        // Close button handler
        $('button[data-modal-action="close"]').on('click', function (e) {
            e.preventDefault();
            if($(this).hasClass('no-confirmation')){
                $('#modal').modal('hide'); // Hide modal				
                return;
            }
            Swal.fire({
                text: "Apakah Anda yakin ingin membatalkan??",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Batalkan!",
                cancelButtonText: "Tidak, Kembali",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    $('#modal').modal('hide'); // Hide modal				
                }
            });
        });

        function formatted_indonesia_date(dateString){
            const dateObject = new Date(dateString);
            // Format the date using toLocaleDateString with Indonesian locale options
            const formattedDate = dateObject.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            return formattedDate;
        }
        
		$(document).ready(function(){
			$('#kt_activities').removeClass('d-none');
		})
	</script>

    @yield('script')
</body>

<body>

</body>

</html>
