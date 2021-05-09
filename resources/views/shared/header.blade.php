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
            <span class="icons icons--large hamburger__icons fas fa-bars"></span>
        </label>
        <input id="hamburgerToggler" type="checkbox" class="toggler navigation__toggler">

        <ul class="menu navigation__menu">
            <li class="menu__item menu__item--vertical">
                <a href="{{ route('books.show.book') }}" class="links links--menu menu__links">
                    <span class="icons links__icons fas fa-home"></span>
                    Strona główna
                </a>
            </li>

            <li class="menu__item menu__item--vertical">
                <a href="{{ route('admin.index') }}" class="links links--menu menu__links">
                    <span class="icons links__icons fas fa-columns"></span>
                    Dashboard
                </a>
            </li>

            <li class="menu__item menu__item--vertical">
                <a href="{{ route('admin.index') }}" class="links links--menu menu__links">
                    <span class="icons links__icons far fa-user"></span>
                    Konto
                    <i class="fas fa-angle-down"></i>
                </a>
            </li>
        </ul>
    </nav>
</header>
