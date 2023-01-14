@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content')
    <!-- Workspace -->
    <main class="workspace overflow-hidden">
        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
               <h1>{{$title}}</h1>
                <ul>
                    <li><a href="#">Menu</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>page</li>
                </ul>
            </div>

            <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">
                <!-- Layout -->
                <div class="flex gap-x-2">
                    <a href="#no-link" class="btn btn_outlined btn_primary">
                        <span class="la la-undo"></span> Retour
                    </a>
                </div>
                <div class="flex gap-x-2">
                    <!-- Add New -->
                    <a href="{{URL::route('selectNiveau')}}" class="btn btn_primary uppercase"><span class="la la-plus-circle text-xl leading-none"></span> Ajouter nouveau</a>
                </div>
            </div>
        </section>
        <!-- List -->
        @include('components.alerts')  
        <div class="card p-5">
            <div class="overflow-x-auto">
                <table class="table-sorter table table-auto table_hoverable w-full">
                     <thead>
                        <tr>
                            <th class="ltr:text-left rtl:text-right">Etudiant</th>
                            <th class="ltr:text-left rtl:text-right">Réference</th>
                            <th class="ltr:text-left rtl:text-right">Motif</th> 
                            <th class="ltr:text-left rtl:text-right">Montant </th> 
                            <th class="ltr:text-left rtl:text-right">Moyen de paiement </th>
                            <th class="ltr:text-left rtl:text-right">Date/Heur</th>   
                            <th class="ltr:text-left rtl:text-right">Status </th>             
                            <th class="text-center" style="text-align:center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($checks as $check)    
                        <tr>
                            <td class="font-bold">{{$check->student->fname}}</td>
                            <td class="font-bold">{{$check->payment_index}}</td>
                            <td class="font-bold">{{$check->motif}}</td>
                            <td class="font-bold">{{$check->montant}}</td>
                            <td class="font-bold">{{$check->type}}</td>
                            <td class="font-bold">{{$check->created_at->format('d/m/y à H:i:s')}}</td>
                            <td class="font-bold">
                              @if($check->status == 0)  
                              <button class="badge badge_outlined badge_danger">En attente</button> 
                              @else 
                              <button class="badge badge_outlined badge_success">Vérifié</button>
                              @endif
                            </td>
                            <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                 <a href="{{URL::route('viewDetail_pay', $check->id)}}" class="btn btn-icon btn_success">
                                  <span class="la la-info-circle"></span>
                                </a>    
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
        function goToNext(c) {
        if(c.value != '') {
            window.location = '{{ URL::current() }}/'+c.value;
        }
        }
        </script>
        @endsection
</main>
@stop