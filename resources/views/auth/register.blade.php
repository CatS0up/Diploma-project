@extends('layouts.app')

@section('inner-content')

    <div class="container app__container">
        <header class="headers app__headers">
            <ol class="breadcrumbs app__breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="/" class="links links--light breadcrumbs__links">
                        Strona główna
                    </a>
                </li>
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    Rejestracja
                </li>
            </ol>
        </header>

        <section class="auth-form app__auth-form">
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
                        <input id="superAdmin" class="forms__checkbox" type="radio" name="role" value="super_admin">
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
        </section>
    </div>

@endsection
