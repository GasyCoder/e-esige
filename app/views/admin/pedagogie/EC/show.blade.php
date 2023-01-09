@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') EC-parcours-{{$elements->parcour->name}} @stop
@section('content')  
    <!-- Workspace -->
    <main class="workspace workspace_with-sidebar">
        <!-- Breadcrumb -->
<section class="breadcrumb lg:flex items-start">
<div>
@include('components.break')
</div>
</section>
@include('components.alerts') 
        <!-- Layout -->
        <div class="flex gap-x-2 mb-1">
            <a href="{{URL::route('indexEc')}}" class="btn btn-icon btn-icon_large btn_outlined btn_primary">
                <span class="la la-undo"></span>
            </a>
        </div>
        <!-- List data selected -->
        <div class="container flex items-center justify-center mb-2 px-4 py-3">
        <div class="border border-dashed p-4 flex flex-wrap gap-2 mt-5">  
            <div class="flex flex-wrap gap-2 px-5">
                <span class="badge badge_success">
                    <span class="la la-check-square text-xl leading-none ltr:mr-1 rtl:ml-1"></span>
                    Niveau: {{$elements->niveau->name}}
                </span>
                <span class="badge badge_success">
                    <span class="la la-check-square text-xl leading-none ltr:mr-1 rtl:ml-1"></span>
                    Parcours: {{$elements->parcour->name}}
                </span>
            </div>
        </div>
        </div>
        <div class="flex flex-col gap-y-5 ">
            <div class="card relative p-5">
                <div class="lg:absolute top-0 ltr:right-0 rtl:left-0 lg:mt-3 lg:ltr:mr-5 lg:rtl:ml-0 mb-5 lg:flex items-center justify-end ltr:text-right rtl:text-left">
                    <button data-toggle="modal" data-target="#grouper" class="badge badge_primary badge_success"><span class="la la-users text-2xl leading-none ltr:mr-1 rtl:ml-1"></span> Grouper</button>
                </div>
                    <div class="accordion rounded-xl mt-2">
                        <div id="faqs-1-3" class="collapse open">
                        <div class="p-5">
                        <table class="table table_bordered w-full mt-0">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right ">ID</th>
                                <th class="ltr:text-left rtl:text-right">Matières</th>
                                <th class="ltr:text-left rtl:text-right ">Abreviation</th>
                                <th class="ltr:text-left rtl:text-right ">Volume Horaire</th>
                                <th class="ltr:text-left rtl:text-right ">Coeficient</th>
                                <th class="ltr:text-left rtl:text-right ">Parcours tronc commun</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $elements = EC::where('class_id', $elements->class_id)
                                            ->where('parcour_id', $elements->parcour_id)
                                            ->orderBy('id', 'desc')->get(); 
                            ?>
                            @foreach($elements as $el)
                            <tr>
                                <td class="font-bold">{{$el->id}}</td>
                                <td class="font-bold">
                                {{$el->name}} {{$el->niveau->short}}
                                </td>
                                <td class="font-bold">{{$el->abr}}</td>
                                <td class="font-bold">{{$el->volH}}</td>
                                <td class="font-bold">{{ $el->coef }}</td>
                                <td class="font-bold">
                                @foreach($troncs as $tronc)
                                   <span class="badge badge_primary badge_success"> {{$tronc->parcour->name}}</span>
                                @endforeach
                                </td>
                               <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{url ()}}/admin/element_constitutifs?id={{$el->id}}" class="btn btn-icon btn_outlined btn_secondary ltr:ml-5 rtl:mr-5">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::current() . '?id=' . $el->id }}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
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
        <br>
@section('js')
<script type="text/javascript">
 $('#parcour').select2();
</script>
@endsection
@include('components.pages.footer')        
    </main>
    <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>
        <!-- Status -->
        <h3 class="p-5">Unité d'Enseignement</h3>
        <hr>
        <div class="flex flex-col gap-y-5 p-5">
        <div class="flex gap-2 p-2">   
        <button class="badge badge_primary badge_success"><span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span> {{ $el->ue->name }}</button>
        </div>
        </div>
    </aside>

<!-- Modal Add -->
<div id="grouper" class="modal" data-animations="fadeInDown, fadeOutUp" data-static-backdrop>
        <div class="modal-dialog modal-dialog_centered max-w-2xl">
            <div class="modal-content w-full">
                <div class="modal-header">
                    <h3 class="modal-title">Regrouper EC</h3>
                    <button type="button" onclick="refresh();" class="close la la-times" data-dismiss="modal"></button>
                </div>
           <div class="modal-body">     
                    <form method="post" action="{{ URL::current() }}">       
                        <div class="custom-select mt-2">
                            <div class="mb-5">
                                    <label class="label block mb-2" for="class1">Ajouter matières tronc communs</label>
                               <select name="element_id" id="element"  class="form-control">
                                    <option disabled>-- Choisir Matières --</option>
                                      @foreach($elements as $ec)
                                            <option value="{{$ec->id}}">{{ $ec->name }}</option>
                                      @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="custom-select mt-2">
                            <div class="mb-5">
                             <?php $parcours = Parcour::where('class_id', $el->class_id)->where('id', '!=', $el->parcour_id)->where('status', 1)->get(); ?>   
                            <label class="label block mb-2" for="parcour">Ajouter parcour</label>
                               <select name="parcour_id[]" id="parcour"  class="form-control" multiple="multiple">
                                    <option disabled>-- Choisir Parcours --</option>
                                      @foreach($parcours as $parcour)
                                            <option value="{{ $parcour->id}}">{{ $parcour->name }}</option>
                                      @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <button class="btn btn_primary uppercase ltr:ml-auto rtl:mr-0">Regrouper</button>
                        </div>
                    </div>
                  </form>              
        </div>
    </div>

@stop