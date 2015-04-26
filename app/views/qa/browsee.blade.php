@extends('template_masterpage') 



@section('content')

    <div class="row">
		<div class="col col-md-8">
			<div class="well">
				<h1>{{$title}}</h1>
				<div id="browse-questions">
					{{-- QUESTION LIST --}}
					@if(count($questions))

						@foreach($questions as $question)
                            <?php

                            $asker = $question->users;

                            $tags = $question->tags;

                            $created_at = $question->created_at;

                            ?>
							<div class="row well" >
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
                                            <p>
                                                <em>Asked by <a href="#">{{$asker->first_name.' '.$asker->last_name}}</a>
                                                    <span>on {{date('d M \'y',strtotime(
$created_at))}} at {{date('H:i',strtotime(
$created_at))}}</span></em>
                                            </p>
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
		</div>
		<div class="col col-md-4">
			@include('template.col-right')
		</div>
	</div>
@stop

@section('footer_assets')
	<script>
		$('#browse-questions').jscroll({
	        autoTrigger: false,
            loadingHtml: '<img src="{{asset('assets/images/loading.gif')}}" alt="Loading" width="10px" height="10px"/> Loading...',
	        nextSelector: '.pager li a',
	        contentSelector: 'div#browse-questions',
	        callback: function() {
	            $('ul.pagination:visible:first').hide();
	        }
        });
	</script>
@stop