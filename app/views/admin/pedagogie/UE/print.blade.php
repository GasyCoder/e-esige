<?php 
$path = Session::get('language');
$control = Control::find(1); 
?>
@include('components.timeAgo')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width,initial-scale=1" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Imprimer | Unité d'Enseignement</title>
  <!-- Generics -->
    <link rel="icon" href="{{ url() }}/public/uploads/favicon/{{$control->favicon}}" sizes="32x32">
    <link rel="icon" href="{{ url() }}/public/uploads/favicon/{{$control->favicon}}" sizes="128x128">
    <link rel="icon" href="{{ url() }}/public/uploads/favicon/{{$control->favicon}}" sizes="192x192">
    <!-- Android -->
    <link rel="shortcut icon" href="{{ url() }}/public/uploads/favicon/{{$control->favicon}}" sizes="196x196">
    <!-- iOS -->
    <link rel="apple-touch-icon" href="{{ url() }}/public/uploads/favicon/{{$control->favicon}}" sizes="152x152">
    <link rel="apple-touch-icon" href="{{ url() }}/public/uploads/favicon/{{$control->favicon}}" sizes="167x167">
    <link rel="apple-touch-icon" href="{{ url() }}/public/uploads/favicon/{{$control->favicon}}" sizes="180x180">
    {{ HTML::style('public/assets/css/other/print.css') }}
    {{ HTML::style('public/assets/css/other/facture.css') }}
    {{ HTML::style('public/assets/css/other/font_fac.css') }}
      <style>
     @media print {
      #sidebar-menu, #desktop-menu, footer, #btn-invoice {
        display: none;
      }
     .container {
        margin-top:2px;
        padding-top: 0;
    }

    .footer_tb {
        padding-bottom: 12px;
        margin-top: 20px;
    }

     body[size="A4"] {
        margin: 0;
        box-shadow: 0;
        color:#000;
        line-height: 80%; text-align: justify; background: transparent
      }
     
     }
    
    @page {
        /*size: 7in 9.25in;*/
        size: 22cm 25.7cm; margin: 1cm;
        /*size: landscape;*/
        margin-top: 20px;
        width: 5rem;
        card: nonre;
        line-height: 120%; text-align: justify; background: transparent
    }
  </style>  
</head>
<body>
  <div>
    <div class="theme-container no-sidebar">
      <!--<header class="navbar" id="btn-invoice">
      <a class="home-link router-link-active" href="/admin"><span class="site-name">SCOLX</span></a>
        <div class="links">
          <nav class="nav-links can-hide">
            <div class="nav-item">
              <button type="button" id="btn-invoice" onclick="window.print();" class="nav-link ltr:ml-5 rtl:mr-5" style="color:blue"><span class="la la-print text-xl"></span> Imprimer</button>
            </div>            
          </nav>
        </div>
      </header>-->
      <main class="page">
      <div class="theme-default-content content__default" style="border:1px #bcdff3 dotted;">
            <div class="bg-white">
            <div id="btn-invoice" class="flex flex-wrap flex-row -mx-6 justify-center">
              <button type="button" id="btn-invoice" onclick="window.print();" class="py-2 px-4 inline-block text-center mb-3 rounded leading-5 text-gray-100 bg-indigo-500 border border-indigo-500 hover:text-white hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2 inline-block bi bi-printer" viewbox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
              </svg>Imprimer
             </button>
            </div>
                <div class="flex justify-between items-center">
                  <div class="flex flex-col">
                    <div class="text-2xl mb-1">
                      <img class="inline-block w-12 h-auto mr-2 shadow-xl rounded-xl" src="{{ url() }}/public/uploads/logo/{{$control->logo}}">ESIGE
                    </div>
                    <p class="text-sm"><b class="text-red-600">É</b>cole <b class="text-red-600">S</b>upérieure d'<b class="text-red-600">I</b>nformatique<br> et de <b class="text-red-600">G</b>estion des <b class="text-red-600">E</b>ntreprises<br>Mahajanga, Madagascar</p>
                  </div>
                   {{ QrCode::encoding("UTF-8")->size(130)->generate($control->school_name.'Enseignement Supérieur|' .$control->email);}}
                </div>
                <div class="text-xl flex items-center justify-center">
                  <span class="uppercase">
                    Unités d’enseignement
                  </span>
                </div>
                <center>
                  <p>
                  <u class="font-bold">Niveau</u>: {{$class->name}} @if($class->id >=2) | <u class="font-bold">Parcours</u>: {{$parcour->name}}<br>@endif
                  </p>
                </center>
                <div align="center">
                <table class="table-sm table-bordered mt-5" cellspacing="0" cellpadding="0"> 
                <tbody>
                <tr>
                <td colspan="4" valign="top" width="450">
                <p align="center"><strong>SEMESTRE 1</strong></p>
                </td>
                </tr>
                <tr>
                 <td valign="top" width="50">
                <strong>Code UE</strong>
                </td> 
                <td valign="top" width="472"><strong>Unités d’enseignement</strong></td>
                <td valign="top" width="78">
                <strong>Elements Constitutif</strong>
                </td>
                <td valign="top" width="78">
                <p align="center"><strong>Crédits</strong></p>
                </td>
                </tr>
              @foreach($ue_print_1 as $sem_1)
                <tr class="">
                <td valign="top" width="50">
                  {{$sem_1->codeUe}}
                </td>  
                <td valign="top" width="472">
                  {{$sem_1->name}}
                </td>
                <td valign="top" width="475">
                  <?php $elements = EC::where('codeUe', $sem_1->codeUe)->where('parcour_id', $sem_1->parcour_id)
                                  ->where('class_id', $sem_1->class_id)->orderBy('id', 'desc')->get(); ?>
                   @foreach($elements as $el)
                   - {{ $el->name.''}}<br>
                   @endforeach  
                </td>
                <td valign="top" width="78">
                <p align="center"><strong>{{$sem_1->credit}}</strong></p>
                </td>
                </tr>
              @endforeach
                <tr>
                <td colspan="3" valign="top" width="372">
                <p align="right" class="font-bold">Total</p>  
                </td>
                 <td valign="top" width="78">
                <p align="center"><strong>{{$credit_one}}</strong></p>
                </td>
                </tr>
                <tr>
                <td colspan="4" valign="top" width="450">
                <p align="center"><strong>SEMESTRE 2</strong></p>
                </td>
                </tr>

            @foreach($ue_print_2 as $sem_2)
                <tr class="">
                <td valign="top" width="372">{{$sem_2->codeUe}}</td>
                <td valign="top" width="472">
                  {{$sem_2->name}}
                </td>
                <td valign="top" width="475">
                  <?php $exo = EC::where('codeUe', $sem_2->codeUe)->where('parcour_id', $sem_2->parcour_id)
                                  ->where('class_id', $sem_2->class_id)->orderBy('id', 'desc')->get(); ?>
                   @foreach($exo as $ex)
                   - {{ $ex->name.''}}<br>
                   @endforeach  
                </td>
                 <td valign="top" width="78">
                <p align="center"><strong>{{$sem_2->credit}}</strong></p>
                </td>
                </tr>
              @endforeach
                <tr>
                <td colspan="3" valign="top" width="372">
                <p align="right" class="font-bold">Total</p>
                </td>
                 <td valign="top" width="78">
                <p align="center"><strong>{{$sumCredit_2}}</strong></p>
                </td>
                </tr>
                </tbody>
                </table>
                <p>&nbsp;</p>
                </div>
                </div>
            </div>
          </div>
        </div>
      </main>
<script src="{{ url() }}/public/assets/js/other/facture.js"></script>
</body>
</html>