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
                            #
                        </th>
                        <th class="tables__header-cell">
                            Użytkownik
                        </th>
                        <th class="tables__header-cell">
                            Rola
                        </th>
                        <th class="tables__header-cell">
                            Ostatnia aktywność
                        </th>
                        <th class="tables__header-cell">
                            Status
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
                                {{ $user->role->name }}
                            </td>
                            <td class="tables__cell" data-label="Ostatnia aktywność">
                                {{ $user->actived_at }}
                            </td>
                            <td class="tables__cell" data-label="Aktywny">
                                Aktywny
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
                            #
                        </th>
                        <th class="tables__header-cell">
                            Użytkownik
                        </th>
                        <th class="tables__header-cell">
                            Rola
                        </th>
                        <th class="tables__header-cell">
                            Ostatnia aktywność
                        </th>
                        <th class="tables__header-cell">
                            Status
                        </th>
                        <th class="tables__header-cell">
                            Opcje
                        </th>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="dashboard__section">
            <h2 class="titles titles--weight-normal dashboard__titles">Użytkownicy</h2>

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
                            Rola
                        </th>
                        <th class="tables__header-cell">
                            Ostatnia aktywność
                        </th>
                        <th class="tables__header-cell">
                            Status
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
                                            <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}"
                                                alt="Avatar użytkownika.">
                                        @endif
                                    </div>
                                    {{ $user->uid }}
                                </div>
                            </td>
                            <td class="tables__cell" data-label="Rola">
                                {{ $user->role->name }}
                            </td>
                            <td class="tables__cell" data-label="Ostatnia aktywność">
                                {{ $user->actived_at }}
                            </td>
                            <td class="tables__cell" data-label="Aktywny">
                                Aktywny
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
                            Rola
                        </th>
                        <th class="tables__header-cell">
                            Ostatnia aktywność
                        </th>
                        <th class="tables__header-cell">
                            Status
                        </th>
                        <th class="tables__header-cell">
                            Opcje
                        </th>
                    </tr>
                </tfoot>
            </table>
        </section>
    </div>

@endsection
