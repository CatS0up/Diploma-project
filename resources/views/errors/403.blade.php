@extends('layouts.app')

@section('title', 'Error 403')

@section('inner-content')

    <header class="headers app__headers">
        <ol class="breadcrumbs dashboard__breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('home') }}" class="links links--light breadcrumbs__links">
                    Strona główna
                </a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item--active">
                Page not found
            </li>
        </ol>
    </header>

    <section class="app__sections app__sections--medium-width">

        <div class="pictures app__pictures">
            <img class="pictures__img" src="{{ asset('img/errors/403_picture.jpg') }}"
                alt="Strona nie została znaleziona.">
        </div>

    </section>

@endsection
