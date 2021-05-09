<header class="headers headers--light site__headers">
    <nav class="navigation site__navigation">
        <a href="/" class="links logo__links">
            <div class="logo navigation__logo">
                <span class="logo__text">
                    {{ $appName }}
                </span>
            </div>
        </a>

        <label for="hamburgerToggler" class="hamburger navigation__hamburger">
            <span class="icons icons--large hamburger__icons fas fa-bars" aria-hidden="true"></span>
        </label>
        <input id="hamburgerToggler" type="checkbox" class="toggler navigation__toggler">

        <ul class="menu navigation__menu">
            <li class="menu__item menu__item--vertical">
                <a href="{{ route('books.show.book') }}" class="links links--menu menu__links">
                    <span class="icons links__icons fas fa-home" aria-hidden="true"></span>
                    Strona główna
                </a>
            </li>

            <li class="menu__item menu__item--vertical">
                <a href="{{ route('admin.index') }}" class="links links--menu menu__links">
                    <span class="icons links__icons fas fa-columns" aria-hidden="true"></span>
                    Dashboard
                </a>
            </li>

            <li class="menu__item menu__item--vertical">
                <div class="dropdown menu__dropdown">
                    <label for="dropdownToggler" class="dropdown__trigger">
                        <span class="icons dropdown__icons dropdown__icons--start fas fa-user"
                            aria-hidden="true"></span>
                        Konto
                        <span class="icons icons--small dropdown__icons fas fa-chevron-down"></span>
                    </label>
                    <input id="dropdownToggler" type="checkbox" class="toggler dropdown__toggler">


                    <div class="dropdown__content">
                        <ul class="menu dropdown__menu">
                            @guest
                                <li class="menu__item">
                                    <a href="{{ route('auth.login.form') }}"
                                        class="links links--dropdown menu__links">Logowanie</a>
                                </li>

                                <li class="menu__item">
                                    <a href="{{ route('auth.register.form') }}"
                                        class="links links--dropdown menu__links">Rejestracja</a>
                                </li>
                            @else
                                <li class="menu__item">
                                    <a href="#" class="links links--dropdown menu__links">Profil</a>
                                </li>

                                <li class="menu__item">
                                    <a href="#" class="links links--dropdown menu__links">Książki</a>
                                </li>

                                <li class="menu__item">
                                    <a href="#" class="links links--dropdown menu__links">Wyloguj</a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</header>
