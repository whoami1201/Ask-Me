@extends('template_masterpage') 

@section('content')
<?php 

            //Question's asker and tags info 

$asker = $question->users; 

$tags = $question->tags;  

$created_at = $question->created_at;               

?> 
<div class="row">

    <div class="col-md-7 col-md-offset-2">
        <div class="well">

            <div class="row">
                <div class="col-md-12">

                    <strong><span class="title">{{$question->title}}</span></strong>
                    <p>
                        <em>Asked by <a href="#">{{$asker->first_name.' '.$question->users->last_name}}</a>
                          <span>on {{ $created_at->format('d M \'y') }} at {{ $created_at->format('H:i') }}</span></em>
                      </p>
                      <div>{{nl2br($question->question)}}</div>

                </div>
            </div>

              <hr>

            <div class="row mobile-fix">

                <div class="col-md-8 col-sm-5 margin-bottom-10">
                    <small>{{$question->viewed}} view{{$question->viewed>1?'s':''}}.</small>
                    <small>{{count($question->answers)}} answer{{$question->answers>1?'s':''}}</small>
                </div>

                @if(Sentry::check())

                <div class="col-md-4 col-sm-7 vote-section"> 
                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                        {{HTML::linkRoute('vote','I like this!',array('up',$question->id)  
                        ,array('class'=>'btn btn-primary like', 'title'=>'Upvote'))}}

                        <button type="button" class="btn btn-default vote-count">{{$question->votes}}</button>

                        {{HTML::linkRoute('vote','Meh',array('down',
                        $question->id),array('class'=>'btn btn-warning dislike','title'=>  
                        'Downvote'))}}
                    </div>
                </div>

                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('template.col-right')
    </div>
</div>

      {{-- if the user/admin is logged in, we will have a   

      buttons section --}} 

      @if(Sentry::check()) 

      <div class="qwrap"> 

          <ul class="fastbar"> 

            @if(Sentry::getUser()->hasAccess('admin')) 
            <li class="close">{{HTML::linkRoute(  

              'delete_question','delete',$question->id)}}  

          </li> 

          @endif 

          <li class="answer glyphicon glyphicon-comment"><a href="#">Answer</a></li>
          {{-- <li class="answer"><a href="#">answer</a></li> --}} 

      </ul> 

  </div> 

  @endif 

</div> 


{{-- if it's a user, we will also have the answer block   

inside our view--}} 

@if(Sentry::check()) 

<div class="rrepol" id="replyarea" style=  

"margin-bottom:10px"> 

{{Form::open(array('route'=>array(  

'question_reply',$question->id,  

Str::slug($question->title))))}} 

<p class="minihead">Provide your Answer:</p> 

{{Form::textarea('answer',Input::old('answer'),  

array('class'=>'fullinput'))}} 

{{Form::submit('Answer the Question!')}} 

{{Form::close()}} 

</div> 

@endif 



</div> 

@stop 
@section('footer_assets') 



{{--If it's a user, hide the answer area and make a   

simple show/hide button --}} 
@if(Sentry::check()) 

<script type="text/javascript"> 



    var $replyarea = $('div#replyarea'); 

    $replyarea.hide(); 



    $('li.answer a').click(function(e){ 

      e.preventDefault(); 



      if($replyarea.is(':hidden')) { 

        $replyarea.fadeIn('fast'); 

    } else { 

        $replyarea.fadeOut('fast'); 

    } 

}); 

</script> 

@endif 



{{-- If the admin is logged in, make a confirmation to   

  delete attempt --}} 

  @if(Sentry::check()) 

  @if(Sentry::getUser()->hasAccess('admin')) 

  <script type="text/javascript"> 

    $('li.close a').click(function(){ 

      return confirm('Are you sure you want to delete   

        this? There is no turning back!'); 

  }); 

</script> 

@endif 

@endif 

@stop 