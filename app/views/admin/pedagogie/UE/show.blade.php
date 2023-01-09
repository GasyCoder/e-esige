@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') UE-{{$parcour->name}}-{{$class->name}} @stop
@section('content')  
    <!-- Workspace -->
    <main class="workspace workspace_with-sidebar">
        <!-- Breadcrumb -->
<section class="breadcrumb lg:flex items-start">
<div>
@include('components.break')
</div>
</section>
        <!-- Actions -->
        <div class="breadcrumb breadcrumb_alt p-3 flex flex-wrap gap-2">
            @if($class->id == 1)
            <a href="/admin/ue/unite_enseignements" class="btn btn_primary">
                <span class="la la-undo text-xl leading-none ltr:mr-1 rtl:ml-1"></span>
                Retour
            </a>
            @else
            <a href="/admin/ue/unite_enseignements/{{$class->id}}" class="btn btn_primary">
                <span class="la la-undo text-xl leading-none ltr:mr-1 rtl:ml-1"></span>
                Retour
            </a>
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
            @endif
            <div class="flex flex-wrap gap-2 ltr:ml-auto rtl:mr-auto">

            @if($class->id == 1)    
            <span class="badge badge_outlined badge_warning font-bold" style="color:#475569">
                    Niveau: {{$class->name}}
            </span>
            <button data-toggle="modal" data-target="#add" class="btn btn_success">
                    <span class="la la-plus-circle text-xl leading-none ltr:mr-0 rtl:ml-0"></span>
                    Ajouter nouveau UE
            </button>
            @if(count($ues)> 0)
             <a href="{{URL::route('print_ue', [$class->id, $parcour->id])}}" target="_blank" class="btn btn_secondary">
                    <span class="la la-print text-xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Mode Impression
            </a>
            @endif

            @else
             <span class="badge badge_outlined badge_warning text-gray-700 font-bold" style="color:#333">
                   Parcour: {{$parcour->abr}}
            </span>
            <span class="badge badge_outlined badge_primary font-bold">
                    Niveau: {{$class->short}}
            </span>
            <button data-toggle="modal" data-target="#add" class="btn btn_success">
                    <span class="la la-plus-circle text-xl leading-none ltr:mr-0 rtl:ml-0"></span>
                    Ajouter nouveau UE
            </button>
            @if(count($ues)> 0)
             <a href="{{URL::route('print_ue', [$class->id, $parcour->id])}}" target="_blank" class="btn btn_secondary">
                    <span class="la la-print text-xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Mode Impression
            </a>
            @endif

            @endif
            </div>
        </div> 

        @if($class->id == 1)
                    <div class="card relative p-5 mt-5">
                    <div class="accordion rounded-xl mt-0">
                        <h3 class="border-t border-divider p-2 active" data-toggle="collapse" data-target="#faqs-1-3">
