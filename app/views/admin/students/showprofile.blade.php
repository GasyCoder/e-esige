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
                <li><a href="{{URL::route('student_admin')}}">Menu</a></li>
                <li class="divider la la-arrow-right"></li>
                <li><a href="{{URL::route('student_liste')}}">Etudiants</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Profil</li>
            </ul>
        </section>
        <div class="grid lg:grid-cols-4 gap-5">
            <!-- Categories -->
            <div class="lg:col-span-2 xl:col-span-1">
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
                                <div class="avatar avatar_with-shadow w-20 h-20 text-4xl">{{ ($fname.''.$lname) }}
                                    <div class="status bg-success"></div>
                                </div>
                        </div>
                        @endif
                    </div>
                </div>  
                <div class="info_pic p-5">
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
                    <hr class="border-dashed">
                    <div class="flex justify-center items-center mt-3">
                        <a href="{{URL::route('editStudent', $profile->token)}}" class="btn btn_success"><span class="la la-pen-fancy text-xl leading-none"></span> Modifier</a>
                    </div>
                </div>
            </div>
            <!-- Payment -->
            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-3">
                @include('components.alerts')
              @if(count($payers)> 0)  
                <div class="card p-5">
                    <h3>Etat de paiement</h3>
                   <table class="table table_bordered w-full mt-3">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right uppercase">Année</th>
                                <th class="text-center uppercase">Mois</th>
                                <th class="ltr:text-left rtl:text-right uppercase">Objet</th>
                                <th class="ltr:text-left rtl:text-right uppercase">Date/Heur</th>
                                <th class="text-center uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($payers as $payer)      
                            <tr>
                                <td>{{$year->yearsUniv}}</td>
                                <td class="text-center font-bold">{{$payer->nbremois}}</td>
                                <td>{{$payer->motif}}</td>
                                <td class="">{{$payer->created_at->format('d/m/y à H:i:s')}}</td>
                                <td class="text-center">
                                  @if($payer->status == 1)
                                  <button class="badge badge_outlined badge_success">Payé</button>
                                  @else
                                  <button class="badge badge_outlined badge_danger">En attente</button>
                                  @endif
                                </td>
                            </tr>
                         @endforeach   
                        </tbody>
                    </table>
                </div>
                @else
                @endif
                @if(count($cours)> 0)
                <!-- Activation Cours -->
                <div class="card p-5">
                <h3>Gérer les cours</h3>
                <table class="table table_bordered w-full mt-3">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right uppercase">Matières</th>
                                <th class="text-center uppercase">Fichier</th>
                                <th class="text-center uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($cours as $cour)    
                            <tr>
                                <td>{{$cour->matiere->name}}</td>
                                <td class="text-center">
                                   <a href="{{ url() }}/uploads/support_files/{{$cour->support->file}}" target="_blank" class="text-red-700"><i><span class="la la-paperclip "></span> document format pdf</i></a> 
                                </td>
                                <td class="text-center">
                                 @if($cour->status == 1) 
                                  <a href="#" class="badge badge_success">Actif</a>
                                 @else
                                 <a href="#" class="badge badge_danger">Inactif</a>
                                 @endif
                                </td>
                            </tr>
                         @endforeach   
                        </tbody>
                    </table>
                </div>
                @else
                @endif
            <div class="grid lg:grid-cols-4 gap-5">
            <!-- Content -->
            <div class="lg:col-span-1 xl:col-span-3">
                <div class="card p-5">

            {{ Form::open(['route'=>['update_std_auth', $profile->token], 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
                    
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
                        <button class="btn btn_info"><span class="la la-ban text-xl leading-none"></span> Bloquer</button>
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