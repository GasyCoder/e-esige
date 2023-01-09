@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Element Constitutifs @stop
@section('content')
    <main class="workspace">
<section class="breadcrumb lg:flex items-start">   
<div>   
</div>
</section>
    <div class="container flex items-center justify-center mb-2 py-1">
        <div class="card p-5 flex flex-col gap-y-2 w-full md:w-1/2 xl:w-1/4">
            <a href="/admin/element_constitutif/{{ $class->id }}/{{ $parcour->id }}"><span class="la la-arrow-left"></span> Retour</a>
            <div class="mx-2 md:mx-3">
                <h2 class=""> <span class="la la-edit"></span>{{$title}}</h2>
            </div>
            <div id="resultajax2" class="center"></div>
            {{ Form::open(['route'=>['updateEc', $elements->id], 'class'=>'', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}    
                        <div class="mb-5">
                            <label class="label block mb-2" for="codeEc">Code EC</label>
                            <input type="text" id="codeEc" name="codeEc" value="{{$elements->codeEc}}" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="name">Intitulé</label>
                            <input type="text" id="name" name="name" value="{{$elements->name}}" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="abr">Abréviation</label>
                           <input type="text" id="abr" name="abr" value="{{$elements->abr}}" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="volH">Volume horaire</label>
                            <input type="number" id="volH" name="volH" value="{{$elements->volH}}" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="coef">Coeficients</label>
                            <input type="number" id="coef" name="coef" value="{{$elements->coef}}" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="codeUe">Unité d'enseignements</label>
                            <div class="custom-select codeUe">
                                <?php $unites = UE::where('class_id', $class->id)
                                                    ->where('parcour_id', $parcour->id)
                                                    ->groupBy('codeUe')
                                                    ->where('status', 1)->get();
                                ?>
                                <select class="form-control" name="codeUe" id="codeUe">
                                @if(!empty($elements->codeUe)) 
                                <option value="{{$elements->codeUe}}" selected class="text-primary font-bold">{{$elements->codeUe}}</option>
                                @else
                                <option disabled selected>--choisir--</option>
                                @endif  
                                   @foreach($unites as $ue)
                                     <option value="{{ $ue->codeUe }}">{{ $ue->name }} - ({{ $ue->codeUe }})</option>
                                   @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <input type="hidden" name="tronc" value="0">
                        <div class="mb-5">
                            <label class="label block mb-2" for="tronc">Semestre</label>
                            <div class="custom-select tronc">
                                <select class="form-control" name="semestre" id="semestre">
                                     @if($elements->semestre == 1)
                                     <option value="{{ $elements->semestre }}" selected style="color:green;" class="font-bold">Semestre 1</option>
                                     <option value="2">Semestre 2</option>
                                     @elseif($elements->semestre == 2)
                                     <option value="{{ $elements->semestre }}" selected style="color:green;" class="font-bold">Semestre 2</option>
                                     <option value="1">Semestre 1</option>
                                     @else
                                     <option value="1">Semestre 1</option>
                                     <option value="2">Semestre 2</option>
                                     @endif
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="tronc">Tronc commun</label>
                            <div class="custom-select tronc">
                                <select class="form-control" name="tronc" id="tronc">
                                     @if($elements->tronc == 1)
                                     <option value="{{ $elements->tronc }}" selected style="color:green;" class="font-bold">Oui</option>
                                     <option value="0">Non</option>
                                     @elseif($elements->tronc == 0)
                                     <option value="{{ $elements->tronc }}" selected style="color:green;" class="font-bold">Non</option>
                                     <option value="1">Oui</option>
                                     @else
                                     <option value="1">Oui</option>
                                     <option value="0">Non</option>
                                     @endif
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Status</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    @if($elements->status == 1)
                                    <input type="checkbox" name="status" checked value="1">
                                    <span></span>
                                    <span>Activer</span>
                                    @else
                                    <input type="checkbox" name="status" value="0">
                                    <span></span>
                                    <span>Activer</span>
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button class="btn btn_success"><span class="la la-sync text-xl"></span> Metre à jour</button>
                        </div>
                      {{ Form::close() }}
                @include('admin.pedagogie.EC.jsUp')
        </div>
    </div>
@include('components.pages.footer')
</main>
 <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>
        <!-- Tags -->
       <h2 class="p-5">Objets sélectionnés</h2>
        <hr>
         <div class="flex flex-col gap-y-5 p-5">
            <a href="#" class="flex items-center text-normal">
                <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                Niveau
                <span class="badge badge_success ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{ $class->name }}</span>
            </a>
        </div>
    </aside>
@stop