<span class="collapse-indicator la la-arrow-circle-down"></span>
                        </h3>
                        <div id="faqs-1-3" class="collapse open">
                        <div class="p-2">
                        <table class="table-sorter table table_bordered w-full mt-0">
                        <thead>
                            <tr style="color:#3F3F46">
                                <th class="ltr:text-left rtl:text-right">Code UE</th>
                                <th class="ltr:text-left rtl:text-right">Unités d'enseignement (UE)</th>
                                <th class="ltr:text-left rtl:text-right">Matières (EC)</th>
                                <th class="" style="text-align:center">Crédits</th>
                                <th class="" style="text-align:center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($ueAp as $ap)       
                            <tr>
                                <td><code class="font-bold">{{$ap->codeUe}}</code></td>
                                <td class="font-bold text-primary"> 
                               {{$ap->name}}
                                </td>
                                <td class="font-bold">
                                 <?php $elements = EC::where('codeUe', $ap->codeUe)
                                                       ->where('parcour_id', $ap->parcour_id)
                                                       ->where('class_id', $ap->class_id)
                                                       ->orderBy('id', 'desc')->get();?>
                                   @foreach($elements as $el)
                                   @if(count($elements) >= 1) 
                                   @if($el->tronc == 1) 
                                    <a href="/admin/element_constitutif/{{$ap->class_id}}/{{$ap->parcour_id}}{{'/'.rtrim(strtr(base64_encode($el->codeEc), '+/', '-_'), '=').'/details-elements-constitutifs' }}" class="badge badge_warning text-primary">
                                        {{ $el->name }}
                                    </a>
                                    @else
                                    <a href="/admin/element_constitutif/{{$ap->class_id}}/{{$ap->parcour_id}}{{'/'.rtrim(strtr(base64_encode($el->codeEc), '+/', '-_'), '=').'/details-elements-constitutifs' }}" class="badge badge_info">
                                        {{ $el->name }}
                                    </a>
                                    @endif
                                    @else
                                    <span class="badge badge_secondary">Aucun element constitutif pour le moment</span>
                                    @endif
                                   @endforeach   
                                </td>
                                <td class="font-bold text-center">
                                    <div class="badge badge_secondary font-bold">{{$ap->credit}}</div>
                                </td>
                                <td class="font-bold">
                                    <div class="text-center">
                                    @if($ap->status = 1)
                                    <a href="{{ URL::current().'/'.rtrim(strtr(base64_encode($ap->id), '+/', '-_'), '=').'/edit' }}" class="btn btn-icon btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @else
                                    <a href="{{ URL::current().'/'.rtrim(strtr(base64_encode($ap->id), '+/', '-_'), '=').'/edit' }}" class="btn btn-icon btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-ban"></span>
                                    </a>
                                    @endif
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('remove_ec', $ap->id) }}" class="btn btn-icon  btn_danger ltr:ml-2 rtl:mr-2">
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
            @else
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
                        <h3 class="border-t border-divider p-2 active" data-toggle="collapse" data-target="#faqs-1-3">
                        <span class="collapse-indicator la la-arrow-circle-down"></span>
                        </h3>
                        <div id="faqs-1-3" class="collapse open">
                        <div class="p-2">
                        <table class="table-sorter table table_bordered w-full mt-0">
                        <thead>
                            <tr style="color:#3F3F46">
                                <th class="ltr:text-left rtl:text-right">Code UE</th>
                                <th class="ltr:text-left rtl:text-right">Unités d'enseignement (UE)</th>
                                <th class="ltr:text-left rtl:text-right">Matières (EC)</th>
                                <th class="" style="text-align:center">Choix</th>
                                <th class="" style="text-align:center">Tronc Commun</th>
                                <th class="" style="text-align:center">Crédits</th>
                                <th class="" style="text-align:center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($ues as $ue)       
                            <tr>
                                <td><code class="font-bold">{{$ue->codeUe}}</code></td>
                                <td class="font-bold text-primary"> 
                                {{$ue->name}}
                                </td>
                                <td class="font-bold">
                                <?php $elements = EC::where('codeUe', $ue->codeUe)
                                                    ->where('parcour_id', $ue->parcour_id)
                                                    ->where('class_id', $ue->class_id)
                                                    ->orderBy('id', 'desc')->get();
                                ?>
                                @foreach($elements as $el)
                                   @if($el->tronc == 1) 
                                    <a href="/admin/element_constitutif/{{$ue->class_id}}/{{$ue->parcour_id}}{{'/'.rtrim(strtr(base64_encode($el->codeEc), '+/', '-_'), '=').'/details-elements-constitutifs' }}" class="badge badge_warning text-primary">
                                        {{ $el->name }}
                                    </a>
                                    @else
                                    <a href="/admin/element_constitutif/{{$ue->class_id}}/{{$ue->parcour_id}}{{'/'.rtrim(strtr(base64_encode($el->codeEc), '+/', '-_'), '=').'/details-elements-constitutifs' }}" class="badge badge_info">
                                        {{ $el->name }}
                                    </a>
                                    @endif
                                @endforeach   
                                </td>
                                @if($ue->choix == 1) 
                                <td class="font-bold text-center">
                                    <span class="badge badge_success font-bold">Obligatoire</span>
                                </td>
                                @else
                                 <td class="font-bold text-center">
                                    <span class="badge badge_danger font-bold">Facultatif</span> 
                                </td>
                                @endif
                                @if($ue->tronc == 0) 
                                <td class="font-bold text-center">
                                    <span class="badge badge_success font-bold">Non</span>
                                </td>
                                @else
                                 <td class="font-bold text-center">
                                    <span class="badge badge_danger font-bold">Oui</span> 
                                </td>
                                @endif
                                <td class="font-bold text-center">
                                    <div class="badge badge_secondary font-bold">{{$ue->credit}}</div>
                                </td>
                                <td class="font-bold">
                                    <div class="text-center">
                                    @if($ue->status = 1)
                                    <a href="{{ URL::current().'/'.rtrim(strtr(base64_encode($ue->id), '+/', '-_'), '=').'/edit' }}" class="btn btn-icon btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @else
                                    <a href="{{ URL::current().'/'.rtrim(strtr(base64_encode($ue->id), '+/', '-_'), '=').'/edit' }}" class="btn btn-icon btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-ban"></span>
                                    </a>
                                    @endif
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('deleteUe', $ue->id) }}" class="btn btn-icon  btn_danger ltr:ml-2 rtl:mr-2">
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
            
            <div class="card relative p-5">
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
                        <div class="p-2">
                        <table class="table-sorter table table_bordered w-full mt-0">
                        <thead>
                            <tr style="color:#3F3F46">
                                <th class="ltr:text-left rtl:text-right">Code</th>
                                <th class="ltr:text-left rtl:text-right">Unité d'enseignements (UE)</th>
                                <th class="ltr:text-left rtl:text-right">Matières (EC)</th>
                                <th class="" style="text-align:center">Choix</th>
                                <th class="" style="text-align:center">Tronc Commun</th>
                                <th class="" style="text-align:center">Crédits</th>
                                <th class="" style="text-align:center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($ues2 as $s_2)        
                            <tr>
                                <td><code class="font-bold">{{$s_2->codeUe}}</code></td>
                                <td class="font-bold text-primary"> {{$s_2->name}}</td>
                                <td class="font-bold">
                                    <?php $elements = EC::where('codeUe', $s_2->codeUe)
                                                       ->where('parcour_id', $s_2->parcour_id)
                                                       ->where('class_id', $s_2->class_id)
                                                       ->orderBy('id', 'desc')->get();
                                    ?>
                                @foreach($elements as $el)
                                   @if($el->tronc == 1) 
                                    <a href="/admin/element_constitutif/{{$s_2->class_id}}/{{$s_2->parcour_id}}{{'/'.rtrim(strtr(base64_encode($el->codeEc), '+/', '-_'), '=').'/details-elements-constitutifs' }}" class="badge badge_warning text-primary">
                                        {{ $el->name }}
                                    </a>
                                    @else
                                    <a href="/admin/element_constitutif/{{$s_2->class_id}}/{{$s_2->parcour_id}}{{'/'.rtrim(strtr(base64_encode($el->codeEc), '+/', '-_'), '=').'/details-elements-constitutifs' }}" class="badge badge_info">
                                        {{ $el->name }}
                                    </a>
                                    @endif
                                @endforeach   
                                </td>

                                 @if($s_2->choix == 1) 
                                <td class="font-bold text-center">
                                    <span class="badge badge_success font-bold">Obligatoire</span>
                                </td>
                                @else
                                 <td class="font-bold text-center">
                                    <span class="badge badge_danger font-bold">Facultatif</span> 
                                </td>
                                @endif
                                @if($s_2->tronc == 0) 
                                <td class="font-bold text-center">
                                    <span class="badge badge_success font-bold">Non</span>
                                </td>
                                @else
                                 <td class="font-bold text-center">
                                    <span class="badge badge_danger font-bold">Oui</span> 
                                </td>
                                @endif
                                <td class="font-bold text-center">
                                    <div class="badge badge_secondary font-bold">{{$s_2->credit}}</div>
                                </td>

                                <td class="font-bold">
                                    <div class="text-center">
                                    @if($s_2->status = 1)
                                    <a href="{{ URL::current().'/'.rtrim(strtr(base64_encode($s_2->id), '+/', '-_'), '=').'/edit' }}" class="btn btn-icon btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @else
                                    <a href="{{ URL::current().'/'.rtrim(strtr(base64_encode($s_2->id), '+/', '-_'), '=').'/edit' }}" class="btn btn-icon btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-ban"></span>
                                    </a>
                                    @endif
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('deleteUe', $s_2->id) }}" class="btn btn-icon  btn_danger ltr:ml-2 rtl:mr-2">
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
            
        @endif
        </div>
@include('components.pages.footer')
@section('js')
<script type="text/javascript">
 $('#parcour').select2();
</script>
<script type="text/javascript">
function goToNext(c) {
  if(c.value != '') {
    window.location = '/admin/ue/{{ $class->id}}/'+c.value;
  }
}
</script>
@endsection        
</main>
@include('admin.pedagogie.UE.formAdd') 
@stop