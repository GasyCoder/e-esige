@extends('layouts.master')
<?php 
$path = Session::get('language'); 
?>
@include('components.timeAgo')
@section('title') {{$title}} - {{$element->name}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
@include('components.alerts')
         <div class="flex gap-x-2 mb-1">
            <a href="/admin/element_constitutif/{{$class->id}}/{{$parcour->id}}" class="btn btn-icon btn-icon_large btn_outlined btn_primary">
                <span class="la la-undo"></span>
            </a>
        </div>   
        @if($element->id_teacher > 0)
        <section class="breadcrumb lg:flex items-start">
           <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
                <div class="flex gap-x-2">
                <div class="avatar w-16 h-16 ltr:mr-5 rtl:ml-5">
                <div class="status bg-success"></div>
                @if(!empty($teacher->image))
                <?php echo HTML::image('uploads/profiles/teacher/'.$teacher->image.'', '', ['class'=>'', 'width'=>'180','height'=>'80']) ?>
                @elseif($teacher->sexe == 1)
                {{ HTML::image('public/assets/avatar/teacher_1.png', '', ['class'=>'', 'width'=>'','height'=>'']) }}
                 @else {{ HTML::image('public/assets/avatar/teacher_2.png', '', ['class'=>'', 'width'=>'','height'=>'50']) }}
                @endif
                </div>
                <div>
                <h5>@if($teacher->sexe == 1) Mr. @else Mme. @endif {{$teacher->fname}} {{$teacher->lname}}</h5>
                <p>Enseignant @if($teacher->sexe == 2) e @endif </p>
                </div>
                </div>
            </div>             
        </section> 
        @endif
<!-- List -->
        <div class="card p-5 mt-5">
            <div class="overflow-x-auto">
                <table class="table table-auto table_hoverable w-full">
                    <thead>
                        <tr style="color:#3F3F46">
                            <th class="ltr:text-left rtl:text-right">Code </th>
                            <th class="ltr:text-left rtl:text-right">Elements Constitutifs (EC)</th>
                            <th class="" style="text-align:center">Volume H</th>
                            <th class="" style="text-align:center">Coéf</th>
                            <th class="" style="text-align:center">Abr</th>
                            @if($class->id >= 2)
                            <th class="" style="text-align:center">Tronc</th>
                            @endif
                            <th class="" style="text-align:center">Niveau</th>
                            @if($class->id >= 2)
                            <th class="" style="text-align:center">Parcours</th>
                            @endif
                            <th class="" style="text-align:center">Semestre</th>
                            <th class="" style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($matieres as $matiere)
                        <?php 
                        $teacher = Teacher::where('id', $matiere->id_teacher)->first();
                        ?>
                        <tr>
                            <td class="text-primary font-bold">
                            <code>{{ $matiere->codeEc }}</code>
                            </td>
                            <td class="text-primary font-bold">
                            {{$matiere->name}}
                            </td>
                            <td class="text-center"><div class="badge badge_success font-bold">{{ $matiere->volH }}</div></td>
                            <td class="text-center"><div class="badge badge_success font-bold">{{ $matiere->coef }}</div></td>
                            <td class="text-center"><div class="badge badge_success font-bold">{{ $matiere->abr }}</div>
                            </td>
                            @if($class->id >= 2)
                            <td class="font-bold text-primary text-center">
                                @if($matiere->tronc == 1) <span class="badge badge_outlined badge_danger"> Oui </span> @else <span class="badge badge_outlined badge_primary"> Non </span> @endif
                            </td>
                            @endif
                             <td class="text-center"><div class="badge badge_success font-bold">{{ $matiere->niveau->short }}</div>
                            </td>
                            @if($class->id >= 2)
                            <td class="text-center"><div class="badge badge_success font-bold">{{ $matiere->parcour->abr }}</div>
                            </td>
                            @endif
                            <td class="text-center"><div class="badge badge_success font-bold">{{ $matiere->semestre }}</div>
                            </td>
                            <td class="whitespace-nowrap text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{URL::route('edit_ec', [$matiere->class_id, $matiere->parcour_id.'/'.rtrim(strtr(base64_encode($matiere->id), '+/', '-_'), '=')])}}" class="btn btn_outlined btn-icon btn_success">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('remove_ec', $matiere->id) }}" class="btn btn_outlined btn-icon btn_danger ltr:ml-2 rtl:mr-2">
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
            Niveau : 
            <span class="badge badge_info ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
            {{$egale->niveau->short}}    
            </span>
        </a>
        <a href="" class="flex items-center text-normal">
            <span class="la la-random text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
            Parcours : 
            <span class="badge badge_danger ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
            {{$egale->parcour->abr}}  
            </span>
        </a>
        </div>
        @endforeach
        @endif

        @if(count($troncs) > 0)
        <hr class="border-dashed">
         <h4 class="p-0">Tronc commun autre niveaux et parcours</h4>
         @foreach($troncs as $tronc)
         <div>
         <a href="" class="flex items-center text-normal">
            <span class="la la-random text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
            Niveau : 
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
        </div>
        <hr class="border-dashed">
        <h3 class="p-5">Unité d'enseignement</h3>
        <hr class="border-dashed">
        <div class="flex flex-col gap-y-5 p-5" style="background-color:#FEF2F2">
             <h3 class="p-0 text-sm">       
                <u class="uppercase">{{$unite->name }}</u>
             </h3>
            <a href="" class="flex items-center text-normal">
                <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                Code UE : 
                <span class="badge badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">
                {{$element->codeUe}}   
                </span>
            </a>
        </div>
    </aside>
@stop