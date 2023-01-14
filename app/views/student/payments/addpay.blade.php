@extends('layouts.master')
<?php 
$path = Session::get('language'); 
$control = Control::find(1);
$tarif = Tarif::where('class_id', $student->class_id)->first();
?>
@section('title') {{$title}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="{{URL::route('typepay', $motif->id)}}"><span class="la la-undo"></span> Retour</a></li>
                 <li class="divider la la-arrow-right"></li>
                <li><a href="{{URL::route('listes_stud')}}">Liste des paiement</a></li>
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
                        <div class="flex gap-2 p-5">
                            <button class="badge badge_outlined badge_success">{{$type->title}}</button>
                            <button class="divider la la-arrow-right"></button>
                            <button class="badge badge_outlined badge_primary">{{$motif->title}}</button>
                        </div>
                         <input type="hidden" name="type" value="{{$type->title}}">
                            <input type="hidden" name="motif" value="{{$motif->title}}">
                         <div class="w-full border border-dashed mb-5" style="display:block;" id="Ecolage">
                          <div class="mb-5 flex-shrink px-4 w-full mt-4">
                                <label class="label block mb-2" for="title">Indiquez nombre de mois <span class="text-red-700">[ Nbre mois reste = {{$student->verify->mois_reste}} ]</span> </label>
                                <input type="number" name="nbremois" class="form-control font-bold" id="nbremois" min="1" max="{{$student->verify->mois_reste}}" placeholder="Indiquez le nombre de mois d'écolage que vous voulez payez" pattern="^[0-9]{4}$">
                          </div> 
                          <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="montant">Montant à payer en {{$control->payment_unit}}</label>
                            <input type="text" name="montant" value="" id="result" class="form-control text-green-800 font-bold">
                          </div>
                        </div>
                       
                        <div class="w-full">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="payment_index">
                            @if($type->same == 1)   
                                Numero de Réference 
                                <small>({{$type->title}})</small>
                            @else
                                Numero du bordereaux 
                                <small>({{$type->title}})</small>
                            @endif    
                            </label>
                                <input class="form-control font-bold" type="text" name="payment_index">
                            </div>
                       </div>
                       @if($type->same == 2) 
                       <div class="w-full">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="agence">Nom de l'Agence</label>
                                <input class="form-control font-bold" type="text" name="agence">
                            </div>
                       </div>
                       @else
                       <input type="hidden" name="agence" value="NULL">
                       @endif

                       <div class="w-full">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="date">Date de paiement</label>
                                <input class="form-control font-bold" type="date" name="date">
                            </div>
                       </div>
                       <div class="w-full">
                           <div class="mb-0 flex-shrink px-4 w-full">
                           <input type="checkbox" id="myCheck" onclick="myFunction()">
                            <span></span>
                                <span>Ajouter pièce jointe?</span>
                           </div>
                        </div>
                        <div class="w-full mb-3">
                           <div class="mt-5 mb-5 flex-shrink px-4 w-full">
                                <input type="file" name="file" id="file" style="display:none" class="form-control">
                            </div>
                        </div>
                        <div class="w-full mb-0">
                           <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="agence">Message <small>(facultatif)</small></label>
                                <textarea class="form-control" name="msg" row="3" style="display:" placeholder="Saisir ici votre message : 100 caractères maximum"></textarea>
                            </div>
                        </div>
                        <div class="w-full mb-3">
                                <label class="mb-5 flex-shrink px-4 w-full">
                                <input type="checkbox" name="status" id="status" value="1" required checked>
                                <span></span>
                                <span>Acceptez les règles de paiement : <a href="#">Lire notre règles.</a></span>
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
            <h2 class="p-5">Tarifs</h2>
            <hr>
            <div class="flex flex-col gap-y-5 p-5">
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Droit d'inscription/an
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$tarif->droit.' ' .$control->payment_unit}}</span>
                </a>
                <a href="#no-link" class="flex items-center text-normal">
                    <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Ecolage/mois
                    <span class="badge badge_outlined badge_primary ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$tarif->ecolage.' ' .$control->payment_unit}}</span>
                </a>
            </div>
        </div>
        @if($verify->droit == 1 && $verify->ecolage == 1)
        <!-- note -->
        <h2 class="p-5">Note</h2>
        <hr>
        <div class="flex gap-2 p-5">
            <div class="alert alert_success">
                <strong class="uppercase"><bdi>Info!</bdi></strong>
                Droit d'inscription + écolage 1ère versement sont dejà reglé!
            </div>
        </div>
        @endif
    </aside>
@stop