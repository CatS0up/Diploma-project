@extends('layouts.admin')

@section('inner-content')

    <div class="container dashboard__container">
        <header class="headers dashboard__headers">
            <ol class="breadcrumbs dashboard__breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="{{ route('admin.index') }}" class="links links--light breadcrumbs__links">
                        Dashboard
                    </a>
                </li>
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    Użytkownicy
                </li>
            </ol>
        </header>

        <section class="stats dashboard__stats">
            <div class="cards dashboard__cards">
                <span class="icons icons--xx-large cards__icons cards__icons--orange fas fa-users" aria-hidden="true">
                </span>

                <div class="cards__body">
                    <h2 class="titles titles--weight-normal cards__titles">
                        Użytkownicy:
                    </h2>
                    <p class="cards__text">
                        {{ $stats['count'] }}
                    </p>
                </div>
            </div>

            <div class="cards dashboard__cards">
                <span class="icons icons--xx-large cards__icons cards__icons--red fas fa-user-lock" aria-hidden="true">
                </span>

                <div class="cards__body">
                    <h2 class="titles titles--weight-normal cards__titles">
                        Zablokowani:
                    </h2>
                    <p class="cards__text">
                        60
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
                        {{ $stats['privilagedCount'] }}
                    </p>
                </div>
            </div>
        </section>

        <section class="dashboard__section">
            <h2 class="titles titles--weight-normal dashboard__titles">Zespół</h2>

            <table class="tables dashboard__tables">
                <thead class="tables__header">
                    <tr class="tables__row">
                        <th class="tables__header-cell">
                            ID
                        </th>
                        <th class="tables__header-cell">
                            Użytkownik
                        </th>
                        <th class="tables__header-cell">
                            E-mail
                        </th>
                        <th class="tables__header-cell">
                            Imię
                        </th>
                        <th class="tables__header-cell">
                            Nazwisko
                        </th>
                        <th class="tables__header-cell">
                            Rola
                        </th>
                        <th class="tables__header-cell">
                            Opcje
                        </th>
                    </tr>
                </thead>

                <tbody class="tables__body">
                    @foreach ($privilagedUsers as $user)
                        <tr class="tables__row">
                            <th class="tables__header-cell" data-label="ID">
                                {{ $user->id }}
                            </th>

                            <td class="tables__cell" data-label="Użytkownik">
                                <div class="tables__item">
                                    <div class="pictures pictures--small pictures--avatar tables__pictures">
                                        @if ($user->avatar)
                                            <img class="pictures__img" src="{{ Storage::url($user->avatar) }}"
                                                alt="Avatar użytkownika.">
                                        @else
                                            <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}"
                                                alt="Avatar użytkownika.">
                                        @endif
                                    </div>
                                    {{ $user->uid }}
                                </div>
                            </td>
                            <td class="tables__cell" data-label="Rola">
                                {{ $user->email }}
                            </td>
                            <td class="tables__cell" data-label="Rola">
                                {{ $user->personalDetails->firstname }}
                            </td>
                            <td class="tables__cell" data-label="Rola">
                                {{ $user->personalDetails->lastname }}
                            </td>
                            <td class="tables__cell" data-label="Rola">
                                {{ $user->role->name }}
                            </td>
                            <td class="tables__cell" data-label="Opcje">
                                <div class="tables__group">
                                    <a href="{{ route('admin.show.user', ['id' => $user->id]) }}"
                                        class="buttons buttons--primary forms__buttons">Profil</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot class="tables__footer">
                    <tr class="tables__row">
                        <th class="tables__header-cell">
                            ID
                        </th>
                        <th class="tables__header-cell">
                            Użytkownik
                        </th>
                        <th class="tables__header-cell">
                            E-mail
                        </th>
                        <th class="tables__header-cell">
                            Imię
                        </th>
                        <th class="tables__header-cell">
                            Nazwisko
                        </th>
                        <th class="tables__header-cell">
                            Rola
                        </th>
                        <th class="tables__header-cell">
                            Opcje
                        </th>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="dashboard__section">
            <h2 class="titles titles--padding-bottom-none titles--weight-normal dashboard__titles">Użytkownicy</h2>


            <div class="dashboard__actions">
                <form class="forms forms--inline dashboard__forms" action="{{ url()->current() }}" method="get">
                    @csrf
                    <div class="forms__group">
                        <label class="forms__group-title" for="search">
                            Wyszukiwarka
                        </label>
                        <input id="search" class="forms__input forms__input--bordered" type="search" name="q"
                            value="{{ $filters['q'] }}">
                    </div>

                    <div class="forms__group">
                        <label class="forms__group-title" for="sortBy">
                            Sortuj według
                        </label>
                        <select id="sortBy" class="forms__input forms__input--bordered" name="sort_by">
                            <option value="id">ID</option>
                            <option value="all">Login</option>
                            <option value="email">Email</option>
                            <option value="firstname">Imię</option>
                            <option value="lastname">Nazwisko</option>
                            <option value="book_amount">Ilość książek</option>
                        </select>
                    </div>

                    <div class="forms__inline-section">
                        <span class="forms__section-name forms__section-name--all-cols">Kierunek sortowania</span>

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

            @if ($users->total() > 0)
                <table class="tables dashboard__tables">
                    <thead class="tables__header">
                        <tr class="tables__row">
                            <th class="tables__header-cell">
                                ID
                            </th>
                            <th class="tables__header-cell">
                                Użytkownik
                            </th>
                            <th class="tables__header-cell">
                                E-mail
                            </th>
                            <th class="tables__header-cell">
                                Imię
                            </th>
                            <th class="tables__header-cell">
                                Nazwisko
                            </th>
                            <th class="tables__header-cell">
                                Książki
                            </th>
                            <th class="tables__header-cell">
                                Opcje
                            </th>
                        </tr>
                    </thead>

                    <tbody class="tables__body">
                        @foreach ($users as $user)
                            <tr class="tables__row">
                                <th class="tables__header-cell" data-label="ID">
                                    {{ $user->id }}
                                </th>

                                <td class="tables__cell" data-label="Użytkownik">
                                    <div class="tables__item">
                                        <div class="pictures pictures--small pictures--avatar tables__pictures">
                                            @if ($user->avatar)
                                                <img class="pictures__img" src="{{ Storage::url($user->avatar) }}"
                                                    alt="Avatar użytkownika.">
                                            @else
                                                <img class="pictures__img"
                                                    src="{{ asset('img/avatar_placeholder.jpg') }}"
                                                    alt="Avatar użytkownika.">
                                            @endif
                                        </div>
                                        {{ $user->uid }}
                                    </div>
                                </td>
                                <td class="tables__cell" data-label="E-mail">
                                    {{ $user->email }}
                                </td>
                                <td class="tables__cell" data-label="Nr. telefonu">
                                    {{ $user->personalDetails->firstname }}
                                </td>
                                <td class="tables__cell" data-label="Ostatnia aktywność">
                                    {{ $user->personalDetails->lastname }}
                                </td>
                                <td class="tables__cell" data-label="Aktywny">
                                    {{ $user->bookAmount() }}
                                </td>
                                <td class="tables__cell" data-label="Opcje">
                                    <div class="tables__group">
                                        <a href="{{ route('admin.show.user', ['id' => $user->id]) }}"
                                            class="buttons buttons--primary forms__buttons">Profil</a>
                                        <form class="forms tables__forms"
                                            action="{{ route('admin.delete.user', ['id' => $user->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="buttons buttons--danger forms__buttons">Usuń</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot class="tables__footer">
                        <tr class="tables__row">
                            <th class="tables__header-cell">
                                ID
                            </th>
                            <th class="tables__header-cell">
                                Użytkownik
                            </th>
                            <th class="tables__header-cell">
                                E-mail
                            </th>
                            <th class="tables__header-cell">
                                Imię
                            </th>
                            <th class="tables__header-cell">
                                Nazwisko
                            </th>
                            <th class="tables__header-cell">
                                Książki
                            </th>
                            <th class="tables__header-cell">
                                Opcje
                            </th>
                        </tr>
                    </tfoot>
                </table>
            @else
                <div class="notifications dashboard__notifications">
                    <span class="icons icons--x-large notifications__icons far fa-folder-open" aria-hidden="true"></span>
                    Brak zarejestrowanych użytkowników
                </div>
            @endif
        </section>
    </div>

@endsection
