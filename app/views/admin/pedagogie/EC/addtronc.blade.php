@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Element Constitutifs @stop
@section('content')
    <main class="workspace">
        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
@include('components.break')
            </div>
        </section>   
<div class="flex gap-x-2 mb-2">
    <a href="{{URL::route('indexEc')}}" class="btn btn-icon btn-icon_large btn_outlined btn_primary">
        <span class="la la-undo"></span>
    </a>
</div>
        <div class="container flex items-center justify-center mb-2 py-1">
        <div class="card p-5 flex flex-col gap-y-2 w-full md:w-1/2 xl:w-1/4">
            <div class="mx-2 md:mx-3">
                <h2 class=""> <span class="la la-edit"></span>Ajouter <br><small>Matière tronc commun ({{$class->short}})</small></h2>
            </div>

            <div id="resultajax" class="center"></div>
            {{ Form::open(['route'=>['saveTronc', $class->id], 'class'=>'flex flex-wrap flex-row -mx-4', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}     

                <div class="mb-5 px-4 w-full">
                    <label class="label block mb-2" for="name">Intitulé</label>
                    <input type="text" id="name" name="name" value="" class="form-control">
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="label block mb-2" for="abr">Abréviation</label>
                   <input type="text" id="abr" name="abr" value="" class="form-control">
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="label block mb-2" for="codeEc">Code EC</label>
                    <input type="text" id="codeEc" name="codeEc" value="" class="form-control">
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="label block mb-2" for="volH">Volume horaire</label>
                    <input type="number" id="volH" name="volH" value="" class="form-control">
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="label block mb-2" for="coef">Coeficients</label>
                    <input type="number" id="coef" name="coef" value="" class="form-control">
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
                <div class="mb-5 px-4 w-full">
                    <label class="label block mb-2" for="ues">Unité d'enseignements</label>
                    <div class="custom-select ues">  
                        <select class="form-control" name="codeUe" id="ues">
                           <option disabled>--choisir UE--</option>
                        </select>
                        <div class="custom-select-icon la la-caret-down"></div>
                    </div>
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="custom-radio">
                        <input type="radio" name="semestre" checked value="1">
                            <span></span>
                            <span style="font-weight:bold;">Semestre 1</span>
                    </label>
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="custom-radio">
                        <input type="radio" name="semestre" value="2">
                            <span></span>
                            <span style="font-weight:bold;">Semestre 2</span>
                    </label>
                </div>
 @include('admin.pedagogie.EC.dep')                
                <div class="mt-10">
                    <button class="btn btn_primary ltr:ml-auto rtl:mr-auto font-bold" onclick="refresh();"><span class="la la-check-circle text-xl"></span> Fait</button>
                    <button class="btn btn_success"><span class="la la-plus-circle text-xl"></span> Ajouter</button>
                </div>
              {{ Form::close() }}
        @include('admin.pedagogie.EC.ajaxTronc')
        </div>
    </div>
@include('components.pages.footer')
@section('js')
<script type="text/javascript">
 $('#parcours').select2();
</script>
<script type="text/javascript">
 $('#class').select2();
</script>
<script type="text/javascript">
 $('#ues').select2();
</script>
@endsection 
</main>
<!-- Sidebar -->
    <aside class="sidebar">
        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>
        <!-- Tags -->
        <h2 class="p-5">Ajouter par classes</h2>
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