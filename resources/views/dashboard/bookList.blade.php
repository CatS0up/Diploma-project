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
                        976
                    </p>
                </div>
            </div>

            <div class="cards dashboard__cards">
                <span class="icons icons--xx-large cards__icons cards__icons--purple fas fa-star-half-alt"
                    aria-hidden="true">
                </span>

                <div class="cards__body">
                    <h2 class="titles titles--weight-normal cards__titles">
                        Książki 7+:
                    </h2>
                    <p class="cards__text">
                        65
                    </p>
                </div>
            </div>
        </section>

        <section class="dashboard__sections">
            <h2 class="titles titles--weight-normal dashboard__titles">Książki</h2>

            <div class="dashboard__actions">
                <form class="forms forms--inline dashboard__forms" action="{{ route('admin.get.books') }}" method="get">
                    @csrf
                    <div class="forms__group">
                        <input id="bookGenre" class="forms__input forms__input--bordered" type="search" name="q"
                            value="{{ old('q') }}" placeholder="Wyszukaj">

                        @error('q')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__group">
                        <select class="forms__input forms__input--bordered" name="publisher">
                            <option value="all">Wszystkie</option>
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="forms__group">
                        <select class="forms__input forms__input--bordered" name="genre">
                            <option value="all">Wszystkie</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="forms__buttons-group forms__buttons-group--content-to-left">
                        <button class="buttons buttons--primary forms__buttons" type="submit">Filtruj</button>
                        <a class="buttons buttons--success forms__buttons" href="{{ route('admin.add.book') }}">Dodaj</a>
                    </div>
                </form>
            </div>

            <section class="dashboard__sections">
                <h2 class="titles titles--weight-normal dashboard__titles">Książki</h2>

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
                                <th class="tables__header-cell" data-label="ID">
                                    {{ $loop->iteration }}
                                </th>

                                <td class="tables__cell" data-label="Użytkownik">
                                    <div class="tables__item">
                                        <div class="pictures pictures--small pictures--avatar tables__pictures">
                                            @if ($book->cover)
                                                <img class="pictures__img" src="{{ Storage::url($book->cover) }}"
                                                    alt="Okładka książki.">
                                            @else
                                                <img class="pictures__img"
                                                    src="{{ asset('img/avatar_placeholder.jpg') }}"
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
                                    @foreach ($book->authors as $author)
                                        {{ $author->firstname . ' ' . $author->lastname }}
                                    @endforeach
                                </td>

                                <td class="tables__cell" data-label="Wydawca">
                                    {{ $book->publisher->name }}
                                </td>

                                <td class="tables__cell" data-label="Gatunki">
                                    @foreach ($book->genres as $genre)
                                        {{ $genre->name }}
                                    @endforeach
                                </td>

                                <td class="tables__cell" data-label="Opcje">
                                    <div class="tables__group">
                                        <form class="forms tables__forms" action="#" method="post">
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
            </section>

    </div>

@endsection
