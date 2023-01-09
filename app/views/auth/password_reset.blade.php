@extends('layouts.default')

@section('title') Mot de passe oublié @stop


@section('content')

    <!-- Top Bar -->
    <section class="top-bar">

        <!-- Brand -->
        <span class="text-xl">e-<span class="brand">ESIGE</span></span>

        <nav class="flex items-center ltr:ml-auto rtl:mr-auto">

            <!-- Dark Mode -->
            <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
                <input id="darkModeToggler" type="checkbox">
                <span></span>
            </label>

            <!-- Fullscreen -->
            <button id="fullScreenToggler"
                class="hidden lg:inline-block ltr:ml-5 rtl:mr-5 text-2xl leading-none la la-expand-arrows-alt"
                data-toggle="tooltip" data-tippy-content="Fullscreen"></button>

            <!-- Login -->
            <a href="/" class="btn btn_primary uppercase ltr:ml-5 rtl:mr-5"><span class="la la-user text-xl"></span> Se connecter</a>
        </nav>
    </section>

    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="flex items-center justify-center gap-x-4 mt-4">
                <div class="avatar w-20 h-20">
                    <img src="">
                </div>
            </div>
            <form class="card mt-5 p-5 md:p-10">
                <div class="mb-5">
                    <label class="label block mb-2" for="email">Email</label>
                    <input id="email" class="form-control" placeholder="example@example.com">
                </div>
                <div class="flex">
                    <button class="btn btn_primary ltr:ml-auto rtl:mr-auto uppercase">Send Reset
                        Link</button>
                </div>
            </form>
        </div>
    </div>
    
@stop