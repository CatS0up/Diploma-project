@extends('layouts.app')

@section('inner-content')
    <div class="container app__container">

        <header class="headers app__headers">
            <ol class="breadcrumbs dashboard__breadcrumbs">
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    Strona główna
                </li>
            </ol>
        </header>


        <section class="app__sections app__sections--columns-2">
            <aside class="categories app__categories">
                <h2 class="titles categories__titles">
                    Kategorie
                </h2>

                <ul class="menu categories__menu">
                    @foreach ($genres as $genre)
                        <li class="menu__item">
                            <a href="{{ url()->full() }}" class="links menu__links">
                                {{ $genre->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            <section class="app__book-list">

                <div class="app__actions">
                    <form class="forms forms--inline app__forms" action="{{ url()->full() }}" method="get">
                        @csrf
                        <div class="forms__group">
                            <label class="forms__group-title" for="search">
                                Wyszukiwarka
                            </label>
                            <input id="search" class="forms__input forms__input--bordered" type="search" name="q"
                                value="{{ $filters['q'] }}">
                        </div>

                        <div class="forms__group">
                            <label class="forms__group-title" for="publisher">
                                Wydawnictwo
                            </label>
                            <select id="publisher" class="forms__input forms__input--bordered" name="publisher">
                                <option value="all">Wszyscy</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->name }}"
                                        {{ !($publisher->name == $filters['publisher']) ?: 'selected' }}>
                                        {{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="forms__inline-section">
                            <span class="forms__section-name forms__section-name--all-cols">Sortuj (Po tytule)</span>

                            <div class="forms__check">
                                <input id="ascending" class="forms__radio" type="radio" name="sort" value="asc"
                                    {{ !($filters['sort'] === 'asc') ?: 'checked' }}>
                                <label for="ascending" class="forms__radio-title">Rosnąco</label>
                            </div>

                            <div class="forms__check">
                                <input id="descending" class="forms__radio" type="radio" name="sort" value="desc"
                                    {{ !($filters['sort'] === 'desc') ?: 'checked' }}>
                                <label for="descending" class="forms__radio-title">Malejąco</label>
                            </div>
                        </div>

                        <div class="forms__buttons-group forms__buttons-group--content-to-left">
                            <button class="buttons buttons--primary forms__buttons" type="submit">Filtruj</button>
                        </div>
                    </form>

                </div>

                <div class="app__items">
                    @if ($books->isNotEmpty())
                        <ul class="lists app__lists">
                            @foreach ($books as $book)
                                <li class="lists__item">
                                    <div class="book-item">
                                        <header class="header book-item__headers">
                                            <div class="pictures book-item__pictures">
                                                <div class="pictures book-item__pictures">
                                                    @if ($book->cover)
                                                        <img class="pictures__img" src="{{ Storage::url($book->cover) }}"
                                                            alt="Okładka książki.">
                                                    @else
                                                        <img class="pictures__img"
                                                            src="{{ asset('img/book_cover.png') }}"
                                                            alt="Okładka książki.">
                                                    @endif
                                                </div>
                                            </div>

                                            <h3 class="titles book-item__titles">
                                                {{ $book->title }}
                                            </h3>
                                        </header>

                                        <div class="book-item__body">
                                            <ul class="lists book-item__lists">
                                                <li class="lists__item">

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="notifications dashboard__notifications">
                            <span class="icons icons--x-large notifications__icons far fa-folder-open"
                                aria-hidden="true"></span>
                            Brak książek
                        </div>
                    @endif
                </div>

                {{ $books->links() }}
            </section>

        </section>
    </div>
@endsection
