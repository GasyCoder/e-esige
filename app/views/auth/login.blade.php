@extends('layouts.default')
@section('title') Se connecter @stop
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
        <div class="w-full md:w-1/2 xl:w-1/3">
                    <div class="flex items-center justify-center gap-x-4 mt-4">
                        <div class="avatar w-20 h-20">
                            <img src="">
                        </div>
                    </div>
            @include('components.alerts')        
            {{ Form::open(['route'=>'auth.check', 'id'=>'', 'class'=>'card mt-5 p-5 md:p-10']) }}
                <div class="mb-5">
                    <label class="label block mb-2" for="email">Email</label>
                    <input id="email" type="text" name="email" class="form-control" placeholder="Saisir adresse e-mail">
                    <div class="help-block with-errors"></div>
                    @if($errors->first('email'))
                    <span class="text-red-700">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="password">Mot de passe</label>
                    <label class="form-control-addon-within">
                        <input id="password" type="password" name="password" class="form-control border-none" placeholder="Saisir mot de passe">
                        <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button"
                                class="text-gray-300 dark:text-gray-700 la la-eye text-xl leading-none"
                                data-toggle="password-visibility"></button>
                        </span>
                    </label>
                    <div class="help-block with-errors"></div>
                    @if($errors->first('password'))
                    <span class="text-red-700">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="flex items-center">
                    <a href="{{URL::route('remind_users_reset')}}" class="text-sm">Mot de passe oublié?</a>
                     <button type="submit" class="btn btn_primary uppercase ltr:ml-auto rtl:mr-auto"><span class="la la-lock"></span> Se connecter</button>
                </div>
            {{Form::close()}}
        </div>
    </div>
@stop