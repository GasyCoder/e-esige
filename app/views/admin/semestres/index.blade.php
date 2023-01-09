@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Sememestre Universitaire @stop
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
                                <th class="ltr:text-left rtl:text-right ">Intitulé</th>
                                <th class="ltr:text-left rtl:text-right ">Début</th>
                                <th class="ltr:text-left rtl:text-right ">Fin</th>
                                <th class="ltr:text-left rtl:text-right ">Activer</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($semestres as $sem)
                            <tr>
                                <td>{{ $sem->id }}</td>
                                <td>{{ $sem->semestre }}</td>
                                <td>{{ $sem->dateStart }}</td>
                                <td>{{ $sem->dateEnd }}</td>
                                <td>
                                @if($sem->status == 1)
                                <div class="badge badge_outlined badge_success">Oui</div> 
                                @else 
                                <div class="badge badge_outlined badge_danger">Non</div> @endif
                                </td>
                                <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{ URL::current() . '?id=' . $sem->id }}" class="btn btn-icon btn_outlined btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('deleteSem', $sem->id) }}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
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
$getSemestre = Semestre::find($id);
if ($getSemestre !== null) {  ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Modifier Sememestre Universitaire</h3>
                  <div id="resultajax2" class="center"></div>    

{{ Form::open(['route'=>['updateSem',$getSemestre->id], 'class'=>'', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}

                    <div class="mb-5">
                            <label class="label block mb-2" for="title">Code Semestre</label>
                            <input id="codeSem" name="codeSem" value="{{$getSemestre->codeSem}}" type="text" class="form-control" placeholder="example : S1 ou S2">
                        </div>
                         <div class="mb-5">
                            <label class="label block mb-2" for="semestre">Intitulé</label>
                            <div class="custom-select">
                               <select name="semestre" id="semestre" class="form-control">
                                    @if(!empty($getSemestre->semestre))
                                    <option value="{{$getSemestre->semestre}}" selected="selected">{{$getSemestre->semestre}}</option>
                                    @else
                                    <option value="" selected disabled>Choisir</option>
                                    @endif
                                    <option value="Semestre_1">Semestre 1</option>
                                    <option value="Semestre_2">Semestre 2</option>
                                    
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="yearsUniv">Début Année Universitaire</label>
                            <div class="custom-select">
                               <select name="yearsUniv" id="yearsUniv" class="form-control">
                                    @if(!empty($getSemestre->yearsUniv))
                                    <option value="{{ $getSemestre->yearsUniv }}" selected="selected">{{ $getSemestre->yearsUniv }}</option>
                                    @else
                                    <option value="" selected disabled>Choisir</option>
                                     @endif
                                    @foreach($years as $year)
                                        <option value="{{ $year->yearsUniv }}">{{ $year->yearsUniv }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Date début</label>
                            <input id="date" name="dateStart" value="{{$getSemestre->dateStart}}" type="date" class="form-control">
                        </div>

                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Date Fin</label>
                            <input id="dateEnd" name="dateEnd" value="{{$getSemestre->dateEnd}}" type="date" class="form-control">
                        </div>

                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Status</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    @if($getSemestre->status == 1)
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
@include('admin.semestres.jsUp')
                </div>
            </div>
<?php } } else { ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Ajouter Semestres Universitaire</h3>
                    <div id="resultajax" class="center"></div>
                    {{ Form::open(['route'=>'storeSem', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator']) }} 
                        <div class="mb-5">
                            <label class="label block mb-2" for="semestre">Intitulé</label>
                            <div class="custom-select">
                               <select name="semestre" id="semestre" class="form-control">
                                    <option value="" selected disabled>Choisir</option>
                                    <option value="Semestre-1">Semestre 1</option>
                                    <option value="Semestre-2">Semestre 2</option>
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="yearsUniv">Année Universitaire</label>
                            <div class="custom-select">
                               <select name="yearsUniv" id="yearsUniv" class="form-control">
                                    <option value="" selected disabled>Choisir</option>
                                    @foreach($years as $year)
                                       <option value="{{ $year->yearsUniv }}">{{ $year->yearsUniv }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Date début</label>
                            <input id="date" name="dateStart" type="date" class="form-control">
                        </div>

                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Date Fin</label>
                            <input id="dateEnd" name="dateEnd" type="date" class="form-control">
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="btn btn_primary uppercase">Ajouter</button>
                        </div>
                {{ Form::close() }}
                @include('admin.semestres.jsAdd')
                </div>
            </div>
<?php }  ?>   
        </div>
@include('components.pages.footer')        
    </main>
@stop