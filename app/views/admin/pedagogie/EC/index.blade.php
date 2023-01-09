@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') Element Constitutifs @stop
@section('content')
    <main class="workspace">
        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
@include('components.break')
            </div>
        </section>
@if(count($classes) >= 1)
         <!-- List -->
        <div class="card p-5">
            <div class="overflow-x-auto">
                <table class="table table-auto table_hoverable w-full">
                    <thead>
                        <tr class="" style="color:#3F3F46">
                            <th class="ltr:text-left rtl:text-right">Listes des classes</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr>
                            <td class="font-bold">
                                <a href="/admin/element_constitutif/1/1">
                                <span class="la la-user-graduate text-xl"></span> Année Préparatoire
                                </a>
                            </td>
                            <td class="text-center font-bold">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="/admin/element_constitutif/1/1" class="btn btn-icon btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-eye"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @foreach($classes as $class)
                        @if($class->id >= 2)
                        <tr>
                            <td class="font-bold">
                             <a href="{{ URL::current().'/'.$class->id }}">   
                                <span class="la la-user-graduate text-xl"></span>{{ $class->name }}
                             </a>   
                            </td>
                            <td class="text-center font-bold">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{ URL::current().'/'.$class->id }}" class="btn btn-icon btn btn-icon btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-eye"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    @endif       
@include('components.pages.footer')
</main>
@stop