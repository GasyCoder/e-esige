@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title. ' - ' .$profile->fname. ' '.$profile->lname}} @stop
@section('content')
<style type="text/css">
.profile_cover {
  background-image: url('{{url()}}/uploads/profiles/students/{{$user->cover_picture}}');
  background-repeat: no-repeat;
  background-size: cover;
  background-color: rgba(255, 255, 255, 0.5);
  opacity: 0.5;
}
.picture_profile img{
  opacity: 1;
}
</style>
<!-- Workspace -->
    <main class="workspace">
        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="{{URL::route('panel.student')}}">Menu</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Profil</li>
            </ul>
        </section>
         @include('components.alerts') 
        <div class="grid lg:grid-cols-4 gap-5">
        <div class="lg:col-span-2 xl:col-span-1 mt-3"> 
                <div class="border">              
                    @if(!empty($user->photo)) 
                    <div class="flex items-center justify-center gap-x-0 cover_pic 
                    profile_cover"> 
                    </div>
                    @endif
                    <div class="flex items-center justify-center gap-x-0">
                       @if(!empty($user->photo))
                        <div class="avatar avatar_with-shadow w-20 h-20">
                            <div class="status bg-success"></div>
                            <img src="{{url()}}/uploads/profiles/students/{{$user->photo}}" class="picture_profile">
                        </div>
                        @else 
                        <div class="flex items-center gap-x-4">
                                <?php 
                                  $fname = substr($profile->fname,0,1);
                                  $lname = substr($profile->lname,0,1);
                                ?>
                                <div class="avatar avatar_with-shadow bg-primary font-bold w-20 h-20 text-4xl">{{ ($fname.''.$lname) }}
                                    <div class="status bg-success"></div>
                                </div>
                        </div>
                        @endif
                    </div>
                    </div>         
                    <div class="info_pic p-5">
                    <div class="mt-0 leading-normal">
                        <a href="#no-link" class="flex items-center text-normal">
                            <span class="la la-user text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                            {{$profile->fname. ' '.$profile->lname}}
                        </a>
                        <a href="#no-link" class="flex items-center text-normal">
                            <span class="la la-genderless text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                           Sexe :  @if($profile->sexe == 1) Homme @else Femme @endif
                        </a>
                        <hr class="my-2">
                         <a href="#no-link" class="flex items-center text-normal">
                            <span class="la la-qrcode text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                            N° matricule : {{$profile->matricule}}
                        </a>
                        <a href="#no-link" class="flex items-center text-normal">
                            <span class="la la-user-graduate text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                            Niveau : {{$profile->class->note}}
                        </a>
                        <a href="#no-link" class="flex items-center text-normal">
                            <span class="la la-list text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                            Parcour : {{$profile->parcour->abr}}
                        </a>
                        <a href="#no-link" class="flex items-center text-normal">
                            <span class="la la-graduation-cap text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                            Vague : {{$profile->vague->abr}}
                        </a>
                        <hr class="my-2">
                            <a href="#no-link" class="flex items-center text-normal">
                                <span class="la la-globe-africa text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                                Pays : {{$user->country}}
                            </a>
                            <a href="#no-link" class="flex items-center text-normal">
                                <span class="la la-city text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                                Ville : {{$user->city}}
                            </a>
                            <hr>
                            <a href="#no-link" class="flex items-center text-normal">
                                <span class="la la-envelope text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                                Email : {{$user->email}}
                            </a>
                            <a href="#no-link" class="flex items-center text-normal">
                                <span class="la la-phone text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                                Tél : {{$user->phone}}
                            </a>
                            @if($user->fb !== NULL)
                            <a href="https://web.facebook.com/{{$user->fb}}" target="_blank" class="flex items-center text-normal">
                                <span class="la la-facebook text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                                {{$user->fb}}
                            </a>
                            @endif
                    </div>  
                </div>
            </div>
            <!-- Info students -->
            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-3">
          {{ Form::open(['route'=>['update_profile', $profile->token], 'files'=>'true', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
            <div class="flex flex-col gap-y-5 grid lg:grid-cols-4 gap-5">
            <div class="lg:col-span-2 xl:col-span-3">
                <div class="card p-5 mt-3">
                    <div class="flex flex-wrap flex-row -mx-4"> 
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="fname">Nom</label>
                            {{ Form::text('fname', $profile->fname, ['id'=>'fname', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('fname'))
                                <span class="text-red-700">{{ $errors->first('fname') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="lname">Prénom(s) <small>option</small></label>
                            {{ Form::text('lname', $profile->lname, ['id'=>'lname', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('lname'))
                                <span class="text-red-700">{{ $errors->first('lname') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="fb">Facebook</label>
                            {{ Form::text('fb', $user->fb, ['id'=>'fb', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('fb'))
                                <span class="text-red-700">{{ $errors->first('fb') }}</span>
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
                        <div class="flex flex-wrap gap-2 mt-2">
                        <button class="btn btn_success"><span class="la la-sync text-xl leading-none"></span> Mettre à jour</button>
                    </div>
                    </div>
                </div>
                 @include('student.ajax.jsUp')
                </div>
                {{ Form::close() }}
                {{ Form::open(['route'=>['photoStudent', $profile->token], 'files'=>'true', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
                <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <div class="card p-5 mt-3">
                       @if(empty($user->photo)) 
                        <label class="label block mb-2" for="photo">Choisir votre photo de profil</label>
                        <label class="input-group font-normal">
                            <input type="file" name="photo" class="form-control">
                        </label>
                        <small class="block mt-2 text-red-700">Vous n'avez pas une photo de profil.</small>
                        @endif
                        <hr class="border-dashed mb-4 mt-2">
                        <!-- Publish -->
                        <div class="flex flex-col gap-y-5">
                            <div class="flex flex-wrap gap-2">
                            @if(empty($user->photo))   
                                <button class="btn btn_success"><span class="la la-plus"></span> Ajouter</button>
                            @else
                                <a onclick="return confirm('Vous voulez supprimer?')" href="{{ URL::route('delete_photo', $profile->token)}}" class="badge badge_danger"><span class="la la-trash text-sm"></span>Supprimer votre photo de profil</a>
                            @endif    
                            </div>
                        </div>
                   </div> 
                </div>
               {{ Form::close() }}  
            </div>
            <div class="grid lg:grid-cols-4 gap-5">
            <div class="lg:col-span-1 xl:col-span-3">
            <div class="card p-5">
            {{ Form::open(['route'=>['student_update_password', $profile->token], 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
                    
                    <div class="mb-5 xl:w-1/1">
                        <label class="label block mb-2" for="password">{{ Lang::get($path.'.old_password') }}</label>
                        <label class="form-control-addon-within">
                            <input id="password" type="password" name="old_password" class="form-control border-none">
                            <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button" class="la la-eye text-gray-300 dark:text-gray-700 text-xl leading-none" data-toggle="password-visibility"></button>
                            </span>
                        </label>
                        <div class="help-block with-errors"></div>
                        @if($errors->first('password'))
                        <span class="text-red-700">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="mb-5 xl:w-1/1">
                        <label class="label block mb-2" for="password">Nouveau mot de passe</label>
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
                    <div class="mb-5 xl:w-1/1">
                        <label class="label block mb-2" for="password_confirm">Confirmer nouveau mot de passe</label>
                        <label class="form-control-addon-within">
                            <input id="password_confirm" type="password" name="password_confirm" class="form-control border-none">
                            <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button" class="la la-eye text-gray-300 dark:text-gray-700 text-xl leading-none" data-toggle="password-visibility"></button>
                            </span>
                        </label>
                        <div class="help-block with-errors"></div>
                            @if($errors->first('password_confirm'))
                            <span class="text-red-700">{{ $errors->first('password_confirm') }}</span>
                            @endif
                    </div>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <button class="btn btn_success"><span class="la la-sync text-xl leading-none"></span> Mettre à jour</button>
                    </div>
            {{ Form::close() }}    
                </div>
            </div>
        </div>
        </div>
        </div>
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