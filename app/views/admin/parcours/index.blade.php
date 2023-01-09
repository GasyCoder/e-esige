@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Parcours @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
<section class="breadcrumb">        
@include('components.break')
</section>
        <div class="grid lg:grid-cols-3 gap-5">
            <!-- Content -->
            <div class="lg:col-span-2">
            <div class="card p-5">
                    <h3> <small class="font-bold">Total:( {{(count($parcours))}} )</small></h3>
                    <table class="table-sorter table table_striped w-full mt-3">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right ">#</th>
                                <th class="ltr:text-left rtl:text-right ">Intitulé</th>
                                <th class="ltr:text-left rtl:text-right ">Abréviation</th>
                                <th class="ltr:text-left rtl:text-right ">Niveaux</th>
                                <th class="ltr:text-left rtl:text-right ">Activer</th>
                                <th class="ltr:text-left rtl:text-right ">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($parcours as $parcour)    
                            <tr>
                                <td>{{ $parcour->id }}</td>
                                <td class="font-bold">{{ $parcour->name }}</td>
                                <td class="font-bold">{{ $parcour->abr }}</td>
                                <td class="font-bold">{{ $parcour->niveau->short }}</td>
                                <td>
                                @if($parcour->status == 1)<div class="badge badge_outlined badge_success">Oui</div> @else <div class="badge badge_outlined badge_danger">Non</div> @endif
                                </td>
                                <td>
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{ URL::current() . '?id=' . $parcour->id }}" class="btn btn-icon btn_outlined btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('deleteP', $parcour->id) }}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-trash-alt"></span>
                                    </a>
                                    @endif @endif
                                </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
<?php 
if (isset($_GET['id'])) { 
  
$id = htmlspecialchars($_GET['id']);

$getparcour = Parcour::find($id);

if ($getparcour !== null) {  ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Modifier Parcour</h3>
                  <div id="resultajax2" class="center"></div>    
                   {{ Form::open(['route'=>['updateParcour',$getparcour->id], 'class'=>'', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}    
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Intitulé</label>
                            <input id="name" name="name" value="{{$getparcour->name}}" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="content">Abréviation</label>
                           <input id="abr" name="abr" value="{{$getparcour->abr}}" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="category">Niveaux</label>
                            <div class="custom-select">
                            <select class="form-control" name="class_id">
                                @if($getparcour->class_id > 0)
                                <option value="{{$getparcour->class_id}}" selected text-red-700 font-bold>{{$getparcour->niveau->name}}</option>
                                @else 
                                <option value="">--Choisir parcours</option>
                                @endif
                                @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                                <div class="custom-select-icon la la-caret-down"></div>
                            </select>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Status</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    @if($getparcour->status == 1)
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
                            <button class="btn btn_primary uppercase">Metre à jour</button>
                        </div>
                      {{ Form::close() }}
                @include('admin.parcours.jsUp')
                </div>
            </div>
<?php } } else { ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Ajouter Parcours</h3>
                    <div id="resultajax" class="center"></div>
                    {{ Form::open(['route'=>'storeParcour', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator']) }} 
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Intitulé</label>
                            <input id="name" name="name" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="content">Abréviation</label>
                           <input id="abr" name="abr" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="category">Niveaux</label>
                            <div class="custom-select">
                                <select class="form-control" name="class_id">
                                    <option selected disabled>Choisir</option>
                                    @foreach($classes as $class)
                                       <option value="{{ $class->id }}">{{ $class->short }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="btn btn_primary uppercase">Ajouter</button>
                        </div>
                {{ Form::close() }}
                @include('admin.parcours.jsAdd')
                </div>
            </div>
<?php }  ?>   
        </div>
@include('components.pages.footer')     

@section('js')

@endsection
    </main>
@stop