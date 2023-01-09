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
                    <li>page</li>
                </ul>
            </div>

            <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
                <!-- Layout -->
                <div class="flex gap-x-2">
                    <a href="#no-link" class="btn btn_outlined btn_primary">
                        <span class="la la-undo"></span> Retour
                    </a>
                </div>

                <div class="flex gap-x-2">
                    <!-- Add New -->
                    <a href="{{URL::route('selectNiveau')}}" class="btn btn_primary uppercase"><span class="la la-plus-circle text-xl leading-none"></span> Ajouter nouveau</a>
                </div>
            </div>
        </section>

        <!-- List -->
        <div class="card p-5">
            <div class="overflow-x-auto">
                <table class="table-sorter table table-auto table_hoverable w-full">
                     <thead>
                        <tr>
                            <th class="ltr:text-left rtl:text-right">Photo</th>
                            <th class="ltr:text-left rtl:text-right">Matricule</th>
                            <th class="ltr:text-left rtl:text-right">Vague</th>
                            <th class="ltr:text-left rtl:text-right">Nom complet</th>
                            <th class="ltr:text-left rtl:text-right">Niveau </th> 
                            <th class="ltr:text-left rtl:text-right">Parcour </th>                
                            <th class="text-center" style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)    
                    <?php
                     $class     = TheClass::where('id', $student->class_id)->first(); 
                     $parcour   = Parcour::where('id',  $student->parcour_id)->first();
                     $vague     = Vague::where('id',    $student->vague_id)->first();
                    ?>
                        <tr>
                            <td>
                            @if(!empty($student->user->photo))
                                <?php echo HTML::image('uploads/profiles/students/'.$student->photo.'', '', ['class'=>'avatar w-20 h-20', 'width'=>'180','height'=>'80']) 
                                ?>
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
                            <td class="font-bold">{{$vague->abr}}</td>
                            <td class="font-bold">{{$student->fname.' '.$student->lname}}</td>
                            <td class="font-bold">{{$class->short}}</td>
                            <td class="font-bold">{{$parcour->abr}}</td>
                            <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                 <a href="{{URL::route('profileEtudiant', $student->token)}}" class="btn btn-icon btn_success">
                                  <span class="la la-user"></span>
                                </a>    
                                <a href="{{URL::route('editStudent', $student->token)}}" class="btn btn-icon btn_primary ltr:ml-2 rtl:mr-2"> <span class="la la-pen-fancy"></span></a>
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