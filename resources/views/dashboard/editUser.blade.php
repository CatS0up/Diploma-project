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

            <div class="show dashboard__show">

                <div class="show__main-info">
                    <div class="show__main-info-group show__main-info-group--text-centered">

                        <div class="pictures pictures--centered show__pictures show__pictures--avatar">
                            @if ($user->avatar)
                                <img class="pictures__img" src="{{ Storage::url($user->avatar) }}"
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
                            {{ $user->description ?? '(brak)' }}
                        </p>
                    </div>
                </div>

                <div class="show__data">
                    <header class="headers show__headers">
                        <h3 class="titles titles--transform-none show__titles show__titles--subtitle">ID Konta:
                            {{ $user->id }}</h3>
                    </header>

                    <div class="show__update">
                        <form class="forms show__forms" action="{{ route('admin.update.user', ['id' => $user->id]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="forms__group">
                                <label class="forms__group-title" for="avatar">
                                    Avatar
                                </label>
                                <input id="avatar" class="forms__input-file" type="file" name="avatar"
                                    value="{{ old('avatar') }}">
                                @error('avatar')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="forms__inline-section">
                                <span class="forms__section-name forms__section-name--all-cols">Reset avatara</span>
                                <div class="forms__check">
                                    <input id="resetAvatarTrue" class="forms__radio" type="radio" name="reset_avatar"
                                        value="yes">
                                    <label for="resetAvatarTrue" class="forms__radio-title">Tak</label>
                                </div>

                                <div class="forms__check">
                                    <input id="resetAvatarFalse" class="forms__radio" type="radio" name="reset_avatar"
                                        value="no" checked>
                                    <label for="resetAvatarFalse" class="forms__radio-title">Nie</label>
                                </div>
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="uid">
                                    Login
                                </label>
                                <input id="uid" class="forms__input" type="text" name="uid"
                                    value="{{ old('uid', $user->uid) }}">

                                @error('uid')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="email">
                                    E-mail
                                </label>
                                <input id="email" class="forms__input" type="email" name="email"
                                    value="{{ old('email', $user->email) }}">

                                @error('email')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="phone">
                                    Numer telefonu
                                </label>
                                <input id="phone" class="forms__input" type="tel" name="phone"
                                    value="{{ old('phone', $user->phone) }}">

                                @error('phone')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            @php
                                $role = old('role', $user->role->id);
                            @endphp

                            @can('superadmin-level')
                                <div class="forms__inline-section">
                                    <div class="forms__check">
                                        <input id="superAdmin" class="forms__radio" type="radio" name="role" value="3"
                                            {{ $role == 3 ? 'checked' : null }}>
                                        <label for="superAdmin" class="forms__radio-title">Super Admin</label>
                                    </div>

                                    <div class="forms__check">
                                        <input id="admin" class="forms__radio" type="radio" name="role" value="2"
                                            {{ $role == 2 ? 'checked' : null }}>
                                        <label for="admin" class="forms__radio-title">Admin</label>
                                    </div>

                                    <div class="forms__check">
                                        <input id="user" class="forms__radio" type="radio" name="role" value="1"
                                            {{ $role == 1 ? 'checked' : null }}>
                                        <label for="user" class="forms__radio-title">User</label>
                                    </div>
                                </div>
                            @endcan
                            <div class="forms__inline-section">
                                <div class="forms__group">
                                    <label class="forms__group-title" for="firstName">
                                        Imię
                                    </label>
                                    <input id="firstName" class="forms__input" type="text" name="firstname"
                                        value="{{ old('firstname', $user->personalDetails->firstname) }}">

                                    @error('firstname')
                                        <span class="forms__input-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="lastName">
                                        Nazwisko
                                    </label>
                                    <input id="lastName" class="forms__input" type="text" name="lastname"
                                        value="{{ old('lastname', $user->personalDetails->lastname) }}">

                                    @error('lastname')
                                        <span class="forms__input-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="birthday">
                                    Data urodzenia
                                </label>
                                <input id="birthday" class="forms__input" type="date" name="birthday"
                                    value="{{ old('firstname', $user->personalDetails->birthday) }}">

                                @error('birthday')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            @php
                                $gender = old('gender', $user->personalDetails->gender);
                            @endphp
                            <div class="forms__inline-section">
                                <div class="forms__check">
                                    <input id="male" class="forms__radio" type="radio" name="gender" value="m"
                                        {{ $gender === 'm' ? 'checked' : null }}>
                                    <label for="male" class="forms__radio-title">Mężczyzna</label>
                                </div>

                                <div class="forms__check">
                                    <input id="female" class="forms__radio" type="radio" name="gender" value="k"
                                        {{ $gender === 'k' ? 'checked' : null }}>
                                    <label for="female" class="forms__radio-title">Kobieta</label>
                                </div>
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__group">
                                    <label class="forms__group-title" for="town">
                                        Miasto
                                    </label>
                                    <input id="town" class="forms__input" type="text" name="town"
                                        value="{{ old('town', $user->address->town) }}">

                                    @error('town')
                                        <span class="forms__input-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="street">
                                        Ulica
                                    </label>
                                    <input id="street" class="forms__input" type="text" name="street"
                                        value="{{ old('street', $user->address->street) }}">

                                    @error('street')
                                        <span class="forms__input-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__group">
                                    <label class="forms__group-title" for="zipcode">
                                        Kod pocztowy
                                    </label>
                                    <input id="zipcode" class="forms__input" type="text" name="zipcode"
                                        value="{{ old('zipcode', $user->address->zipcode) }}">

                                    @error('zipcode')
                                        <span class="forms__input-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="houseNumber">
                                        Numer domu
                                    </label>
                                    <input id="houseNumber" class="forms__input" type="text" name="house_number"
                                        value="{{ old('house_number', $user->address->house_number) }}">

                                    @error('house_number')
                                        <span class="forms__input-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="description">
                                    Opis
                                </label>
                                <textarea id="description" class="forms__input forms__input--textarea" name="description"
                                    rows="10">{{ old('description', $user->description) }}</textarea>

                                @error('description')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
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
