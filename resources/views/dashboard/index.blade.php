@extends('layouts.admin')

@section('inner-content')

    <header class="headers dashboard__headers">
        <ol class="breadcrumbs dashboard__breadcrumbs">
            <li class="breadcrumbs__item breadcrumbs__item--active">
                Dashboard
            </li>
        </ol>
    </header>

    <section class="stats dashboard__stats">
        <div class="cards dashboard__cards">
            <span class="icons icons--xx-large cards__icons cards__icons--orange fas fa-book" aria-hidden="true">
            </span>

            <div class="cards__body">
                <h2 class="titles titles--weight-normal cards__titles">
                    Książki:
                </h2>
                <p class="cards__text">
                    {{ $countStats['books'] }}
                </p>
            </div>
        </div>

        <div class="cards dashboard__cards">
            <span class="icons icons--xx-large cards__icons cards__icons--purple fas fa-users" aria-hidden="true">
            </span>

            <div class="cards__body">
                <h2 class="titles titles--weight-normal cards__titles">
                    Użytkownicy:
                </h2>
                <p class="cards__text">
                    {{ $countStats['users'] }}
                </p>
            </div>
        </div>

        <div class="cards dashboard__cards">
            <span class="icons icons--xx-large cards__icons cards__icons--red fab fa-teamspeak" aria-hidden="true">
            </span>

            <div class="cards__body">
                <h2 class="titles titles--weight-normal cards__titles">
                    Członkowie zespołu:
                </h2>
                <p class="cards__text">
                    {{ $countStats['privilaged_users'] }}
                </p>
            </div>
        </div>

        <div class="cards dashboard__cards">
            <span class="icons icons--xx-large cards__icons cards__icons--blue fas fa-journal-whills" aria-hidden="true">
            </span>

            <div class="cards__body">
                <h2 class="titles titles--weight-normal cards__titles">
                    Gatunki:
                </h2>
                <p class="cards__text">
                    {{ $countStats['genres'] }}
                </p>
            </div>
        </div>

        <div class="cards dashboard__cards">
            <span class="icons icons--xx-large cards__icons cards__icons--red fas fa-at" aria-hidden="true">
            </span>

            <div class="cards__body">
                <h2 class="titles titles--weight-normal cards__titles">
                    Autorzy:
                </h2>
                <p class="cards__text">
                    {{ $countStats['authors'] }}
                </p>
            </div>
        </div>

        <div class="cards dashboard__cards">
            <span class="icons icons--xx-large cards__icons cards__icons--orange-two fas fa-book-open" aria-hidden="true">
            </span>

            <div class="cards__body">
                <h2 class="titles titles--weight-normal cards__titles">
                    Wydawcy:
                </h2>
                <p class="cards__text">
                    {{ $countStats['publishers'] }}
                </p>
            </div>
        </div>
    </section>

    <section class="dashboard__sections">
        <h2 class="titles titles--weight-normal dashboard__titles">Ostatnia aktywność</h2>

        <div class="dashboard__activity-stats">
            @if ($latest['books']->isNotEmpty())
                <ul class="lists dashboard__lists">
                    @foreach ($latest['books'] as $book)
                        <li class="lists__item">
                            <div class="info-item lists__info-item">
                                <div class="picutres pictures--small info-item__pictures">
                                    @if ($book->cover)
                                        <img class="pictures__img" src="{{ Storage::url($book->cover) }}"
                                            alt="Okładka książki.">
                                    @else
                                        <img class="pictures__img" src="{{ asset('img/book_cover.png') }}"
                                            alt="Okładka książki.">
                                    @endif
                                </div>

                                <div class="info-item__body">
                                    <span class="info-item__timestamp">
                                        {{ $book->created_at }}
                                    </span>

                                    <p class="info-item__message">
                                        <a href="{{ route('admin.show.book', ['id' => $book->id]) }}"
                                            class="links links--light info-item__links">{{ $book->title }}</a>
                                        została
                                        dodana.
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="notifications dashboard__notifications">
                    <span class="icons icons--x-large notifications__icons far fa-folder-open" aria-hidden="true"></span>
                    Brak książek
                </div>
            @endif

            @if ($latest['users']->isNotEmpty())
                <ul class="lists dashboard__lists">
                    @foreach ($latest['users'] as $user)
                        <li class="lists__item">
                            <div class="info-item lists__info-item">
                                <div class="picutres pictures--small info-item__pictures">
                                    @if ($user->avatar)
                                        <img class="pictures__img" src="{{ Storage::url($user->avatar) }}"
                                            alt="Avatar użytkownika.">
                                    @else
                                        <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}"
                                            alt="Avatar użytkownika.">
                                    @endif
                                </div>

                                <div class="info-item__body">
                                    <span class="info-item__timestamp">
                                        {{ $user->created_at }}
                                    </span>

                                    <p class="info-item__message">
                                        <a href="{{ route('admin.show.user', ['id' => $user->id]) }}"
                                            class="links links--light info-item__links">{{ $user->uid }}</a>
                                        założył konto w
                                        serwisie.
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="notifications dashboard__notifications">
                    <span class="icons icons--x-large notifications__icons far fa-folder-open" aria-hidden="true"></span>
                    Brak użytkowników
                </div>
            @endif
        </div>
    </section>

@endsection
