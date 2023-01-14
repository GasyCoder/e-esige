@extends('layouts.master')
<?php 
$path = Session::get('language'); 
$control = Control::find(1); 
@include('components.timeAgo') 
?>
@if(Auth::user()->is_admin)
  @section('title') Administrateur @stop
@endif
@if(Auth::user()->is_student)
  @section('title') Page d'accueil - Etudiant @stop
@endif
@if(Auth::user()->is_teacher)
  @section('title') Enseignant @stop
@endif  
@if(Auth::user()->is_secretaire)
  @section('title')  Sécretaire @stop
@endif
@section('content')

<!--- MAIN ADMIN -->
@if(Auth::user()->is_admin)
@if(!Auth::user()->is_secretaire)
<main class="workspace">
        <section class="breadcrumb">
            <h1>Tableau de bord</h1>
            <ul>
                <li><a href="#no-link">Accueil</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Tableau de bord</li>
            </ul>
        </section>
        <div class="grid lg:grid-cols-2 gap-5">
        @include('admin.dashboard.count')
        @include('admin.dashboard.annonce')
        @include('admin.dashboard.log')
        </div>
        @include('components.pages.footer')    
    </main>
@endif
@endif
<!--END ADMIN -->

<!-- MAIN STUDENT -->
@if(Auth::user()->is_student)
    <main class="workspace">
        <section class="breadcrumb">
            <h1>Espace d'étudiant</h1>
            <ul>
                <li><a href="#no-link">Accueil</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Menu</li>
            </ul>
        </section>
        
        <div class="grid lg:grid-cols-1 gap-5">
            @if(Auth::user()->is_student == 0)
            <div class="alert alert_danger">
                    <strong class="uppercase"><bdi>Danger!</bdi></strong>
                    This is an alert message.
                    <button class="dismiss la la-times" data-dismiss="alert"></button>
            </div>
            @endif
            @include('student.index')
        </div>

        @include('components.pages.footer')         

        @section('js')
        <script src="{{url()}}/public/assets/js/Sortable.min.js"></script>
        @endsection
            </main>
        @endif
         <!--END STUDENT -->
        @stop