<?php 
$token      = Auth::user()->token;
$profile    = Student::where('token', $token)->first();
$user       = Profil::where('token',  $token)->first();
$pay_count  = Pay::where('read', 0)->where('status', 1)->where('id_student', $user->id)->count();
$pay_notifs = Pay::where('read', 0)->where('status', 1)->where('id_student', $user->id)->get(); 
?>
@include('components.timeAgo');
 <!-- Top Bar -->
    <header class="top-bar">
        <!-- Menu Toggler -->
        <button class="menu-toggler la la-bars" data-toggle="menu"></button>
        <!-- Brand -->
        <span class="brand">{{$control->univ_name}}</span>
        <!-- Right -->
        <div class="flex items-center ltr:ml-auto rtl:mr-auto">
            <!-- Dark Mode -->
            <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
                <input id="darkModeToggler" type="checkbox">
                <span></span>
            </label>
            <!-- Fullscreen -->
            <button id="fullScreenToggler"
                class="hidden lg:inline-block ltr:ml-3 rtl:mr-3 px-2 text-2xl leading-none la la-expand-arrows-alt"
                data-toggle="tooltip" data-tippy-content="Fullscreen"></button>
            <!-- Notifications -->
            <div class="dropdown self-stretch">
                <button class="relative flex items-center h-full ltr:ml-1 rtl:mr-1 px-2 text-2xl leading-none la la-bell" data-toggle="custom-dropdown-menu" data-tippy-arrow="true" data-tippy-placement="bottom-end">
                @if($pay_count >= 1)    
                    <span class="absolute top-0 right-0 rounded-full border border-red-500 bg-danger -mt-1 -mr-1 px-2 leading-tight text-xs font-body text-gray-100">
                       {{$pay_count}}
                    </span>
                @endif    
                </button>
                <div class="custom-dropdown-menu">
                    <div class="flex items-center px-5 py-2">
                        <h5 class="mb-0 uppercase">Notifications</h5>
                    </div>
                    <hr>  
                   @foreach($pay_notifs as $key => $pay_notif) 
                    <div class="p-5 hover:bg-primary hover:bg-opacity-5">
                        <a href="{{URL::route('readnotifypay', $pay_notif->token)}}">
                            <h6 class="uppercase">{{$pay_notif->motif}}</h6>
                        <p class="text-gray-600">{{ substr($pay_notif->msg, 0, 40)}}...</p>
                        <small>{{ timeAgo($pay_notif->created_at) }}</small>
                        </a>
                    </div>
                    <hr>
                   @endforeach
                </div>
            </div>

            <!-- User Menu -->
            <div class="dropdown">
                <button class="flex items-center ltr:ml-4 rtl:mr-4" data-toggle="custom-dropdown-menu"
                    data-tippy-arrow="true" data-tippy-placement="bottom-end">
                    @if(!empty($user->photo))
                        <div class="avatar avatar_with-shadow">
                        <div class="status bg-success"></div>
                        <?php echo HTML::image('uploads/profiles/students/'.$user->photo) ?>
                       </div>
                    @else
                    <span class="avatar">
                        <?php 
                          $fname = substr($profile->fname,0,1);
                          $lname = substr($profile->lname,0,1);
                        ?>
                        <span class="avatar_with-shadow avatar font-bold bg-primary">
                           <div class="status bg-success"></div> 
                            {{$fname.''.$lname}}
                        </span>
                    </span>
                   @endif 
                </button>
                <div class="custom-dropdown-menu w-64">
                    <div class="p-5">
                        <h5 class="uppercase">{{$profile->fname.' '.$profile->lname}}</h5>
                        <p>@if($user->sexe == 1)Etudiant @else Etudiante @endif</p>
                    </div>
                    <hr>
                    <div class="p-5">
                        <a href="{{URL::route('studprofile', $profile->token)}}" class="flex items-center text-normal hover:text-primary">
                            <span class="la la-user-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                            Voir le profil
                        </a>
                    </div>
                    <hr>
                    <div class="p-5">
                        <a href="{{URL::route('logout')}}" class="flex items-center text-normal hover:text-primary">
                            <span class="la la-power-off text-2xl leading-none ltr:mr-2 rtl:ml-2 text-red-700"></span>
                            Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>