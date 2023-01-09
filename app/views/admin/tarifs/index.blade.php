@extends('layouts.master')
<?php 
$path = Session::get('language'); 
$control = Control::find(1);
?>
@section('title') Tarif d'écolage par niveau @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
<section class="breadcrumb">        
@include('components.break')
</section>
        <div class="grid lg:grid-cols-3 gap-5">
            <!-- Content -->
        @include('components.alerts')    
            <div class="lg:col-span-2">
            <div class="card p-5">
                    <table class="table table_striped w-full mt-3">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right ">#</th>
                                <th class="ltr:text-left rtl:text-right ">Niveau</th>
                                <th class="ltr:text-left rtl:text-right ">Ecolage</th>
                                <th class="ltr:text-left rtl:text-right ">Droit d'inscription</th>
                                <th class="ltr:text-left rtl:text-right ">Montant Total</th>
                                <th class="ltr:text-left rtl:text-right ">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tarifs as $tarif)
                            <tr>
                                <td>{{ $tarif->id }}</td>
                                <td>{{ $tarif->niveau->name }}</td>
                                <td>{{ $tarif->ecolage . '' .$control->payment_unit }}/mois</td>
                                <td>{{ $tarif->droit . '' .$control->payment_unit }}</td>
                                <td>{{ $tarif->total. '' .$control->payment_unit }}</td>
                                <td>
                                @if($tarif->status == 1)<div class="badge badge_outlined badge_success">Oui</div> @else <div class="badge badge_outlined badge_danger">Non</div> @endif
                                </td>
                                <td>
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{ URL::current() . '?id=' . $tarif->id }}" class="btn btn-icon btn_outlined btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('deletetarif', $tarif->id) }}" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2">
                                        <span class="la la-trash-alt"></span>
                                    </a>
                                    @endif @endif
                                </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    <?php 
    if (isset($_GET['id'])) { 
    $id = htmlspecialchars($_GET['id']);
    $getEcoT = Tarif::find($id);
    if ($getEcoT !== null) {  ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Modifier Prix d'écolage</h3>
                  <div id="resultajax2" class="center"></div>    
                   {{ Form::open(['route'=>['updatetarif',$getEcoT->id], 'class'=>'', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}    
                       <div class="mb-5">
                          <label class="label block mb-2" for="class_id">Niveau</label>
                         <div class="custom-select">
                          <select class="form-control" name="class_id" id="class_id">
                               @if(!empty($getEcoT->class_id))
                                <option value="{{ $getEcoT->class_id }}" selected class="text-red-700"><h5>{{ $getEcoT->niveau->short }}</h5>
                                </option>
                               @else
                                <option value="" selected disabled>Choisir *</option>
                               @endif
                               @foreach($classes as $class)
                                 <option value="{{ $class->id }}">{{ $class->short }}</option>
                               @endforeach
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="ecolage">Ecolage par mois</label>
                            <input id="ecolage" name="ecolage" value="{{$getEcoT->ecolage}}" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="droit">Droit d'inscription</label>
                            <input id="droit" name="droit" value="{{$getEcoT->droit}}" type="text" class="form-control">
                        </div>
                         <div class="mb-5">
                            <label class="label block mb-2" for="total">Montant total</label>
                            <input id="total" name="total" value="{{$getEcoT->total}}" type="text" class="form-control">
                        </div>
                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Status</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    @if($getEcoT->status == 1)
                                    <input type="checkbox" name="status" checked value="1">
                                    <span></span>
                                    <span>Activé</span>
                                    @else
                                    <input type="checkbox" name="status" value="0">
                                    <span></span>
                                    <span>Désactiver</span>
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button class="btn btn_primary uppercase">Metre à jour</button>
                        </div>
                      {{ Form::close() }}
@include('admin.tarifs.ajaxUp')
                </div>
            </div>

<?php } } else { ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Ajouter le prix d'écolage</h3>
                    <div id="resultajax" class="center"></div>
            {{ Form::open(['route'=>'storetarif', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator']) }} 
                        <div class="mb-5">
                          <label class="label block mb-2" for="class_id">Niveau</label>
                         <div class="custom-select">
                          <select class="form-control" name="class_id" id="class_id">
                            <option value="" disabled selected>--Choisir niveau--</option>   
                            @foreach($classes as $class)
                                 <option value="{{ $class->id }}">{{ $class->short }}</option>
                               @endforeach
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="ecolage">Ecolage par mois</label>
                            <input id="ecolage" name="ecolage" type="text" class="form-control">
                        </div>
                         <div class="mb-5">
                            <label class="label block mb-2" for="droit">Droit d'inscription</label>
                            <input id="droit" name="droit" type="text" class="form-control">
                        </div>
                         <div class="mb-5">
                            <label class="label block mb-2" for="title">Montant total</label>
                            <input id="total" name="total" type="text" class="form-control">
                        </div>
                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Status</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    <input type="checkbox" name="status" checked value="1">
                                    <span></span>
                                    <span>Activé</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="btn btn_primary"><span class="la la-plus"></span> Ajouter</button>
                        </div>
            {{ Form::close() }}

@include('admin.tarifs.ajaxAdd')
                </div>
            </div>
<?php }  ?> 
        </div>
@include('components.pages.footer')        
    </main>
@stop