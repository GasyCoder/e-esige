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
@if(count($elements)>0)
        <div class="grid lg:grid-cols-3 gap-5">
        <!-- Content -->
        <div class="lg:col-span-2">
        <div class="flex gap-x-2 mb-0">
            <a href="/admin/element_constitutif/{{$class->id}}/{{$parcour->id}}" class="btn btn-icon btn-icon_large btn_outlined btn_primary">
                <span class="la la-undo"></span>
            </a>
        </div> 	
        <div class="container flex items-left justify-left mb-0 px-2 py-1 p-1 mt-3">  
            <div class="flex flex-wrap gap-2 px-2">
                <span class="badge badge_primary font-bold">
                    <span class="la la-check-square text-xl leading-none ltr:mr-1 rtl:ml-1"></span>
                    Classe: {{$class->name}}
                </span>
               
                <span class="badge badge_primary font-bold">
                    <span class="la la-check-square text-xl leading-none ltr:mr-1 rtl:ml-1"></span>
                    Parcour: {{$parcour->name}}
                </span>
            </div>
        </div>   

                <div class="card p-5 mt-5">
                    <table class="table table_bordered w-full mt-3">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right">Code EC</th>
                                <th class="ltr:text-left rtl:text-right">Tronc commun Parcours</th>
                                <th class="text-center">Rétiré</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                       @foreach($troncs as $list)   
                            <tr>
                                <td class="">{{ $list->matiere->codeEc }}</td>
                                <!--<td class="">
                                <?php/*@foreach($mats as $mat)
                                <span class="badge badge_info">{{$mat->matiere->name}}</span>
                                @endforeach*/?>
                                </td>-->
                                <td class="">
                                  <span class="badge badge_success">{{$list->parcour->name}}
                                    </span> 
                                </td>
                                <td>
                                <div class="text-center">
                                    <a onclick="return confirm('Ho fafana ao anatin\'ny lisitra matière tronc commun?')" href="{{ URL::route('delete_tronc', $list->id) }}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-trash-alt"></span>
                                    </a>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>   
            </div>
            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Ajouter parcour tronc commun</h3>
                 <form method="post" action="{{ URL::current() }}">       
                        <div class="custom-select mt-2">
                            <div class="mb-5">
                            <label class="label block mb-2" for="class1">Nom matière (EC)</label>
                               <select name="element_id" id="element"  class="form-control">
                                      @foreach($elements as $el)
                                            <option value="{{$el->id}}" selected class="font-bold">{{ $el->name }}</option>
                                      @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="custom-select mt-2">
                            <div class="mb-5">
                             <?php $parcours = Parcour::where('class_id', $class->id)->where('id', '!=', $parcour->id)->where('status', 1)->get(); ?>   
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
        </div>
        @else
<!-- Layout -->
<div class="flex gap-x-2 mb-5">
    <a href="/admin/element_constitutifs?class-id={{ $class->id }}/{{ $parcour->id }}" class="btn btn-icon btn-icon_large btn_outlined btn_primary">
        <span class="la la-undo"></span>
    </a>
</div>
<div class="alert alert_danger">
    <strong class="uppercase"><bdi>Désolé!</bdi></strong>
     Il n'y a pas des données disponible ici.  
    <button type="button" class="dismiss la la-times" data-dismiss="alert"></button>
</div>
@endif
@include('components.pages.footer')  
@section('js')
<script type="text/javascript">
 $('#parcour').select2();
</script>
@endsection      
</main>
@stop