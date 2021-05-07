<nav class="sidebar">

    <header class="headers sidebar__headers">
        <h2 class="titles sidebar__titles">
            Dashboard
        </h2>
    </header>

    <ul class="menu sidebar__menu">
        <li class="menu__item menu__item--underlined">
            <a href="{{ route('admin.index') }}" class="links menu__links">
                <span class="links__text">
                    <span class="icons icons--small links__icons fas fa-columns" aria-hidden="true"></span>
                    Dashboard
                </span>
                <span class="icons icons--small links__icons fas fa-chevron-right" aria-hidden="true"></span>
            </a>
        </li>

        <li class="menu__item menu__item--underlined">
            <a href="{{ route('admin.get.books') }}" class="link menu__links">
                <span class="links__text">
                    <span class="icons icons--small links__icons fas fa-book" aria-hidden="true"></span>
                    Książki
                </span>
                <span class="icons icons--small links__icons fas fa-chevron-right" aria-hidden="true"></span>
            </a>
        </li>

        <li class="menu__item menu__item--underlined">
            <a href="{{ route('admin.get.users') }}" class="links menu__links">
                <span class="links__text">
                    <span class="icons icons--small links__icons far fa-user" aria-hidden="true"></span>
                    Użytkownicy
                </span>
                <span class="icons icons--small links__icons fas fa-chevron-right" aria-hidden="true"></span>
            </a>
        </li>
    </ul>
</nav>
