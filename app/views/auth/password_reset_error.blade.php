@extends('layouts.default')
<?php $path = Session::get('language'); ?>
@section('title') {{ Lang::get($path.'.reset_code_error') }} @stop
@section('content')
    <!-- Top Bar -->
    <section class="top-bar">
        <!-- Brand -->
    <span class="text-xl">e-<span class="brand">ESIGE</span></span>
    </section>
    <div class="container flex items-center justify-center mt-0 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10 text-center uppercase">
                <h2 class="text-primary mt-5">{{ Lang::get($path.'.reset_code_error') }}</h2>
                <h5 class="mt-2">Veuillez réunitialiser encore.</h5>
                <a href="{{URL::route('remind_users_reset')}}" class="btn btn_primary mt-5 ltr:ml-2 rtl:mr-2">Rétenter</a>
            </div>
        </div>
    </div>
@stop