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

    <section class="app__sections app__sections--medium-width">

        <div class="user-profile app__user-profile">

            <div class="pictures user-profile__pictures">
                @if ($user->avatar)
                    <img class="pictures__img" src="{{ Storage::url($user->avatar) }}" alt="Avatar użytkownika.">
                @else
                    <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}" alt="Avatar użytkownika.">
                @endif
            </div>

            <header class="headers user-profile__headers">
                <h1 class="titles titles--transform-none user-profile__titles">
                    {{ $user->uid }}
                    <br>
                    <span class="titles__subtitle">{{ $user->role->name }}</span>
                </h1>

                <section class="user-profile__stats">
                    <div class="user-profile__stats-item">
                        <h5 class="titles user-profile__titles">
                            Książki
                        </h5>

                        <p class="user-profile__stats-content">
                            {{ $user->bookAmount() }}
                        </p>
                    </div>

                    <div class="user-profile__stats-item">
                        <h5 class="titles user-profile__titles">
                            Recenzje
                        </h5>

                        <p class="user-profile__stats-content">
                            {{ $user->bookAmount() }}
                        </p>
                    </div>
                </section>
            </header>

            <section class="user-profile__body">
                <h5 class="titles user-profile__titles">Opis</h5>

                <p class="user-profile__description">
                    {{ $user->description ?? '(Brak opisu)' }}
                </p>
            </section>
        </div>

    </section>

@endsection
