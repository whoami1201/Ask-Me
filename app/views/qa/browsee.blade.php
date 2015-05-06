@extends('template_masterpage') 



@section('content')

    <div class="row">
		<div class="col col-md-7 col-md-offset-1">
			<div class="well">
				<h1>{{$title}}</h1>

                {{-- QUESTION LIST --}}
                @if(count($questions))
                    <div id="browse-questions">
                        @foreach($questions as $question)
                            <?php

                            $asker = $question->users;

                            $tags = $question->tags;

                            $created_at = $question->created_at;

                            ?>
                            <div class="row well question-bg" >
                                <div class="col-md-1 col-sm-1 col-xs-1">
                                    <div class="text-center vote-section">
                                        <div class="row">
                                            {{HTML::linkRoute('vote','',array('up',$question->id),
                                            array('class'=>'like glyphicon glyphicon-chevron-up',
                                            'title'=>'Upvote'
                                            ))}}
                                        </div>
                                        <div class="row">
                                            <h4 class="text-muted vote-count">{{$question->votes}}</h4>
                                        </div>
                                        <div class="row">
                                            {{HTML::linkRoute('vote','',array('down',$question->id),
                                            array('class'=>'dislike glyphicon glyphicon-chevron-down',
                                            'title'=>'Downvote'
                                            ))}}
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
                    </div>

            @endif

			</div>
		</div>
		<div class="col col-md-3">
			@include('template.col-right')
		</div>
	</div>
@stop

@section('footer_assets')
	<script>
		$('#browse-questions').jscroll({
            debug: true,
	        autoTrigger: false,
            loadingHtml: '<img src="{{asset('assets/images/loading.gif')}}" alt="Loading" width="10px" height="10px"/> Loading...',
	        nextSelector: '.pager li a',
            contentSelector: 'div#browse-questions',
            callback: function(){
                $('ul.pager:visible:first').hide();
            }
        });
	</script>
    @if (Sentry::check())
    {{ HTML::script('assets/js/handle_like.js') }}
    @endif
@stop