@extends('layouts.master')
<?php $path = Session::get('language'); ?>
@section('title') {{$title}} @stop
@section('content')
<!-- Workspace -->
    <main class="workspace">
        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>{{$title}}</h1>
            <ul>
                <li><a href="#">Menu</a></li>
                <li class="divider la la-arrow-right"></li>
                <li><a href="{{URL::route('typeControle')}}">Types de paiement</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>page</li>
            </ul>
        </section>

        {{ Form::open(['route'=>'storetype', 'files'=>'true']) }} 

            <div class="container flex items-center justify-center mb-2 py-1">
            <div class="p-5 flex flex-col gap-y-2 w-full md:w-1/2 xl:w-1/4">
                <div class="card p-5 mt-3">
                        <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="title">Type</label>
                            {{ Form::text('title', '', ['id'=>'title', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('title'))
                                <span class="text-red-700">{{ $errors->first('title') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="number">Numéro</label>
                            {{ Form::text('number', '', ['id'=>'number', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('number'))
                                <span class="text-red-700">{{ $errors->first('number') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="name">Au nom de:</label>
                            {{ Form::text('name', '', ['id'=>'name', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('name'))
                                <span class="text-red-700">{{ $errors->first('name') }}</span>
                                @endif
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="phone">Icon</label>
                            <input type="file" name="icon" class="form-control">
                        </div>
                        <div class="p-5 mt-3">
                            <div class="flex items-center">
                                <button type="submit" class="btn btn_primary"><span class="la la-plus-circle"></span> Ajouter</button>
                            </div> 
                        </div>  
                        </div>
                        </div>
                    </div>
    {{ Form::close() }}
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