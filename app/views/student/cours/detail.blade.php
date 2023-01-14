@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content')
 <!-- Workspace -->
    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
           <div> 
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="#no-link">Menu</a></li>
                <li class="divider la la-arrow-right"></li>
                <li><a href="{{URL::route('cours_index')}}">Liste cours</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Detail</li>
            </ul>
            </div>
            <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 xl:mt-0">
                <!-- Add New -->
                <a href="" class="btn btn_primary uppercase"><span class="la la-plus-circle"></span> Exercice correspond</a>
            </div>
        </section>

        <div class="grid lg:grid-cols-4 gap-5">

            <!-- Categories -->
            <div class="lg:col-span-2 xl:col-span-1">
                <div class="card p-5">
                    <h3><span class="la la-file-pdf"></span> Document pdf</h3>
                    <hr>
                    <div class="mt-5 leading-normal">
                        <a href="{{ url() }}/uploads/support_files/{{$show->support->file}}" target="_blank" class="flex items-center text-normal text-red-700">
                            <span class="la la-paperclip text-muted text-2xl ltr:mr-2 rtl:ml-2"></span>
                            document joint
                        </a>
                    </div>
                </div>
            </div>

            <!-- FAQs -->
            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-3">
                <div class="card p-5">
                    <h3>Matière : <span class="text-primary">{{$show->support->matiere->name}}</span></h3>
                    <div class="border border-divider rounded mt-5">
                        <h5 class="p-5">
                            {{$show->support->title}}
                        </h5>
                        <div class="">
                            <div class="p-5 pt-0">{{$show->support->content}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('components.pages.footer')

@section('js')

@endsection
    </main>
@stop