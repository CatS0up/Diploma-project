@extends('layouts.app')

@section('inner-content')
    <div class="container app__container">

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


        <section class="app__sections ">
            <div class="app__items">
                @if ($books->total() > 0)
                    <ul class="lists app__lists">
                        @foreach ($books as $book)
                            <li class="lists__item">
                                <div class="book-preview lists__book-preview">
                                    <div class="book-preview__header">
                                        <h3 class="titles book-preview__titles">
                                            {{ $book->title }}
                                        </h3>

                                        <div class="pictures book-preview__pictures">
                                            @if ($book->cover)
                                                <img class="pictures__img" src="{{ Storage::url($book->cover) }}"
                                                    alt="Okładka książki.">
                                            @else
                                                <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}"
                                                    alt="Okładka książki.">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="book-preview__body">
                                        <div class="book-preview__info">
                                            <ul class="lists book-preview__lists">
                                                <li class="lists__item lists__item--labeled-horizontal">
                                                    <span class="lists__item-label">ISBN</span>
                                                    {{ $book->isbn }}
                                                </li>

                                                <li class="lists__item lists__item--labeled-horizontal">
                                                    <span class="lists__item-label">Wydawca</span>
                                                    {{ $book->publisher->name }}
                                                </li>

                                                <li class="lists__item lists__item--labeled-horizontal">
                                                    <span class="lists__item-label">Autorzy</span>
                                                    @foreach ($book->authors as $author)
                                                        {{ $author->firstname . ' ' . $author->lastname }}
                                                    @endforeach
                                                </li>

                                                <li class="lists__item lists__item--labeled-horizontal">
                                                    <span class="lists__item-label">Gatunki</span>
                                                    {{ $book->genres->implode('name', ',') }}
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="book-preview__options">
                                            <a href="{{ route('book.show', ['slug' => $book->slug]) }}"
                                                class="links links--light book-preview__links">Szczegóły</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="notifications dashboard__notifications">
                        <span class="icons icons--x-large notifications__icons far fa-folder-open"
                            aria-hidden="true"></span>
                        Brak książek
                    </div>
                @endif
            </div>

        </section>

        </section>
    </div>
@endsection
