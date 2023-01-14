@extends('layouts.master')
<?php 
$path = Session::get('language'); 
$control = Control::find(1);
$tarif   = Tarif::where('class_id', $step_pay->class_id)->first();
?>
@section('title') {{$title}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="{{URL::route('student_liste')}}"><span class="la la-undo"></span> Retour</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>paiment</li>
            </ul>
        </section>
<!-- Layout -->
<div class="container flex items-center justify-center mb-2 py-1">
<div class="card p-5 flex flex-col gap-y-2 w-full md:w-1/2 xl:w-1/4">
@include('components.alerts')
{{ Form::open(['route'=>['sotre_firstpay', $step_pay->id], 'files'=>'true', 'id'=>'myForm', 'class'=>'', 'data-toggle'=>'validator'])  }} 
                    <div class="flex flex-wrap flex-row -mx-4 collapse open">
                        <div class="w-full mb-5 flex-shrink px-4 w-full">
                        <label class="label block mb-2" for="category">Motifs</label>
                            <div class="custom-select">
                                <select class="form-control" name="motif">
                                    @if($verify->otherpayed == 0)
                                    <option value="Droit d'inscription + Ecolage" selected>1ère versement(Droit+Ecolage 1 mois)</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if($verify->otherpayed == 0)
                        <input type="hidden" name="nbremois" value="1">
                        @endif
                       <div class="w-full">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="montant">Montant</label>
                                <input class="form-control font-bold" type="number" name="montant">
                            </div>
                       </div>
                       <div class="w-full">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="date">Date</label>
                                <input class="form-control font-bold" type="date" name="date">
                            </div>
                       </div>
                        <div class="w-full mb-0">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="msg">Message <small>(facultatif)</small></label>
                                <textarea class="form-control" name="msg" row="3">Votre paiement de de première versement a été réglé avec succès!</textarea>
                            </div>
                        </div>
                        <div class="flex justify-center items-center mt-3 p-5">
                            <button type="submit" class="btn btn_primary"><span class="la la-user-plus"></span> Ajouter paiement</button>
                        </div>
                  </div>                  
            {{ Form::close() }}
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
            <h2 class="p-5">Information</h2>
            <hr>
            <div class="flex flex-col gap-y-5 p-5">
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-user text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    {{$step_pay->fname.''.$step_pay->lname}}
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Niveau
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$step_pay->class->short}}</span>
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Parcours
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$step_pay->parcour->abr}}</span>
                </a>
                <hr>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                     Droit d'inscription
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$tarif->droit. ' ' .$control->payment_unit}}</span>
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                     Ecolage
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$tarif->ecolage. ' ' .$control->payment_unit}}</span>
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                     Droit de soutenance
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">100000 MGA</span>
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                     Droit d'examen
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">30000 MGA</span>
                </a>
            </div>
            @if($verify->otherpayed == 1 && $verify->payed == 1)
            <!-- note -->
            <h2 class="p-5">Note</h2>
            <hr>
            <div class="flex gap-2 p-5">
                <div class="alert alert_success">
                    <strong class="uppercase"><bdi>Info!</bdi></strong>
                    1ère versement de cet étudiant a été reglé!
                </div>
            </div>
            @endif
        </div>
    </aside>
@stop