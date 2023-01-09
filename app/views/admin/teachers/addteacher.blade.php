@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content')
<!-- Workspace -->
    <main class="workspace">
        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="#">Menu</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>page</li>
            </ul>
        </section>
        {{ Form::open(['route'=>'teacherStore', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator']) }} 
        <div class="grid lg:grid-cols-4 gap-5">
            <!-- Content -->
            <div class="lg:col-span-2 xl:col-span-3">
                <div class="card p-5 mt-3">
                    <div class="flex flex-wrap flex-row -mx-4"> 
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="fname">Nom</label>
                            {{ Form::text('fname', '', ['id'=>'fname', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('fname'))
                                <span class="text-red-700">{{ $errors->first('fname') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="lname">Prénom(s) <small>option</small></label>
                            {{ Form::text('lname', '', ['id'=>'lname', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('lname'))
                                <span class="text-red-700">{{ $errors->first('lname') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="email">Email</label>
                            {{ Form::email('email', '', ['id'=>'email', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('email'))
                                <span class="text-red-700">{{ $errors->first('email') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="phone">Télephone</label>
                            {{ Form::text('phone', '', ['id'=>'phone', 'class'=>'form-control']) }}
                            <div class="help-block with-errors"></div>
                                @if($errors->first('phone'))
                                <span class="text-red-700">{{ $errors->first('phone') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="password">Mot de passe</label>
                            <label class="form-control-addon-within">
                            <input id="password" type="password" name="password" class="form-control border-none">
                            <span class="flex items-center ltr:pr-4 rtl:pl-4">
		                    <button type="button" class="la la-eye text-gray-300 dark:text-gray-700 text-xl leading-none" data-toggle="password-visibility"></button>
		                    </span>
                            </label>
                            <div class="help-block with-errors"></div>
                                @if($errors->first('password'))
                                <span class="text-red-700">{{ $errors->first('password') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="password_confirm">Confirmer mot de passe</label>
                            <label class="form-control-addon-within">
                                <input id="password" type="password" name="password_confirm" class="form-control border-none">
                                <span class="flex items-center ltr:pr-4 rtl:pl-4">
                                    <button type="button" class="la la-eye text-gray-300 dark:text-gray-700 text-xl leading-none" data-toggle="password-visibility"></button>
                                </span>
                            </label>
                            <div class="help-block with-errors"></div>
                                @if($errors->first('password_confirm'))
                                <span class="text-red-700">{{ $errors->first('password_confirm') }}</span>
                                @endif
                        </div>
                </div>
            </div>
            </div>
            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Tags -->
                <div class="card p-5 mt-3">
                        <div class="flex flex-col gap-y-2 mb-2">
                        <label class="label block mb-2" for="sexe">Sexe</label>   
                        <label class="custom-radio">
                            {{Form::radio('sexe', 1)}}
                            <span></span>
                            <span>Homme</span>
                        </label>
                        <label class="custom-radio">
                            {{Form::radio('sexe', 2)}}
                            <span></span>
                            <span>Femme</span>
                        </label>
                        <div class="help-block with-errors"></div>
                        @if($errors->first('sexe'))
                        <span class="text-red-700">{{ $errors->first('sexe') }}</span>
                        @endif
                    </div>
                    <hr class="border-dashed mb-4 mt-2">
                <!-- Publish -->
                <div class="flex flex-col gap-y-5">
                    <div class="flex flex-wrap gap-2">
                        <button class="btn btn_primary uppercase"><span class="la la-plus"></span> Ajouter</button>
                    </div>
                </div>
               </div> 
            </div>
        </div>
    {{ Form::close() }}
@include('components.pages.footer')
        @section('js')
        <script type="text/javascript">
        function goToNext(c) {
        if(c.value != '') {
            window.location = '{{ URL::current() }}/'+c.value;
        }
        }
        </script>
        @endsection
</main>
@stop