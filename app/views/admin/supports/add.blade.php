@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
         <section class="breadcrumb lg:flex items-start">
            <div>
               <h1>{{$title}}</h1>
                <ul>
                    <li><a href="#">Menu</a></li>
                   <li class="divider la la-arrow-right"></li>
                    <li><a href="{{URL::route('checkVagueCours', [$class->id, $parcour->id])}}">Vague</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>Programmes</li>
                </ul>
            </div>
            <div class="breadcrumb breadcrumb_alt p-4 flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
                 <div class="flex flex-wrap gap-2 ltr:ml-auto rtl:mr-auto">
                    <a class="badge badge_secondary uppercase"><span class="la la-graduate text-xl leading-none"></span> Niveau:  <span class="text-red-700">{{$class->short}}</span></a>
                </div>
                <div class="flex flex-wrap gap-2 ltr:ml-auto rtl:mr-auto">
                    <a class="badge badge_secondary uppercase"><span class="la la-graduate text-xl leading-none"></span> Parcour:  <span class="text-red-700">{{$parcour->abr}}</span></a>
                </div>
            </div>
        </section>
        <div class="grid lg:grid-cols-3 gap-5">
            <!-- Content -->
            <div class="lg:col-span-2">
            @include('components.alerts')
            @if($if_Existe > 0)    
            <div class="card p-5 mt-3">
                <table class="table table_list mt-3 w-full">
                    <thead>
                        <tr>
                            <th class="ltr:text-left rtl:text-right">#</th>
                            <th class="ltr:text-left rtl:text-right uppercase">Titre cours</th>
                            <th class="ltr:text-left rtl:text-right uppercase">Matière</th>
                            <th class="w-px uppercase">Semestre</th>
                            <th class="w-px uppercase">Partagé</th>
                            <th class="w-px uppercase">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cours as $key => $cour)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$cour->title}}</td>
                            <td>{{$cour->matiere->name}}</td>
                            <td class="text-center">{{$cour->matiere->semestre}}</td>
                            <td class="text-center">
                              @if($cour->status == 1)  
                                <span class="badge badge_outlined badge_success">Oui</span> 
                              @else
                                <span class="badge badge_outlined badge_danger">Non</span> 
                              @endif
                            </td>
                            <td class="text-center">
                                <a href="{{URL::route('detailCours', $cour->id)}}" class="btn btn-icon btn_warning">
                                  <span class="la la-info-circle text-gray-600"></span>
                                </a>    
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-auto">
                    <a href="#no-link" class="btn btn_primary mt-5">Voir tous les supports</a>
                </div>   
            </div>
            @else
             <div class="alert alert_danger">
                    <strong class="uppercase"><bdi>Info!</bdi></strong>
                    Aucun donnés ajouter pour le moment!
                    <button class="dismiss la la-times" data-dismiss="alert"></button>
                </div>
            @endif
            </div>

            <div class="flex flex-col gap-y-5 lg:col-span-3 xl:col-span-2">
                <!-- add support -->
                <div class="card p-5 flex flex-col gap-y-4">
                    <h3 class="mb-5">Ajouter cours</h3>
                    {{ Form::open(['route'=>['CoursStore', $class->id, $parcour->id, $vague->id], 'files'=>'true'])  }}
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Matière</label>
                            <div class="custom-select">
                                <select class="form-control" name="matiere_id">
                                    <option selected disabled>--Choisir matière--</option>
                                    @foreach($matieres as $matiere)
                                       <option value="{{ $matiere->id }}">{{ $matiere->name }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <div class="mb-5">
                           <label class="label block mb-2" for="title">Sous-Titre</label>
                            {{ Form::text('title', '', ['id'=>'title', 'class'=>'form-control']) }}
                            <div class="help-block with-errors"></div>
                            @if($errors->first('title'))
                            <span class="text-red-700">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="mb-5">
                           <label class="label block mb-2" for="volh">Volume Horaire</label>
                            {{ Form::number('volh', '', ['id'=>'volh', 'class'=>'form-control']) }}
                            <div class="help-block with-errors"></div>
                            @if($errors->first('volh'))
                            <span class="text-red-700">{{ $errors->first('volh') }}</span>
                            @endif
                        </div>
                        <div class="mb-5">
                           <label class="label block mb-2" for="content">Introduction</label>
                            <textarea id="ckeditor" name="content"></textarea>
                        </div>
                        <div class="mb-5">
                            <label class="input-group font-normal">
                                <div class="file-name input-addon input-addon-prepend input-group-item w-full overflow-x-hidden">Aucun fichiers</div>
                                <input type="file" id="fileInput" name="file" class="hidden">
                                <div class="input-group-item btn btn_primary uppercase">Parcourir</div>
                            </label>
                        </div>
                        <div class="mt-10">
                            <button class="btn btn_primary uppercase"><span class="la la-plus-circle"></span> Ajouter</button>
                        </div>
                {{ Form::close() }}
                </div>
            </div>  
        </div>
        @include('components.pages.footer')     
        @section('js')
            <!-- JS --->
         <script src="{{url()}}/public/assets/js/ckeditor.js"></script>
         <p id="fileSize"></p>
          <script>
            var fileInput = document.getElementById("fileInput");
            var fileSize = document.getElementById("fileSize");
            
            fileInput.addEventListener("change", function() {
              var file = fileInput.files[0];
              fileSize.innerHTML = "File size: " + file.size + " bytes";
            });
          </script>
        @endsection
    </main>
    @stop