@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Element Constitutifs @stop
@section('content')
    <main class="workspace">
        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
@include('components.break')
            </div>
        </section>   
<div class="breadcrumb breadcrumb_alt p-3 flex flex-wrap gap-2 mt-2">  
            <a href="{{URL::route('indexEc')}}" class="btn btn_outlined btn_primary">
                <span class="la la-undo text-xl leading-none ltr:mr-1 rtl:ml-1"></span>
                Retour
            </a>
            <div class="flex flex-wrap gap-2 ltr:ml-auto rtl:mr-auto"> 
                <a href="{{URL::route('AddtroncCommun', $class->id)}}" class="badge badge_primary badge_success font-bold"><span class="la la-plus-square text-2xl leading-none ltr:mr-2 rtl:ml-2"></span> Ajouter EC tronc communs</a> 
            </div>
        </div>
@if(count($parcours)>0)
        <div class="card p-5">
            <div class="overflow-x-auto">
                <table class="table-sorter table table-auto table_hoverable w-full">
                    <thead>
                        <tr style="color:#3F3F46">
                           <th class="ltr:text-left rtl:text-right ">ID</th>
                            <th class="ltr:text-left rtl:text-right ">Parcours </th>
                            <th class="" style="text-align:center">Total matières (EC)</th>
                            <th class="" style="text-align:center">Matières tronc commun</th>                  
                            <th class="text-center" style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($parcours as $key => $parcour)
                        <tr>
                           <td>{{$parcour->id }}</td>
                           <td class="font-bold text-primary"><a href="{{URL::route('addnew', [$class->id,$parcour->id])}}">{{$parcour->name }}</a></td>
                           <td class="text-center">
                            <?php $elements  = EC::where('tronc', 0)->where('status', 1)->where('class_id', $class->id)
                                                                     ->where('parcour_id', $parcour->id)->get();
                            ?>
                               @if(count($elements) > 0)
                               <span class="badge badge_success">{{count($elements)}}</span>
                               @else
                               <span class="badge badge_outlined badge_secondary"> 0 
                               @endif
                           </td>
                           <td class="text-center">
                            <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                               <?php $socle  = EC::where('tronc', 1)
                                                    ->where('status', 1)
                                                    ->where('class_id', $class->id) 
                                                    ->where('parcour_id', $parcour->id)               
                                                    ->get();
                                ?>
                               @if(count($socle) > 0)
                              <span class="badge badge_danger">{{count($socle)}}</span>
                               @else
                               <span class="badge badge_outlined badge_secondary"> 0 
                               @endif
                            </div>   
                           </td>
                            <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{URL::route('addnew', [$class->id,$parcour->id])}}" class="badge badge_success ltr:ml-2 rtl:mr-2">
                                      <span class="la la-plus-circle"></span> Ajouter
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
 $('#parcour').select2();
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
                <span class="badge badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
                    {{ $class->name}}
                </span>
            </a>
            <a href="#" class="flex items-center text-normal">
                <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                Total parcours
                <?php $all_parcours = Parcour::where('class_id', $class->id)->where('status', 1)->count() ?>
                <span class="badge badge_success ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
                   {{ $all_parcours}}
                </span>
            </a>
        </div>
    </aside>
@else
<br>
<div class="alert alert_danger">
<strong class="uppercase"><bdi>Désolé!</bdi></strong>
 Il n'y a pas des données disponible ici. Veuillez insérer votre <b><a href="{{URL::route('indexParcour')}}" class="underline">parcours</a></b>.  
<button type="button" class="dismiss la la-times" data-dismiss="alert"></button>
</div>
@endif
@stop