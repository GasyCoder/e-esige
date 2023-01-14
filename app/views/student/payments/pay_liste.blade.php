@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
<section class="breadcrumb">        
@include('components.break')
</section>
        <!-- Actions -->
        <div class="breadcrumb breadcrumb_alt p-4 flex flex-wrap gap-2">
            <a href="{{URL::route('panel.student')}}" class="btn btn_outlined btn_primary">
                <span class="la la-undo text-xl leading-none ltr:mr-2 rtl:ml-2"></span>
                Retour
            </a>
            <div class="flex flex-wrap gap-2 ltr:ml-auto rtl:mr-auto">
                <a href="{{URL::route('typepay', 1)}}" class="btn btn_primary uppercase">
                    <span class="la la-plus-circle text-xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Paiement
                </a>
            </div>
        </div>
@include('components.alerts')     
        <!--Content -->
            <div class="flex flex-col gap-y-5">
                <div class="card p-5">
                    <table class="table table_bordered w-full mt-3">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right">#</th>
                                <th class="ltr:text-left rtl:text-right">Motif</th>
                                <th class="text-center">Montant</th>
                                <th class="ltr:text-left rtl:text-right">Date/Heur</th>
                                <th class="center" style="text-align:center;">Status</th>
                                <th class="center" style="text-align:center;">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $key => $payment) 
                            <tr>
                                <td>{{$key+1}}</td>
                                <td class="">{{ $payment->motif }}</td>
                                <td class="text-center" width="120">{{ $payment->montant }}</td>
                                <td class="" width="160">{{ $payment->created_at->format('d/m/y à H:m:s') }}</td>
                                <td class="text-center" width="100">
                                 @if($payment->status == 0) 
                                  <button class="badge badge_outlined badge_danger">En attente...</button>  
                                  @else 
                                  <button class="badge badge_outlined badge_success">Payé</button> 
                                  @endif
                                </td>
                                <td class="text-center" width="100">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{URL::route('infopay_stud', $payment->token)}}" class="btn btn-icon btn_success">
                                        <span class="la la-eye"></span>
                                    </a>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            <!--- Fin content -->
    @include('components.pages.footer')     
    @section('js')
    <!--Add JS -->
    @endsection
</main>
@stop