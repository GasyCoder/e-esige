@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Matières - Ajouter Enseignant @stop
@section('content')
    <main class="workspace">
<section class="breadcrumb lg:flex items-start">   
<div>   
</div>
</section>
<a href="/admin/element_constitutif/{{ $class->id }}/{{ $parcour->id }}" class="btn btn-icon btn-icon_large btn_outlined btn_primary p-5">
    <span class="la la-undo"></span>
</a>
@if(!empty($element->id_teacher))  
 <section class="breadcrumb lg:flex items-start p-5">
           <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
                <div class="flex gap-x-2">
                <div class="avatar w-16 h-16 ltr:mr-5 rtl:ml-5">
                <div class="status bg-success"></div>
                @if(!empty($element->teacher->image))
                <?php echo HTML::image('uploads/profiles/teacher/'.$element->teacher->image.'', '', ['class'=>'', 'width'=>'180','height'=>'80']) ?>
                @elseif($element->teacher->sexe == 1)
                {{ HTML::image('public/assets/avatar/teacher_1.png', '', ['class'=>'', 'width'=>'','height'=>'']) }}
                 @else {{ HTML::image('public/assets/avatar/teacher_2.png', '', ['class'=>'', 'width'=>'','height'=>'50']) }}
                @endif
                </div>
                <div>
                <h5>@if($element->teacher->sexe == 1) Mr. @else Mme. @endif {{$element->teacher->fname}} {{$element->teacher->lname}}</h5>
                <p>Enseignant @if($element->teacher->sexe == 2) e @endif </p>
                </div>
                </div>
            </div>             
        </section>
    <hr>
     @endif 
    <div class="container flex items-center justify-center mb-2 py-1">
        <div class="card p-5 flex flex-col gap-y-2 w-full md:w-1/2 xl:w-1/4">
            <div class="mx-2 md:mx-3">
                <h3 class=""> <span class="la la-plus-circle"></span>{{$title}}</h3>
            </div>
            <div id="resultajax2" class="center"></div>
            {{ Form::open(['route'=>['ajouterTeacher', $element->id], 'class'=>'', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}    
                        <div class="mb-5">
                            <label class="label block mb-2" for="matiere">Nom matière</label>
                            <div class="custom-select matiere">
                                <select class="form-control" disabled>
                                <option>{{$element->name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="teacher">Enseignants</label>
                            <div class="custom-select id_teacher">
                                <select class="form-control" name="id_teacher" id="teacher">
                                @if(!empty($element->id_teacher))
                                <option value="{{$element->id_teacher}}" disabled selected class="font-bold text-primary" style="color:red">{{ $element->teacher->grade }} {{$element->teacher->fname}} {{$element->teacher->lname}}</option>
                                @else
                                <option disabled selected>--choisir enseignant--</option>
                                @endif
                                   @foreach($teachers as $teacher)
                                     <option value="{{ $teacher->id }}">{{ $teacher->grade }} {{ $teacher->fname }} {{ $teacher->lname }}
                                     </option>
                                   @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button class="btn btn_success"><span class="la la-plus text-xl"></span> Ajouter</button>
                        </div>
                      {{ Form::close() }}
                @include('admin.pedagogie.EC.ajaxTeacher')
        </div>
    </div>
@include('components.pages.footer')
@section('js')
<script type="text/javascript">
 $('#teacher').select2();
</script>

<script type="text/javascript">
 var urlmenu = document.getElementById( 'select_element_name' );
 urlmenu.onchange = function() {
      window.open( this.options[ this.selectedIndex ].value, '_self');
 };
</script>

<script type="text/javascript">
 var urlmenu = document.getElementById( 'select_parcour_name' );
 urlmenu.onchange = function() {
      window.open( this.options[ this.selectedIndex ].value, '_self');
 };
</script>

@endsection   
</main>
 <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>
        <!-- Tags -->
       <h2 class="p-5">Objets sélectionnés</h2>
        <hr>
         <div class="flex flex-col gap-y-5 p-5">
            <a href="#" class="flex items-center text-normal">
                <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                Niveau
                <span class="badge badge_success ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{ $class->name }}</span>
            </a>
            <a href="#" class="flex items-center text-normal">
                <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                Parcours
                <span class="badge badge_success ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{ $parcour->name }}</span>
            </a>
             <a href="#" class="flex items-center text-normal">
                <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                Tronc commun
                <span class="badge badge_danger ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
                   @if($element->tronc == 1) Oui @else Non @endif
                </span>
            </a>

        </div>
    </aside>
@stop