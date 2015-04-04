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
            <div>
                <div>
                    <strong><span class="title">{{$question->title}}</span></strong>
                    <p ><em>Asked by <a href="#">{{$asker->first_name.' '.$question->
                    users->last_name}}</a>
                    <span> on {{ $created_at->format('d M \'y') }} at {{ $created_at->format('H:i') }}</span></em></p>
                    <div>{{$question->question}} </div>
                    <hr>
                    <div>Viewed {{$question->viewed}} time{{$question->viewed>1?'s':''}}.</div>
                    <div>{{count($question->answers)}} answers</div>
                    
                </div>
                @if(Sentry::check())
                  <div> 
                    {{HTML::linkRoute('vote','Upvote',array('up',$question->id)  
                    ,array('class'=>'like', 'title'=>'Upvote'))}} 
                    {{HTML::linkRoute('vote','Downvote',array('down',  
                    $question->id),array('class'=>'dislike','title'=>  
                    'Downvote'))}} 
                  </div> 
                @endif
            </div>
        </div>
    </div>
</div>

@if(Sentry::check()) 

    <div class="col-md-1 col-xs-1 col-lg-1"> 
      {{HTML::linkRoute('vote','',array('up',$question->id)  
      ,array('class'=>'', 'title'=>'Upvote'))}} 
      <br>
      {{HTML::linkRoute('vote','',array('down',  
      $question->id),array('class'=>'dislike glyphicon glyphicon-thumbs-down','title'=>  
      'Downvote'))}} 
    </div> 

@endif 



{{-- class will differ on the situation --}} 

@if($question->votes > 0) 

<div class="col-md-1 col-xs-1 col-lg-1 cntgreen"> 

  @elseif($question->votes == 0) 

  <div class="col-md-1 col-xs-1 col-lg-1"> 

      @else 

      <div class="col-md-1 col-xs-1 col-lg-1 cntred"> 
          @endif 

          <div class="cntcount">{{$question->votes}}</div> 

          <div class="cnttext">vote</div> 

      </div>
      <div class="rblock col-md-8 col-xs-8 col-lg-8"> 

        <div class="rbox"> 

          <p>{{($question->question)}}</p> 

      </div> 

      <div class="row">
          <div class="container">
            <div class="qinfo">Asked by <a href="#">  

              {{$question->users->first_name.' '.$question->  

              users->last_name}}</a> around {{date('m/d/Y   

              H:i:s',strtotime($question->created_at))}}</div>
          </div>
      </div> 



      {{--if the question has tags, show them --}} 

      @if($question->tags!=null) 

      <ul class="qtagul"> 

        @foreach($question->tags as $tag) 

        <li>{{HTML::linkRoute('tagged',$tag->tag,  

            $tag->tagFriendly)}}</li> 

            @endforeach 

        </ul> 

        @endif 
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