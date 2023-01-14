@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Les Vagues @stop
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
                    <h3>Listes des vagues <small class="font-bold">Total:({{(count($vagues))}})</small></h3>
                    <table class="table table_striped w-full mt-3">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right">#</th>
                                <th class="ltr:text-left rtl:text-right">Intitulé</th>
                                <th class="text-center">Abréviation</th>
                                <th class="text-center">Date début</th>
                                <th class="text-center">Date fin</th>
                                <th class="ltr:text-left rtl:text-right">Actif</th>
                                <th class="ltr:text-left rtl:text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($vagues as $key=> $vague)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td class="font-bold">{{ $vague->name }}</td>
                                <td class="text-center font-bold">{{ $vague->abr }}</td>
                                <td class="text-center">{{ $vague->dateStart }}</td>
                                <td class="text-center">{{ $vague->dateEnd }}</td>
                                <td>
                                @if($vague->status == 1)
                                <div class="badge badge_outlined badge_success">Oui</div> 
                                @else 
                                <div class="badge badge_outlined badge_danger">Non</div> 
                                @endif
                                </td>
                                <td>
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{ URL::current() . '?id=' . $vague->id }}" class="btn btn-icon btn_outlined btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('class_delete', $vague->id) }}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
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
$getvague = Vague::find($id);
if ($getvague !== null) {  ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Modifier Vague</h3>
                  <div id="resultajax2" class="center"></div>    
                   {{ Form::open(['route'=>['class_update',$getvague->id], 'class'=>'', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}    
                        <div class="mb-5">
                            <label class="label block mb-2" for="name">Intitulé</label>
                            <input id="name" name="name" value="{{$getvague->name}}" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="abr">Abréviation</label>
                            <input id="abr" name="abr" value="{{$getvague->abr}}" type="text" class="form-control">
                        </div>
                  		<div class="mb-5">
                            <label class="label block mb-2" for="dateStart">Date début</label>
                           <input id="dateStart" name="dateStart" value="{{$getvague->dateStart}}" type="date" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="dateEnd">Date fin</label>
                           <input id="dateEnd" name="dateEnd" value="{{$getvague->dateEnd}}" type="date" class="form-control">
                        </div>
                         <div class="mb-5">
                            <label class="label block mb-2" for="note">Programmes</label>
                           <textarea name="note" class="form-control" rows="4">{{$getvague->note}}</textarea>
                        </div>
                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Actif</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    @if($getvague->status == 1)
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
@include('admin.vagues.jsUp')
                </div>
            </div>
            
<?php } } else { ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Ajouter Vague</h3>
                    <div id="resultajax" class="center"></div>
                    {{ Form::open(['route'=>'storeniveau', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator', 'accept-charset'=>'UTF-8']) }} 
                        <div class="mb-5">
                            <label class="label block mb-2" for="name">Intitulé</label>
                            <input id="name" name="name" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="abr">Abréviation</label>
                            <input id="abr" name="abr" type="text" class="form-control">
                        </div>
                  		<div class="mb-5">
                            <label class="label block mb-2" for="dateStart">Date début</label>
                            <input id="dateStart" name="dateStart" type="date" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="dateEnd">Date fin</label>
                            <input id="dateEnd" name="dateEnd" type="date" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="note">Observation</label>
                           <textarea name="note" class="form-control" rows="4" placeholder="Saisir ici les programmes sur cette vague"></textarea>
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
                @include('admin.vagues.jsAdd')
                </div>
            </div>
<?php }  ?>   
        </div>
@include('components.pages.footer')        
    </main>
@stop