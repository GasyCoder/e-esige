@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Types de paiement @stop
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
                    <table class="table-sorter table table_striped w-full mt-0">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right ">#</th>
                                <th class="ltr:text-left rtl:text-right ">Titre</th>
                                <th class="ltr:text-left rtl:text-right ">Numéro</th>
                                <th class="ltr:text-left rtl:text-right ">Nom</th>
                                <th class="ltr:text-left rtl:text-right ">Icon</th>
                                <th class="center" style="text-align:center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $key=> $type) 
                            <tr>
                                <td>{{ $key}}</td>
                                <td class="font-bold">{{ $type->title }}</td>
                                <td class="font-bold">{{ $type->number }}</td>
                                <td class="font-bold">{{ $type->name }}</td>
                                <td class="font-bold">
                                <?php echo HTML::image('uploads/icons/'.$type->icon.'', '', ['class'=>'avatar', 'width'=>'180','height'=>'80']) 
                                ?>
                                </td>
                                <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="#" class="btn btn-icon btn_danger ltr:ml-2 rtl:mr-2">
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
           <a href="{{URL::route('addtype')}}">    
            <div class="card card_hoverable card_list text-primary">
                <div class="image image_icon">
                    <span class="la la-user-plus la-4x"></span>
                </div>
                <div class="body">
                    <h5>Ajouter type de paiement</h5>
                </div>
            </div>
           </a> 
        </div>
@include('components.pages.footer')     
@section('js')

@endsection
    </main>
@stop