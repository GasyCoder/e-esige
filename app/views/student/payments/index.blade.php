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
            <button class="btn btn_outlined btn_primary">
                <span class="la la-undo text-xl leading-none ltr:mr-2 rtl:ml-2"></span>
                Retour
            </button>
            <div class="flex flex-wrap gap-2 ltr:ml-auto rtl:mr-auto">
                <a href="{{URL::route('typepay', Auth::user()->token)}}" class="btn btn_primary uppercase">
                    <span class="la la-plus-circle text-xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Paiement
                </a>
            </div>
        </div>
@include('components.alerts')     
        <!--Content -->
            <div class="flex flex-col gap-y-5">
                <div class="card p-5">
                    <table class="table table_striped w-full mt-3">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right ">#</th>
                                <th class="ltr:text-left rtl:text-right ">Réf</th>
                                <th class="ltr:text-left rtl:text-right ">Type </th>
                                <th class="ltr:text-left rtl:text-right ">Mois</th>
                                <th class="ltr:text-left rtl:text-right ">Mode</th>
                                <th class="ltr:text-left rtl:text-right ">Date</th>
                                <th class="center" style="text-align:center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $key => $payment) 
                        <?php 
                            $type = Paycontrol::where('token', $payment->token)->first();
                        ?>
                            <tr>
                                <td>{{$key+1}}</td>
                                <td class="font-bold">{{ $payment->payment_index }}</td>
                                <td class="font-bold">{{ $payment->motif }}</td>
                                <td class="font-bold">{{ $type->nbremois }}, reste = {{ $type->mois_reste }}</td>
                                <td class="font-bold">{{ $payment->montant }}</td>
                                <td class="font-bold">{{ $type->date }}</td>
                                <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="#" class="btn btn-icon btn_success">
                                        <span class="la la-print"></span>
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

@endsection
    </main>
@stop