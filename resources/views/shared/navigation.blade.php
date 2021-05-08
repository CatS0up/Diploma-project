<nav class="navigation navigation--light site__navigation">
    <a href="/" class="links logo__links">
        <div class="logo navigation__logo">
            <div class="pictures logo__pictures">
                <img class="pictures__img" src="{{ asset('img/page_logo.png') }}" alt="Logo serwisu.">
            </div>

            <span class="logo__text">
                {{ $appName }}
            </span>
        </div>
    </a>

    <label for="hamburgerToggler" class="hamburger navigation__hamburger">
        <span class="icons icons--large hamburger__icons fas fa-bars"></span>
    </label>
    <input id="hamburgerToggler" type="checkbox" class="toggler navigation__toggler">

    <ul class="menu menu--light navigation__menu">
        <li class="menu__item">
            <a href="{{ route('books.show.book') }}" class="link menu__links">
                Książki
            </a>
        </li>

        <li class="menu__item">
            <a href="{{ route('books.show.book') }}" class="link menu__links">
                Książki
            </a>
        </li>

        <li class="menu__item">
            <a href="{{ route('books.show.book') }}" class="link menu__links">
                Książki
            </a>
        </li>
    </ul>
</nav>
