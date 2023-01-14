@extends('layouts.master')
<?php 
$path = Session::get('language'); 
$control = Control::find(1);
?>
@section('title') {{$title}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="{{URL::route('listes_stud')}}">Liste des paiement</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Details</li>
            </ul>
        </section>
<!-- Layout -->
<div class="container flex items-center justify-center mb-2 py-1">
<div class="card p-5 flex flex-col gap-y-2 w-full md:w-1/2 xl:w-1/4">
@include('components.alerts')
                    <div class="flex flex-wrap flex-row -mx-4 collapse open">
                        <div class="flex gap-2 p-5">
                            <button class="badge badge_outlined badge_success">{{$detail->type}}</button>
                            <button class="divider la la-arrow-right"></button>
                            <button class="badge badge_outlined badge_primary">{{$detail->motif}}</button>
                            <button class="divider la la-arrow-right"></button>
                            <button class="badge badge_outlined badge_danger">pour {{$detail->nbremois}} mois</button>
                        </div>
                        <div class="w-full">
                           <div class="mb-2 flex-shrink px-4 w-full">
                            <label class="label block">Réference de paiement</label>
                                <input class="form-control" value="{{$detail->payment_index}}" disabled>
                            </div>
                        </div>
                        <div class="w-full">
                           <div class="mb-2 flex-shrink px-4 w-full">
                            <label class="label block">Montant</label>
                                 <input class="form-control" value="{{$detail->montant}}" disabled>
                            </div>
                        </div>
                        <div class="w-full">
                           <div class="mb-2 flex-shrink px-4 w-full">
                            <label class="label block">Agence</label>
                                <input class="form-control" value="{{$detail->agence}}" disabled>
                            </div>
                        </div>
                        <div class="w-full">
                           <div class="mb-2 flex-shrink px-4 w-full">
                            <label class="label block">Date/Heur de paiement</label>
                                <input class="form-control" value="{{$detail->created_at->format('d/m/y à H:i:s')}}" disabled>
                            </div>
                        </div>
                        <div class="flex justify-center items-center p-5">
                            <a href="#" class="btn btn_secondary">
                                <span class="la la-print text-xl leading-none"></span> Reçu
                            </a>
                        </div>
                </div>                                                             
            </div>
            </div>
@include('components.pages.footer')     
@section('js')

@endsection
</main>
 <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>
        <div class="overflow-y-auto">
            <!-- Status -->
            <h2 class="p-5">Info</h2>
            <hr>
            <div class="flex flex-col gap-y-5 p-5">
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-sync text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Pending Tasks
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">10</span>
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Completed Tasks
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">20</span>
                </a>
            </div>
        </div>
    </aside>

@stop