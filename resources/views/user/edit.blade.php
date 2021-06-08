@extends('layouts.app')

@section('inner-content')
    <header class="headers dashboard__headers">
        <ol class="breadcrumbs dashboard__breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('home') }}" class="links links--light breadcrumbs__links">
                    Strona główna
                </a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('profile.show', ['uid' => $user->uid]) }}"
                    class="links links--light breadcrumbs__links">
                    {{ $user->uid }}
                </a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item--active">
                Biblioteka
            </li>
        </ol>

        <section class="auth-forms auth-forms--small main__auth-forms">
            <form class="forms show__forms" action="{{ route('profile.update', ['uid' => $user->uid]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')

                <input class="forms__hidden-input" type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="forms__group">
                    <label class="forms__group-title" for="avatar">
                        Avatar
                    </label>
                    <input id="avatar" class="forms__input-file" type="file" name="avatar" value="{{ old('avatar') }}">
                    @error('avatar')
                        <span class="forms__input-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="forms__inline-section">
                    <div class="forms__inline-section">
                        <span class="forms__section-name forms__section-name--all-cols">Reset avatara</span>
                        <div class="forms__check">
                            <input id="resetAvatarTrue" class="forms__radio" type="radio" name="reset_avatar" value="yes">
                            <label for="resetAvatarTrue" class="forms__radio-title">Tak</label>
                        </div>

                        <div class="forms__check">
                            <input id="resetAvatarFalse" class="forms__radio" type="radio" name="reset_avatar" value="no"
                                checked>
                            <label for="resetAvatarFalse" class="forms__radio-title">Nie</label>
                        </div>
                    </div>

                    <div class="forms__group">
                        <label class="forms__group-title" for="uid">
                            Login
                            <span class="forms__required-info">*</span>
                        </label>
                        <input id="uid" class="forms__input" type="text" name="uid" value="{{ old('uid', $user->uid) }}">
                        @error('uid')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="forms__inline-section">
                    <div class="forms__group">
                        <label class="forms__group-title" for="email">
                            E-mail
                            <span class="forms__required-info">*</span>
                        </label>
                        <input id="email" class="forms__input" type="text" name="email"
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
                            <span class="forms__required-info">*</span>
                        </label>
                        <input id="phone" class="forms__input" type="text" name="phone"
                            value="{{ old('phone', $user->phone) }}">
                        @error('phone')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

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

                <div class="forms__inline-section">
                    <div class="forms__group">
                        <label class="forms__group-title" for="newPwd">
                            Nowe hasło
                        </label>
                        <input id="newPwd" class="forms__input" type="password" name="new_pwd"
                            value="{{ old('new_pwd') }}">
                        @error('new_pwd')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__group">
                        <label class="forms__group-title" for="pwdConfirmation">
                            Powtórz hasło
                        </label>
                        <input id="pwdConfirmation" class="forms__input" type="password" name="new_pwd_confirmation"
                            value="{{ old('new_pwd_confirmation') }}">
                        @error('new_pwd_confirmation')
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
                    <a class="buttons buttons--primary forms__buttons"
                        href="{{ route('profile.show', ['uid' => $user->uid]) }}">Powrót</a>
                    <button class="buttons buttons--primary forms__buttons">Zaloguj</button>
                </div>
            </form>
        </section>

    @endsection
