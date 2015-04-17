{{-- Top error (about login etc.) --}}
@if(Session::has('topError'))
	<div class="alert alert-danger" role="alert">
		<p class="text-center">{{ Session::get('topError') }}</p>
	</div>
@endif

<nav class="navbar navbar-default navbar-static-top">
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
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="{{HTML::active('browse')}}">{{HTML::linkRoute('browse','Browse')}}</li>
            <li class="{{HTML::active('random')}}"><a href="#">Random</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Category <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
        </ul>
        <form class="navbar-form navbar-left" role="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" aria-describedby="addon1">
                <span class="input-group-addon" id="addon1">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </span>
            </div>
        </form>
    	@if(!Sentry::check())
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <p  class="navbar-btn">
                        {{HTML::link('signup','Register', array('class' => 'btn btn-info'))}}    
                    </p>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                            {{Form::open(array(
                                'route'=>'login_post',
                                'class'=>'navbar-form'
                                ))}}
                          <div class="form-group margin-top-5">
                            {{Form::email('email', Input::old('email'), array(
                                'placeholder' => 'E-mail',
                                'class'=>'form-control')
                                )}}
                          </div>
                          <div class="form-group margin-top-5">
                            {{Form::password('password', array(
                                'placeholder' =>'Password',
                                'class' => 'form-control'))}}
                          </div>
                          {{Form::button('Log in',array(
                            'type'=>'submit',
                            'class'=>'btn btn-success margin-top-5'
                            ))}}
                          <span class="checkbox">
                            <label><input type="checkbox">  Remember me</label>
                          </span>
                          {{Form::close()}}
                          <li><a href="#">Forgot your password?</a></li>
                    </ul>
                </li> 
            </ul>
    	@else
            <ul class="nav navbar-nav navbar-right">
            	<li class="mobile-fix"><span class="navbar-text">Hello again, 
                {{HTML::link('#',Sentry::getUser()->first_name)}}!</span></li>
                <li class="mobile-fix">
                    <p class="navbar-btn">
                        {{HTML::linkRoute('ask','Ask question',null,array('class'=>'btn btn-primary'))}}
                    </p>
                </li>
            	<li class="mobile-fix">
                    <p class="navbar-btn">
            		  {{HTML::linkRoute('logout','Log out',null ,array('class' => 'btn btn-warning'))}}    
                    </p>
                </li>
            </ul>
    	@endif
    </div><!--/.navbar-collapse-->
    
  </div>
</nav>