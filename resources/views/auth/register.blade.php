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
            <form class="forms profile__forms" action="{{ route('auth.register') }}" method="post">
                @csrf
                <div class="forms__group">
                    <label class="forms__group-title" for="uid">
                        Login
                        <span class="forms__required-info">*</span>
                    </label>
                    <input id="uid" class="forms__input" type="text" name="uid" value="{{ old('uid') }}">
                    @error('uid')
                        <span class="forms__input-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="forms__inline-section">
                    <div class="forms__group">
                        <label class="forms__group-title" for="email">
                            E-mail
                            <span class="forms__required-info">*</span>
                        </label>
                        <input id="email" class="forms__input" type="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__group">
                        <label class="forms__group-title" for="emailConfirmation">
                            Powtórz E-mail
                            <span class="forms__required-info">*</span>
                        </label>
                        <input id="emailConfirmation" class="forms__input" type="email" name="email_confirmation"
                            value="{{ old('email_confirmation') }}">
                    </div>
                </div>

                <div class="forms__inline-section">
                    <div class="forms__group">
                        <label class="forms__group-title" for="pwd">
                            Hasło
                            <span class="forms__required-info">*</span>
                        </label>
                        <input id="pwd" class="forms__input" type="password" name="pwd" value="{{ old('pwd') }}">
                        @error('pwd')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__group">
                        <label class="forms__group-title" for="pwdConfirmation">
                            Powtórz Hasło
                            <span class="forms__required-info">*</span>
                        </label>
                        <input id="pwdConfirmation" class="forms__input" type="password" name="pwd_confirmation"
                            value="{{ old('pwd_confirmation') }}">
                    </div>
                </div>


                <div class="forms__group">
                    <label class="forms__group-title" for="phone">
                        Numer telefonu
                    </label>
                    <input id="phone" class="forms__input" type="tel" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <span class="forms__input-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="forms__inline-section">
                    <div class="forms__group">
                        <label class="forms__group-title" for="firstName">
                            Imię
                        </label>
                        <input id="firstName" class="forms__input" type="text" name="firstname"
                            value="{{ old('firstname') }}">
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
                            value="{{ old('lastname') }}">
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
                    <input id="birthday" class="forms__input" type="date" name="birthday" value="{{ old('birthday') }}">
                    @error('birthday')
                        <span class="forms__input-feedback">
                            {{ $message }}
                        </span>
                    @enderror
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
                        <input id="town" class="forms__input" type="text" name="town" value="{{ old('town') }}">
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
                        <input id="street" class="forms__input" type="text" name="street" value="{{ old('street') }}">
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
                        <input id="zipcode" class="forms__input" type="text" name="zipcode" value="{{ old('zipcode') }}">
                        @error('zipcode')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__group">
                        <label class="forms__group-title" for="buldingNumber">
                            Numer budynku
                        </label>
                        <input id="buldingNumber" class="forms__input" type="text" name="building_number"
                            value="{{ old('building_number') }}">
                        @error('building_number')
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
                            value="{{ old('house_number') }}">
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
                        rows="10">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="forms__input-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="forms__buttons-group">
                    <a href="#" class="buttons buttons--delete forms__buttons">Anuluj</a>
                    <button class="buttons buttons--primary forms__buttons" type="submit">Edytuj</button>
                </div>
            </form>
        </section>
    </div>

@endsection
