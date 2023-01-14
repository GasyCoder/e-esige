@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content')
    <!-- Workspace -->
    <main class="workspace overflow-hidden">
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
                <span class="leading-none ltr:mr-1 rtl:ml-1"></span> <h5 class="bg_red">Total:{{count($students)}}</h5>
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
                <table class="table-sorter table table-auto table_hoverable w-full">
                     <thead>
                        <tr>
                            <th class="ltr:text-left rtl:text-right">Photo</th>
                            <th class="ltr:text-left rtl:text-right">Matricule</th>
                            <th class="ltr:text-left rtl:text-right">Nom complet</th>
                            <th class="ltr:text-left rtl:text-right">Vague</th>
                            <th class="ltr:text-left rtl:text-right">Niveau </th> 
                            <th class="ltr:text-left rtl:text-right">Parcours </th>                
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
                            <td class="font-bold">{{$class->short}}</td>
                            <td class="font-bold">{{$parcour->abr}}</td>
                            <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                 <a href="{{URL::route('profileEtudiant', $student->token)}}" class="btn btn-icon btn_success ltr:ml-2 rtl:mr-2">
                                  <span class="la la-user"></span>
                                </a>    
                                <a href="{{URL::route('editStudent', $student->token)}}" class="btn btn-icon btn_primary ltr:ml-2 rtl:mr-2"> <span class="la la-user-edit"></span>
                                </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

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