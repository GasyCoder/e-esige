@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title. ' - ' .$profile->fname. ' '.$profile->lname}} @stop
@section('content')
<!-- Workspace -->
    <main class="workspace">
        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="{{URL::route('student_admin')}}">Menu</a></li>
                <li class="divider la la-arrow-right"></li>
                <li><a href="{{URL::route('teacher_admin')}}">Enseignants</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Profil</li>
            </ul>
        </section>
        <div class="grid lg:grid-cols-4 gap-5">
            <!-- Categories -->
            <div class="lg:col-span-2 xl:col-span-1">
                     <div class="flex items-center justify-center gap-x-4 mt-4 dropzone">
                        <div class="">
                            @if(!empty($user->photo))
                            <?php echo HTML::image('uploads/profiles/teacher/'.$user->photo.'', '', ['class'=>'avatar w-20 h-20', 'width'=>'180','height'=>'80']) 
                            ?>
                            @else 
                             <div class="flex items-center gap-x-4 mt-4">
                                <?php 
                                  $fname = substr($profile->fname,0,1);
                                  $lname = substr($profile->lname,0,1);
                                ?>
                                <div class="avatar avatar_with-shadow w-20 h-20 text-4xl">{{ ($fname.''.$lname) }}
                                    <div class="status bg-success"></div>
                                </div>
                             </div>
                            @endif
                        </div>
                    </div>
                <div class="card p-5 mt-3">
                    <h3>Informations</h3>
                    <div class="mt-5 leading-normal">
                        <a href="#no-link" class="flex items-center text-normal">
                            <span class="la la-user text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                            {{$profile->fname. ' '.$profile->lname}}
                        </a>
                        <a href="#no-link" class="flex items-center text-normal">
                            <span class="la la-genderless text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                           Sexe :  @if($profile->sexe == 1) Homme @else Femme @endif
                        </a>
                        <a href="#no-link" class="flex items-center text-normal">
                                <span class="la la-envelope text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                                Email : {{$user->email}}
                            </a>
                            <a href="#no-link" class="flex items-center text-normal">
                                <span class="la la-phone text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                                Tél : {{$profile->phone}}
                            </a>
                            @if($user->fb !== NULL)
                            <a href="https://web.facebook.com/{{$user->fb}}" target="_blank" class="flex items-center text-normal">
                                <span class="la la-facebook text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                                {{$user->fb}}
                        </a>
                            @endif
                    </div>  
                    <hr class="border-dashed">
                    <div class="flex justify-center items-center mt-3">
                        <a href="{{URL::route('editTeacher', $profile->token)}}" class="btn btn_success"><span class="la la-pen-fancy text-xl leading-none"></span> Modifier</a>
                    </div>
                </div>
            </div>

            <!-- FAQs -->
            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-3">
                @include('components.alerts')
                <div class="card p-5">
                    <h3>Infos pédagogie</h3>
                   <table class="table table_bordered w-full">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right uppercase">#</th>
                                <th class="ltr:text-left rtl:text-right uppercase">Matière</th>
                                <th class="ltr:text-left rtl:text-right uppercase">Niveau</th>
                                <th class="ltr:text-left rtl:text-right uppercase">Parcour</th>
                                <th class="ltr:text-left rtl:text-right uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John</td>
                                <td>Doe</td>
                                <td>@john</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

        <div class="grid lg:grid-cols-4 gap-5">
            <!-- Content -->
            <div class="lg:col-span-1 xl:col-span-3">
                <div class="card p-5">

            {{ Form::open(['route'=>['up_teacherAuth', $profile->token], 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
                    
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
            <div class="flex flex-col gap-y-2 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="border p-5 flex justify-center item-center gap-y-2">
                    <div class="flex flex-wrap gap-2 mt-2">
                        <button class="btn btn btn_danger"><span class="la la-trash text-xl leading-none"></span> Supprimer</button>
                    </div>
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