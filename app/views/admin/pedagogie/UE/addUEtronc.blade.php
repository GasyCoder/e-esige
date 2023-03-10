@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Unités d'enseignements tronc communs @stop
@section('content')
    <main class="workspace">
        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
@include('components.break')
            </div>
        </section>   
<div class="flex gap-x-2 mb-2">
    <a href="/admin/ue/unite_enseignements/{{$class->id}}" class="btn btn-icon btn-icon_large btn_outlined btn_primary">
        <span class="la la-undo"></span>
    </a>
</div>
        <div class="container flex items-center justify-center mb-2 py-1">
        <div class="card p-5 flex flex-col gap-y-2 w-full md:w-1/2 xl:w-1/4">
            <div class="mx-2 md:mx-3">
                <h2 class=""> <span class="la la-edit"></span>Ajouter tronc commun</h2>
            </div>

            <div id="resultajax" class="center"></div>
            {{ Form::open(['route'=>['saveUETronc', $class->id], 'class'=>'flex flex-wrap flex-row -mx-4', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}     

                <div class="mb-5  px-4 w-full">
                  <label class="label block mb-2" for="codeSem">Semestres</label>
                  <div class="custom-select">
                   <select class="form-control" name="codeSem" id="codeSem">
                        <option selected disabled>Choisir</option>
                           @foreach($semestres as $sem)
                             <option value="{{ $sem->id }}">{{ $sem->semestre }}</option>
                           @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>
                </div>
                <div class="mb-5  px-4 w-full">
                    <label class="label block mb-2" for="name">Intitulé</label>
                    <input id="name" type="text" name="name" class="form-control">
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="label block mb-2" for="codeUe">Code UE</label>
                    <input id="codeUe" placeholder="Ex: 1.UE-Tronc-Math" type="text" name="codeUe" class="form-control">
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="label block mb-2" for="name">Nombre de crédit</label>
                    <input id="credit" type="number" name="credit" class="form-control">
                </div>
               <div class="mb-5 px-4 w-full">
                    <label class="label block mb-2" for="parcours">Parcours</label>
                    <div class="custom-select parcours">  
                        <select class="form-control" name="parcour_id[]" id="parcours" multiple="multiple">
                          <option disabled>--choisir Parcours--</option>
                           @foreach($allParcours as $parcour)
                             <option value="{{ $parcour->id }}">{{ $parcour->name }}</option>
                           @endforeach
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>
                </div>               
                <div class="mt-10">
                    <button class="btn btn_primary ltr:ml-auto rtl:mr-auto font-bold" onclick="refresh();"><span class="la la-check-circle text-xl"></span> Fait</button>
                    <button class="btn btn_success"><span class="la la-plus-circle text-xl"></span> Ajouter</button>
                </div>
              {{ Form::close() }}
        @include('admin.pedagogie.UE.ajaxTronc')
        </div>
    </div>
@include('components.pages.footer')
@section('js')
<script type="text/javascript">
 $('#parcours').select2();
</script>
@endsection 
</main>
<!-- Sidebar -->
    <aside class="sidebar">
        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>
        <!-- Tags -->
        <h2 class="p-5">Ajouter par niveau</h2>
        <hr>
        <div class="flex flex-col gap-y-5 p-5">
           @foreach($allClasses as $class) 
            <a href="/admin/element_constitutifs/{{$class->id}}" class="flex items-center text-normal">
                <span class="la la-user-graduate text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                {{$class->name}}
                <span class="badge badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
                   {{$class->short}}
                </span>
            </a>
            @endforeach
        </div>
    </aside>
@stop