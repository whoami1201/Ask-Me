{{-- Top error (about login etc.) --}}
@if(Session::has('topError'))
<!-- 	<div class="centerfix" id="infobar">
		<div class="centercontent">
			{{ Session::get('topError') }}
		</div>
	</div> -->
	<div class="alert alert-danger" role="alert">
		<p class="text-center">{{ Session::get('topError') }}</p>
	</div>
@endif

<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      {{HTML::linkRoute('index','Laravel Ask Me',null, array('class' => 'navbar-brand'))}}  
    </div>
    @if(!Sentry::check())
        <div id="navbar" class="navbar-collapse collapse">
          	{{Form::open(array(
          		'route'=>'login_post',
          		'class'=>'navbar-form navbar-right'
          		))}}
            <div class="form-group">
              {{Form::email('email', Input::old('email'), array(
              	'placeholder' => 'E-mail',
              	'class'=>'form-control')
              	)}}
            </div>
            <div class="form-group">
              {{Form::password('password', array(
              	'placeholder' =>'Password',
              	'class' => 'form-control'))}}
            </div>
            {{Form::button('Log in',array(
            	'type'=>'submit',
            	'class'=>'btn btn-success'
            	))}}
            
            {{Form::close()}}
            <ul class="nav navbar-right">
                <li>
                    <p class="navbar-btn">
                        {{HTML::link('signup','Register', array('class' => 'btn btn-info'))}}    
                    </p>
                </li>
            </ul>
    	</div><!--/.navbar-collapse-->
    @else
        <ul class="nav navbar-nav navbar-right">
        	<li><span class="navbar-text">Hello again, {{HTML::link('#',Sentry::getUser()->first_name)}}!</span></li>
        	<li><p class="navbar-btn">
        		{{HTML::linkRoute('logout','Logout',null ,array('class' => 'btn btn-warning'))}}    
                </p></li>
        </ul>
    @endif
  </div>
</nav>