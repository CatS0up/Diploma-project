@extends('layouts.admin')

@section('inner-content')
    <header class="headers dashboard__headers">
        <ol class="breadcrumbs dashboard__breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('admin.index') }}" class="links links--light breadcrumbs__links">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item--active">
                Książki
            </li>
        </ol>
    </header>

    <section class="stats dashboard__stats">
        <div class="cards dashboard__cards">
            <span class="icons icons--xx-large cards__icons cards__icons--orange fas fa-book" aria-hidden="true">
            </span>

            <div class="cards__body">
                <h2 class="titles titles--weight-normal cards__titles">
                    Książki:
                </h2>
                <p class="cards__text">
                    {{ $stats['all_amount'] }}
                </p>
            </div>
        </div>

        <div class="cards dashboard__cards">
            <span class="icons icons--xx-large cards__icons cards__icons--purple fas fa-star-half-alt" aria-hidden="true">
            </span>

            <div class="cards__body">
                <h2 class="titles titles--weight-normal cards__titles">
                    Książki 4+:
                </h2>
                <p class="cards__text">
                    {{ $stats['best_amount'] }}
                </p>
            </div>
        </div>
    </section>

    <section class="dashboard__sections">
        <h2 class="titles titles--weight-normal dashboard__titles">Książki</h2>

        <div class="dashboard__actions">
            <form class="forms forms--inline app__forms" action="{{ url()->current() }}" method="get">
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
                        @foreach ($inputValues['publishers'] as $publisher)
                            <option value="{{ $publisher->name }}"
                                {{ !($publisher->name == $filters['publisher']) ?: 'selected' }}>
                                {{ $publisher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="forms__group">
                    <label class="forms__group-title" for="search">
                        Gatunek
                    </label>
                    <select class="forms__input forms__input--bordered" name="genre">
                        <option value="all">Wszystkie</option>
                        @foreach ($inputValues['genres'] as $genre)
                            <option value="{{ $genre->name }}" {{ !($genre->name == $filters['genre']) ?: 'selected' }}>
                                {{ $genre->name }}</option>
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

        @if ($books->isNotEmpty())
            <table class="tables dashboard__tables">
                <thead class="tables__header">
                    <tr class="tables__row">
                        <th class="tables__header-cell">
                            #
                        </th>
                        <th class="tables__header-cell">
                            Książka
                        </th>
                        <th class="tables__header-cell">
                            ISBN
                        </th>
                        <th class="tables__header-cell">
                            Autorzy
                        </th>
                        <th class="tables__header-cell">
                            Wydawca
                        </th>
                        <th class="tables__header-cell">
                            Gatunki
                        </th>
                        <th class="tables__header-cell">
                            Opcje
                        </th>
                    </tr>
                </thead>

                <tbody class="tables__body">
                    @foreach ($books as $book)
                        <tr class="tables__row">
                            <th class="tables__header-cell">
                                {{ $loop->iteration }}
                            </th>

                            <td class="tables__cell" data-label="Książka">
                                <div class="tables__item">
                                    <div class="pictures pictures--small tables__pictures">
                                        @if ($book->cover)
                                            <img class="pictures__img" src="{{ Storage::url($book->cover) }}"
                                                alt="Okładka książki.">
                                        @else
                                            <img class="pictures__img" src="{{ asset('img/book_cover.png') }}"
                                                alt="Okładka książki.">
                                        @endif
                                    </div>
                                    {{ $book->title }}
                                </div>
                            </td>

                            <td class="tables__cell" data-label="ISBN">
                                {{ $book->isbn }}
                            </td>

                            <td class="tables__cell" data-label="Autorzy">
                                {{ $book->authors->implode('fullname', ', ') }}
                            </td>

                            <td class="tables__cell" data-label="Wydawca">
                                {{ $book->publisher->name }}
                            </td>

                            <td class="tables__cell" data-label="Gatunki">
                                {{ $book->genres->implode('name', ', ') }}
                            </td>

                            <td class="tables__cell" data-label="Opcje">
                                <div class="tables__group">
                                    <a class="buttons buttons--primary tables__buttons"
                                        href="{{ route('admin.show.book', ['id' => $book->id]) }}">Pokaż</a>

                                    <form class="forms tables__forms"
                                        action="{{ route('admin.delete.book', ['id' => $book->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="buttons buttons--danger forms__buttons">Usuń</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot class="tables__footer">
                    <tr class="tables__row">
                        <th class="tables__header-cell">
                            #
                        </th>
                        <th class="tables__header-cell">
                            Książka
                        </th>
                        <th class="tables__header-cell">
                            ISBN
                        </th>
                        <th class="tables__header-cell">
                            Autorzy
                        </th>
                        <th class="tables__header-cell">
                            Wydawca
                        </th>
                        <th class="tables__header-cell">
                            Gatunki
                        </th>
                        <th class="tables__header-cell">
                            Opcje
                        </th>
                    </tr>
                </tfoot>
            </table>
        @else
            <div class="notifications dashboard__notifications">
                <span class="icons icons--x-large notifications__icons far fa-folder-open" aria-hidden="true"></span>
                Brak książek
            </div>
        @endif

        {{ $books->links() }}
    </section>

@endsection
