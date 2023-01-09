@extends('layouts.master')
<?php 
$path = Session::get('language'); 
$uex = UE::where('class_id', $class->id)
                        ->where('parcour_id', $parcour->id)
                        ->where('status', 1)->get();
?>
@include('components.timeAgo')
@section('title') {{$title}} - {{$element}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
@include('components.alerts')
         <div class="flex gap-x-2 mb-1">
            <a href="/admin/element_constitutif/{{$class->id}}/{{$parcour->id}}" class="btn btn-icon btn-icon_large btn_outlined btn_primary">
                <span class="la la-undo"></span>
            </a>
        </div>    
<!-- List -->
        <div class="card p-5 mt-5">
            <div class="overflow-x-auto">
                <table class="table table-auto table_hoverable w-full">
                    <thead>
                        <tr style="color:#3F3F46">
                            <th class="ltr:text-left rtl:text-right">Code</th>
                            <th class="ltr:text-left rtl:text-right">Elements Constitutifs (EC)</th>
                            <th class="" style="text-align:center">Volume H</th>
                            <th class="" style="text-align:center">Coéf</th>
                            <th class="" style="text-align:center">Abréviation</th>
                            @if($class->id >= 2)
                            <th class="" style="text-align:center">Tronc commun</th>
                            @endif
                            <th class="" style="text-align:center">Classe</th>
                            @if($class->id >= 2)
                            <th class="" style="text-align:center">Parcour</th>
                            @endif
                            <th class="" style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    	
                        <tr>
                            <td class="text-primary font-bold">
                            <code>{{ $element->codeEc }}</code>
                            </td>
                            <td class="text-primary font-bold">
                            {{$element->name}}
                            </td>
                            <td class="text-center"><div class="badge badge_success font-bold">{{ $element->volH }}</div></td>
                            <td class="text-center"><div class="badge badge_success font-bold">{{ $element->coef }}</div></td>
                            <td class="text-center"><div class="badge badge_success font-bold">{{ $element->abr }}</div>
                            </td>
                            @if($class->id >= 2)
                            <td class="font-bold text-primary text-center">
                                @if($element->tronc == 1) <span class="badge badge_outlined badge_danger"> Oui </span> @else <span class="badge badge_outlined badge_primary"> Non </span> @endif
                            </td>
                            @endif
                             <td class="text-center"><div class="badge badge_success font-bold">{{ $element->niveau->short }}</div>
                            </td>
                            @if($class->id >= 2)
                            <td class="text-center"><div class="badge badge_success font-bold">{{ $element->parcour->abr }}</div>
                            </td>
                            @endif
                            <td class="whitespace-nowrap text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{URL::route('edit_ec', [$element->class_id, $element->parcour_id.'/'.rtrim(strtr(base64_encode($element->id), '+/', '-_'), '=')])}}" class="btn btn_outlined btn-icon btn_success">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('remove_ec', $element->id) }}" class="btn btn_outlined btn-icon btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-trash-alt"></span>
                                    </a>@endif @endif
                                </div>
                            </td>
                        </tr>
                 
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
        <!-- Status -->
        <h3 class="p-5">Informations</h3>
        <div class="flex flex-col gap-y-5 p-5">
        @if(count($troncs_egale) >= 1)   
         <h4 class="p-0">Tronc commun différentes parcours</h4>
         @foreach($troncs_egale as $egale)
            <div style="background-color:#F7FEE7">
        <a href="" class="flex items-center text-normal">
            <span class="la la-random text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
            Classe : 
            <span class="badge badge_info ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
            {{$egale->niveau->name}}    
            </span>
        </a>
        <a href="" class="flex items-center text-normal">
            <span class="la la-random text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
            Parcour : 
            <span class="badge badge_danger ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
            {{$egale->parcour->name}}  
            </span>
        </a>
        </div>
        @endforeach
        @endif

        @if(count($troncs) > 0)
        <hr class="border-dashed">
         <h4 class="p-0">Tronc commun autre classes et parcours</h4>
         @foreach($troncs as $tronc)
         <div>
         <a href="" class="flex items-center text-normal">
            <span class="la la-random text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
            Classes : 
            <span class="badge badge_info ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
            {{$tronc->niveau->name}}    
            </span>
         </a>
         <a href="" class="flex items-center text-normal">
            <span class="la la-random text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
            Parcours : 
            <span class="badge badge_danger ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
            {{$tronc->parcour->name}}    
            </span>
         </a>
     </div>
         @endforeach
        @endif
        <hr class="border-dashed">
        </div>
        <h3 class="p-5">Unité d'enseignement</h3>
        <?php $unites = UE::where('class_id', $class->id)
                        ->where('parcour_id', $parcour->id)
                        ->where('codeUe', $element->codeUe)
                        ->where('status', 1)->get();
        ?>
        <hr class="border-dashed">
        <div class="flex flex-col gap-y-5 p-5" style="background-color:#FEF2F2">
        	 <h3 class="p-0 text-sm">      
        	  @foreach($unites as $item)   
		         <u class="uppercase">{{ $item->name }}</u>
		      @endforeach
		     </h3>
	        <a href="" class="flex items-center text-normal">
		        <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
		        Code UE : 
		        <span class="badge badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
		        {{$item->codeUe}}	
		        </span>
		    </a>
        </div>
       <h3 class="p-5">Enseignant</h3>
        <hr class="border-dashed">
        <div class="flex flex-col gap-y-5 p-5" style="background-color:#FEF2F2">
            <a href="" class="flex items-center text-normal">
                <span class="la la-chalkboard-teacher text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
              
        </div>
    </aside>
@stop