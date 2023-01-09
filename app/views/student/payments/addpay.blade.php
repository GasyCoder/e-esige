@extends('layouts.master')
<?php 
$path = Session::get('language'); 
$control = Control::find(1);
$tarif = Tarif::where('class_id', $i->class_id)->first();
?>
@section('title') {{$title}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="#no-link">Liste des paiement</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>paiment</li>
            </ul>
        </section>
<!-- Layout -->
<div class="container flex items-center justify-center mb-2 py-1">
<div class="card p-5 flex flex-col gap-y-2 w-full md:w-1/2 xl:w-1/4">
@include('components.alerts')
{{ Form::open(['route'=>['payStore', $type->token, Auth::user()->token], 'files'=>'true', 'id'=>'myForm', 'class'=>'', 'data-toggle'=>'validator'])  }} 
                    <div class="flex flex-wrap flex-row -mx-4 collapse open">
                        
                        <div class="mb-5 flex-shrink px-4 w-full">
                        <label class="label block mb-2" for="title">Type de paiement</label>
                            <input class="form-control font-bold text-green-700" type="text" name="type" value="{{$type->title}}" readonly>
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full">
                                <label class="label block mb-2" for="motif">Motifs</label>
                                <div class="custom-select">
                                <select class="form-control font-bold" name="motif" id="motif" required>
                                   <option value="" selected disabled>--Choisir motif de paiment--</option>
                                   @foreach($motifs as $motif) 
                                     <option value="{{$motif->title}}" class="font-bold">{{$motif->title}}</option>
                                   @endforeach
                                </select>
                                    <div class="custom-select-icon la la-caret-down"></div>
                                </div>
                        </div>
                      
                        @if($i->controlpay->otherpayed != 0)
                        <div class="w-full border border-dashed mb-5" style="display:none;" id="Ecolage">
                              <div class="mb-5 flex-shrink px-4 w-full mt-4">
                                    <label class="label block mb-2" for="title">Indiquez nombre de mois <span class="text-red-700">[Nbre mois initial = {{$i->mois_reste}}]</span> </label>
                                    <input type="number" name="nbremois" class="form-control font-bold" id="nbremois" min="1" max="{{$i->mois_reste}}" placeholder="Indiquez le nombre de mois d'écolage que vous voulez payez">
                              </div> 
                              <div class="mb-5 flex-shrink px-4 w-full">
                                <label class="label block mb-2" for="montant">Montant à payer en {{$control->payment_unit}}</label>
                                <input type="text" name="montant" value="" id="result" class="form-control text-green-800 font-bold">
                              </div>
                        </div>
                        @else
                        <div class="w-full mb-5 p-5" style="display:none;" id="Ecolage">
                             <div class="alert alert_warning text-gray-600">
                                <strong class="uppercase"><bdi>Attention!</bdi></strong>
                                Vous devez payer d'abord votre droit d'inscription.
                                <button class="dismiss la la-times" data-dismiss="alert"></button>
                            </div>
                        </div>
                        @endif 

                       @if($i->controlpay->otherpayed == 0)
                        <div class="w-full border border-dashed mb-5" style="display:none;" id="Droit">
                            <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="montant">Montant à payer en {{$control->payment_unit}}</label>
                            <input type="text" value="{{$tarif->droit}}" name="montant" id="montant" class="form-control text-green-800 font-bold">
                            </div>
                        </div>
                        @else
                        <div class="p-5 w-full mb-5" style="display:none;" id="Droit">
                            <div class="alert alert_info">
                                <strong class="uppercase"><bdi>Info!</bdi></strong>
                                Votre droit d'inscription a été payé! à la date du :
                                <button class="dismiss la la-times" data-dismiss="alert"></button>
                            </div>
                        </div>
                        @endif

                       @if($type->same == 1)
                        <div class="w-full">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="title">Numero de Réference</label>
                                <input class="form-control font-bold" type="text" name="payment_index">
                            </div>
                       </div>
                       @endif

                       @if($type->same == 2) 
                       <div class="w-full">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="title">Numero du bordereaux</label>
                                <input class="form-control font-bold" type="text" name="num_bordero">
                            </div>
                       </div>
                       <div class="w-full">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="title">Nom de l'Agence</label>
                                <input class="form-control font-bold" type="text" name="agence">
                            </div>
                       </div>
                       @endif

                       <div class="w-full">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="title">Date de paiement</label>
                                <input class="form-control font-bold" type="date" name="date">
                            </div>
                       </div>
                       <div class="w-full">
                           <div class="mb-5 flex-shrink px-4 w-full">
                           <input type="checkbox" id="myCheck" onclick="myFunction()">
                            <span></span>
                                <span>Ajouter pièce jointe?</span>
                           </div>
                        </div>
                         <div class="w-full mb-3">
                           <div class="mb-5 flex-shrink px-4 w-full">
                                <input type="file" name="file" id="file" style="display:none" class="form-control">
                            </div>
                       </div>
                       
                        <div class="w-full mb-5">
                                <label class="mb-5 flex-shrink px-4 w-full">
                                <input type="checkbox" name="status" id="status" value="1" required>
                                <span></span>
                                <span>Acceptez les règles de notre paiement : <a href="#">Lire notre règles.</a></span>
                                </label>
                        </div>
 
                    <div class="flex justify-center items-center mt-3 p-5">
                            <button type="submit" class="btn btn_primary"><span class="la la-user-plus"></span> Effectuer le paiement</button>
                    </div>

                </div>                  
                                            
{{ Form::close() }}

</div>
</div>
@include('components.pages.footer')     
@section('js')

<script type="text/javascript">
 document.getElementById('motif').addEventListener("change", function (e) 
 {
      if (e.target.value === 'Ecolage') {
            document.getElementById('Ecolage').style.display = 'block';
        } 
      else {
          document.getElementById('Ecolage').style.display = 'none';
        }
  });
</script>

<script type="text/javascript">
 document.getElementById('motif').addEventListener("change", function (e) 
 {
      if (e.target.value === 'Droit') {
            document.getElementById('Droit').style.display = 'block';
        } 
      else {
          document.getElementById('Droit').style.display = 'none';
        }
  });
</script>
@if($i->controlpay->otherpayed != 0)
<script type="text/javascript">
const $inputs = $('input[type="number"]')
$inputs.change(function() {
  var total = 0;
  $inputs.each(function() {
    if ($(this).val() != '') {
    total += parseInt($(this).val());
    }
  });
  
  $('#result').val(total*{{$tarif->ecolage}});

});
</script>
@endif

<script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("file");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>

@endsection
</main>
 <!-- Sidebar -->
    <aside class="sidebar">

        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>

        <div class="overflow-y-auto">

            <!-- Status -->
            <h2 class="p-5">Status</h2>
            <hr>
            <div class="flex flex-col gap-y-5 p-5">
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-sync text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Pending Tasks
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">10</span>
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Completed Tasks
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">20</span>
                </a>
            </div>

            <!-- Categories -->
            <h2 class="p-5">Categories</h2>
            <hr>
            <div class="flex flex-col gap-y-5 p-5">
                <label class="custom-checkbox">
                    <input type="checkbox">
                    <span></span>
                    <span>Potato</span>
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">10</span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox">
                    <span></span>
                    <span>Tomato</span>
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">20</span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox">
                    <span></span>
                    <span>Onion</span>
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">10</span>
                </label>
            </div>

            <!-- Tags -->
            <h2 class="p-5">Tags</h2>
            <hr>
            <div class="flex gap-2 p-5">
                <button class="badge badge_outlined badge_primary">Potato</button>
                <button class="badge badge_outlined badge_success">Tomato</button>
                <button class="badge badge_outlined badge_warning">Onion</button>
            </div>
        </div>
    </aside>

@stop