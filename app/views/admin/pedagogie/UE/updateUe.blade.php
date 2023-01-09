@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Unité d'Enseignements @stop
@section('content')
<main class="workspace">
<section class="breadcrumb lg:flex items-start">   
<div>   
@include('components.break')
</div>
</section>
    <div class="container flex items-center justify-center mb-2 py-1">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <a href="/admin/ue/{{$ues->class_id}}/{{$ues->parcour_id}}"><span class="la la-arrow-left"></span> Retour</a>
            <div class="mx-2 md:mx-3">
                <h2 class="uppercase"> <span class="la la-edit"></span>Modifier</h2>
            </div>
            <div id="resultajax2" class="center"></div>
            {{ Form::open(['route'=>['updateUe',$ues->id], 'class'=>'card mt-5 p-5 md:p-10', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}    
                <div class="mb-5">
                    <label class="label block mb-2" for="codeUe">Code UE</label>
                    <input id="codeUe" type="text" name="codeUe" value="{{$ues->codeUe}}" class="form-control">
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="name">Intitulé</label>
                    <input id="name" type="text" name="name" value="{{$ues->name}}" class="form-control">
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="name">Nombre de crédit</label>
                    <input id="credit" type="text" name="credit" value="{{$ues->credit}}" class="form-control">
                </div>
                 <div class="mb-5">
                  <label class="label block mb-2" for="codeSem">Semestres</label>
                  <div class="custom-select">
                  <select class="form-control" name="codeSem" id="codeSem">
                           @if(!empty($ues->codeSem))
                            <option value="{{ $ues->codeSem }}" selected class="text-red-700 font-bold"><b>Semestre_{{ $ues->codeSem }}</b></option>
                           @else
                            <option value="" selected>Choisir</option>
                           @endif
                           @foreach($semestres as $sem)
                             <option value="{{ $sem->id }}">{{ $sem->semestre }}</option>
                           @endforeach
                        </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>
                </div>
                <input type="hidden" name="class_id" value="{{ $ues->class_id }}">
                @if($ues->class_id >= 2)
                <div class="mb-5">
                <label class="label block mb-2" for="tronc">Tronc commun</label>
                <div class="custom-select tronc">
                    <select class="form-control" name="tronc" id="tronc">
                         @if($ues->tronc == 1)
                         <option value="{{ $ues->tronc }}" selected style="color:green;" class="font-bold">Oui</option>
                         <option value="0">Non</option>
                         @elseif($ues->tronc == 0)
                         <option value="{{ $ues->tronc }}" selected style="color:green;" class="font-bold">Non</option>
                         <option value="1">Oui</option>
                         @else
                         <option value="1">Oui</option>
                         <option value="0">Non</option>
                         @endif
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>
                </div>
                <div class="mb-5">
                <label class="label block mb-2" for="choix">Choix</label>
                <div class="custom-select choix">
                    <select class="form-control" name="choix" id="choix">
                         @if($ues->choix == 1)
                         <option value="{{ $ues->choix }}" selected style="color:green;" class="font-bold">Obligatoire</option>
                         <option value="2">Facultatif</option>
                         @elseif($ues->choix == 2)
                         <option value="{{ $ues->choix }}" selected style="color:green;" class="font-bold">Facultatif</option>
                         <option value="1">Obligatoire</option>
                         @else
                         <option value="1">Obligatoire</option>
                         <option value="2">Facultatif</option>
                         @endif
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>
                </div>
                @endif
                <div class="flex items-center">
                    <div class="w-1/2">
                        <label class="label block">Status</label>
                    </div>
                    <div class="w-3/4 ml-2">
                    <label class="label switch">
                        @if($ues->status == 1)
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
                <div class="flex">
                 <button type="submit" class="btn btn_success ltr:ml-auto rtl:mr-auto uppercase"><span class="la la-refresh"></span> Mettre à jour</button>
                </div>
           {{ Form::close() }}
           @include('admin.pedagogie.UE.jsUp') 
        </div>
    </div>
@include('components.pages.footer')
@section('js')
<script type="text/javascript">
 $('#parcour').select2();
</script>
@endsection
</main>
@stop