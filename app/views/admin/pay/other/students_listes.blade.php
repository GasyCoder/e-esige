@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content')
    <!-- Workspace -->
    <main class="workspace overflow-hidden">
@if(count($students) > 0)       
        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
               <h1>{{$title}}</h1>
                <ul>
                    <li><a href="#">Menu</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>Liste</li>
                </ul>
            </div>
            <!-- Actions -->
            <div class="breadcrumb breadcrumb_alt p-4 flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
                 <div class="flex flex-wrap gap-2 ltr:ml-auto rtl:mr-auto">
                    <a class="badge badge_secondary uppercase"><span class="la la-graduate text-xl leading-none"></span> Niveau:  <span class="text-red-700">{{$class->short}}</span></a>
                </div>
                <div class="flex flex-wrap gap-2 ltr:ml-auto rtl:mr-auto">
                    <a class="badge badge_secondary uppercase"><span class="la la-graduate text-xl leading-none"></span> Parcour:  <span class="text-red-700">{{$parcour->abr}}</span></a>
                </div>
                @if(Session::has('download'))
                <a href="{{ url() }}/uploads/data/{{ Session::get('download') }}" class="btn btn_warning text-gray-600">
                    <span class="la la-cloud-download-alt text-xl leading-none ltr:mr-1 rtl:ml-1 text-gray-600"></span>
                    <span class="text-gray-600">Télécharger .csv</span>
                </a>
                @endif
                {{ Form::open(['route'=>'data_export', 'files'=>'true' , 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
                <div class="form-group">
                <button type="submit" class="btn btn_info">
                    <span class="la la-file-alt text-xl leading-none ltr:mr-1 rtl:ml-1"></span> Exporter
                </button>
                </div>
               {{ Form::close() }}
                <div class="flex flex-wrap gap-2 ltr:ml-auto rtl:mr-auto">
                    <a href="{{URL::route('selectNiveau')}}" class="btn btn_primary uppercase"><span class="la la-plus-circle text-xl leading-none"></span> Ajouter</a>
                </div>
            </div>
        </section>
        <!-- List -->
        <div class="card p-5">
            @include('components.alerts')
            <div class="overflow-x-auto">
                <table class="table-sorter table table_striped w-full">
                     <thead>
                        <tr>
                            <th class="ltr:text-left rtl:text-right">Photo</th>
                            <th class="ltr:text-left rtl:text-right">Matricule</th>
                            <th class="ltr:text-left rtl:text-right">Nom complet</th>
                            <th class="ltr:text-left rtl:text-right">Vague</th>               
                            <th class="text-center" style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)    
                    <?php
                     $class     = TheClass::where('id', $student->class_id)->first(); 
                     $parcour   = Parcour::where('id',  $student->parcour_id)->first();
                     $vague     = Vague::where('id',    $student->vague_id)->first();
                     $user      = Profil::where('id', $student->id)->first();
                    ?>
                        <tr>
                            <td>
                            @if(!empty($user->photo))
                                <div class="avatar avatar_with-shadow w-16 h-16">
                                <?php echo HTML::image('uploads/profiles/students/'.$user->photo.'', '', ['class'=>'']) 
                                ?>
                                </div>
                                @else 
                                <div class="flex items-center gap-x-4 mt-4">
                                    <?php 
                                    $fname = substr($student->fname,0,1);
                                    $lname = substr($student->lname,0,1);
                                    ?>
                                    <div class="avatar avatar_with-shadow text-xl">{{ ($fname.''.$lname) }}
                                    </div>
                                </div>
                                @endif
                            </td>
                            <td class="font-bold">{{$student->matricule}}</td>
                            <td class="font-bold">{{$student->fname.' '.$student->lname}}</td>
                            <td class="font-bold">{{$vague->abr}}</td>
                            <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                 <a href="{{URL::route('addPay', $student->id)}}" class="btn btn-icon btn_info ltr:ml-2 rtl:mr-2"> <span class="la la-money-bill-alt"></span>
                                </a>
                                 <a href="{{URL::route('profileEtudiant', $student->token)}}" class="btn btn-icon btn_success ltr:ml-2 rtl:mr-2">
                                  <span class="la la-user"></span>
                                </a>    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@else
<br>
<div class="alert alert_outlined alert_danger">
<strong class="uppercase"><bdi>Désolé!</bdi></strong>
 Il n'y a pas des données disponible ici pour le moment.</b>.  
<button type="button" class="dismiss la la-times" data-dismiss="alert"></button>
</div>
@endif
    @include('components.pages.footer')
        @section('js')
        <script type="text/javascript">
        function goToNext(c) {
        if(c.value != '') {
            window.location = '{{ URL::current() }}/'+c.value;
        }
        }
        </script>
        @endsection
</main>
@stop