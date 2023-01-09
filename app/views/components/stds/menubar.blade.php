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
            <a href="{{URL::route('panel.student')}}" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                <span class="icon la la-home"></span>
                <span class="title">Accueil</span>
            </a>
             <a href="#" class="link" data-toggle="tooltip-menu"
                data-tippy-content="settings">
                <span class="icon la la-euro-sign"></span>
                <span class="title">Paiement</span>
            </a>
             <a href="#" class="link" data-toggle="tooltip-menu"
                data-tippy-content="settings">
                <span class="icon la la-user-circle"></span>
                <span class="title">Mon compte</span>
            </a>
        </div>
    </aside>