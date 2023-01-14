@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content')
<!-- Workspace -->
    <main class="workspace workspace_with-sidebar">
         <!-- Layout -->
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="#no-link">Menu</a></li>
                <li class="divider la la-arrow-right"></li>
                <li><a href="{{URL::route('checkParcourCours', [$class->id])}}">Parcours</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Vagues</li>
            </ul>
        </section>     
<div class="container flex items-center justify-center py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <h3><span class="la la-check-square text-xl leading-none"></span>Choisir Vague</h3>
            <div class="breadcrumb breadcrumb_alt mt-2 p-5 md:p-10" action="#">
                <div class="custom-select mt-2">
                      <select name="select_vague_name" id="select_vague_name" onchange="goToNext(this)" class="form-control">
                            <option value="" selected disabled>-- Choisir vague --</option>
                              @foreach($vagues as $vague)
                                    <option value="{{ $vague->id}}">{{ $vague->name }}</option>
                              @endforeach
                        </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>
            </div>
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
    <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler la la-ellipsis-v" data-toggle="sidebar"></button>
        <!-- Tags -->
        <h2 class="p-5">Objets sélectionnés</h2>
        <hr>
       <div class="flex flex-col gap-y-5 p-5">
            <a href="#" class="flex items-center text-normal">
                <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                Niveau
                <span class="badge badge_success ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$class->name}}</span>
            </a>
            <a href="#" class="flex items-center text-normal">
                <span class="la la-check-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                Parcours
                <span class="badge badge_success ltr:mr-2 rtl:ml-2 ltr:ml-auto rtl:mr-auto">{{$parcour->name}}</span>
            </a>
        </div>
    </aside>
@stop