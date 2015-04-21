@extends('template_masterpage') 



@section('content')

<div class="container">
	<div class="row">
		<div class="col col-md-8">
			<div class="well">
				<h1>{{$title}}</h1>

				{{-- QUESTION LIST --}}
				@if(count($questions)) 

					@foreach($questions as $question)
					<?php 

					            //Question's asker and tags info 

					$asker = $question->users; 

					$tags = $question->tags;                 

					?>
						<div class="row well">
							<div class="col-md-1 col-sm-1 col-xs-1">
							    <div class="text-center">
							        <div class="row">
							            <span class="glyphicon glyphicon-chevron-up"></span>
							        </div>
							        <div class="row">
							            <h4 class="text-muted"><?php echo rand(-5, 10);?></h4>
							        </div>
							        <div class="row">
							            <span class="glyphicon glyphicon-chevron-down"></span>
							        </div>
							    </div>
							</div>
							<div class="col-md-11">
								<div class="row">
									<div class="col-md-12">
									<h4>
									{{HTML::linkRoute('question_details',
									$question->title,array(
										$question->id,
										Str::slug($question->title)
										))}} 
									</h4>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
									<p>By {{$asker->first_name}}</a> 
									around {{date('m/d/Y H:i:s',strtotime($question->created_at))}}</p>
									</div>
								</div>
							</div>
						</div>
					@endforeach
					<div class="text-center">
						{{$questions->links()}} 
					</div>
					
				@endif
			</div>
		</div>
		<div class="col col-md-4">
			@include('template.col-right')
		</div>
	</div>
</div>
@stop