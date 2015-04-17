@extends('template_masterpage') 

@section('content') 

<div class="cover-wrapper text-center">
      <div class="inner">
            <h1>Hello.</h1>
            <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua.
            </p>

            {{HTML::link('ask','Ask something', array('class'=>'btn btn-default margin-top-10'))}}
      </div>
</div>

@stop 