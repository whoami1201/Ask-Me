@extends('template_masterpage')

@section('content')
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
@stop