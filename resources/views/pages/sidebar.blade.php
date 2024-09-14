<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-5">
            <!-- Logo -->
            <a class="fw-semibold text-white tracking-wide" href="{{ route('home') }}">
            <span class="smini-visible">
              J<span class="opacity-75">M</span>
            </span>
                <span class="smini-hidden">
              Job<span class="opacity-75">Match</span>
            </span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div>
                <!-- Toggle Sidebar Style -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <!-- Class Toggle, functionality initialized in Helpers.dmToggleClass() -->
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                        data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on"
                        onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
                    <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                </button>
                <!-- END Toggle Sidebar Style -->

                <!-- Dark Mode -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                        data-target="#dark-mode-toggler" data-class="far fa"
                        onclick="Dashmix.layout('dark_mode_toggle');">
                    <i class="far fa-moon" id="dark-mode-toggler"></i>
                </button>
                <!-- END Dark Mode -->

                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout"
                        data-action="sidebar_close">
                    <i class="fa fa-times-circle"></i>
                </button>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <x-nav-link :href="route('home')"
                                :active="request()->routeIs('home')"
                                icon="home">
                        Home
                    </x-nav-link>
                </li>

                @auth
                    <li class="nav-main-item">
                        <x-nav-link :href="route('dashboard')"
                                    :active="request()->routeIs('dashboard')"
                                    icon="location-arrow">
                            Dashboard
                        </x-nav-link>
                    </li>

                    @can('viewAny', App\Models\User::class)
                        <li class="nav-main-item">
                            <x-nav-link :href="route('user.index')"
                                        :active="request()->routeIs('user.*')"
                                        icon="user">
                                Utilisateurs
                            </x-nav-link>
                        </li>
                    @endcan

                    @can('viewAny', App\Models\Offre::class)
                        <li class="nav-main-item">
                            <x-nav-link :href="route('offre.index')"
                                        :active="request()->routeIs('offre.*')"
                                        icon="briefcase">
                                Offres
                            </x-nav-link>
                        </li>
                    @endcan

                    @can('viewAllCandidatures', App\Models\Candidature::class)
                        <li class="nav-main-item">
                            <x-nav-link :href="route('candidature.index')"
                                        :active="request()->routeIs('candidature.*')"
                                        icon="briefcase">
                                Candidatures
                            </x-nav-link>
                        </li>
                    @endcan

                    <li class="nav-main-item">
                        <x-nav-link :href="route('profile.edit')"
                                    :active="request()->routeIs('profile.*')"
                                    icon="user">
                            Profile
                        </x-nav-link>
                    </li>

                    @can('view-candidat-settings')
                        <li class="nav-main-heading">Paramètres</li>
                        <li class="nav-main-item{{ request()->is('candidat/*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                               aria-expanded="true" href="#">
                                <i class="nav-main-link-icon fa fa-wrench"></i>
                                <span class="nav-main-link-name">Candidat</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->routeIs('langue.*') ? ' active' : '' }}"
                                       href="{{ route('langue.index') }}">
                                        <span class="nav-main-link-name">Langue</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->routeIs('competence.*') ? ' active' : '' }}"
                                       href="{{ route('competence.index') }}">
                                        <span class="nav-main-link-name">Competence</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->routeIs('experience.*') ? ' active' : '' }}"
                                       href="{{ route('experience.index') }}">
                                        <span class="nav-main-link-name">Experience</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->routeIs('formation.*') ? ' active' : '' }}"
                                       href="{{ route('formation.index') }}">
                                        <span class="nav-main-link-name">Formation</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    <li class="nav-main-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();this.closest('form').submit();"
                                        icon="arrow-alt-circle-left">
                                Sign Out
                            </x-nav-link>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-main-item">
                        <x-nav-link :href="route('login')" icon="sign-in-alt">
                            Se connecter
                        </x-nav-link>
                    </li>
                @endguest
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
