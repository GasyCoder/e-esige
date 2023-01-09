<!-- Modal Add -->
    <div id="add" class="modal" data-animations="fadeInDown, fadeOutUp" data-static-backdrop>
        <div class="modal-dialog modal-dialog_centered max-w-2xl">
            <div class="modal-content w-full">
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter nouveau UE</h4>
                    <button type="button" onclick="refresh();" class="close la la-times" data-dismiss="modal"></button>
                </div>
           <div class="modal-body"> 
        <div class="flex flex-col gap-y-5 lg:col-span-2 xl:col-span-1">
       <div id="resultajax" class="center"></div>
        
        {{ Form::open(['route'=>['storeUe', $class->id, $parcour->id], 'class'=>'flex flex-wrap flex-row -mx-4', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}        
             @if($class->id >= 2)  
               <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="custom-radio">
                        <input type="radio" name="choix" checked value="1">
                            <span></span>
                            <span style="font-weight:bold;color:green;">Obligatoire</span>
                    </label>
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="custom-radio">
                        <input type="radio" name="choix" value="2">
                            <span></span>
                            <span style="font-weight:bold;color:red;">Facultatif</span>
                    </label>
                </div>
                <div class="mb-5  px-4 w-full">
                  <label class="label block mb-2" for="codeSem">Semestres</label>
                  <div class="custom-select">
                   <select class="form-control" name="codeSem" id="codeSem">
                        <option selected disabled>Choisir</option>
                           @foreach($semestres as $sem)
                             <option value="{{ $sem->codeSem }}">{{ $sem->semestre }}</option>
                           @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>
                </div>
                @endif
                @if($class->id == 1) 
                <input type="hidden" name="codeSem" value="ap">
                @endif
                <div class="mb-5  px-4 w-full">
                    <label class="label block mb-2" for="name">Intitulé</label>
                    <input id="name" type="text" name="name" class="form-control">
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="label block mb-2" for="codeUe">Code UE</label>
                    <input id="codeUe" type="text" name="codeUe" class="form-control">
                </div>
                <div class="mb-5 flex-shrink px-4 w-full xl:w-1/2">
                    <label class="label block mb-2" for="name">Nombre de crédit</label>
                    <input id="credit" type="number" name="credit" class="form-control">
                </div>

                <input type="hidden" name="class_id" class="form-control" value="{{$class->id}}">
                <input type="hidden" name="parcour_id" class="form-control" value="{{$parcour->id}}"> 
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
                    <div class="flex ltr:ml-auto rtl:mr-auto">
                        <button type="button" class="badge badge_primary ltr:ml-auto rtl:mr-auto font-bold" onclick="refresh();"><span class="la la-check-circle text-xl"></span> Fait</button>
                        <button type="submit" class="btn btn_success ltr:ml-2 rtl:mr-2"><span class="la la-plus-circle"></span>Ajouter</button>
                    </div>
                </div>
 {{ Form::close() }}
 @include('admin.pedagogie.UE.jsAdd')
            </div> 
           </div> 
        </div>
       </div> 
      </div>          



