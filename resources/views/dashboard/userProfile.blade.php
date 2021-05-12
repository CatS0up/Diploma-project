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
                <li class="breadcrumbs__item">
                    <a href="{{ route('admin.get.users') }}" class="links links--light breadcrumbs__links">
                        Użytkownicy
                    </a>
                </li>
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    {{ $user->uid }}
                </li>
            </ol>
        </header>

        <section class="dashboard__sections">
            <h2 class="titles titles--weight-normal dashboard__titles">Profil</h2>

            <div class="show dashboard__show">

                <div class="show__main-info">
                    <div class="show__main-info-group show__main-info-group--text-centered">

                        <div class="pictures pictures--centered show__pictures show__pictures--avatar">
                            @if ($user->avatar)
                                <img class="pictures__img" src="{{ asset('avatars/' . $user->avatar) }}"
                                    alt="Avatar użytkownika.">
                            @else
                                <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}"
                                    alt="Avatar użytkownika.">
                            @endif
                        </div>

                        <p class="show__name">
                            {{ $user->uid }}
                        </p>

                        <p class="show__info">
                            {{ $user->role->name }}
                        </p>

                        <p class="show__info">
                            <span class="icons show__icons show__icons--right-space far fa-envelope"
                                aria-hidden="true"></span>
                            {{ $user->email }}
                        </p>

                        <p class="show__info">
                            <span class="icons show__icons show__icons--right-space fas fa-phone-volume"
                                aria-hidden="true"></span>
                            {{ $user->phone }}
                        </p>
                    </div>

                    <div class="show__main-info-group">
                        <h5 class="titles titles--transform-none show__titles show__titles--group-titles">
                            Opis
                        </h5>

                        <p class="show__description">
                            {{ $user->description }}
                        </p>
                    </div>
                </div>

                <div class="show__data">
                    <header class="headers show__headers">
                        <h3 class="titles titles--transform-none show__titles show__titles--subtitle">ID Konta:
                            {{ $user->id }}</h3>
                    </header>

                    <div class="show__data-group">
                        <h4 class="titles show__titles show__titles--group-title">
                            <span class="icons show__icons show__icons--right-space far fa-address-card"
                                aria-hidden="true"></span>
                            Dane Osobowe
                        </h4>

                        <ul class="lists show__lists">
                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Imię:</span>
                                {{ $user->personalDetails->firstname }}
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Nazwisko:</span>
                                {{ $user->personalDetails->lastname }}
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Data urodzenia:</span>
                                {{ $user->personalDetails->birthday }}
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Płeć:</span>
                                {{ $user->personalDetails->gender ?? '(brak)' }}
                            </li>
                        </ul>
                    </div>

                    <div class="show__data-group">
                        <h4 class="titles show__titles show__titles--group-title">
                            <span class="icons show__icons show__icons--right-space fas fa-map-marker-alt"
                                aria-hidden="true"></span>
                            Dane adresowe
                        </h4>

                        <ul class="lists show__lists">
                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Miasto:</span>
                                {{ $user->address->town }}
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Ulica:</span>
                                {{ $user->address->street ?? '(brak)' }}
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Kod pocztowy:</span>
                                {{ $user->address->zipcode }}
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Numer domu:</span>
                                {{ $user->address->house_number }}
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Numer budynku:</span>
                                {{ $user->address->building_number ?? '(brak)' }}
                            </li>
                        </ul>
                    </div>

                    <div class="show__options">
                        <a class="buttons buttons--success show__buttons"
                            href="{{ route('admin.edit.user', ['id' => $user->id]) }}">
                            <span role="img" class="icons show__icons fas fa-user-edit" aria-label="Edytuj"></span>
                        </a>
                        <a href="{{ route('admin.delete.user', ['id' => $user->id]) }}"
                            class="buttons buttons--delete show__buttons">
                            <span role="img" class="icons show__icons fas fa-trash" aria-label="Usuń"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
