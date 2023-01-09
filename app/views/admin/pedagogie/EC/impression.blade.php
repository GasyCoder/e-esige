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
        size: 21cm 28.9cm; margin: 1cm;
        /*size: landscape;*/
        margin-top: 20px;
        width: 5rem;
        card: nonre;
        line-height: 120%; text-align: justify; background: transparent
    }
  </style>  
</head>
<body>
    <div class="theme-container no-sidebar">
      <main class="page">
      <div class="theme-default-content content__default" style="border:1px #bcdff3 dotted;">
      <div class="">
             <div class="">
              <div class="p-6 bg-white">
            <div id="btn-invoice" class="flex flex-wrap flex-row -mx-6 justify-center">
              <button type="button" id="btn-invoice" onclick="window.print();" class="py-2 px-4 inline-block text-center mb-3 rounded leading-5 text-gray-100 bg-indigo-500 border border-indigo-500 hover:text-white hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2 inline-block bi bi-printer" viewbox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
              </svg>Imprimer</button>
            </div>
                <div class="flex justify-between items-center border-b border-gray-200">
                  <div class="flex flex-col">
                    <div class="text-2xl mb-1">
                      <img class="inline-block w-12 h-auto mr-2 shadow-xl rounded-xl" src="{{ url() }}/public/uploads/logo/{{$control->logo}}">ESIGE
                    </div>
                    <p class="text-sm"><b class="text-red-600">É</b>cole <b class="text-red-600">S</b>upérieure d'<b class="text-red-600">I</b>nformatique<br> et de <b class="text-red-600">G</b>estion des <b class="text-red-600">E</b>ntreprises<br>Mahajanga, Madagascar</p>
                  </div>
                   {{ QrCode::encoding("UTF-8")->size(130)->generate($control->school_name.'Enseignement Supérieur|' .$control->email);}}
                </div>
                <div class="text-xl font-bold flex items-center justify-center mt-3">
                  <span class="">ELEMENTS CONSTITUTIFS</span>
                </div>
                <center>
                  <u class="font-bold">Niveau</u>: {{$class->name}}@if($class->id >= 2) | <u class="font-bold">Parcours</u>: {{$parcour->name}}<br>@endif
                </center>

        				<table class="table-sm table-bordered w-full text-left text-gray-900 mt-5">
        				  <thead>
                    <tr class="text-sm"> 
                     <th colspan="7" style="text-align:center;">
                     	<p align="center"><strong>SEMESTRE 1</strong></p>
                     </th>
                    </tr>
        				    <tr class="bg-gray-50 text-gray-800">
        		        <th class="ltr:text-left rtl:text-right" style="text-align:center;">#</th>
        		        <th class="ltr:text-left rtl:text-right">Code</th>
        					  <th>Matières</th>
        		        <th class="text-center">Vol H</th>
        					  <th class="text-center">Coéf</th>
                    <th class="text-center">Enseignant</th>
                    @if($class->id >= 2)
        				    <th class="text-center">Tronc</th>
                    @endif
        				    </tr>
        				  </thead>
        				  <tbody>
          		    @foreach($matires_S1 as $key => $print)
          				<tr class="text-gray-800">
          	          <td class="text-center">{{$key+1}}</td>
          	          <td>{{$print->codeEc}}</td>
          				    <td class="h">{{$print->name}}</td>
          			      <td class="text-center">{{$print->volH}}</td>
          			      <td class="text-center">{{$print->coef}}</td>
                      @if(!empty($print->id_teacher))
                      <td class="text-center">
                        @if($print->teacher->sexe == 1)Mr.@else Mme.@endif{{$print->teacher->lname}}
                      </td>
                      @else
                      <td class="text-center">Aucun</td>
                      @endif
                      @if($class->id >= 2)
                  	  <td class="text-center">
                  	  	@if($print->tronc == 1)
                  	  	<span class="inline-block leading-none text-center py-1 px-2 bg-red-700 text-gray-100 font-bold rounded-xl ab" style="font-size:.75em;">Oui</span>
                  	  	@else
                  	  	<span class="inline-block leading-none text-center py-1 px-2 bg-green-700 text-gray-100 font-bold rounded-xl pr" style="font-size:.75em;">Non</span>
                  	  	@endif
                  	  </td>
                      @endif
          				</tr>
          		    @endforeach
        				  </tbody>
        				</table> 

                <table class="table-sm table-bordered w-full text-left text-gray-900 mt-5">
                  <thead>
                    <tr class="text-sm"> 
                     <th colspan="7" style="text-align:center;">
                      <p align="center"><strong>SEMESTRE 2</strong></p>
                     </th>
                    </tr>
                    <tr class="bg-gray-50 text-gray-800">
                    <th class="ltr:text-left rtl:text-right" style="text-align:center;">#</th>
                    <th class="ltr:text-left rtl:text-right">Code</th>
                    <th>Matières</th>
                    <th class="text-center" width="80">Vol H</th>
                    <th class="text-center">Coéf</th>
                    <th class="text-center">Enseignant</th>
                    @if($class->id >= 2)
                    <th class="text-center">Tronc</th>
                    @endif
                    </tr>
                  </thead>

                  <tbody>
                  @foreach($matires_S2 as $key => $print_2)
                  <tr class="text-gray-800">
                      <td class="text-center">{{$key+1}}</td>
                      <td>{{$print_2->codeEc}}</td>
                      <td class="h">{{$print_2->name}}</td>
                      <td class="text-center">{{$print_2->volH}}</td>
                      <td class="text-center">{{$print_2->coef}}</td>
                      @if(!empty($print->id_teacher))
                      <td class="text-center">{{$print->teacher->lname}}</td>
                      @else
                      <td class="text-center">Aucun</td>
                      @endif
                      @if($class->id >= 2)
                      <td class="text-center">
                        @if($print_2->tronc == 1)
                        <span class="inline-block leading-none text-center py-1 px-2 bg-red-700 text-gray-100 font-bold rounded-xl ab" style="font-size:.75em;">Oui</span>
                        @else
                        <span class="inline-block leading-none text-center py-1 px-2 bg-green-700 text-gray-100 font-bold rounded-xl pr" style="font-size:.75em;">Non</span>
                        @endif
                      </td>
                      @endif
                  </tr>
                @endforeach
                  </tbody>
                </table>          
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
<script src="{{ url() }}/public/assets/js/other/facture.js"></script>
</body>
</html>