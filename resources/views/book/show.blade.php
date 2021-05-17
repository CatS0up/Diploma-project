@extends('layouts.app')

@section('inner-content')
    <header class="headers app__headers">
        <ol class="breadcrumbs dashboard__breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('home') }}" class="links links--light breadcrumbs__links">
                    Strona główna
                </a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item--active">
                {{ $book->title }}
            </li>
        </ol>
    </header>

    <section class="app__sections app__sections--medium-width">

        <div class="book-info app__book-info">
            <div class="book-info__thumbnail">
                <div class="pictures book-info__pictures">
                    @if ($book->cover)
                        <img class="pictures__img" src="{{ Storage::url($book->cover) }}" alt="Okładka książki.">
                    @else
                        <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}" alt="Okładka książki.">
                    @endif
                </div>
            </div>

            <div class="book-info__details">
                <h1 class="titles titles--transform-none book-info__titles">
                    {{ $book->title }}
                </h1>

                <ul class="lists book-info__lists">
                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">ISBN</span>
                        {{ $book->isbn }}
                    </li>

                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Wydawca</span>
                        {{ $book->publisher->name }}
                    </li>

                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Autorzy</span>
                        @foreach ($book->authors as $author)
                            {{ $author->firstname . ' ' . $author->lastname }}
                        @endforeach
                    </li>

                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Data wydania</span>
                        {{ $book->publishing_date }}
                    </li>


                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Gatunki</span>
                        {{ $book->genres->implode('name', ',') }}
                    </li>
                </ul>

                <p class="book-info__description">
                    {{ $book->description }}
                </p>

                <div class="book-info__options">
                    <a href="{{ route('book.download', ['id' => $book->id]) }}"
                        class="buttons buttons--primary book-info__books">
                        Pobierz
                    </a>

                    @auth
                        @if ($userHasBook)
                            <form class="forms tables__forms" action="{{ route('me.remove.book', ['id' => $book->id]) }}"
                                method="post">
                                @csrf
                                <button class="buttons buttons--danger forms__buttons">Usuń z biblioteki</button>
                            </form>
                        @else
                            <form class="forms tables__forms" action="{{ route('me.add.book', ['id' => $book->id]) }}"
                                method="post">
                                @csrf
                                <button class="buttons buttons--primary forms__buttons">Dodaj do biblioteki</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

    </section>

    <section class="app__sections app__sections--medium-width">
        <h2 class="titles app__titles">Recenzje</h2>
    </section>
@endsection
