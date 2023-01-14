@extends('layouts.default')
<?php $control = Control::find(1); ?>
@section('title') Changer mot de passe @stop
@section('content')
    <!-- Top Bar -->
    <section class="top-bar">
        <!-- Brand -->
        <span class="text-xl">e-<span class="brand">ESIGE</span></span>
        <nav class="flex items-center ltr:ml-auto rtl:mr-auto">
            <!-- Dark Mode -->
            <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Basculer en mode sombre">
                <input id="darkModeToggler" type="checkbox">
                <span></span>
            </label>
            <!-- Fullscreen -->
            <button id="fullScreenToggler"
                class="hidden lg:inline-block ltr:ml-5 rtl:mr-5 text-2xl leading-none la la-expand-arrows-alt"
                data-toggle="tooltip" data-tippy-content="Plein écran"></button>
        </nav>
    </section>
    <div class="container flex items-center justify-center mt-5 py-10"> 
    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
             <div class="flex items-center justify-center gap-x-4 mt-4">
                        <div class="avatar w-20 h-20">
                           <img src="{{ url() }}/public/uploads/logo/{{$control->logo}}">
                        </div>
                    </div>
                <div class="alert alert_info mt-2">
                    <strong class="uppercase"><bdi>Info!</bdi></strong>
                    Veuillez modifier votre mot de passe.
                    <button class="dismiss la la-times" data-dismiss="alert"></button>
                </div>      
             {{ Form::open(['route' => ['remind_password_update', $token], 'class'=>'card mt-5 p-5 md:p-10'])  }}  
                <div class="mb-5">
                    <label class="label block mb-2" for="email">Adresse e-mail</label>
                    <input id="email" type="email" name="email" value="{{$email->email}}" class="form-control" readonly>
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="password">Nouveau mot de passe</label>
                    <label class="form-control-addon-within">
                        <input id="password" type="password" name="password" class="form-control border-none" required>
                        <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button" class="la la-eye text-gray-300 dark:text-gray-700 text-xl leading-none" data-toggle="password-visibility">
                            </button>
                        </span>
                    </label>
                    <div class="help-block with-errors"></div>
                    @if($errors->first('password'))
                      <p class="p-alert">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="password">Confirmer le mot de passe</label>
                    <label class="form-control-addon-within">
                        <input id="password" type="password" name="password_confirmation" class="form-control border-none" required>
                        <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button" class="la la-eye text-gray-300 dark:text-gray-700 text-xl leading-none" data-toggle="password-visibility">
                            </button>
                        </span>
                    </label>
                    <div class="help-block with-errors"></div>
                     @if($errors->first('password_confirmation'))
                      <p class="p-alert">{{ $errors->first('password_confirmation') }}</p>
                      @endif
                </div>
                <input type="hidden" name="token" value="{{$token}}">
                <div class="flex">
                    <button class="btn btn_primary ltr:ml-auto rtl:mr-auto uppercase">Réinitialiser le mot de passe</button>
                </div>
            {{Form::close()}}
        </div>
    </div>
@stop