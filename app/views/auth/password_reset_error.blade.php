@extends('layouts.login_master')

<?php $path = Session::get('language'); ?>


@section('title') {{ Lang::get($path.'.reset_code_error') }} @stop

@section('content')



<div class="articles" style="margin-top: 50px;">

  <div class="single">

      <div class="panel panel-default bord">
        <div class="panel-body">


      <br>
      <div class="alert alert-danger center">
      <h3>{{ Lang::get($path.'.reset_code_error') }}</h3>
      </div>


          
        </div>
      </div>

  </div>  

</div>

@stop