<!DOCTYPE html>
<head>
	<meta charset="utf-8"/>
	<title> {{ isset($title) ? $title.' | ' : '' }} Laravel Ask Me </title>
	<link href="{{ asset('assets/css/reset.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	{{ HTML::style('assets/css/style.css') }}
</head>
<body>
	{{--We include the top menu view here--}}
	@include('template.topmenu')

	<div class="container">
		@if(Session::has('error'))
			<div class="margin-bottom-10">
			
				<div class="alert alert-danger" role="alert">
					<p class="text-center">{{ Session::get('error') }}</p>
				</div>
			</div>
		@endif

		@if(Session::has('success'))
			<div class="margin-bottom-10">
				<div class="alert alert-success" role="alert">
					<p class="text-center">{{ Session::get('success') }}</p>
				</div>
			</div>
		@endif
		@yield('content')
	</div>
	{{-- JavaScript files --}}
	{{ HTML::script('assets/js/jquery-2.1.3.min.js') }}
<!-- 	{{ HTML::script('assets/js/plugin.js') }}
	{{ HTML::script('assets/js/script.js') }} -->
	{{ HTML::script('assets/bootstrap/js/bootstrap.min.js') }}

	{{-- Each page's custom assets (if available) will be yeiled here --}}
	@yield('footer_assets')

	{{-- if the user is logged in and on index or question details page--}} 
    @if(Sentry::check() && (Route::currentRouteName() == 'index' 
    	|| Route::currentRouteName() == 'question_details')) 

      {{ HTML::script('assets/js/handle_like.js') }}

    @endif 
	
</body>
</html>