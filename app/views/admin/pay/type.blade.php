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
                    <table class="table table_striped w-full mt-0">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right ">#</th>
                                <th class="ltr:text-left rtl:text-right ">Titre</th>
                                <th class="ltr:text-left rtl:text-right ">Numéro</th>
                                <th class="ltr:text-left rtl:text-right ">Nom</th>
                                <th class="ltr:text-left rtl:text-right ">Icon</th>
                                <th class="center" style="text-align:center;">Status</th>
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
                                @if($type->status == 1)
                                <div class="badge badge_outlined badge_success">Activé</div> 
                                @else 
                                <div class="badge badge_outlined badge_danger">Desactivé</div> 
                                @endif
                                </td>
                                <td class="text-center">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    @if(Auth::user()->is_admin) @if(!Auth::user()->is_secretaire)
                                    <a href="{{ URL::current() . '?id=' . $type->id }}" class="btn btn-icon btn_outlined btn_success ltr:ml-2 rtl:mr-2">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
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
<?php 
if (isset($_GET['id'])) { 
$id = htmlspecialchars($_GET['id']);
$gettype = Typepay::find($id);
if ($gettype !== null) {  ?>

            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Modifier Type de paiement</h3>    
                   {{ Form::open(['route'=>['update_type', $gettype->id], 'files'=>'true', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}   
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Intitulé</label>
                            <input id="title" name="title" value="{{$gettype->title}}" type="text" class="form-control">
                        </div>
                        <div class="mb-5">
                        <label class="label block mb-2" for="number">Numéro</label>
                            {{ Form::text('number', $gettype->number, ['id'=>'number', 'class'=>'form-control']) }}
                            <div class="help-block with-errors"></div>
                            @if($errors->first('number'))
                            <span class="text-red-700">{{ $errors->first('number') }}</span>
                            @endif
                        <div class="mb-5">
                            <label class="label block mb-2" for="name">Au nom de:</label>
                            {{ Form::text('name', $gettype->name, ['id'=>'name', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                            @if($errors->first('name'))
                                <span class="text-red-700">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="icon">Icon</label>
                            {{ Form::file('icon', ['class'=>'form-control', 'id'=>'file']) }}
                        </div>
                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Actif</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    @if($gettype->status == 1)
                                    <input type="checkbox" name="status" checked value="1">
                                    <span></span>
                                    <span>Activé</span>
                                    @else
                                    <input type="checkbox" name="status" value="0">
                                    <span></span>
                                    <span>Activer</span>
                                    @endif
                                </label>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button class="btn btn_primary uppercase">Metre à jour</button>
                        </div>
             {{ Form::close() }}
                </div>
            </div>
            
<?php } } else { ?>


            <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1 mt-3">
                <!-- Publish -->
                <div class="card p-5 flex flex-col gap-y-5">
                    <h3>Ajouter type de paiement</h3>
                    {{ Form::open(['route'=>'storetype', 'files'=>'true']) }}  
                        <div class="mb-5">
                            <label class="label block mb-2" for="title">Intitulé</label>
                            {{ Form::text('title', '', ['id'=>'title', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('title'))
                                <span class="text-red-700">{{ $errors->first('title') }}</span>
                                @endif
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="number">Numéro</label>
                            {{ Form::text('number', '', ['id'=>'number', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('number'))
                                <span class="text-red-700">{{ $errors->first('number') }}</span>
                                @endif
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="name">Au nom de:</label>
                            {{ Form::text('name', '', ['id'=>'name', 'class'=>'form-control']) }}
                             <div class="help-block with-errors"></div>
                                @if($errors->first('name'))
                                <span class="text-red-700">{{ $errors->first('name') }}</span>
                                @endif
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="phone">Icon</label>
                            <input type="file" name="icon" class="form-control">
                        </div>
                        <div class="flex items-center">
                            <div class="w-1/2">
                                <label class="label block">Actif</label>
                            </div>
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    <input type="checkbox" name="status" checked value="1">
                                    <span></span>
                                    <span>Activé</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="btn btn_primary uppercase"><span class="la la-plus"></span> Ajouter</button>
                        </div>
                {{ Form::close() }}
                @include('admin.niveau.jsAdd')
                </div>
            </div>
<?php }  ?>              
        </div>
@include('components.pages.footer')     
@section('js')

@endsection
    </main>
@stop