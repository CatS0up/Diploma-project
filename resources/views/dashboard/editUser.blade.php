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

                    <div class="profile__update">
                        <form action="#" class="forms profile__forms">
                            @csrf
                            @method('put')
                            <div class="forms__group">
                                <label class="forms__group-title" for="uid">
                                    Login
                                </label>
                                <input id="uid" class="forms__input" type="text" name="uid">
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="email">
                                    E-mail
                                </label>
                                <input id="email" class="forms__input" type="email" name="email">
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="phone">
                                    Numer telefonu
                                </label>
                                <input id="phone" class="forms__input" type="tel" name="phone">
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__check">
                                    <input id="superAdmin" class="forms__checkbox" type="radio" name="role"
                                        value="super_admin">
                                    <label for="superAdmin" class="forms__checkbox-title">Super Admin</label>
                                </div>

                                <div class="forms__check">
                                    <input id="admin" class="forms__checkbox" type="radio" name="role" value="admin">
                                    <label for="admin" class="forms__checkbox-title">Admin</label>
                                </div>

                                <div class="forms__check">
                                    <input id="user" class="forms__checkbox" type="radio" name="role" value="user">
                                    <label for="user" class="forms__checkbox-title">User</label>
                                </div>
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__group">
                                    <label class="forms__group-title" for="firstName">
                                        Imię
                                    </label>
                                    <input id="firstName" class="forms__input" type="text" name="firstname">
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="lastName">
                                        Nazwisko
                                    </label>
                                    <input id="lastName" class="forms__input" type="text" name="lastname">
                                </div>
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="birthday">
                                    Data urodzenia
                                </label>
                                <input id="birthday" class="forms__input" type="date" name="birthday">
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__check">
                                    <input id="male" class="forms__checkbox" type="radio" name="gender" value="m">
                                    <label for="male" class="forms__checkbox-title">Mężczyzna</label>
                                </div>

                                <div class="forms__check">
                                    <input id="female" class="forms__checkbox" type="radio" name="gender" value="k">
                                    <label for="female" class="forms__checkbox-title">Kobieta</label>
                                </div>
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__group">
                                    <label class="forms__group-title" for="town">
                                        Miasto
                                    </label>
                                    <input id="town" class="forms__input" type="text" name="town">
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="street">
                                        Ulica
                                    </label>
                                    <input id="street" class="forms__input" type="text" name="street">
                                </div>
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__group">
                                    <label class="forms__group-title" for="zipcode">
                                        Kod pocztowy
                                    </label>
                                    <input id="zipcode" class="forms__input" type="text" name="zipcode">
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="buldingNumber">
                                        Numer budynku
                                    </label>
                                    <input id="buldingNumber" class="forms__input" type="text" name="building_number">
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="houseNumber">
                                        Numer domu
                                    </label>
                                    <input id="houseNumber" class="forms__input" type="text" name="house_number">
                                </div>
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="description">
                                    Opis
                                </label>
                                <textarea id="description" class="forms__input forms__input--textarea" name="description"
                                    rows="10"></textarea>
                            </div>

                            <div class="forms__buttons-group">
                                <a href="#" class="buttons buttons--delete forms__buttons">Anuluj</a>
                                <button class="buttons buttons--primary forms__buttons" type="submit">Edytuj</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
