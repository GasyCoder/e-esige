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
                <li>Niveau</li>
            </ul>
        </section>       
<div class="container flex items-center justify-center py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <h3><span class="la la-check-square text-xl leading-none"></span>Choisir niveau</h3>
            <div class="breadcrumb breadcrumb_alt mt-2 p-5 md:p-10" action="#">
                <div class="custom-select mt-2">
                      <select name="select_class_name" id="select_class_name" onchange="goToNext(this)" class="form-control">
                            <option value="" selected disabled>-- Choisir niveau --</option>
                              @foreach($classes as $class)
                                    <option value="{{ $class->id}}">{{ $class->name }}</option>
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
@stop