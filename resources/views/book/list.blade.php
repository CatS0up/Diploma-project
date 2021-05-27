@extends('layouts.app')

@section('inner-content')
    <div class="container main__container">

        <header class="headers main__headers">
            <ol class="breadcrumbs dashboard__breadcrumbs">
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    Strona główna
                </li>
            </ol>
        </header>

        <section class="books main__books">

            <aside class="genres books__genres">
                <header class="headers headers--dark genres__headers">
                    <h3 class="titles titles--transform-none genres__titles">
                        Kategorie
                        <span class="icons titles__icons fas fa-bars" aria-hidden="true"></span>
                    </h3>
                </header>

                <ul class="menu genres__menu">
                    @forelse ($genres as $genre)
                        <li class="menu__item">
                            <a href="#" class="links genres__links">{{ $genre->name }}</a>
                        </li>
                    @empty
                        <li class="menu__item menu__item--underlined">
                            Brak gatunków :(
                        </li>
                    @endforelse
                </ul>
            </aside>



            <div class="books__items">
                <article class="book-item books__book-item">

                    <header class="headers book-item__headers">

                        <div class="pictures book-item__pictures">

                        </div>

                    </header>

                    <div class="book-item__body">
                        <h3 class="titles book-item__titles">Książka</h3>

                        <div class="book-item__options">

                        </div>
                    </div>

                </article>
            </div>
        </section>
    </div>
@endsection
