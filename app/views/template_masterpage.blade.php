<!DOCTYPE html>
<head>
	<meta charset="utf-8"/>
	<title> {{ isset($title) ? $title.' | ' : '' }} LARAVEL ASK ME </title>
	<link href="{{ asset('assets/css/reset.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	{{ HTML::style('asset/css/style.css') }}
</head>
<body>
	{{--We include the top menu view here--}}

	@include('template.topmenu')

	<div class="container">
		@yield('content')
	</div>
	
	{{-- JavaScript files --}}
	{{ HTML::script('assets/js/jquery-2.1.3.min.js') }}
	{{ HTML::script('assets/js/plugin.js') }}
	{{ HTML::script('assets/js/script.js') }}
	{{ HTML::script('assets/bootstrap/js/bootstrap.min.js') }}

	{{-- Each page's custom assets (if available) will be yeiled here --}}
	@yield('footer_assets')
	
</body>
</html>