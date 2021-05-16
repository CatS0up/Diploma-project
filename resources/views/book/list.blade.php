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
                    @if ($books->total() > 0)
                        <ul class="lists app__lists">
                            @foreach ($books as $book)
                                <li class="lists__item">
                                    <div class="book-preview lists__book-preview">
                                        <div class="book-preview__header">
                                            <h3 class="titles book-preview__titles">
                                                {{ $book->title }}
                                            </h3>

                                            <div class="pictures book-preview__pictures">
                                                @if ($book->cover)
                                                    <img class="pictures__img" src="{{ Storage::url($book->cover) }}"
                                                        alt="Okładka książki.">
                                                @else
                                                    <img class="pictures__img"
                                                        src="{{ asset('img/avatar_placeholder.jpg') }}"
                                                        alt="Okładka książki.">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="book-preview__body">
                                            <div class="book-preview__info">
                                                <ul class="lists book-preview__lists">
                                                    <li class="lists__item lists__item--labeled-horizontal">
                                                        <span class="lists__item-label">ISBN</span>
                                                        {{ $book->isbn }}
                                                    </li>

                                                    <li class="lists__item lists__item--labeled-horizontal">
                                                        <span class="lists__item-label">Wydawca</span>
                                                        {{ $book->publisher->name }}
                                                    </li>

                                                    <li class="lists__item lists__item--labeled-horizontal">
                                                        <span class="lists__item-label">Autorzy</span>
                                                        {{ $book->publisher->name }}
                                                    </li>

                                                    <li class="lists__item lists__item--labeled-horizontal">
                                                        <span class="lists__item-label">Gatunki</span>
                                                        {{ $book->isbn }}
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="book-preview__options">
                                                <a href="{{ route('book.show', ['id' => $book->id]) }}"
                                                    class="links links--light book-preview__links">Szczegóły</a>
                                            </div>
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

            </section>

        </section>
    </div>
@endsection
