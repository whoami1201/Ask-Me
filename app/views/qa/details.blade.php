@extends('template_masterpage') 

@section('content')
<?php 

            //Question's asker and tags info 

$asker = $question->users; 

$tags = $question->tags;  

$created_at = $question->created_at;               

?> 
<div class="row">
    <!--================================LEFT COLUMN==================================-->
    <div class="col-md-2">
        @include('template.col-left')
    </div>

    <!--=================================MAIN COLUMN==================================-->
    <div class="col-md-7">
        <div class="well">

            <div class="row">
                <div class="col-md-12">
                    <!-- Question's title -->
                    <strong><span class="title">{{$question->title}}</span></strong>

                    <!-- Asked by ... -->
                    <p>
                        <em>Asked by <a href="#">{{$asker->first_name.' '.$question->users->last_name}}</a>
                        <span>on {{ $created_at->format('d M \'y') }} at {{ $created_at->format('H:i') }}</span></em>
                    </p>

                    <!-- Question's content -->
                    <div>{{nl2br($question->question)}}</div>

                    <!-- Tags -->
                    {{--if the question has tags, show them --}}
                    @if($question->tags!=null) 

                      <div>
                        <span class="text-muted">Tags:</span> 
                        @foreach($question->tags as $tag) 

                          <span>{{HTML::linkRoute('tagged',$tag->tag,$tag->tagFriendly)}}</span> 

                        @endforeach 
                      </div> 

                    @endif
                </div>
            </div>

              <hr>

            <div class="row mobile-fix">

                <!-- View and answer count -->
                <div class="col-md-5 col-sm-5 margin-top-5 text-muted">
                    <span>{{$question->viewed}} view{{$question->viewed>1?'s':''}}.</span>
                    <span>{{count($question->answers)}} answer{{$question->answers>1?'s':''}}</span>
                </div>

                <!-- Upvote and downvote function for users -->
                @if(Sentry::check())

                    <div class="col-md-7 col-sm-7 vote-section"> 

                            <a href="#" class="text-muted margin-side-10" id="comment">Comment</a>
                            <a href="#" class="text-muted margin-side-10">Share</a>

                            {{HTML::linkRoute('vote','Downvote',array('down',$question->id),array(
                                'class'=>'text-muted margin-side-10 dislike',
                                'title'=> 'Downvote'
                                ))}}

                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            
                                {{HTML::linkRoute('vote','I like this!',array('up',$question->id)  
                                ,array('class'=>'btn btn-primary like', 'title'=>'Upvote'))}}


                                <button type="button" class="btn btn-default vote-count">{{$question->votes}}</button>

                            </div>
                        
                    </div>

                <!-- Sign in link for guest -->
                @else 

                    <div class="col-md-4 col-sm-7 col-md-offset-3 margin-top-5"> 
                        {{HTML::link('signup','Log in to answer')}}
                    </div>

                @endif
            </div>

            <!-- Answer block -->
            {{-- if it's a user, we will also have the answer block inside our view--}} 
            @if(Sentry::check()) 
                <div class="row margin-top-10">
                    <div class="rrepol col-md-12" id="replyarea"> 

                        {{Form::open(array('route'=>array(  
                            'question_reply',
                            $question->id,
                            Str::slug($question->title)
                            )))}} 

                        @if(Sentry::getUser()->hasAccess('admin')) 

                            <li class="close">{{HTML::linkRoute('delete_question','delete',$question->id)}}</li> 

                        @endif

                        <div class="form-group">
                            {{Form::textarea('answer',Input::old('answer'),array(
                                'class'=>'fullinput form-control',
                                'placeholder'=>'Type your comment here..',
                                'rows'=>'4'
                                ))}} 
                        </div>
                        {{Form::button('Comment', array('class'=>'btn btn-success', 'type'=>'submit'))}}
                        {{Form::close()}} 

                    </div>
                </div> 

            @endif 
        </div>
    </div>

    <!--============================RIGHT COLUMN======================================-->
    <div class="col-md-3">
        @include('template.col-right')
    </div>

</div>


@stop 


@section('footer_assets') 

{{--If it's a user, hide the answer area and make a simple show/hide button --}} 
@if(Sentry::check()) 

    <script type="text/javascript"> 
        
        var $replyarea = $('div#replyarea'); 
        $replyarea.hide(); 

        $('#comment').click(function(e){ 
            e.preventDefault(); 

            if($replyarea.is(':hidden')) { 
                $replyarea.fadeIn('fast'); 
            } else { 
                $replyarea.fadeOut('fast'); 
            } 
        }); 

    </script> 

    {{-- If the admin is logged in, make a confirmation to delete attempt --}} 
    @if(Sentry::getUser()->hasAccess('admin')) 

        <script type="text/javascript"> 
            $('li.close a').click(function(){ 
          
                return confirm('Are you sure you want to delete this? There is no turning back!'); 

            }); 
        </script> 

    @endif

@endif 

@stop 