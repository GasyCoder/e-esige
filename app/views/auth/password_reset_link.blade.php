@extends('layouts.login_master')

<?php $path = Session::get('language'); ?>


@section('title') {{ Lang::get($path.'.lost_password') }} @stop

@section('content')



<div class="articles" style="margin-top: 50px;">

  <div class="single">

     <div class="panel panel-default">
        <div class="panel-body">
            <h3>{{ Lang::get($path.'.lost_password') }}</h3>
            <div class="clear"></div>
        </div>
      </div>

      <div class="panel panel-default bord">
        <div class="panel-body">

          <div class="col-md-10 col-md-offset-1">


@if(Session::has('error'))
<div class="alert alert-danger center alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{ Session::get('error') }}</strong>
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-success center alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif  

<div class="clear"></div>

            {{ Form::open(['route' => ['remind_password_update', $token], 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

            
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.email') }}  : </label>
                 <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                {{ Form::text('email', $email->email, ['placeholder'=>'', 'class'=>'form-control input-lg']) }} 
                </div>
              </div>



              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.password') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input name="password" type="password" name="password" data-minlength="6" class="form-control input-lg" id="inputPassword" placeholder="" required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('password'))
                  <p class="p-alert">{{ $errors->first('password') }}</p>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.password_confirmation') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input name="password_confirmation" type="password" class="form-control input-lg" data-match="#inputPassword" data-match-error="Votre champ n'est pas identique" placeholder="" required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('password_confirmation'))
                  <p class="p-alert">{{ $errors->first('password_confirmation') }}</p>
                  @endif
              </div>


               {{ Form::hidden('token', $token) }}
              


              {{ Form::submit(Lang::get($path.'.reset'), ['class'=>'btn btn-info btn-block input-lg']) }} 


              {{ Form::close() }}
              
          </div><br>    

          
        </div>
      </div>

  </div>  

</div>

@stop