
<div class="breadcrumb breadcrumb_alt p-5">
    <div class="mt-5">
        <div id="sortable-style-3" class="grid lg:grid-cols-4 gap-5">
        <a href="{{URL::route('index_pay')}}">
            <div class="card border border-divider px-4 py-8 text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <span class="text-primary text-5xl leading-none la la-file-invoice-dollar"></span>
                <h5 class="text-primary leading-none mt-5">Paiements</h5>
                <p class="mt-2 text-gray-600">frais de foramtion + autres</p>
            </div>
        </a>
        @if($student == 1)
        <a href="{{URL::route('cours_index')}}">
            <div class="card border border-divider px-4 py-8 text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <span class="text-primary text-5xl leading-none la la-book"></span>
                <h5 class="text-primary leading-none mt-5">Leçons/Cours</h5>
                <p class="mt-2 text-gray-600">format .pdf,ppt,docx</p>
            </div>
        </a>
        @else
        <div class="border border-divider px-4 py-8 text-center">
            <span class="text-gray-300 text-5xl leading-none la la-lock"></span>
            <h5 class="text-gray-300 leading-none mt-5">Menu bloquer</h5>
            <p class="mt-2 text-gray-300">Bientôt disponible</p>
        </div>
        @endif
        <a href="#">
            <div class="card border border-divider px-4 py-8 text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <span class="text-primary text-5xl leading-none la la-file-contract"></span>
                <h5 class="text-primary leading-none mt-5">Exercices</h5>
                <p class="mt-2 text-gray-600">Sujets + Correction</p>
            </div>
        </a>
        <a href="#">
            <div class="card border border-divider px-4 py-8 text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <span class="text-primary text-5xl leading-none la la-youtube"></span>
                <h5 class="text-primary leading-none mt-5">Explication de l'esneignant</h5>
                <p class="mt-2 text-gray-600">Explication des cours</p>
            </div>
        </a>
        <a href="#">
            <div class="card border border-divider px-4 py-8 text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <span class="text-primary text-5xl leading-none la la-cube"></span>
                <h5 class="text-primary leading-none mt-5">Programmes Universitaire</h5>
                <p class="mt-2 text-gray-600 dark:text-pimary">Session et semestre</p>
            </div>
        </a>
        <a href="#">
            <div class="card border border-divider px-4 py-8 text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <span class="text-primary text-5xl leading-none la la-user-shield"></span>
                <h5 class="text-primary leading-none mt-5">Règlements intérieur</h5>
                <p class="mt-2 text-gray-600">règles et conditions d'utulisation</p>
            </div>
        </a>
        <div class="border border-divider px-4 py-8 text-center">
                <span class="text-gray-300 text-5xl leading-none la la-lock"></span>
                <h5 class="text-gray-300 leading-none mt-5">Menu bloquer</h5>
                <p class="mt-2 text-gray-300">Bientôt disponible</p>
        </div>
        <div class="border border-divider px-4 py-8 text-center">
            <span class="text-gray-300 text-5xl leading-none la la-lock"></span>
            <h5 class="text-gray-300 leading-none mt-5">Menu bloquer</h5>
            <p class="mt-2 text-gray-300">Bientôt disponible</p>
        </div>
        </div>
    </div>
</div>

