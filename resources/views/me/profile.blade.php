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
                {{ $user->uid }}
            </li>
        </ol>
    </header>

    <section class="profile-page main__profile-page main__section--tight">
        <div class="profile-page__main-info">
            <div class="pictures pictures--medium profile-page__pictures">
                @if ($user->avatar)
                    <img class="pictures__img" src="{{ Storage::url($user->avatar) }}" alt="Avatar użytkownika.">
                @else
                    <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}" alt="Avatar użytkownika.">
                @endif
            </div>

            <p class="profile-page__name">
                {{ $user->uid }}
            </p>

            <p class="profile-page__main-detail">
                {{ $user->role->name }}
            </p>

            <p class="profile-page__main-detail">
                {{ $user->email }}
            </p>

            <p class="profile-page__main-detail">
                {{ $user->phone }}
            </p>
        </div>

        <div class="profile-page__details">
            <div class="profile-page__details-info">
                <h4 class="titles profile-page__titles">
                    Dane osobowe
                </h4>

                <li class="lists__item lists__item--labeled-vertical">
                    <span class="lists__item-label">Imię i nazwisko</span>
                    {{ $user->personalDetails->fullname }}
                </li>

                <li class="lists__item lists__item--labeled-vertical">
                    <span class="lists__item-label">Data urodzenia</span>
                    {{ $user->personalDetails->birthday }}
                </li>

                <li class="lists__item lists__item--labeled-vertical">
                    <span class="lists__item-label">Płeć</span>
                    {{ $user->personalDetails->gender }}
                </li>
            </div>

            <div class="profile-page__details-info">
                <h4 class="titles profile-page__titles">
                    Dane adresowe
                </h4>

                <ul class="lists profile-page__lists">
                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Miasto</span>
                        {{ $user->address->town }}
                    </li>

                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Kod pocztowy</span>
                        {{ $user->address->zipcode }}
                    </li>

                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Ulica</span>
                        {{ $user->address->street }}
                    </li>

                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Numer domu</span>
                        {{ $user->address->house_number }}
                    </li>
                </ul>

                <div class="description">
                    h5.titles.
                </div>
            </div>
        </div>
    </section>
@endsection
