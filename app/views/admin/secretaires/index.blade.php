@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Secretaire @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
<section class="breadcrumb">        
@include('components.break')
</section>
        <div class="grid lg:grid-cols-3 gap-5">
            <!-- Content -->
            <div class="lg:col-span-2">
            @include('components.alerts')     
            <div class="card p-5 mt-3">
                    <h3> <small class="font-bold">Total:( {{(count($secretaires))}} )</small></h3>
                    <table class="table-sorter table table_striped w-full mt-0">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right ">#</th>
                                <th class="ltr:text-left rtl:text-right ">Nom</th>
                                <th class="ltr:text-left rtl:text-right ">Prénom</th>
                                <th class="ltr:text-left rtl:text-right ">Tél</th>
                                <th class="ltr:text-left rtl:text-right ">Email</th>
                                <th class="ltr:text-left rtl:text-right ">Sexe</th>
                                <th class="center" style="text-align:center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($secretaires as $secretaire) 
                        <?php $user = Profil::where('token', $secretaire->token)->first(); ?>   
                            <tr>
                                <td>{{ $secretaire->id }}</td>
                                <td class="font-bold">{{ $secretaire->fname }}</td>
                                <td class="font-bold">{{ $secretaire->lname }}</td>
                                <td class="font-bold">{{ $user->phone }}</td>
                                <td class="font-bold">{{ $user->email }}</td>
                                <td class="font-bold">
                                @if($secretaire->sexe == 1)Homme @else Femme @endif
                                </td>
                                <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{URL::route('profileSecretaire', $secretaire->token)}}" class="btn btn-icon btn_success">
                                        <span class="la la-user"></span>
                                    </a>
                                    <a href="{{ URL::route('editSecretaire', $secretaire->token)}}" class="btn btn-icon btn_primary ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="" class="btn btn-icon btn_danger ltr:ml-2 rtl:mr-2">
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
           <a href="{{URL::route('addsecretaire')}}">    
            <div class="card card_hoverable card_list text-primary">
                <div class="image image_icon">
                    <span class="la la-user-plus la-4x"></span>
                </div>
                <div class="body">
                    <h5>Ajouter Sécretaire</h5>
                    <p>Créer un compte</p>
                </div>
            </div>
           </a> 
        </div>
@include('components.pages.footer')     
@section('js')

@endsection
    </main>
@stop