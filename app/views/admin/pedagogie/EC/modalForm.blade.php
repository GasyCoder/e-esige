<!-- Modal Add -->
    <div id="add" class="modal" data-animations="fadeInDown, fadeOutUp" data-static-backdrop>
        <div class="modal-dialog modal-dialog_centered max-w-2xl">
            <div class="modal-content w-full">
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter nouveau EC</h4>
                    <button type="button" onclick="refresh();" class="close la la-times" data-dismiss="modal"></button>
                </div>
           <div class="modal-body"> 
        <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
        <!-- Publish -->
        <div id="resultajax" class="center"></div>
        {{ Form::open(['route'=>['storeEc', $class->id, $parcour->id], 'class'=>'flex flex-wrap flex-row -mx-4', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}   

                       <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="codeUe">Unité d'enseignements</label>
                            <div class="custom-select">
                                <select class="form-control" name="codeUe" id="codeUe">   
                                <option value="" selected disabled>Choisir</option>
                                @foreach($ues as $uex)
                                    <option value="{{ $uex->codeUe }}">({{ $uex->codeUe }}) - {{ $uex->name }}</option>
                                @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>
                        </div>
                       <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="name">Intitulé</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="codeEc">Code EC</label>
                            <input type="text" id="codeEc" name="codeEc" class="form-control">
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="abr">Abréviation</label>
                           <input type="text" id="abr" name="abr" class="form-control">
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="volH">Volume horaire</label>
                            <input type="number" id="volH" name="volH" class="form-control">
                        </div>
                        <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                            <label class="label block mb-2" for="coef">Coeficients</label>
                            <input type="number" id="coef" name="coef" class="form-control">
                        </div>
                      <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="semestre">Semestres</label>
                          <select name="semestre" id="semestre" class="form-control semestre">
                            <option value="" selected disabled>Semestres</option>
                             @foreach($semes as $seme)
                                <option value="{{ $seme->codeSem }}">{{ $seme->semestre }}</option>
                             @endforeach
                         </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                      </div>
                      <div class="mb-5 flex-shrink px-4 w-full">
                            <label class="label block mb-2" for="choix">Choix</label>
                          <select name="choix" id="choix" class="form-control choix">
                            <option value="" selected disabled>Choix</option>
                             @foreach($choixs as $choix)
                                <option value="{{ $choix->id }}">{{ $choix->id }}</option>
                             @endforeach
                         </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                      </div>      
                    <input type="hidden" class="form-control" name="class_id" id="class" value="{{$class->id }}">
                    <input type="hidden" class="form-control" name="parcour_id" id="parcour" value="{{$parcour->id }}">
                    <div class="mb-5 unites flex-shrink px-4 w-full">
                        @if($class->id == 1)
                        <div class="flex items-center">
                        <div class="w-1/1">
                            <label class="label block">Copier pour AL</label>
                        </div>
                        <div class="w-2/4 ml-2">
                            <label class="label switch">
                                <input type="checkbox" name="al_value" checked value="{{$parcour->id }}">
                                <span></span>
                                <span>Oui</span>
                            </label>
                        </div>
                        </div>
                        @endif
                        <div class="mt-10 flex-shrink px-4 w-full">
                            <button type="button" class="badge badge_primary ltr:ml-auto rtl:mr-auto font-bold" onclick="refresh();"><span class="la la-check-circle text-xl"></span> Fait</button>
                            <button type="submit" class="btn btn_success ltr:ml-2 rtl:mr-2"><span class="la la-plus-circle"></span>Ajouter</button>
                        </div>
                      {{ Form::close() }}
                @include('admin.pedagogie.EC.jsAdd')

<script type="text/javascript">
$(document).ready(function () { 

            $('#codeUe').on('change',function(e){
            var codeUe = e.target.value;

            $(".semestre").css ({"display":"block"});

            $.ajax({
            type: "GET",
            url: "{{ url() }}/ajax-semestre?codeUe="+codeUe,
                success: function(data) {  
                    var subcat =  $('#semestre').empty();
                    //subcat.append('<option value =""  selected disabled>Date de promotion</option>');
                    $.each(data,function(create,subcatObj){
                    var option = $('<option/>', {id:create, value:subcatObj});
                    subcat.append('<option value ="'+subcatObj+'" class="text-primary font-bold">'+create+'</option>');
                    });
                }
            });
        });
});
$(document).ready(function () { 

            $('#codeUe').on('change',function(e){
            var codeUe = e.target.value;

            $(".choix").css ({"display":"block"});

            $.ajax({
            type: "GET",
            url: "{{ url() }}/ajax-choix?codeUe="+codeUe,
                success: function(data) {  
                    var subcat =  $('#choix').empty();
                    //subcat.append('<option value =""  selected disabled>Date de promotion</option>');
                    $.each(data,function(create,subcatObj){
                    var option = $('<option/>', {id:create, value:subcatObj});
                    subcat.append('<option value ="'+subcatObj+'" class="text-primary font-bold">'+create+'</option>');
                    });
                }
            });
        });
});
</script>    

            </div> 
           </div> 
        </div>
       </div> 
      </div>