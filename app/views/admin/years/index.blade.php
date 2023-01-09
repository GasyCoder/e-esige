@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Année Universitaire @stop
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
                    <table class="table table_striped w-full mt-3">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right ">#</th>
                                <th class="ltr:text-left rtl:text-right ">Année Universitaire</th>
                                <th class="ltr:text-left rtl:text-right ">Début</th>
                                <th class="ltr:text-left rtl:text-right ">Fin</th>
                                <th class="ltr:text-left rtl:text-right ">Actif</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($years as $year)
                            <tr>
                                <td>{{ $year->id }}</td>

                                <td>{{ $year->yearsUniv }}</td>

                                <td>{{ \Carbon\Carbon::parse($year->dateStart)->format('d M Y')}}</td>
                                <td>{{ \Carbon\Carbon::parse($year->dateEnd)->format('d M Y')}}</td>
                                
                                <td>
                                @if($year->status == 1)
                                <div class="badge badge_success uppercase">Oui</div> 
                                @else 
                                <div class="badge badge_danger uppercase">Non</div> @endif
                                </td>
                                <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{ URL::current() . '?id=' . $year->id }}" class="btn btn-icon btn_outlined btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('deleteYear', $year->id) }}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
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
$getYear = Year::find($id);
if ($getYear !== null) {  ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Modifier Année Universitaire</h3>
                  <div id="resultajax2" class="center"></div>    

{{ Form::open(['route'=>['updateYear',$getYear->id], 'class'=>'', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}

                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Année Début</label>
                            <input id="yearsUniv" name="yearsUniv" value="{{$getYear->yearsUniv}}" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Date début</label>
                            <input id="date" name="dateStart" value="{{$getYear->dateStart}}" type="date" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Date Fin</label>
                            <input id="dateEnd" name="dateEnd" value="{{$getYear->dateEnd}}" type="date" class="form-control">
                        </div>
                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Status</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    @if($getYear->status == 1)
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
@include('admin.years.jsUp')
                </div>
            </div>
<?php } } else { ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Ajouter Année Universitaire</h3>
                    <div id="resultajax" class="center"></div>
                    {{ Form::open(['route'=>'storeYear', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator']) }} 
                       <div class="mb-5">
                            <label class="label block mb-2" for="title">Année Universitaire</label>
                            <input id="yearsUniv" name="yearsUniv" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Date début</label>
                            <input id="dateStart" name="dateStart" type="date" class="form-control">
                        </div>

                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Date Fin</label>
                            <input id="dateEnd" name="dateEnd" type="date" class="form-control">
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="btn btn_primary uppercase">Ajouter</button>
                        </div>
                {{ Form::close() }}
                @include('admin.years.jsAdd')
                </div>
            </div>
<?php }  ?>   
        </div>
@include('components.pages.footer')        
    </main>
@stop