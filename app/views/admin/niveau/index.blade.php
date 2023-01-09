@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Les Niveaux @stop
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
                    <h3>Listes des niveaux <small class="font-bold">Total:({{(count($niveau))}})</small></h3>
                    <table class="table table_striped w-full mt-3">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right">#</th>
                                <th class="ltr:text-left rtl:text-right">Intitulé</th>
                                <th class="text-center">Abréviation</th>
                                <th class="text-center">Observation</th>
                                <th class="ltr:text-left rtl:text-right">Actif</th>
                                <th class="ltr:text-left rtl:text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($niveau as $class)
                            <tr>
                                <td>{{ $class->id }}</td>
                                <td class="font-bold">{{ $class->name }}</td>
                                <td class="text-center font-bold">{{ $class->short }}</td>
                                <td class="text-center">{{ htmlspecialchars_decode($class->note) }}</td>
                                <td>
                                @if($class->status == 1)<div class="badge badge_outlined badge_success">Oui</div> @else <div class="badge badge_outlined badge_danger">Non</div> @endif
                                </td>
                                <td>
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{ URL::current() . '?id=' . $class->id }}" class="btn btn-icon btn_outlined btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('class_delete', $class->id) }}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
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
$getclass = TheClass::find($id);
if ($getclass !== null) {  ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Modifier Niveaux</h3>
                  <div id="resultajax2" class="center"></div>    
                   {{ Form::open(['route'=>['class_update',$getclass->id], 'class'=>'', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}    
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Intitulé</label>
                            <input id="name" name="name" value="{{$getclass->name}}" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Abréviation</label>
                            <input id="short" name="short" value="{{$getclass->short}}" type="text" class="form-control">
                        </div>
                  		<div class="mb-5">
                            <label class="label block mb-2" for="title">Observation</label>
                           <textarea name="note" class="form-control" rows="2">{{$getclass->note}}</textarea>
                        </div>
                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Actif</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    @if($getclass->status == 1)
                                    <input type="checkbox" name="status" checked value="1">
                                    <span></span>
                                    <span>Activé</span>
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
@include('admin.niveau.jsUp')
                </div>
            </div>
            
<?php } } else { ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Ajouter Niveau</h3>
                    <div id="resultajax" class="center"></div>
                    {{ Form::open(['route'=>'storeniveau', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator', 'accept-charset'=>'UTF-8']) }} 
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Intitulé</label>
                            <input id="name" name="name" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Abréviation</label>
                            <input id="short" name="short" type="text" class="form-control">
                        </div>
                  		<div class="mb-5">
                            <label class="label block mb-2" for="title">Observation</label>
                           <textarea name="note" class="form-control" rows="2" placeholder="Exemple : Master en Deuxième partie"></textarea>
                        </div>
                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Actif</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    <input type="checkbox" name="status" checked value="1">
                                    <span></span>
                                    <span>Activé</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="btn btn_primary uppercase">Ajouter</button>
                        </div>
                {{ Form::close() }}
                @include('admin.niveau.jsAdd')
                </div>
            </div>
<?php }  ?>   
        </div>
@include('components.pages.footer')        
    </main>
@stop