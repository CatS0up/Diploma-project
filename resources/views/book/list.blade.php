@extends('layouts.app')

@section('inner-content')
    <div class="container main__container">

        <header class="headers main__headers">
            <ol class="breadcrumbs dashboard__breadcrumbs">
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    Strona główna
                </li>
            </ol>
        </header>

        <section class="books main__books">

            <aside class="genres books__genres">
                <header class="headers headers--dark genres__headers">
                    <h3 class="titles titles--transform-none genres__titles">
                        Kategorie
                        <span class="icons titles__icons fas fa-bars" aria-hidden="true"></span>
                    </h3>
                </header>

                <ul class="menu genres__menu">
                    @forelse ($genres as $genre)
                        <li class="menu__item">
                            <a href="{{ url()->full() . '?genre=' . $genre->slug }}"
                                class="links genres__links">{{ $genre->name }}</a>
                        </li>
                    @empty
                        <li class="menu__item menu__item--underlined">
                            Brak gatunków :(
                        </li>
                    @endforelse
                </ul>
            </aside>

            <div class="books__filters">
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

            <div class="books__items">
                @forelse ($books as $book)
                    <article class="book-item books__book-item">

                        <header class="headers book-item__headers">

                            <div class="pictures book-item__pictures">
                                @if ($book->cover)
                                    <img class="pictures__img" src="{{ Storage::url($book->cover) }}"
                                        alt="Okładka książki.">
                                @else
                                    <img class="pictures__img" src="{{ asset('img/book_cover.png') }}"
                                        alt="Okładka książki.">
                                @endif
                            </div>

                        </header>

                        <div class="book-item__body">
                            <h3 class="titles titles--transform-none book-item__titles">{{ $book->title }}</h3>

                            <div class="book-item__options">
                                <a href="{{ route('book.show', ['slug' => $book->slug]) }}"
                                    class="links book-item__links">
                                    <span role="img" class="icons icons--small far fa-eye" aria-label="Pokaż"></span>
                                </a>

                                @auth
                                    @if (Auth::user()->hasBook($book->id))
                                        <form class="forms tables__forms"
                                            action="{{ route('me.remove.book', ['slug' => $book->slug]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="buttons buttons--bg-no book-item__buttons">
                                                <span role="img" class="icons icons--small fas fa-minus"
                                                    aria-label="Usuń"></span>
                                            </button>
                                        </form>
                                    @else
                                        <form class="forms tables__forms"
                                            action="{{ route('me.add.book', ['slug' => $book->slug]) }}" method="post">
                                            @csrf
                                            <button class="buttons buttons--bg-no  book-item__buttons">
                                                <span role="img" class="icons icons--small fas fa-plus"
                                                    aria-label="Dodaj"></span>
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
                    <div class="notifications books__notifications">
                        <span class="icons icons--x-large notifications__icons far fa-folder-open"
                            aria-hidden="true"></span>
                        Brak książek
                    </div>
                @endforelse
            </div>

            {{ $books->links() }}
        </section>
    </div>
@endsection
