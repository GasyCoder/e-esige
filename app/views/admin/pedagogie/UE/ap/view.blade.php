@extends('layouts.main')
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
        <div class="card p-4 flex flex-wrap gap-2">
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
                        <option value="" selected disabled>--Autre parcours--</option>
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
                   Parcours: {{$parcour->abr}}
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
        <!-- To UE -->
            <div class="card relative p-5 mt-5">
                    <div class="accordion rounded-xl mt-0">
                        <h3 class="border-t border-divider p-2 active" data-toggle="collapse" data-target="#faqs-1-3">
<span class="collapse-indicator la la-arrow-circle-down"></span>
                        </h3>
                        <div id="faqs-1-3" class="collapse open">
                        <div class="p-2">
                        <table class="table table_bordered w-full mt-0">
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
                        @foreach($ues as $key => $ue)       
                            <tr>
                                <td><code class="font-bold">{{$ue->codeUe}}</code></td>
                                <td class="font-bold text-primary"> 
                               {{$ue->name}}
                                </td>
                                <td class="font-bold">
                                 <?php $elements = EC::where('codeUe', $ue->codeUe)
                                                       ->where('parcour_id', $ue->parcour_id)
                                                       ->where('class_id', $ue->class_id)
                                                       ->orderBy('id', 'desc')->get();?>
                                   @foreach($elements as $el)
                                   @if(count($elements) >= 1) 
                                   @if($el->tronc == 1) 
                                    <a href="/admin/element_constitutif/{{$ue->class_id}}/{{$ue->parcour_id}}{{'/'.rtrim(strtr(base64_encode($el->codeEc), '+/', '-_'), '=').'/details-elements-constitutifs' }}" class="badge badge_warning text-primary">
                                        {{ $el->name }}
                                    </a>
                                    @else
                                    <a href="/admin/element_constitutif/{{$ue->class_id}}/{{$ue->parcour_id}}{{'/'.rtrim(strtr(base64_encode($el->codeEc), '+/', '-_'), '=').'/details-elements-constitutifs' }}" class="badge badge_info">
                                        {{ $el->name }}
                                    </a>
                                    @endif
                                    @else
                                    <span class="badge badge_secondary">Aucun element constitutif pour le moment</span>
                                    @endif
                                   @endforeach   
                                </td>
                                <td class="font-bold text-center">
                                    <div class="badge badge_success font-bold">{{$ue->credit}}</div>
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
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('remove_ec', $ue->id) }}" class="btn btn-icon  btn_danger ltr:ml-2 rtl:mr-2">
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
    window.location = '/admin/ue/{{ $class->id}}/'+c.value;
  }
}
</script>
@endsection        
</main>
@include('admin.pedagogie.UE.ap.add') 
@stop