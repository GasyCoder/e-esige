@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content')
    <!-- Workspace --> 
    <main class="workspace workspace_with-sidebar">

        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
                <h1>{{$title}}</h1>
                <ul>
                    <li><a href="{{URL::route('formCours', [$support->class_id, $support->parcour_id,$support->vague_id])}}">Liste supports</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>detail</li>
                </ul>
            </div>
            <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 xl:mt-0">
                <!-- Add New -->
                <a href="{{URL::route('formCours', [$support->class_id, $support->parcour_id,$support->vague_id])}}" class="btn btn_primary uppercase"><span class="la la-plus-circle"></span> Ajouter</a>
            </div>
        </section>
        <!-- To Do -->
        <div class="flex flex-col gap-y-5 ">
        <div class="card relative p-5">
        {{ Form::open(['route'=>['shareLesson', $support->id], 'files'=>'true', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}          
                <div class="lg:absolute top-0 ltr:right-0 rtl:left-0 lg:mt-3 lg:ltr:mr-5 lg:rtl:ml-5 mb-5 lg:flex items-center justify-end ltr:text-right rtl:text-left">
                    <span class="inline-flex text-muted pb-2 lg:pb-0">{{$support->created_at}}</span>
                    <a href="#no-link" class="btn btn-icon btn_outlined btn_success ltr:ml-5 rtl:mr-5">
                        <span class="la la-pen-fancy"></span>
                    </a>
                    <a onclick="return confirm('Supprimer ce donnée?')" href="{{URL::route('deleteSupport', $support->id)}}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
                        <span class="la la-trash-alt"></span>
                    </a>
                </div>
                <table class="table table_hoverable w-full">
                    <thead>
                        <tr>
                            <th class="ltr:text-left rtl:text-right">
                                <h3 class="text-gray-600 mb-3 uppercase">Matière</h3> 
                                <span class="uppercase"><i class="uppercase la la-file-alt"></i>{{$support->matiere->name}}</span> |
                                <small>({{$support->volh}}h volume horaire)</small>
                                <small>(Enseignant:@if($support->matiere->teacher->sexe == 1)Mr. @else Mme. @endif {{$support->matiere->teacher->fname.' '.$support->matiere->teacher->lname}})
                                </small>
                             </th>   
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td>
                                <h3 class="uppercase mb-5">Contenus</h3>
                                <p class="">{{$support->content}}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="overflow-x-auto" style="display:none;">  
                    @foreach($students as $student)  
                        <input type="text" name="id_student[]" value="{{$student->id}}" class="form-control">  
                    @if($student->status == 1)
                        <input type="text" name="status[]" value="1" class="form-control">
                    @else
                        <input type="text" name="status[]" value="0" class="form-control">
                    @endif 
                        <input type="text" name="class_id[]" value="{{$student->class_id}}">
                        <input type="text" name="parcour_id[]" value="{{$student->parcour_id}}">
                        <input type="text" name="vague_id[]" value="{{$student->vague_id}}">
                    @endforeach
                </div>
                @if($support->status == 0)
                <div class="ltr:right-0 rtl:left-0 lg:mt-3 lg:ltr:mr-5 lg:rtl:ml-5 lg:flex items-center justify-end ltr:text-right rtl:text-left">
                 <button onclick="return confirm('Êtes-vous sûr de vouloir partager?')" class="btn btn_success uppercase">
                    Partager <span class="la la-paper-plane text-xl leading-none ltr:ml-2 rtl:mr-2"></span>
                </button>
                </div>
                @endif
     {{ Form::close() }}           
            </div>
        </div>
        @include('components.pages.footer')
        @section('js')
        <!--JS --->
        @endsection
        </main>

     <!-- Sidebar -->
      <aside class="sidebar">

        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>

        <div class="overflow-y-auto">

            <!-- Status -->
            <h2 class="p-5">Informations</h2>
            <hr>
            <div class="flex flex-col gap-y-5 p-5">
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Niveau
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$support->class->short}}</span>
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Parcours
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$support->parcour->abr}}</span>
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Vague
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$support->vague->abr}}</span>
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Semestre
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$support->matiere->semestre}}</span>
                </a>
            </div>
            @if(!empty($support->file))
            <!-- Categories -->
            <h2 class="p-5">Fichiers <small class="text-red-700">(0{{count($file)}})</small> </h2>
            <hr>
            <div class="flex flex-col gap-y-5 p-5">
            <!-- PHP loop to generate the `<a>` elements -->
                <a href="{{ url() }}/uploads/support_files/{{$support->file}}" target="_blank" class="flex items-center text-normal text-primary file-link">
                <span class="la la-paperclip text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                fichier jointe <span class="file-size text-red-700"></span>
                <span class="badge badge_danger ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto"><i class="la la-download"></i></span>
              </a>
            </div>
            @endif
           <script>
            var fileLinks = document.querySelectorAll(".file-link");
            fileLinks.forEach(function(fileLink) {
                fileLink.addEventListener("click", function(event) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("HEAD", fileLink.href, true);
                    xhr.onreadystatechange = function() {
                        if (this.readyState === this.DONE) {
                            var size = xhr.getResponseHeader("Content-Length");
                            var sizeInKb = (size/1024).toFixed(2);
                            var fileSizeSpan = fileLink.querySelector(".file-size");
                            fileSizeSpan.innerHTML = "(" + sizeInKb + "KB)";
                        }
                    };
                    xhr.send();
                });
            });
         </script>
        </div>
    </aside>
    @stop