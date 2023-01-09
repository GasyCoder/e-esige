@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title. ' ' .$student->fname. ' '.$student->lname}} @stop
@section('content')
<!-- Workspace -->
    <main class="workspace">
        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="#">Menu</a></li>
                <li class="divider la la-arrow-right"></li>
                <li><a href="{{URL::route('student_liste')}}">Etudiants</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Modifier</li>
            </ul>
        </section>

        {{ Form::open(['route'=>['updateStudent', $student->token], 'files'=>'true', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
        <div class="grid lg:grid-cols-4 gap-5">
            <!-- Content -->
            <div class="lg:col-span-2 xl:col-span-3">
                <div class="card p-5 mt-3">
                    <div class="flex flex-wrap flex-row -mx-4"> 
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="fname">Nom</label>
                            {{ Form::text('fname', $student->fname, ['id'=>'fname', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('fname'))
                                <span class="text-red-700">{{ $errors->first('fname') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="lname">Prénom(s) <small>option</small></label>
                            {{ Form::text('lname', $student->lname, ['id'=>'lname', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('lname'))
                                <span class="text-red-700">{{ $errors->first('lname') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="email">Email</label>
                            {{ Form::email('email', $user->email, ['id'=>'email', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('email'))
                                <span class="text-red-700">{{ $errors->first('email') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="phone">Télephone</label>
                            {{ Form::text('phone', $user->phone, ['id'=>'phone', 'class'=>'form-control']) }}
                            <div class="help-block with-errors"></div>
                                @if($errors->first('phone'))
                                <span class="text-red-700">{{ $errors->first('phone') }}</span>
                                @endif
                        </div>

                </div>
            </div>
            </div>
            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Tags -->
                <div class="card p-5 mt-0">
                   <label class="label block mb-2" for="sexe">N° Matricule</label>
                        <label class="form-control-addon-within flex-row-reverse">
                        {{ Form::text('matricule', $student->matricule, ['id'=>'matricule', 'class'=>'form-control ltr:pl-2 rtl:pr-2 border-none w-full', 'placeholder'=>'Saisir ici le numéro matricule']) }}      
                        </label>
                        <small class="block mt-2">Le numéro matricule a été ajouté à la base de la scolarité.</small>
                        <div class="help-block with-errors"></div>
                        @if($errors->first('matricule'))
                        <span class="text-red-700">{{ $errors->first('matricule') }}</span>
                        @endif
                        <hr class="border-dashed mb-4 mt-2">
                        <div class="flex flex-col gap-y-2 mb-2">
                        <label class="label block mb-2" for="sexe">Sexe</label>   
                        
                        <label class="custom-radio">
                        @if($user->sexe == 1) 
                            {{Form::radio('sexe', 1, ['checked'=>'checked'])}}
                            <span></span>
                            <span>Homme</span>
                        @else
                        {{Form::radio('sexe', 1)}}
                            <span></span>
                            <span>Homme</span>
                        @endif    
                        </label>

                        <label class="custom-radio">
                        @if($user->sexe == 2) 
                            {{Form::radio('sexe', 2, ['checked'=>'checked'])}}
                            <span></span>
                            <span>Femme</span>
                        @else
                        {{Form::radio('sexe', 2)}}
                            <span></span>
                            <span>Femme</span>
                        @endif   
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
                        <button class="btn btn_success uppercase"><span class="la la-sync"></span> Mettre à jour</button>
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