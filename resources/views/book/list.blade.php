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
            <aside class="app__categories">
                <ul class="lists app__lists">
                    @foreach ($genres as $genre)
                        <li class="lists__item">
                            <a class="links lists__links"
                                href="{{ route('book.show', ['id' => $genre->id]) }}">{{ $genre->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            <section class="app__book-list">
                <div class="app__actions">
                    <form class="forms forms--inline dashboard__forms" action="{{ route('book.get.books') }}"
                        method="get">
                        @csrf
                        <div class="forms__group">
                            <input id="bookGenre" class="forms__input forms__input--bordered" type="search" name="q"
                                value="{{ old('q') }}" placeholder="Wyszukaj">

                            @error('q')
                                <span class="forms__input-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="forms__group">
                            <select class="forms__input forms__input--bordered" name="publisher">
                                <option value="all">Wszystkie</option>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="forms__buttons-group forms__buttons-group--content-to-left">
                            <button class="buttons buttons--primary forms__buttons" type="submit">Filtruj</button>
                        </div>
                    </form>

                    @isset($phrase)
                        <div class="app__search-info">
                            Wyniki wyszukiwania dla: {{ $phrase }}
                        </div>
                    @endisset
                </div>

                <div class="app__items">
                    @foreach ($books as $book)
                        <article class="book-thumbnails app__book-thumbnails">
                            <h2 class="titles book-thumbnails__titles">
                                {{ $book->title }}
                            </h2>

                            <div class="pictures pictures--centered book-thumbnails__pictures">
                                @if ($book->cover)
                                    <img class="pictures__img" src="{{ Storage::url($book->cover) }}"
                                        alt="Okładka książki.">
                                @else
                                    <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}"
                                        alt="Okładka książki.">
                                @endif
                            </div>

                            <ul class="lists book-thumbnails__lists book-thumbnails__lists">
                                <li class="lists__item lists__item--labeled-horizontal">
                                    <span class="lists__item-label">Wydawca:</span>
                                    {{ $book->publisher->name }}
                                </li>

                                <li class="lists__item lists__item--labeled-horizontal">
                                    <span class="lists__item-label">Autorzy:</span>
                                    @foreach ($book->authors as $author)
                                        {{ $author->firstname . ' ' . $author->lastname }}
                                    @endforeach
                                </li>

                                <li class="lists__item lists__item--labeled-horizontal">
                                    <span class="lists__item-label">Gatunki:</span>
                                    @foreach ($book->genres as $genre)
                                        {{ $genre->name }}
                                    @endforeach
                                </li>
                            </ul>

                            <div class="book-thumbnails__options">
                                <a class="buttons buttons--primary" href="#">Dodaj do biblioteki</a>
                                <a class="buttons buttons--primary"
                                    href="{{ route('book.show', ['id' => $book->id]) }}">Pokaż</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        </section>
    </div>
@endsection
