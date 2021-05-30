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
                Moje książki
            </li>
        </ol>
    </header>

    <section class="users-library">

        <div class="filters users-library__filters">
            <form class="forms forms--inline main__forms" action="{{ url()->current() }}" method="get">
                @csrf
                <div class="forms__group">
                    <label class="forms__group-title" for="search">
                        Wyszukiwarka
                    </label>
                    <input id="search" class="forms__input forms__input--bordered" type="search" name="q"
                        value="{{ $filters['q'] }}">
                </div>

                <div class="forms__group">
                    <label class="forms__group-title" for="publisher">
                        Wydawnictwo
                    </label>
                    <select id="publisher" class="forms__input forms__input--bordered" name="publisher">
                        <option value="all">Wszyscy</option>
                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher->name }}"
                                {{ !($publisher->name == $filters['publisher']) ?: 'selected' }}>
                                {{ $publisher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="forms__inline-section">
                    <span class="forms__section-name forms__section-name--all-cols">Sortuj (Po tytule)</span>

                    <div class="forms__check">
                        <input id="ascending" class="forms__radio" type="radio" name="sort" value="asc"
                            {{ !($filters['sort'] === 'asc') ?: 'checked' }}>
                        <label for="ascending" class="forms__radio-title">Rosnąco</label>
                    </div>

                    <div class="forms__check">
                        <input id="descending" class="forms__radio" type="radio" name="sort" value="desc"
                            {{ !($filters['sort'] === 'desc') ?: 'checked' }}>
                        <label for="descending" class="forms__radio-title">Malejąco</label>
                    </div>
                </div>

                <div class="forms__buttons-group forms__buttons-group--content-to-left">
                    <button class="buttons buttons--primary forms__buttons" type="submit">Filtruj</button>
                    <a class="buttons buttons--success forms__buttons" href="{{ route('admin.add.book') }}">Dodaj</a>
                </div>
            </form>

        </div>
    </section>
@endsection
