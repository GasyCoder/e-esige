<!-- Menu Bar -->
    <aside class="menu-bar menu-sticky">
        <div class="menu-items">
            <div class="menu-header hidden">
                <a href="/" class="flex items-center mx-8 mt-8">
                    <span class="avatar w-16 h-16">JD</span>
                    <div class="ltr:ml-4 rtl:mr-4 ltr:text-left rtl:text-right">
                        <h5>John Doe</h5>
                        <p class="mt-2">Editor</p>
                    </div>
                </a>
                <hr class="mx-8 my-4">
            </div>
            <a href="/admin" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                <span class="icon la la-home"></span>
                <span class="title">Accueil</span>
            </a>
            <button class="link" data-target="[data-menu=ui]" data-toggle="tooltip-menu" data-tippy-content="users">
                <span class="icon la la-users"></span>
                <span class="title">Utilisateurs</span>
            </button>
            <button class="link" data-target="[data-menu=pages]" data-toggle="tooltip-menu" data-tippy-content="scolarite">
                <span class="icon la la-university"></span>
                <span class="title">Scolarité</span>
            </button>
            <button class="link" data-target="[data-menu=pay]" data-toggle="tooltip-menu" data-tippy-content="pay">
                <span class="icon la la-file-invoice-dollar"></span>
                <span class="title">Paiements</span>
            </button>
            <button class="link" data-target="[data-menu=applications]" data-toggle="tooltip-menu"
                data-tippy-content="suopport">
                <span class="icon la la-folder"></span>
                <span class="title">Supports</span>
            </button>
            <button class="link" data-target="[data-menu=menu]" data-toggle="tooltip-menu" data-tippy-content="examen">
                <span class="icon la la-book-open"></span>
                <span class="title">Examens</span>
            </button>
             <a href="#" class="link" data-toggle="tooltip-menu"
                data-tippy-content="settings">
                <span class="icon la la-cog"></span>
                <span class="title">Paramètre</span>
            </a>
        </div>

        <!-- UI -->
        <div class="menu-detail" data-menu="ui">
            <div class="menu-detail-wrapper">
                <h6 class="uppercase">Gestion Utilisateurs</h6>
                <a href="{{URL::route('student_admin')}}">
                    <span class="la la-user-graduate"></span>
                    Etudiants
                </a>
                <a href="{{URL::route('teacher_admin')}}">
                    <span class="la la-chalkboard-teacher"></span>
                    Enseignants 
                </a>
                <a href="{{URL::route('secretaire_admin')}}">
                    <span class="la la-user-plus"></span>
                    Sécretaire
                </a>
            </div>
        </div>

        <!-- Pages -->
        <div class="menu-detail" data-menu="pages">
            <div class="menu-detail-wrapper">
                <h6 class="uppercase">Gestion scolarité</h6>
                <a href="{{URL::route('addniveau')}}">
                    <span class="la la-cubes"></span>
                    Niveaux
                </a>
                <a href="{{URL::route('indexParcour')}}">
                    <span class="la la-list"></span>
                    Parcours
                </a>
                <a href="{{URL::route('tarif_index')}}">
                    <span class="la la-file-invoice-dollar"></span>
                    Tarifs
                </a>
                <hr>
                <h6 class="uppercase">Gestions des matières</h6>
                <a href="{{URL::route('indexUe')}}">
                    <span class="la la-list"></span>
                    Unité d'Enseignements
                </a>
                <a href="{{URL::route('indexEc')}}">
                    <span class="la la-list"></span>
                    Elements Constitutifs
                </a>
                <hr>
                <h6 class="uppercase">Contrôle</h6>
                <a href="blog-list.html">
                    <span class="la la-dollar"></span>
                    Vérification de paiement
                </a>
                <hr>
                <h6 class="uppercase">Année/Semestres</h6>
                <a href="{{URL::route('indexYear')}}">
                    <span class="la la-calendar-plus"></span>
                    Année Universitaire
                </a>
                <hr class="border-dashed">
                <a href="{{URL::route('indexSemestre')}}">
                    <span class="la la-calendar-week"></span>
                    Semestre Universitaire
                </a>
            </div>
        </div>

        <!-- Payement -->
        <div class="menu-detail" data-menu="pay">
            <div class="menu-detail-wrapper">
                <h6 class="uppercase">Gestion de paiement</h6>
                <a href="{{URL::route('typeControle')}}">
                    <span class="la la-user-graduate"></span>
                    Type de paiement
                </a>
                <a href="{{URL::route('motifControle')}}">
                    <span class="la la-chalkboard-teacher"></span>
                    Motif de paiement 
                </a>
                <a href="{{URL::route('regleControle')}}">
                    <span class="la la-user-plus"></span>
                    Règles de paiement
                </a>
            </div>
        </div>

        <!-- Applications -->
        <div class="menu-detail" data-menu="applications">
            <div class="menu-detail-wrapper">
                <h6 class="uppercase">Support des cours</h6>
                <a href="applications-media-library.html">
                    <span class="la la-file-pdf"></span>
                    Cours en pdf
                </a>
                <a href="applications-point-of-sale.html">
                    <span class="la la-file-alt"></span>
                    Exercices
                </a>
            </div>
        </div>
        <!-- examen -->
         <div class="menu-detail" data-menu="menu">
            <h6 class="uppercase">Gestion des examens</h6>
            <div class="menu-detail-wrapper">
                <a href="#no-link">
                    <span class="la la-file-alt"></span>
                    Ajouter sujet
                </a>
                <a href="#no-link">
                    <span class="la la-sitemap"></span>
                    Configuration
                </a>
                </div>
            </div>
        </div>
    </aside>