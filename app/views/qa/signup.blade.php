@extends('template_masterpage')

@section('content')
<div class="row">
<div class="col-md-4">
	<div class="well">
		<h3 class="text-primary">Already a member?</h3>
			{{Form::open(array(
				'route'=>'login_post'
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
		  <div class="checkbox">
		  	<label>
		  		<input type="checkbox">Remember me
		  	</label>

		  </div>
		  {{Form::button('Log in',array(
		  	'type'=>'submit',
		  	'class'=>'btn btn-success'
		  	))}}
		  
		  {{Form::close()}}
		  <hr>
		  <a href="#">Forgot your password?</a>
	</div>
</div>
<div class="col-md-8">
<div class="well">
	<div class="row text-center">
		<h1 class="text-primary">Sign up</h1>
		<p>Please fill all the credentials correctly to register to our site</p>
	</div>
	<div class="row">
		{{Form::open(array('route'=>'signup_form_post','class'=>'form-horizontal'))}}
		<div class="form-group">
		    <label for="signup-firstname" class="col-md-2 control-label col-md-offset-1">First name</label>
		    <div class="col-md-3">
		    {{Form::text('first_name', Input::get('first_name'), array(
		    	'class' => 'fullinput form-control',
		    	'id' => 'signup-firstname'
		    	))}}
		    	</div>
		    <label for="signup-lastname" class="col-md-2 control-label">Last name</label>
		    <div class="col-md-3">
		    {{Form::text('last_name', Input::get('last_name'), array(
		    	'class' => 'fullinput form-control',
		    	'id' => 'signup-lastname'
		    	))}}
		    	</div>	
		 </div>

		 <div class="form-group">
		    <label for="signup-email" class="col-md-2 control-label col-md-offset-1">Email address</label>
		    <div class="col-md-8">
		    {{Form::email('email', Input::get('email'), array(
		    	'class' => 'fullinput form-control',
		    	'id' => 'signup-email'
		    	))}}
		    	</div>
		 </div>
		 <div class="form-group">
		    <label for="signup-password" class="col-md-2 control-label col-md-offset-1">Password</label>
		    <div class="col-md-8">
		    {{Form::password('password', array(
		    	'class' => 'fullinput form-control',
		    	'id' => 'signup-password'
		    	))}}
		    	</div>
		 </div>
		 <div class="form-group">
		    <label for="signup-repassword" class="col-md-2 control-label col-md-offset-1">Retype password</label>
		    <div class="col-md-8">
		    {{Form::password('re_password', array(
		    	'class' => 'fullinput form-control',
		    	'id' => 'signup-repassword'
		    	))}}
		    	</div>
		 </div>
	 </div>

	<div class="row">
		<p class="text-info text-center">Your personal info will not be shared with any 3rd party companies.</p>
		{{Form::button('Done!', array('class'=>'btn btn-success center-block', 'type'=>'submit'))}}
		{{Form::close()}}
	</div>
</div>
</div>
</div>
@stop