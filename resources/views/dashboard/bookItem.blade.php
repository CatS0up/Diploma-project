@extends('layouts.admin')

@section('inner-content')

    <header class="headers dashboard__headers">
        <ol class="breadcrumbs dashboard__breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('admin.index') }}" class="links links--light breadcrumbs__links">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('admin.get.books') }}" class="links links--light breadcrumbs__links">
                    Książki
                </a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item--active">
                {{ $book->title }}
            </li>
        </ol>
    </header>

    <section class="dashboard__sections">
        <h2 class="titles titles--weight-normal dashboard__titles">Książka</h2>

        <div class="show dashboard__show">

            <div class="show__main-info">
                <div class="show__main-info-group show__main-info-group--text-centered">

                    <div class="pictures pictures--centered show__pictures show__pictures">
                        @if ($book->cover)
                            <img class="pictures__img" src="{{ Storage::url($book->cover) }}" alt="Okładka książki.">
                        @else
                            <img class="pictures__img" src="{{ asset('img/book_cover.png') }}" alt="Okładka książki.">
                        @endif
                    </div>

                    <p class="show__name">
                        {{ $book->title }}
                    </p>

                    <p class="show__info">
                        {{ $book->isbn }}
                    </p>

                    <p class="show__info">
                        {{ $book->publishing_date ?? '(brak)' }}
                    </p>
                </div>

                <div class="show__main-info-group">
                    <h5 class="titles titles--transform-none show__titles show__titles--group-titles">
                        Opis
                    </h5>

                    <p class="show__description">
                        {{ $book->description ?? '(brak)' }}
                    </p>
                </div>
            </div>

            <div class="show__data">
                <header class="headers show__headers">
                    <h3 class="titles titles--transform-none show__titles show__titles--subtitle">ID Książki:
                        {{ $book->id }}</h3>
                </header>

                <div class="show__data-group">
                    <h4 class="titles show__titles show__titles--group-title">
                        <span class="icons show__icons show__icons--right-space fas fa-users" aria-hidden="true"></span>
                        Autorzy
                    </h4>

                    <ul class="lists show__lists">
                        @foreach ($book->authors as $author)
                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Autor nr. {{ $loop->iteration }}</span>
                                {{ $author->firstname . ' ' . $author->lastname }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="show__data-group">
                    <h4 class="titles show__titles show__titles--group-title">
                        <span class="icons show__icons show__icons--right-space fas fa-journal-whills"
                            aria-hidden="true"></span>
                        Gatunki
                    </h4>

                    <ul class="lists show__lists">
                        @foreach ($book->genres as $genre)
                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Gatunek nr. {{ $loop->iteration }}</span>
                                {{ $genre->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>


                <div class="show__data-group show__data-group--full-size">
                    <h4 class="titles show__titles show__titles--group-title">
                        <span class="icons show__icons show__icons--right-space fas fa-file" aria-hidden="true"></span>
                        Pliki
                    </h4>

                    <ul class="lists show__lists">
                        <li class="lists__item lists__item--labeled-vertical">
                            <span class="lists__item-label">Okładka</span>
                            {{ $book->cover ?? '(brak)' }}
                        </li>

                        <li class="lists__item lists__item--labeled-vertical">
                            <span class="lists__item-label">PDF</span>
                            {{ $book->file }}
                        </li>
                    </ul>
                </div>


                <div class="show__options">
                    <a class="buttons buttons--success show__buttons"
                        href="{{ route('admin.edit.book', ['id' => $book->id]) }}">
                        Edycja
                    </a>

                    <form class="forms tables__forms" action="{{ route('admin.delete.book', ['id' => $book->id]) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button class="buttons buttons--danger show__buttons">
                            Usuń
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
