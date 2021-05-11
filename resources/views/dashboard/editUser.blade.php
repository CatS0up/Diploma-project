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
                    <a href="{{ route('admin.get.books') }}" class="links links--light breadcrumbs__links">
                        Książki
                    </a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="{{ route('admin.show.user', ['id' => $user->id]) }}"
                        class="links links--light breadcrumbs__links">
                        {{ $user->uid }}
                    </a>
                </li>
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    Edycja
                </li>
            </ol>
        </header>

        <section class="dashboard__sections">
            <h2 class="titles titles--weight-normal dashboard__titles">Profil</h2>

            <div class="profile dashboard__profile">

                <div class="profile__account">
                    <div class="profile__account-group profile__account-group--text-centered">

                        <div class="pictures pictures--centered profile__pictures">
                            @if ($user->avatar)
                                Test
                            @else
                                <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}"
                                    alt="Avatar użytkownika.">
                            @endif
                        </div>

                        <p class="profile__nickname">
                            {{ $user->uid }}
                        </p>

                        <p class="profile__info">
                            {{ $user->role->name }}
                        </p>

                        <p class="profile__info">
                            <span class="icons profile__icons profile__icons--right-space far fa-envelope"
                                aria-hidden="true"></span>
                            {{ $user->email }}
                        </p>

                        <p class="profile__info">
                            <span class="icons profile__icons profile__icons--right-space fas fa-phone-volume"
                                aria-hidden="true"></span>
                            {{ $user->phone }}
                        </p>
                    </div>

                    <div class="profile__account-group">
                        <h5 class="titles titles--transform-none profile__titles profile__titles--group-titles">
                            Opis
                        </h5>

                        <p class="profile__description">
                            {{ $user->description ?? '(brak)' }}
                        </p>
                    </div>
                </div>

                <div class="profile__data">
                    <header class="headers profile__headers">
                        <h3 class="titles titles--transform-none profile__titles profile__titles--subtitle">ID Konta:
                            {{ $user->id }}</h3>
                    </header>

                    <div class="profile__update">
                        <form class="forms profile__forms" action="{{ route('admin.update.user', ['id' => $user->id]) }}"
                            method="post">
                            @csrf
                            @method('put')
                            <div class="forms__group">
                                <label class="forms__group-title" for="uid">
                                    Login
                                </label>
                                <input id="uid" class="forms__input" type="text" name="uid"
                                    value="{{ old('uid', $user->uid) }}">
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="email">
                                    E-mail
                                </label>
                                <input id="email" class="forms__input" type="email" name="email"
                                    value="{{ old('email', $user->email) }}">
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="phone">
                                    Numer telefonu
                                </label>
                                <input id="phone" class="forms__input" type="tel" name="phone"
                                    value="{{ old('phone', $user->phone) }}">
                            </div>

                            @php
                                $role = old('role', $user->role->id);
                            @endphp

                            <div class="forms__inline-section">
                                <div class="forms__check">
                                    <input id="superAdmin" class="forms__checkbox" type="radio" name="role" value="3"
                                        {{ $role == 3 ? 'checked' : null }}>
                                    <label for="superAdmin" class="forms__checkbox-title">Super Admin</label>
                                </div>

                                <div class="forms__check">
                                    <input id="admin" class="forms__checkbox" type="radio" name="role" value="2"
                                        {{ $role == 2 ? 'checked' : null }}>
                                    <label for="admin" class="forms__checkbox-title">Admin</label>
                                </div>

                                <div class="forms__check">
                                    <input id="user" class="forms__checkbox" type="radio" name="role" value="1"
                                        {{ $role == 1 ? 'checked' : null }}>
                                    <label for="user" class="forms__checkbox-title">User</label>
                                </div>
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__group">
                                    <label class="forms__group-title" for="firstName">
                                        Imię
                                    </label>
                                    <input id="firstName" class="forms__input" type="text" name="firstname"
                                        value="{{ old('firstname', $user->personalDetails->firstname) }}">
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="lastName">
                                        Nazwisko
                                    </label>
                                    <input id="lastName" class="forms__input" type="text" name="lastname"
                                        value="{{ old('lastname', $user->personalDetails->lastname) }}">
                                </div>
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="birthday">
                                    Data urodzenia
                                </label>
                                <input id="birthday" class="forms__input" type="date" name="birthday"
                                    value="{{ old('firstname', $user->personalDetails->birthday) }}">
                            </div>

                            @php
                                $gender = old('gender', $user->personalDetails->gender);
                            @endphp
                            <div class="forms__inline-section">
                                <div class="forms__check">
                                    <input id="male" class="forms__checkbox" type="radio" name="gender" value="m"
                                        {{ $gender === 'm' ? 'checked' : null }}>
                                    <label for="male" class="forms__checkbox-title">Mężczyzna</label>
                                </div>

                                <div class="forms__check">
                                    <input id="female" class="forms__checkbox" type="radio" name="gender" value="k"
                                        {{ $gender === 'k' ? 'checked' : null }}>
                                    <label for="female" class="forms__checkbox-title">Kobieta</label>
                                </div>
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__group">
                                    <label class="forms__group-title" for="town">
                                        Miasto
                                    </label>
                                    <input id="town" class="forms__input" type="text" name="town"
                                        value="{{ old('town', $user->address->town) }}">
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="street">
                                        Ulica
                                    </label>
                                    <input id="street" class="forms__input" type="text" name="street"
                                        value="{{ old('street', $user->address->street) }}">
                                </div>
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__group">
                                    <label class="forms__group-title" for="zipcode">
                                        Kod pocztowy
                                    </label>
                                    <input id="zipcode" class="forms__input" type="text" name="zipcode"
                                        value="{{ old('zipcode', $user->address->zipcode) }}">
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="buldingNumber">
                                        Numer budynku
                                    </label>
                                    <input id="buldingNumber" class="forms__input" type="text" name="building_number"
                                        value="{{ old('building_number', $user->address->building_number) }}">
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="houseNumber">
                                        Numer domu
                                    </label>
                                    <input id="houseNumber" class="forms__input" type="text" name="house_number"
                                        value="{{ old('house_number', $user->address->house_number) }}">
                                </div>
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="description">
                                    Opis
                                </label>
                                <textarea id="description" class="forms__input forms__input--textarea" name="description"
                                    rows="10">{{ old('description', $user->description) }}</textarea>
                            </div>

                            <div class="forms__buttons-group">
                                <a class="buttons buttons--delete forms__buttons"
                                    href="{{ route('admin.show.user', ['id' => $user->id]) }}">Anuluj</a>
                                <button class="buttons buttons--primary forms__buttons" type="submit">Edytuj</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
