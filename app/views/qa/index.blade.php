@extends('template_masterpage') 

@section('content') 

<div class="cover-wrapper text-center">
      <div class="inner">
            <h1>Hello.</h1>
            <p>
            	“What’s in the box?”
            </p>
            <p>
            	Come join our community of asking and answering now!
            </p>


            {{HTML::link('ask','Ask something', array('class'=>'btn btn-default margin-top-10'))}}
      </div>
</div>

@stop 