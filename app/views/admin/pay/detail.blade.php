@extends('layouts.master')
<?php 
$path = Session::get('language'); 
$control = Control::find(1);
?>
@section('title') {{$title}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="{{URL::route('chekpay')}}"><span class="la la-undo"></span> Retour</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>paiment</li>
            </ul>
        </section>
    <div class="container flex items-center justify-center mt-10 py-10">
        <div class="w-full md:w-2/2 xl:w-1/1">
            <div class="mx-5 md:mx-10 mb-5">
                <h2 class="">
                @if($detail->student->user->sexe == 1)Mr. 
                @else Mme/Mlle. @endif <span class="uppercase">{{$detail->student->fname}}</span>
                </h2>
                <h4 class="uppercase"><span class="text-gray-600">Objet: </span>Paiement {{$detail->motif}}</h4>
            </div>
            <!-- Basic -->
            <div class="card p-5">
                <table class="table w-full mt-3">
                    <thead>
                        <tr>
                            <th class="ltr:text-left rtl:text-right uppercase">#Réf</th>
                            <th class="ltr:text-left rtl:text-right uppercase">Moyen de paiement</th>
                            <th class="ltr:text-left rtl:text-right uppercase">Montant</th>
                            <th class="ltr:text-left rtl:text-right uppercase">Nbre Mois</th>
                            <th class="ltr:text-left rtl:text-right uppercase">Fichier</th>
                            <th class="ltr:text-left rtl:text-right uppercase">Date/Heur</th>
                            <th class="ltr:text-left rtl:text-right uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$detail->payment_index}}</td>
                            <td>{{$detail->type}}</td>
                            <td>{{$detail->montant}}</td>
                            <td>{{$detail->nbremois}}</td>
                            <td>
                            @if(!empty($detail->file))
                            <a href="{{ url() }}/uploads/files_pay/{{$detail->file}}" target="_blank" class="flex items-center text-normal text-primary"><span class="la la-paperclip "></span> pièce jointe </a>
                            @else
                            <p>Null</p>
                            @endif
                            </td>
                            <td>{{$detail->created_at->format('d/m/y à H:i:s')}}</td>
                            <td>
                              @if($detail->status == 0) 
                              <button class="badge badge_outlined badge_danger">En attente</button>  
                              @else 
                              <button class="badge badge_outlined badge_success">Vérifié</button> 
                              @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="mb-2">
                <h5>Message</h5>
                <textarea class="form-control" row="4">{{$detail->msg}}</textarea>
                <hr>
                <div class="flex mt-5">
                    <a onclick="return confirm('Êtes-vous sûr de vouloir accepter ce paiement?')" href="{{URL::route('validPay', $detail->id)}}" class="btn btn_success ltr:ml-auto rtl:mr-auto uppercase">
                    <span class="la la-check-square"></span> Valider</a>
                </div> 
            </div>
        </div>
    </div>
    @include('components.pages.footer')
    @section('js')
    @endsection
</main>
@stop