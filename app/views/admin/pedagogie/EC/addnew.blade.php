@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Element Constitutifs @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
<section class="breadcrumb">       
@include('components.break')
</section>
@include('components.alerts')
        <!-- Actions -->
        <div class="card p-4 flex flex-wrap gap-2">
            @if($class->id == 1)
            <a href="/admin/element_constitutifs" class="btn btn_primary">
                <span class="la la-undo text-xl leading-none ltr:mr-1 rtl:ml-1"></span>
                Retour
            </a>
            @else
            <a href="/admin/element_constitutifs/{{$class->id}}" class="btn btn_outlined btn_primary">
                <span class="la la-undo text-xl leading-none ltr:mr-1 rtl:ml-1"></span>
                Retour
            </a>

            @endif
             <div class="custom-select mt-0">
                    <select name="select_parcour_name" id="select_parcour_name" onchange="goToNext(this)" class="form-control">
                        @if(!empty($parcour->id))
                        <option value="{{ $parcour->id }}" selected class="font-bold text-primary">{{ $parcour->name }}</option>
                        @else
                        <option value="" selected disabled>--Autre parcours--</option>
                        @endif
                        @foreach($parcours as $select_parcour)
                          <option value="{{ $select_parcour->id}}">{{ $select_parcour->name }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
            </div>
            <div class="flex flex-wrap gap-2 ltr:ml-auto rtl:mr-auto">
                 <button data-toggle="modal" data-target="#add" class="btn btn_success">
                    <span class="la la-plus-circle text-xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Ajouter Matière
                </button>
                <span class="badge badge_outlined badge_warning text-gray-700 font-bold" style="color:#333">
                       Parcours: {{$parcour->abr}}
                </span>
                <span class="badge badge_outlined badge_primary font-bold">
                        Niveau: {{$class->short}}
                </span>
                @if(count($ec_s1)> 0)
                <a href="{{URL::route('print_element', [$class->id, $parcour->id])}}" target="_blank" class="btn btn_secondary text-gray-700">
                    <span class="la la-print text-xl leading-none ltr:mr-2 rtl:ml-2"></span>
                   Imprimer
                </a>
                @endif
            </div>
        </div>
                    <!-- To UE -->
                    <div class="card relative p-5 mt-5">
                            @if($class->short == 'L1')
                            <h3 class=""><span class="la la-check-square"></span>Semestre 1</h3>
                            @elseif($class->short == 'L2')
                            <h3 class=""><span class="la la-check-square"></span>Semestre 3</h3>
                            @elseif($class->short == 'L3')
                            <h3 class=""><span class="la la-check-square"></span>Semestre 5</h3>
                            @elseif($class->short == 'M1')
                            <h3 class=""><span class="la la-check-square"></span>Semestre 7</h3>
                            @elseif($class->short == 'M2')
                            <h3 class=""><span class="la la-check-square"></span>Semestre 9</h3>
                            @endif
                            <div class="accordion rounded-xl mt-0">
                                <center>     
                                <p class="text-sm" style="color:#1F2937"> <u class="font-bold">Total matières non tronc commun</u>: {{$NoMixte}}@if($class->id >= 2) </p>
                                <p class="text-sm" style="color:#1F2937"> <u class="font-bold">Total matières tronc commun</u>: {{$matiereMixte}} @endif </p>
                                </center>
                                <div id="faqs-1-3" class="collapse open">
                                <div class="p-5">
                                <table class="table-sorter table table_bordered w-full mt-0">
                                <thead>
                                    <tr style="color:#3F3F46">
                                        <th class="" width="140" style="text-align:center">Code</th>
                                        <th class="ltr:text-left rtl:text-right" width="480">Matières (EC)</th>
                                        @if($class->id >= 2)
                                        <th style="text-align:center" width="100">Tronc Com</th>
                                        @endif
                                        <th style="text-align:center" width="100">Coef</th>
                                        <th style="text-align:center">Enseignant</th>
                                        <th class="text-center" width="210" style="text-align:center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($ec_s1 as $key => $ec)   
                                    <tr>
                                        <td class="font-bold text-primary" align="center" width=""><code>{{$ec->codeEc}}</code></td>
                                        <td class="font-bold text-primary">{{ $ec->name }}</td>
                                        @if($class->id >= 2)
                                        <td class="font-bold text-primary text-center" align="center" width="10">
                                            @if($ec->tronc == 1) <span class="badge badge_outlined badge_danger"> Oui </span> @else <span class="badge badge_outlined badge_primary"> Non </span> @endif
                                        </td>
                                        @endif
                                        <td class="text-center">
                                            <div class="badge badge_outlined badge_success font-bold">{{ $ec->coef}}</div>
                                        </td>
                                        <td>
                                          @if($ec->id_teacher > 0) @if($ec->teacher->sexe == 1) Mr. @else Mme. @endif {{ $ec->teacher->fname. ''.$ec->teacher->lname }} @else NULL @endif
                                        </td>
                                        <td>
                                        <div class="text-center">
                                            <a href="{{ URL::current().'/'.$ec->id.'/details-elements-constitutifs' }}" class="btn btn-icon btn_warning" style="color:#333;">
                                                <span class="la la-info-circle text-xl"></span>
                                            </a>
                                            <a href="{{URL::route('addTeacher_ec', [$ec->class_id, $ec->parcour_id, $ec->id])}}" class="btn btn-icon btn_primary ltr:ml-2 rtl:mr-2 font-bold">
                                                <span class="la la-chalkboard-teacher text-xl"></span>
                                            </a>
                                            @if($ec->status == 1)
                                            <a href="{{URL::route('edit_ec', [$ec->class_id, $ec->parcour_id.'/'.rtrim(strtr(base64_encode($ec->id), '+/', '-_'), '=')])}}" class="btn btn-icon btn_success ltr:ml-2 rtl:mr-2">
                                                <span class="la la-pen-fancy"></span>
                                            </a>
                                            @else
                                            <a href="{{URL::route('edit_ec', [$ec->class_id, $ec->parcour_id.'/'.rtrim(strtr(base64_encode($ec->id), '+/', '-_'), '=')])}}" class="btn btn-icon btn_danger ltr:ml-2 rtl:mr-2">
                                                <span class="la la-ban"></span>
                                            </a>
                                            @endif
                                            @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                            <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('remove_ec', $ec->id) }}" class="btn btn-icon  btn_danger ltr:ml-2 rtl:mr-2">
                                                <span class="la la-trash-alt"></span>
                                            </a>@endif @endif
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                            </div>
                        </div>
                    </div>
                    <br>
                 <div class="card relative p-5 mt-5">   
                    @if($class->short == 'L1')
                    <h3 class=""><span class="la la-check-square"></span>Semestre 2</h3>
                    @elseif($class->short == 'L2')
                    <h3 class=""><span class="la la-check-square"></span>Semestre 4</h3>
                    @elseif($class->short == 'L3')
                    <h3 class=""><span class="la la-check-square"></span>Semestre 6</h3>
                    @elseif($class->short == 'M1')
                    <h3 class=""><span class="la la-check-square"></span>Semestre 8</h3>
                    @elseif($class->short == 'M2')
                    <h3 class=""><span class="la la-check-square"></span>Semestre 10</h3>
                    @endif
                    <div class="rounded-xl mt-0">
                        <div>
                        <div class="p-5">
                        <table class="table-sorter table table_bordered w-full mt-0">
                        <thead>
                            <tr style="color:#3F3F46">
                                <th class="" width="140" style="text-align:center">Code</th>
                                <th class="ltr:text-left rtl:text-right" width="480">Matières (EC)</th>
                                @if($class->id >= 2)
                                <th style="text-align:center" width="100">Tronc Com</th>
                                @endif
                                <th style="text-align:center" width="100">Coef</th>
                                <th style="text-align:center">Enseignant</th>
                                <th class="text-center" width="210" style="text-align:center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ec_s2 as $key => $ec2)   
                            <tr>
                                <td class="font-bold text-primary" align="center" width=""><code>{{$ec2->codeEc}}</code></td>
                                <td class="font-bold text-primary">{{ $ec2->name }}</td>
                                @if($class->id >= 2)
                                <td class="font-bold text-primary text-center" align="center" width="">
                                    @if($ec2->tronc == 1) <span class="badge badge_outlined badge_danger"> Oui </span> @else <span class="badge badge_outlined badge_primary"> Non </span> @endif
                                </td>
                                @endif
                                <td class="text-center">
                                    <div class="badge badge_outlined badge_success font-bold">{{ $ec2->coef }}</div>
                                </td>
                                <td>
                                  @if($ec2->id_teacher > 0) @if($ec2->teacher->sexe == 1) Mr. @else Mme. @endif {{ $ec2->teacher->fname. ''.$ec2->teacher->lname }} @else NULL @endif
                                </td>
                                <td>
                                <div class="text-center">
                                    <a href="{{ URL::current().'/'.rtrim(strtr(base64_encode($ec2->codeEc), '+/', '-_'), '=').'/details-elements-constitutifs' }}" class="btn btn-icon btn_warning" style="color:#333;">
                                        <span class="la la-info-circle text-xl"></span>
                                    </a>
                                    <a href="{{URL::route('addTeacher_ec', [$ec2->class_id, $ec2->parcour_id.'/'.rtrim(strtr(base64_encode($ec2->id), '+/', '-_'), '=')])}}" class="btn btn-icon btn_primary ltr:ml-2 rtl:mr-2 font-bold">
                                        <span class="la la-chalkboard-teacher text-xl"></span>
                                    </a>
                                    @if($ec2->status == 1)
                                    <a href="{{URL::route('edit_ec', [$ec2->class_id, $ec2->parcour_id.'/'.rtrim(strtr(base64_encode($ec2->id), '+/', '-_'), '=')])}}" class="btn btn-icon btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @else
                                    <a href="{{URL::route('edit_ec', [$ec2->class_id, $ec2->parcour_id.'/'.rtrim(strtr(base64_encode($ec2->id), '+/', '-_'), '=')])}}" class="btn btn-icon btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-ban"></span>
                                    </a>
                                    @endif
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('remove_ec', $ec2->id) }}" class="btn btn-icon  btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-trash-alt"></span>
                                    </a>@endif @endif
                                </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    </div>
                </div>
            </div>  
        </div>
@include('components.pages.footer')  
@section('js')
<script type="text/javascript">
 $('#parcour').select2();
</script>
<script type="text/javascript">
function goToNext(c) {
  if(c.value != '') {
    window.location = '/admin/element_constitutif/{{ $class->id}}/'+c.value;
  }
}
</script>
@endsection      
</main>
@include('admin.pedagogie.EC.modalForm') 
@stop