<!DOCTYPE html>
<head>
	<meta charset="utf-8"/>
	<title> {{ isset($title) ? $title.' | ' : '' }} Laravel Ask Me </title>
	<link rel="shortcut icon" href="{{{ asset('assets/images/rubik.ico') }}}">
	<link href="{{ asset('assets/css/reset.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/bootstrap/css/bootstrap-custom.min.css')}}" rel="stylesheet">
	{{ HTML::style('assets/css/style.css') }}
</head>
<body>
	{{--We include the top menu view here--}}
	@include('template.topmenu')
	<div class="content-wrapper">
		<div class="container">
            <div class="row">
                <div class="col col-md-12">
                    <div class="row">
                        <div class="col col-md-10 col-sm-12 col-md-offset-1">
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
                        </div>
                    </div>
                        @yield('content')
                </div>

            </div>

		</div>
	</div>
	<footer class="footer">
		<div class="container padding-top-15 text-center">
			<div class="text-muted pull-left">@ Metropolia 2015, by team25.</div>
			<div class="pull-right">
			<iframe id="iframe-footer"src="http://ghbtns.com/github-btn.html?user=ruathudo&repo=ask-me&type=fork&count=true"
			            allowtransparency="true" frameborder="0" scrolling="0" width="80" height="20"></iframe>
			</div>            
		</div>
	</footer>

	
	{{-- JavaScript files --}}
	{{ HTML::script('assets/js/jquery-2.1.3.min.js') }}
	{{ HTML::script('assets/js/jquery.jscroll.min.js') }}
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea'});</script>
	{{--{{ HTML::script('assets/js/script.js') }}--}}
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