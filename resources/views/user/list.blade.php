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
                <a href="{{ route('profile.show', ['uid' => $current_user]) }}"
                    class="links links--light breadcrumbs__links">
                    {{ $current_user }}
                </a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item--active">
                Biblioteka
            </li>
        </ol>
    </header>

    <section class="user-library main__user-library  main__section--tight">

        <div class="filters user-library__filters">
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
                        @foreach ($inputValues['publishers'] as $publisher)
                            <option value="{{ $publisher->name }}"
                                {{ !($publisher->name == $filters['publisher']) ?: 'selected' }}>
                                {{ $publisher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="forms__group">
                    <label class="forms__group-title" for="genre">
                        Gatunek
                    </label>
                    <select id="genre" class="forms__input forms__input--bordered" name="genre">
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
                </div>
            </form>

        </div>

        <div class="user-library__items">
            @forelse ($books as $book)
                <article class="book-item books__book-item">

                    <header class="headers book-item__headers">

                        <div class="pictures book-item__pictures">
                            @if ($book->cover)
                                <img class="pictures__img" src="{{ Storage::url($book->cover) }}" alt="Okładka książki.">
                            @else
                                <img class="pictures__img" src="{{ asset('img/book_cover.png') }}"
                                    alt="Okładka książki.">
                            @endif
                        </div>

                    </header>

                    <div class="book-item__body">
                        <h3 class="titles titles--transform-none book-item__titles">{{ $book->title }}</h3>

                        <div class="book-item__options">
                            <a href="{{ route('book.show', ['slug' => $book->slug]) }}" class="links book-item__links">
                                <span role="img" class="icons icons--small far fa-eye" aria-label="Pokaż"></span>
                            </a>

                            @auth
                                @if (Auth::user()->hasBook($book->id))
                                    <form class="forms tables__forms"
                                        action="{{ route('user.remove.book', ['slug' => $book->slug]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="buttons buttons--bg-no book-item__buttons">
                                            <span role="img" class="icons icons--small fas fa-minus" aria-label="Usuń"></span>
                                        </button>
                                    </form>
                                @else
                                    <form class="forms tables__forms"
                                        action="{{ route('user.add.book', ['slug' => $book->slug]) }}" method="post">
                                        @csrf
                                        <button class="buttons buttons--bg-no  book-item__buttons">
                                            <span role="img" class="icons icons--small fas fa-plus" aria-label="Dodaj"></span>
                                        </button>
                                    </form>
                                @endif
                            @endauth

                            <a href="{{ route('book.download', ['slug' => $book->slug]) }}"
                                class="links book-item__links">
                                <span role="img" class="icons icons--small fas fa-file-download"
                                    aria-label="Pobierz"></span>
                            </a>
                        </div>
                    </div>

                </article>
            @empty
                <div class="notifications user-library__notifications">
                    <span class="icons icons--x-large notifications__icons far fa-folder-open" aria-hidden="true"></span>
                    Brak książek
                </div>
            @endforelse
        </div>

        {{ $books->links() }}
    </section>
@endsection
