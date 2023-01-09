@if(Session::has('error'))
<div class="relative pl-8 my-2 px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
 <div class="alert alert_danger">
        <strong class="uppercase"><bdi>Erreur!</bdi></strong>
       {{ Session::get('error') }}
        <button type="button" class="dismiss la la-times" data-dismiss="alert"></button>
    </div>
@endif


@if(Session::has('success'))
 <div class="alert alert_success">
        <strong class="uppercase"><bdi>Succès!</bdi></strong>
       {{ Session::get('success') }}
        <button type="button" class="dismiss la la-times" data-dismiss="alert"></button>
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert_info">
        <strong class="uppercase"><bdi>Info!</bdi></strong>
       {{ Session::get('warning') }}
        <button type="button" class="dismiss la la-times" data-dismiss="alert"></button>
    </div>
@endif

