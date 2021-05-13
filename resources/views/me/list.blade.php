@extends('layouts.app')

@section('inner-content')
    <div class="container app__container">

        <header class="headers app__headers">
            <ol class="breadcrumbs dashboard__breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="{{ route('home') }}" class="links links--light breadcrumbs__links">
                        Strona główna
                    </a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="{{ route('book.get.books') }}" class="links links--light breadcrumbs__links">
                        Książki
                    </a>
                </li>
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    {{ $book->title }}
                </li>
            </ol>
        </header>

        <section class="app__sections">
            <div class="book app__book">
                <div class="pictures book__pictures">
                    @if ($book->cover)
                        <img class="pictures__img" src="{{ Storage::url($book->cover) }}" alt="Okładka książki.">
                    @else
                        <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}" alt="Okładka książki.">
                    @endif
                </div>

                <div class="book__details">
                    <h1 class="titles book__titles">
                        {{ $book->title }}
                    </h1>

                    <p class="book__description">
                        {{ $book->description }}
                    </p>

                    <ul class="lists book__lists">
                        <li class="lists__item lists__item--labeled-horizontal">
                            <span class="lists__item-label">ISBN:</span>
                            {{ $book->isbn }}
                        </li>

                        <li class="lists__item lists__item--labeled-horizontal">
                            <span class="lists__item-label">Data Wydania:</span>
                            {{ $book->publishing_date }}
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

                    <div class="book__options">
                        <a href="#" class="buttons buttons--success">Dodaj do biblioteki</a>
                        <a href="{{ route('book.download', ['id' => $book->id]) }}"
                            class="buttons buttons--primary">Pobierz</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
