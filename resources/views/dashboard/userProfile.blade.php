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
                    Typek jakiś
                </li>
            </ol>
        </header>

        <section class="dashboard__sections">
            <h2 class="titles titles--weight-normal dashboard__titles">Profil</h2>

            <div class="profile dashboard__profile">

                <div class="profile__account">
                    <div class="profile__account-group profile__account-group--text-centered">

                        <div class="pictures pictures--centered profile__pictures">
                            <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}"
                                alt="Avatar użytkownika.">
                        </div>

                        <p class="profile__nickname">
                            Admin
                        </p>

                        <p class="profile__info">
                            <span class="icons profile__icons profile__icons--right-space far fa-envelope"
                                aria-hidden="true"></span>
                            test@gmail.com
                        </p>

                        <p class="profile__info">
                            <span class="icons profile__icons profile__icons--right-space fas fa-phone-volume"
                                aria-hidden="true"></span>
                            123456789
                        </p>
                    </div>

                    <div class="profile__account-group">
                        <h5 class="titles titles--transform-none profile__titles profile__titles--group-titles">
                            Opis
                        </h5>

                        <p class="profile__description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas ipsa, quos facilis quia hic ea
                            provident non, fugiat rerum facere dignissimos minima commodi mollitia, in eius tempore
                            corrupti! Consectetur, ratione?
                        </p>
                    </div>
                </div>

                <div class="profile__data">
                    <header class="headers profile__headers">
                        <h3 class="titles titles--transform-none profile__titles profile__titles--subtitle">ID Konta: 1</h3>
                    </header>

                    <div class="profile__data-group">
                        <h4 class="titles profile__titles profile__titles--group-title">
                            <span class="icons profile__icons profile__icons--right-space far fa-address-card"
                                aria-hidden="true"></span>
                            Dane Osobowe
                        </h4>

                        <ul class="lists profile__lists">
                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Imię:</span>
                                Damian
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Nazwisko:</span>
                                Woźniak
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Data urodzenia:</span>
                                1998-10-11
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Płeć:</span>
                                Chłop
                            </li>
                        </ul>
                    </div>

                    <div class="profile__data-group">
                        <h4 class="titles profile__titles profile__titles--group-title">
                            <span class="icons profile__icons profile__icons--right-space fas fa-map-marker-alt"
                                aria-hidden="true"></span>
                            Dane adresowe
                        </h4>

                        <ul class="lists profile__lists">
                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Miasto:</span>
                                Derby
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Ulica:</span>
                                Jakaś tam
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Kod pocztowy:</span>
                                21-044
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Numer domu:</span>
                                653
                            </li>

                            <li class="lists__item lists__item--labeled-vertical">
                                <span class="lists__item-label">Numer budynku:</span>
                                123
                            </li>
                        </ul>
                    </div>

                    <div class="profile__options">
                        <a href="#" class="buttons buttons--success profile__buttons">
                            <span role="img" class="icons profile__icons fas fa-user-edit" aria-label="Edytuj"></span>
                        </a>
                        <a href="#" class="buttons buttons--danger profile__buttons">
                            <span role="img" class="icons profile__icons fas fa-ban" aria-label="Zablokuj"></span>
                        </a>
                        <a href="#" class="buttons buttons--delete profile__buttons">
                            <span role="img" class="icons profile__icons fas fa-trash" aria-label="Usuń"></span>
                        </a>
                    </div>
                </div>
            </div>
    </div>

@endsection
