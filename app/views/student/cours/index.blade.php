@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content')
 <!-- Workspace -->
    <main class="workspace">
            <!-- Breadcrumb -->
            <section class="breadcrumb lg:flex items-start" style="margin-bottom:0rem">
                <ul>
                 <li><a href="{{URL::route('index_pay')}}"><span class="la la-undo"></span> Retour</a></li>
                </ul>
                <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-0 lg:mt-0 p-5">
                    <!-- Search -->
                    <form class="flex flex-auto">
                        <label class="form-control-addon-within rounded-full">
                            <input class="form-control border-none" placeholder="Search">
                            <button
                                class="text-gray-300 dark:text-gray-700 text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
                        </label>
                    </form>
                </div>
            </section>
            <!-- List -->
        @if(count($lessons) > 0)    
            <div class="flex flex-col gap-y-5">
            @foreach($lessons as $lesson) 
            <div class="card card_row card_hoverable">
                <div>
                    <div class="image">
                        <div class="aspect-w-4 aspect-h-3">
                            <img src="assets/images/potato.jpg">
                        </div>
                        <label class="custom-checkbox absolute top-0 ltr:left-0 rtl:right-0 mt-2 ltr:ml-2 rtl:mr-2">
                            <input type="checkbox" data-toggle="cardSelection">
                            <span></span>
                        </label>
                        <div
                            class="badge badge_outlined badge_secondary uppercase absolute top-0 ltr:right-0 rtl:left-0 mt-2 ltr:mr-2 rtl:ml-2">
                            Draft
                        </div>
                    </div>
                </div>
                <div class="header">
                    <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h5>
                    <p>Nunc et tincidunt tortor. Integer pellentesque bibendum neque, ultricies semper neque vulputate
                        congue. Nunc fringilla mi sed nisi finibus vulputate. Nunc eu risus velit.</p>
                </div>
                <div class="body">
                    <h6 class="uppercase">Views</h6>
                    <p>100</p>
                    <h6 class="uppercase mt-4 lg:mt-auto">Date Created</h6>
                    <p>December 15, 2019</p>
                </div>
                <div class="actions">
                    <div class="dropdown ltr:-ml-3 rtl:-mr-3 lg:ltr:ml-auto lg:rtl:mr-auto">
                        <button data-toggle="dropdown-menu">
                            <span class="la la-ellipsis-v text-4xl leading-none"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#no-link">Dropdown Action</a>
                            <a href="#no-link">Link</a>
                            <hr>
                            <a href="#no-link">Something Else</a>
                        </div>
                    </div>
                    <a href="#no-link"
                        class="btn btn-icon btn_outlined btn_secondary mt-auto ltr:ml-auto rtl:mr-auto lg:ltr:ml-0 lg:rtl:mr-0">
                        <span class="la la-pen-fancy"></span>
                    </a>
                    <a href="#no-link"
                        class="btn btn-icon btn_outlined btn_danger lg:mt-2 ltr:ml-2 rtl:mr-2 lg:ltr:ml-0 lg:rtl:mr-0">
                        <span class="la la-trash-alt"></span>
                    </a>
                </div>
            </div>
           @endforeach 
        </div>
        <div class="container flex items-center justify-center mt-3 py-1">   
        <div class="lg:col-span-2 xl:col-span-3 mt-2">        
        <div class="mt-5">
            <!-- Pagination -->
            <div class="">
                <nav class="">
                    <a href="#no-link" class="btn btn_primary">Péc</a>
                    <a href="#no-link" class="btn btn_secondary">Suiv</a>
                </nav>
            </div>
        </div>
      </div>
    </div> 
    @else
    <br>
    <div class="alert alert_outlined alert_danger">
    <strong class="uppercase"><bdi>Désolé!</bdi></strong>
     Il n'y a pas des données disponible ici pour le moment.</b>.  
    <button type="button" class="dismiss la la-times" data-dismiss="alert"></button>
    </div>
    @endif  
@include('components.pages.footer')

@section('js')

@endsection
</main>
@stop