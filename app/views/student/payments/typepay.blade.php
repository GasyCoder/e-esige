@extends('layouts.master')
<?php 
$path       = Session::get('language'); 
$control    = Control::find(1);
?>
@section('title') {{$title}} @stop
@section('content') 
<!-- Workspace -->
<main class="workspace">
        <section class="breadcrumb">
            <ul>
                <li><a href="{{URL::route('index_pay')}}"><span class="la la-undo"></span> Retour</a></li>
            </ul>
        </section>
            <div class="container flex items-center justify-center mt-3 py-1">   
                <div class="lg:col-span-2 xl:col-span-3 mt-2">
                <h1>{{$title}}</h1>
                <hr class="border-dashed mb-5"> 
                <!-- type -->
                  <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    @foreach($types as $type)
                    <a href="{{URL::route('addStudpay', [$motif->id,$type->token,Auth::user()->token,$type->same])}}">
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

@stop