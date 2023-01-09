@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="#no-link">Type des paiement</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>paiment</li>
            </ul>
        </section>
            <div class="container flex items-center justify-center mt-5 py-1">   
                <div class="lg:col-span-2 xl:col-span-3 mt-5">
                <!-- type -->
                  <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    @foreach($types as $type)
                    <a href="{{URL::route('addStudpay', [$type->token, Auth::user()->token,$type->same])}}">
                    <div class="card card_hoverable card_list">
                        <div class="image image_icon">
                        <?php echo HTML::image('uploads/icons/'.$type->icon.'', '', ['class'=>'avatar', 'width'=>'40','height'=>'40']) 
                        ?>
                        </div>
                        <div class="body">
                            <h5>{{$type->title}}</h5>
                            <hr class="border-dashed">
                            <p>
                                N°: {{$type->number}} <br>
                                Nom de : {{$type->name}}
                            </p>
                        </div>
                    </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
@include('components.pages.footer')     
@section('js')

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