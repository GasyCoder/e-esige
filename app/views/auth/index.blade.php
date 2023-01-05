<!DOCTYPE html>
<html lang="en" dir="ltr"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Yeti</title>
    <!-- Generics -->
    <link rel="icon" href="assets/images/favicon/favicon-32.png" sizes="32x32">
    <link rel="icon" href="assets/images/favicon/favicon-128.png" sizes="128x128">
    <link rel="icon" href="assets/images/favicon/favicon-192.png" sizes="192x192">
    <!-- Android -->
    <link rel="shortcut icon" href="assets/images/favicon/favicon-196.png" sizes="196x196">
    <!-- iOS -->
    <link rel="apple-touch-icon" href="assets/images/favicon/favicon-152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="assets/images/favicon/favicon-167.png" sizes="167x167">
    <link rel="apple-touch-icon" href="assets/images/favicon/favicon-180.png" sizes="180x180">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Top Bar -->
    <header class="top-bar">

        <!-- Menu Toggler -->
        <button class="menu-toggler la la-bars" data-toggle="menu"></button>

        <!-- Brand -->
        <span class="brand">Yeti</span>

        <!-- Search -->
        <form class="hidden md:block ltr:ml-10 rtl:mr-10">
            <label class="form-control-addon-within rounded-full">
                <input class="form-control border-none" placeholder="Search">
                <button class="text-gray-300 dark:text-gray-700 text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
            </label>
        </form>

        <!-- Right -->
        <div class="flex items-center ltr:ml-auto rtl:mr-auto">

            <!-- Dark Mode -->
            <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
                <input id="darkModeToggler" type="checkbox">
                <span></span>
            </label>

            <!-- Fullscreen -->
            <button id="fullScreenToggler" class="hidden lg:inline-block ltr:ml-3 rtl:mr-3 px-2 text-2xl leading-none la la-expand-arrows-alt" data-toggle="tooltip" data-tippy-content="Fullscreen"></button>

            <!-- Apps -->
            <div class="dropdown self-stretch">
                <button class="flex items-center h-full ltr:ml-4 rtl:mr-4 lg:ltr:ml-1 lg:rtl:mr-1 px-2 text-2xl leading-none la la-box" data-toggle="custom-dropdown-menu" data-tippy-arrow="true" data-tippy-placement="bottom">
                </button>
                <div class="custom-dropdown-menu p-5 text-center">
                    <div class="flex justify-around">
                        <a href="#no-link" class="p-5 text-normal hover:text-primary">
                            <span class="block la la-cog text-5xl leading-none"></span>
                            <span>Settings</span>
                        </a>
                        <a href="#no-link" class="p-5 text-normal hover:text-primary">
                            <span class="block la la-users text-5xl leading-none"></span>
                            <span>Users</span>
                        </a>
                    </div>
                    <div class="flex justify-around">
                        <a href="#no-link" class="p-5 text-normal hover:text-primary">
                            <span class="block la la-book text-5xl leading-none"></span>
                            <span>Docs</span>
                        </a>
                        <a href="#no-link" class="p-5 text-normal hover:text-primary">
                            <span class="block la la-dollar text-5xl leading-none"></span>
                            <span>Shop</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="dropdown self-stretch">
                <button class="relative flex items-center h-full ltr:ml-1 rtl:mr-1 px-2 text-2xl leading-none la la-bell" data-toggle="custom-dropdown-menu" data-tippy-arrow="true" data-tippy-placement="bottom-end">
                    <span class="absolute top-0 right-0 rounded-full border border-primary -mt-1 -mr-1 px-2 leading-tight text-xs font-body text-primary">3</span>
                </button>
                <div class="custom-dropdown-menu">
                    <div class="flex items-center px-5 py-2">
                        <h5 class="mb-0 uppercase">Notifications</h5>
                        <button class="btn btn_outlined btn_warning uppercase ltr:ml-auto rtl:mr-auto">Clear All</button>
                    </div>
                    <hr>
                    <div class="p-5 hover:bg-primary hover:bg-opacity-5">
                        <a href="#no-link">
                            <h6 class="uppercase">Heading One</h6>
                        </a>
                        <p>Lorem ipsum dolor, sit amet consectetur.</p>
                        <small>Today</small>
                    </div>
                    <hr>
                    <div class="p-5 hover:bg-primary hover:bg-opacity-5">
                        <a href="#no-link">
                            <h6 class="uppercase">Heading Two</h6>
                        </a>
                        <p>Mollitia sequi dolor architecto aut deserunt.</p>
                        <small>Yesterday</small>
                    </div>
                    <hr>
                    <div class="p-5 hover:bg-primary hover:bg-opacity-5">
                        <a href="#no-link">
                            <h6 class="uppercase">Heading Three</h6>
                        </a>
                        <p>Nobis reprehenderit sed quos deserunt</p>
                        <small>Last Week</small>
                    </div>
                </div>
            </div>

            <!-- User Menu -->
            <div class="dropdown">
                <button class="flex items-center ltr:ml-4 rtl:mr-4" data-toggle="custom-dropdown-menu" data-tippy-arrow="true" data-tippy-placement="bottom-end">
                    <span class="avatar">JD</span>
                </button>
                <div class="custom-dropdown-menu w-64">
                    <div class="p-5">
                        <h5 class="uppercase">John Doe</h5>
                        <p>Editor</p>
                    </div>
                    <hr>
                    <div class="p-5">
                        <a href="#no-link" class="flex items-center text-normal hover:text-primary">
                            <span class="la la-user-circle text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                            View Profile
                        </a>
                        <a href="#no-link" class="flex items-center text-normal hover:text-primary mt-5">
                            <span class="la la-key text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                            Change Password
                        </a>
                    </div>
                    <hr>
                    <div class="p-5">
                        <a href="#no-link" class="flex items-center text-normal hover:text-primary">
                            <span class="la la-power-off text-2xl leading-none ltr:mr-2 rtl:ml-2"></span>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
            <a href="index.html" class="link" data-toggle="tooltip-menu" data-tippy-content="Dashboard">
                <span class="icon la la-laptop"></span>
                <span class="title">Dashboard</span>
            </a>
            <button class="link" data-target="[data-menu=ui]" data-toggle="tooltip-menu" data-tippy-content="UI">
                <span class="icon la la-cube"></span>
                <span class="title">UI</span>
            </button>
            <button class="link" data-target="[data-menu=pages]" data-toggle="tooltip-menu" data-tippy-content="Pages">
                <span class="icon la la-file-alt"></span>
                <span class="title">Pages</span>
            </button>
            <button class="link" data-target="[data-menu=applications]" data-toggle="tooltip-menu" data-tippy-content="Applications">
                <span class="icon la la-store"></span>
                <span class="title">Applications</span>
            </button>
            <button class="link" data-target="[data-menu=menu]" data-toggle="tooltip-menu" data-tippy-content="Menu">
                <span class="icon la la-sitemap"></span>
                <span class="title">Menu</span>
            </button>
            <a href="blank.html" class="link" data-toggle="tooltip-menu" data-tippy-content="Blank Page">
                <span class="icon la la-file"></span>
                <span class="title">Blank Page</span>
            </a>
            <a href="https://yeti.yetithemes.net/docs" target="_blank" class="link" data-toggle="tooltip-menu" data-tippy-content="Docs">
                <span class="icon la la-book-open"></span>
                <span class="title">Docs</span>
            </a>
        </div>

        <!-- Dashboard -->
 
        <div class="menu-detail" data-menu="dashboard">
            <div class="menu-detail-wrapper">
                <a href="index.html">
                    <span class="la la-cube"></span>
                    Default
                </a>
                <a href="index.html">
                    <span class="la la-file-alt"></span>
                    Content
                </a>
                <a href="index.html">
                    <span class="la la-shopping-bag"></span>
                    Ecommerce
                </a>
            </div>
        </div>


        <!-- UI -->
        <div class="menu-detail" data-menu="ui">
            <div class="menu-detail-wrapper">
                <h6 class="uppercase">Form</h6>
                <a href="form-components.html">
                    <span class="la la-cubes"></span>
                    Components
                </a>
                <a href="form-input-groups.html">
                    <span class="la la-stop"></span>
                    Input Groups
                </a>
                <a href="form-layout.html">
                    <span class="la la-th-large"></span>
                    Layout
                </a>
                <a href="form-validations.html">
                    <span class="la la-check-circle"></span>
                    Validations
                </a>
                <a href="form-wizards.html">
                    <span class="la la-hand-pointer"></span>
                    Wizards
                </a>
                <hr>
                <h6 class="uppercase">Components</h6>
                <a href="components-alerts.html">
                    <span class="la la-bell"></span>
                    Alerts
                </a>
                <a href="components-avatars.html">
                    <span class="la la-user-circle"></span>
                    Avatars
                </a>
                <a href="components-badges.html">
                    <span class="la la-certificate"></span>
                    Badges
                </a>
                <a href="components-buttons.html">
                    <span class="la la-play"></span>
                    Buttons
                </a>
                <a href="components-cards.html">
                    <span class="la la-layer-group"></span>
                    Cards
                </a>
                <a href="components-collapse.html">
                    <span class="la la-arrow-circle-right"></span>
                    Collapse
                </a>
                <a href="components-colors.html">
                    <span class="la la-palette"></span>
                    Colors
                </a>
                <a href="components-dropdowns.html">
                    <span class="la la-arrow-circle-down"></span>
                    Dropdowns
                </a>
                <a href="components-modal.html">
                    <span class="la la-times-circle"></span>
                    Modal
                </a>
                <a href="components-popovers-tooltips.html">
                    <span class="la la-thumbtack"></span>
                    Popovers &amp; Tooltips
                </a>
                <a href="components-tabs.html">
                    <span class="la la-columns"></span>
                    Tabs
                </a>
                <a href="components-tables.html">
                    <span class="la la-table"></span>
                    Tables
                </a>
                <a href="components-toasts.html">
                    <span class="la la-bell"></span>
                    Toasts
                </a>
                <hr>
                <h6 class="uppercase">Extras</h6>
                <a href="extras-carousel.html">
                    <span class="la la-images"></span>
                    Carousel
                </a>
                <a href="extras-charts.html">
                    <span class="la la-chart-area"></span>
                    Charts
                </a>
                <a href="extras-editors.html">
                    <span class="la la-keyboard"></span>
                    Editors
                </a>
                <a href="extras-sortable.html">
                    <span class="la la-sort"></span>
                    Sortable
                </a>
            </div>
        </div>

        <!-- Pages -->
        <div class="menu-detail" data-menu="pages">
            <div class="menu-detail-wrapper">
                <h6 class="uppercase">Authentication</h6>
                <a href="auth-login.html">
                    <span class="la la-user"></span>
                    Login
                </a>
                <a href="auth-forgot-password.html">
                    <span class="la la-user-lock"></span>
                    Forgot Password
                </a>
                <a href="auth-register.html">
                    <span class="la la-user-plus"></span>
                    Register
                </a>
                <hr>
                <h6 class="uppercase">Blog</h6>
                <a href="blog-list.html">
                    <span class="la la-list"></span>
                    List
                </a>
                <a href="blog-list-card-rows.html">
                    <span class="la la-list"></span>
                    List - Card Rows
                </a>
                <a href="blog-list-card-columns.html">
                    <span class="la la-list"></span>
                    List - Card Columns
                </a>
                <a href="blog-add.html">
                    <span class="la la-layer-group"></span>
                    Add Post
                </a>
                <hr>
                <h6 class="uppercase">Errors</h6>
                <a href="errors-403.html" target="_blank">
                    <span class="la la-exclamation-circle"></span>
                    403 Error
                </a>
                <a href="errors-404.html" target="_blank">
                    <span class="la la-exclamation-circle"></span>
                    404 Error
                </a>
                <a href="errors-500.html" target="_blank">
                    <span class="la la-exclamation-circle"></span>
                    500 Error
                </a>
                <a href="errors-under-maintenance.html" target="_blank">
                    <span class="la la-exclamation-circle"></span>
                    Under Maintenance
                </a>
                <hr>
                <a href="pages-pricing.html">
                    <span class="la la-dollar"></span>
                    Pricing
                </a>
                <a href="pages-faqs-layout-1.html">
                    <span class="la la-question-circle"></span>
                    FAQs - Layout 1
                </a>
                <a href="pages-faqs-layout-2.html">
                    <span class="la la-question-circle"></span>
                    FAQs - Layout 2
                </a>
                <a href="pages-invoice.html">
                    <span class="la la-file-invoice-dollar"></span>
                    Invoice
                </a>
            </div>
        </div>

        <!-- Applications -->
        <div class="menu-detail" data-menu="applications">
            <div class="menu-detail-wrapper">
                <a href="applications-media-library.html">
                    <span class="la la-image"></span>
                    Media Library
                </a>
                <a href="applications-point-of-sale.html">
                    <span class="la la-shopping-bag"></span>
                    Point Of Sale
                </a>
                <a href="applications-to-do.html">
                    <span class="la la-check-circle"></span>
                    To Do
                </a>
                <a href="applications-chat.html">
                    <span class="la la-comment"></span>
                    Chat
                </a>
            </div>
        </div>

        <!-- Menu -->
        <div class="menu-detail" data-menu="menu">
            <div class="menu-detail-wrapper">
                <a href="#no-link">
                    <span class="la la-cube"></span>
                    Default
                </a>
                <a href="#no-link">
                    <span class="la la-file-alt"></span>
                    Content
                </a>
                <a href="#no-link">
                    <span class="la la-shopping-bag"></span>
                    Ecommerce
                </a>
                <hr>
                <a href="#no-link">
                    <span class="la la-layer-group"></span>
                    Main Level
                </a>
                <a href="#no-link">
                    <span class="la la-arrow-circle-right"></span>
                    Grand Parent
                </a>
                <button class="collapse-header active" data-toggle="collapse" data-target="#menuGrandParentOpen">
                    <span class="collapse-indicator la la-arrow-circle-down"></span>
                    Grand Parent Open
                </button>
                <div id="menuGrandParentOpen" class="collapse open">
                    <a href="#no-link">
                        <span class="la la-layer-group"></span>
                        Sub Level
                    </a>
                    <a href="#no-link">
                        <span class="la la-arrow-circle-right"></span>
                        Parent
                    </a>
                    <button class="collapse-header active" data-toggle="collapse" data-target="#menuParentOpen">
                        <span class="collapse-indicator la la-arrow-circle-down"></span>
                        Parent Open
                    </button>
                    <div id="menuParentOpen" class="collapse open">
                        <a href="#no-link">
                            <span class="la la-layer-group"></span>
                            Sub Level
                        </a>
                    </div>
                </div>
                <hr>
                <h6 class="uppercase">Menu Types</h6>
                <a href="#no-link" data-toggle="menu-type" data-value="default">
                    <span class="la la-hand-point-right"></span>
                    Default
                </a>
                <a href="#no-link" data-toggle="menu-type" data-value="hidden">
                    <span class="la la-hand-point-left"></span>
                    Hidden
                </a>
                <a href="#no-link" data-toggle="menu-type" data-value="icon-only">
                    <span class="la la-th-large"></span>
                    Icons Only
                </a>
                <a href="#no-link" data-toggle="menu-type" data-value="wide">
                    <span class="la la-arrows-alt-h"></span>
                    Wide
                </a>
            </div>
        </div>
    </aside>

    <!-- IMPORTANT: Replace the following line with the contents from included file for Laravel Mix -->
    <!-- Customizer -->
    <aside id="customizer" class="sidebar sidebar_customizer">

        <!-- Togglers -->
        <div class="toggler-wrapper">
            <div>
                <button class="toggler" data-toggle="customizer">
                    <span class="la la-gear animate-spin-slow"></span>
                </button>
                <button class="randomizer mt-2" data-toggle="randomizer">
                    <span class="la la-random"></span>
                </button>
            </div>
        </div>

        <!-- Theme Customizer -->
        <div class="flex items-center justify-between h-20 p-4">
            <div>
                <h2>Theme Customizer</h2>
                <p>Customize &amp; Preview</p>
            </div>
            <button class="close text-2xl leading-none hover:text-primary la la-times" data-toggle="customizer"></button>
        </div>
        <hr>
        <div class="overflow-y-auto">
            <div class="flex items-center justify-between p-4">
                <h5>Dark Mode</h5>
                <label class="switch switch_outlined">
                    <input data-toggle="dark-mode" type="checkbox">
                    <span></span>
                </label>
            </div>
            <hr>
            <div class="flex items-center justify-between p-4">
                <h5>RTL</h5>
                <label class="switch switch_outlined">
                    <input data-toggle="rtl" type="checkbox">
                    <span></span>
                </label>
            </div>
            <hr>
            <div class="flex items-center justify-between p-4">
                <div>
                    <h5>Branded Menu</h5>
                    <small>Menu will be set to primary color</small>
                </div>
                <label class="switch switch_outlined">
                    <input data-toggle="branded-menu" type="checkbox">
                    <span></span>
                </label>
            </div>
            <hr>
            <div class="p-4">
                <h5>Menu Types</h5>
                <div id="customizerMenuTypes" class="flex flex-col space-y-2 mt-5">
      <label class="custom-radio">
        <input type="radio" name="menuType" data-toggle="menu-type" data-value="default">
        <span></span>
        <span>Default</span>
      </label>
      <label class="custom-radio">
        <input type="radio" name="menuType" data-toggle="menu-type" data-value="hidden">
        <span></span>
        <span>Hidden</span>
      </label>
      <label class="custom-radio">
        <input type="radio" name="menuType" data-toggle="menu-type" data-value="icon-only">
        <span></span>
        <span>Icon Only</span>
      </label>
      <label class="custom-radio">
        <input type="radio" name="menuType" data-toggle="menu-type" data-value="wide">
        <span></span>
        <span>Wide</span>
      </label></div>
            </div>
            <hr>
            <div class="p-4">
                <h5>Themes</h5>
                <div id="customizerThemes" class="themes">
      <button data-toggle="theme" data-value="default" class="active">
        <span class="color bg-[#0284C7]"></span>
        <span>Sky</span>
      </button>
      <button data-toggle="theme" data-value="red">
        <span class="color bg-[#DC2626]"></span>
        <span>Red</span>
      </button>
      <button data-toggle="theme" data-value="orange">
        <span class="color bg-[#EA580C]"></span>
        <span>Orange</span>
      </button>
      <button data-toggle="theme" data-value="amber">
        <span class="color bg-[#D97706]"></span>
        <span>Amber</span>
      </button>
      <button data-toggle="theme" data-value="yellow">
        <span class="color bg-[#CA8A04]"></span>
        <span>Yellow</span>
      </button>
      <button data-toggle="theme" data-value="lime">
        <span class="color bg-[#65A30D]"></span>
        <span>Lime</span>
      </button>
      <button data-toggle="theme" data-value="green">
        <span class="color bg-[#65A30D]"></span>
        <span>Green</span>
      </button>
      <button data-toggle="theme" data-value="emerald">
        <span class="color bg-[#059669]"></span>
        <span>Emerald</span>
      </button>
      <button data-toggle="theme" data-value="teal">
        <span class="color bg-[#0D9488]"></span>
        <span>Teal</span>
      </button>
      <button data-toggle="theme" data-value="cyan">
        <span class="color bg-[#0891B2]"></span>
        <span>Cyan</span>
      </button>
      <button data-toggle="theme" data-value="blue">
        <span class="color bg-[#2563EB]"></span>
        <span>Blue</span>
      </button>
      <button data-toggle="theme" data-value="indigo">
        <span class="color bg-[#4F46E5]"></span>
        <span>Indigo</span>
      </button>
      <button data-toggle="theme" data-value="violet">
        <span class="color bg-[#7C3AED]"></span>
        <span>Violet</span>
      </button>
      <button data-toggle="theme" data-value="purple">
        <span class="color bg-[#9333EA]"></span>
        <span>Purple</span>
      </button>
      <button data-toggle="theme" data-value="fuchsia">
        <span class="color bg-[#C026D3]"></span>
        <span>Fuchsia</span>
      </button>
      <button data-toggle="theme" data-value="pink">
        <span class="color bg-[#DB2777]"></span>
        <span>Pink</span>
      </button>
      <button data-toggle="theme" data-value="rose">
        <span class="color bg-[#E11D48]"></span>
        <span>Rose</span>
      </button></div>
            </div>
            <hr>
            <div class="p-4">
                <div>
                    <h5>50 Shades of Gray</h5>
                    <small>5 x 10 Shades</small>
                </div>
                <div id="customizerGrays" class="themes">
      <button data-toggle="gray" data-value="default" class="active">
        <span class="color bg-[#4B5563]"></span>
        <span>Pure</span>
      </button>
      <button data-toggle="gray" data-value="slate">
        <span class="color bg-[#475569]"></span>
        <span>Slate</span>
      </button>
      <button data-toggle="gray" data-value="zinc">
        <span class="color bg-[#52525B]"></span>
        <span>Zinc</span>
      </button>
      <button data-toggle="gray" data-value="neutral">
        <span class="color bg-[#525252]"></span>
        <span>Neutral</span>
      </button>
      <button data-toggle="gray" data-value="stone">
        <span class="color bg-[#57534E]"></span>
        <span>Stone</span>
      </button></div>
            </div>
            <hr>
            <div class="p-4">
                <h5>Fonts</h5>
                <div id="customizerFonts" class="themes fonts">
      <button data-toggle="font" data-value="default" class="active">
        <h5 class="font-['Nunito']">Nunito</h5>
        <p class="font-['Nunito_Sans']">Nunito Sans</p>
      </button>
      <button data-toggle="font" data-value="montserrat">
        <h5 class="font-['Montserrat']">Montserrat</h5>
        <p class="font-['Montserrat']">Montserrat</p>
      </button>
      <button data-toggle="font" data-value="raleway">
        <h5 class="font-['Raleway']">Raleway</h5>
        <p class="font-['Raleway']">Raleway</p>
      </button>
      <button data-toggle="font" data-value="poppins">
        <h5 class="font-['Poppins']">Poppins</h5>
        <p class="font-['Poppins']">Poppins</p>
      </button>
      <button data-toggle="font" data-value="oswald">
        <h5 class="font-['Oswald']">Oswald</h5>
        <p class="font-['Oswald']">Oswald</p>
      </button>
      <button data-toggle="font" data-value="roboto-condensed-roboto">
        <h5 class="font-['Roboto Condensed']">Roboto Condensed</h5>
        <p class="font-['Roboto']">Roboto</p>
      </button>
      <button data-toggle="font" data-value="inter">
        <h5 class="font-['Inter']">Inter</h5>
        <p class="font-['Inter']">Inter</p>
      </button>
      <button data-toggle="font" data-value="yantramanav">
        <h5 class="font-['Yantramanav']">Yantramanav</h5>
        <p class="font-['Yantramanav']">Yantramanav</p>
      </button></div>
            </div>
        </div>
    </aside>

    <!-- Workspace -->
    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>Dashboard</h1>
            <ul>
                <li><a href="#no-link">Login</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Dashboard</li>
            </ul>
        </section>

        <div class="grid lg:grid-cols-2 gap-5">

            <!-- Summaries -->
            <div class="grid sm:grid-cols-3 gap-5">
                <div class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                    <div>
                        <span class="text-primary text-5xl leading-none la la-sun"></span>
                        <p class="mt-2">Published Posts</p>
                        <div class="text-primary mt-5 text-3xl leading-none">18</div>
                    </div>
                </div>
                <div class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                    <div>
                        <span class="text-primary text-5xl leading-none la la-cloud"></span>
                        <p class="mt-2">Pending Posts</p>
                        <div class="text-primary mt-5 text-3xl leading-none">16</div>
                    </div>
                </div>
                <div class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                    <div>
                        <span class="text-primary text-5xl leading-none la la-layer-group"></span>
                        <p class="mt-2">Categories</p>
                        <div class="text-primary mt-5 text-3xl leading-none">9</div>
                    </div>
                </div>
            </div>

            <!-- Lines -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
                <div class="card p-5">
                    <h6 class="chart-heading uppercase"></h6>
                    <h4 class="chart-value text-2xl mt-2"></h4>
                    <small class="chart-label uppercase"></small>
                    <canvas id="lineWithAnnotationChart1" class="mt-5"></canvas>
                </div>
                <div class="card p-5">
                    <h6 class="chart-heading uppercase"></h6>
                    <h4 class="chart-value text-2xl mt-2"></h4>
                    <small class="chart-label uppercase"></small>
                    <canvas id="lineWithAnnotationChart2" class="mt-5"></canvas>
                </div>
                <div class="card p-5">
                    <h6 class="chart-heading uppercase"></h6>
                    <h4 class="chart-value text-2xl mt-2"></h4>
                    <small class="chart-label uppercase"></small>
                    <canvas id="lineWithAnnotationChart3" class="mt-5"></canvas>
                </div>
                <div class="card p-5">
                    <h6 class="chart-heading uppercase"></h6>
                    <h4 class="chart-value text-2xl mt-2"></h4>
                    <small class="chart-label uppercase"></small>
                    <canvas id="lineWithAnnotationChart4" class="mt-5"></canvas>
                </div>
            </div>

            <!-- Visitors -->
            <div class="card p-5 min-w-0">
                <h3>Visitors</h3>
                <div class="mt-5 min-w-0">
                    <canvas id="visitorsChart"></canvas>
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="card p-5 flex flex-col">
                <h3>Recent Posts</h3>
                <table class="table table_list mt-3 w-full">
                    <thead>
                        <tr>
                            <th class="ltr:text-left rtl:text-right uppercase">Title</th>
                            <th class="w-px uppercase">Views</th>
                            <th class="w-px uppercase">Pulbished</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                            <td class="text-center">100</td>
                            <td class="text-center">
                                <div class="badge badge_outlined badge_secondary uppercase">Draft</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Donec tempor lacus quis ex ullamcorper, ut cursus dui pellentesque.</td>
                            <td class="text-center">150</td>
                            <td class="text-center">
                                <div class="badge badge_outlined badge_success uppercase">Published</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Quisque molestie velit sed elit finibus, nec gravida nunc finibus.</td>
                            <td class="text-center">300</td>
                            <td class="text-center">
                                <div class="badge badge_outlined badge_warning uppercase">Pending</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Morbi nec nisl ac libero facilisis finibus vitae fringilla dolor.</td>
                            <td class="text-center">120</td>
                            <td class="text-center">
                                <div class="badge badge_outlined badge_success uppercase">Published</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Donec suscipit libero in nibh fringilla hendrerit.</td>
                            <td class="text-center">180</td>
                            <td class="text-center">
                                <div class="badge badge_outlined badge_secondary uppercase">Draft</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-auto">
                    <a href="#no-link" class="btn btn_primary mt-5">Show all Posts</a>
                </div>
            </div>

            <!-- Categories -->
            <div class="card p-5 flex flex-col min-w-0">
                <h3>Categories</h3>
                <div class="flex-auto mt-5 min-w-0">
                    <canvas id="categoriesChart"></canvas>
                </div>
            </div>

            <!-- Quick Post -->
            <div class="card p-5">
                <h3>Quick Post</h3>
                <form class="mt-5">
                    <div class="mb-5">
                        <label class="label block mb-2" for="title">Title</label>
                        <input id="title" class="form-control">
                    </div>
                    <div class="mb-5">
                        <label class="label block mb-2" for="content">Content</label>
                        <textarea id="content" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="mb-5">
                        <label class="label block mb-2" for="category">Category</label>
                        <div class="custom-select">
                            <select class="form-control">
                                <option>Select</option>
                                <option>Option</option>
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <button class="btn btn_primary uppercase">Publish</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Footer -->
        <footer class="mt-auto">
            <div class="footer">
                <span class="uppercase">© 2022 Yeti Themes</span>
                <nav>
                    <a href="mailto:Yeti Themes<info@yetithemes.net>?subject=Support">Support</a>
                    <span class="divider">|</span>
                    <a href="http://yeti.yetithemes.net/docs" target="_blank" rel="noreferrer">Docs</a>
                </nav>
            </div>
        </footer>
    </main>
    <!-- Scripts -->
    <script src="assets/js/vendor.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>