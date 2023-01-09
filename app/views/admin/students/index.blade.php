@extends('layouts.master')
<?php $path = Session::get('language'); ?>

@section('title') Gestion des étudiants @stop

@section('content')
    <main class="workspace">
        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div class="p-4">
@include('components.break')
            </div>
        </section>
       <div class="p-4">
            <div class="overflow-x-auto">
                <div class="grid sm:grid-cols-2 xl:grid-cols-2 gap-5">
                 <a href="{{URL::route('selectNiveau')}}">    
                        <div class="card card_hoverable card_list text-primary">
                            <div class="image image_icon">
                                <span class="la la-user-plus la-4x"></span>
                            </div>
                            <div class="body">
                                <h5>Ajouter étudiant</h5>
                                <p>Créer un compte</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{URL::route('student_liste')}}">    
                        <div class="card card_hoverable card_list text-primary">
                            <div class="image image_icon">
                                <span class="la la-list-alt la-4x"></span>
                            </div>
                            <div class="body">
                                <h5>Liste des étudiants</h5>
                                <p>Voir liste</p>
                            </div>
                        </div>
                    </a>
               </div>
            </div>
        </div>
    
@include('components.pages.footer')
</main>
    <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>
        <!-- Status -->
        <h3 class="p-5">Les étudiants</h3>
        <hr>
        <div class="flex flex-col gap-y-5 p-5">  
        <a href="" class="flex items-center text-normal">
          <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
             Total
          <span class="badge badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto"> 
             {{$students}}
          </span>
        </a>
        <a href="" class="flex items-center text-normal">
          <span class="la la-flag text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
           Année Universitaire
          <span class="badge badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto"> 
             {{$years->yearsUniv}}
          </span>
        </a>
        </div>
    </aside>
@stop