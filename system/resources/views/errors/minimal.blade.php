<!DOCTYPE html>
<html dir="{{ _dir() }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title')</title>
	<link rel="shortcut icon" sizes="114x114" href="{{ _favicon() }}">

	<!-- Global stylesheets -->
    <link href="{{ url('assets/global/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link id="auth-theme-mode"  href="{{ _assets('css/'._dir().'/auth-all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ _assets('css/'._dir().'/app.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

	<!-- Core JS files -->
    <script src="{{ _assets('js/global/jquery.min.js') }}"></script>
    <script src="{{ _assets('js/global/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

	<!-- Theme JS files -->
	{{-- <script src="assets/js/app.js"></script> --}}
	<!-- /theme JS files -->

</head>

<body>
	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Container -->
					<div class="flex-fill">

						<!-- Error title -->
						<div class="text-center mb-4">
							<img src="{{ _get_image('errors/error_bg.svg', 'message') }}" class="img-fluid mb-3" height="230" alt="">
							<h1 class="display-2 font-weight-semibold line-height-1 mb-2">@yield('code')</h1>
							<h6 class="w-md-25 mx-md-auto">@yield('message')</h6>
						</div>
						<!-- /error title -->

						<!-- Error content -->
						<div class="text-center">
							<a href="@if(_is_admin()) {{ route('admin.panel') }} @else {{ url('/') }} @endif" class="btn btn-primary">
								<i class="icon-home4 mr-2"></i>
								{{ Str::title(__('errors.return_to_'.(_is_admin()?'dashboard':'site'))) }}
							</a>
						</div>
						<!-- /error wrapper -->

					</div>
					<!-- /container -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

	<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>

	<script>
		$(function() {
			if(Cookies.get('theme_mode') != 'undefined'){
				if(Cookies.get('theme_mode') == 'dark'){
					setDarkhref();
				}else{
					setLighthref();
				}
			}
		});

		function setDarkhref()
		{
			var href = "{{ _assets('css/'._dir().'/auth-all-dark.min.css') }}";
			$("#theme_mode").attr("checked", true);
			$('#auth-theme-mode').attr('href', href);
		}

		function setLighthref()
		{
			var href = "{{ _assets('css/'._dir().'/auth-all.min.css') }}";
			$('#auth-theme-mode').attr('href', href);
		}
	</script>

</body>
</html>
