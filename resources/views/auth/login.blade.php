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
                    Logowanie
                </li>
            </ol>
        </header>

        <section class="app__auth-form  app__auth-form--decorated">
            <form class="forms app__forms" action="{{ route('auth.login') }}" method="post">
                @csrf
                <div class="forms__group">
                    <label class="forms__group-title" for="uid">
                        Login/E-mail
                        <span class="forms__required-info">*</span>
                    </label>
                    <input id="uid" class="forms__input" type="text" name="uid" value="{{ old('uid') }}">
                    @error('uid')
                        <span class="forms__input-feedback">
                            {{ $message }}
                        </span>
                    @enderror
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

                <div class="forms__buttons-group">
                    <a class="buttons buttons--primary forms__buttons" href="{{ url()->previous() }}">Powrót</a>
                    <button class="buttons buttons--primary forms__buttons">Zaloguj</button>
                </div>
            </form>

            <div class="pictures dashboard__pictures">
                <img class="pictures__img" src="{{ asset('img/registration_img.jpg') }}" alt="Stos książek.">
            </div>
        </section>
    </div>

@endsection
