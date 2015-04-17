@extends('template_masterpage')

@section('content')
	<div class="row">
		<div class="col-md-2">
			@include('template.col-left')
		</div>
		<div class="col-md-7">
			<div class="well">
				<h1>Ask a question</h1>
				<p>Note: If you think your question's been answered correctly, please don't forget to mark the answer as "correct".</p>
				{{Form::open(array('route'=>'ask_post'))}}
				<div class="form-group">
				    <label for="asknew-title" class="control-label">Title</label>
				    {{Form::text('title', Input::old('title'), array(
				    	'class' => 'fullinput form-control',
				    	'id' => 'asknew-title',
				    	'placeholder'=>'By the way, which one\'s Pink?'
				    	))}}
				</div>
			    <div class="form-group">
				    <label for="asknew-content" class="control-label">Explain your question</label>
				    <p class="help-block"><strong>Hint: </strong>Basic HTML is accepted.</p>	
				    {{Form::textarea('question', Input::old('question'), array(
				    	'class' => 'fullinput form-control',
				    	'id' => 'asknew-content'
				    	))}}
				</div>
				<div class="form-group">
				    <label for="asknew-tag" class="control-label">Tags </label>
				    {{Form::text('tags', Input::old('tags'), array(
				    	'class' => 'fullinput form-control',
				    	'id' => 'asknew-tag',
				    	'placeholder' => 'laravel, javascript-noob'
				    	))}}
				    <p class="help-block"><strong>Hint: </strong>You can use commas to split tags (tag1, tag2, etc.). 
				    To join multiple words in a tag, use '-' in between (tag-name).</p>	
				</div>
				{{Form::button('Ask this question', array(
				'class'=>'btn btn-success',
				'type'=>'submit'
				))}}
				{{Form::close()}}
			</div>
		</div>
		<div class="col-md-3">
			@include('template.col-right')
		</div>

	</div>
@stop

@section('footer_assets')
	{{-- A simple jQuery code to lowercase all tags before submission --}}
	<script type='text/javascript'>
		$('input[name="tags"]').keyup(function(){
			$(this).val($(this).val().toLowerCase());
		});
	</script>
@stop