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
                {{ $book->title }}
            </li>
        </ol>
    </header>

    <section class="app__sections app__sections--medium-width">

        <div class="book-info app__book-info">
            <div class="book-info__thumbnail">
                <div class="pictures book-info__pictures">
                    @if ($book->cover)
                        <img class="pictures__img" src="{{ Storage::url($book->cover) }}" alt="Okładka książki.">
                    @else
                        <img class="pictures__img" src="{{ asset('img/book_cover.png') }}" alt="Okładka książki.">
                    @endif
                </div>
            </div>

            <div class="book-info__details">
                <h1 class="titles titles--transform-none book-info__titles">
                    {{ $book->title }}
                </h1>

                <ul class="lists book-info__lists">
                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Ocena</span>
                        <div class="rate book-info__rate">
                            @for ($i = 0; $i < 5; $i++)
                                <span class="icons icons--small rate__star rate__icons fas fa-star"></span>
                            @endfor
                        </div>
                    </li>

                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">ISBN</span>
                        {{ $book->isbn }}
                    </li>

                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Wydawca</span>
                        {{ $book->publisher->name }}
                    </li>

                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Autorzy</span>
                        @foreach ($book->authors as $author)
                            {{ $author->firstname . ' ' . $author->lastname }}
                        @endforeach
                    </li>

                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Data wydania</span>
                        {{ $book->publishing_date }}
                    </li>


                    <li class="lists__item lists__item--labeled-vertical">
                        <span class="lists__item-label">Gatunki</span>
                        {{ $book->genres->implode('name', ',') }}
                    </li>
                </ul>

                <p class="book-info__description">
                    {{ $book->description }}
                </p>

                <div class="book-info__options">
                    <a href="{{ route('book.download', ['id' => $book->id]) }}"
                        class="buttons buttons--primary book-info__books">
                        Pobierz
                    </a>

                    @auth
                        @if ($userHasBook)
                            <form class="forms tables__forms" action="{{ route('me.remove.book', ['slug' => $book->slug]) }}"
                                method="post">
                                @csrf
                                @method('delete')
                                <button class="buttons buttons--danger forms__buttons">Usuń z biblioteki</button>
                            </form>
                        @else
                            <form class="forms tables__forms" action="{{ route('me.add.book', ['slug' => $book->slug]) }}"
                                method="post">
                                @csrf
                                <button class="buttons buttons--primary forms__buttons">Dodaj do biblioteki</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

    </section>

    <section class="reviews app__reviews">
        <header class="headers reviews__headers">
            <h2 class="titles app__titles">Recenzje</h2>

            <section class="reviews__list">
                <ul class="lists reviews__lists">
                    @foreach ($reviews as $review)
                        <li class="lists__item">
                            <div class="review reviews__review">
                                <header class="headers review__headers">
                                    <h3 class="titles review__titles">{{ $review->title }}</h3>

                                    <div class="rate review__rate">
                                        @for ($i = 0; $i < 5; $i++)
                                            <span
                                                class="icons icons--small rate__star rate__icons {{ $i < $review->rate ? 'fas fa-star' : 'far fa-star' }}"></span>
                                        @endfor
                                    </div>
                                </header>

                                <section class="review__body">
                                    <div class="pictures pictures--small review__pictures">
                                        @if ($review->user->avatar)
                                            <img class="pictures__img" src="{{ Storage::url($review->user->avatar) }}"
                                                alt="Avatar użytkownika.">
                                        @else
                                            <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}"
                                                alt="Avatar użytkownika.">
                                        @endif
                                    </div>

                                    <div class="review__info-group">
                                        <section class="review__info">
                                            <span class="review__author-info">
                                                {{ $review->user->uid }}
                                            </span>
                                            <br>
                                            <span class="review__info-item">
                                                {{ $review->added_at }}
                                            </span>
                                        </section>
                                    </div>

                                    <p class="review__text">
                                        {{ $review->text_content }}
                                    </p>
                                </section>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>

            <section class="reviews__actions">
                <h3 class="titles reviews__titles">Dodaj recenzję</h3>
                <form class="forms reviews__forms" action="{{ route('reviews.add') }}" method="post">
                    @csrf
                    <div class="forms__group">
                        <input id="bookId" class="forms__input-hidden" type="hidden" name="book_id"
                            value="{{ $book->id }}">
                    </div>

                    <div class="forms__inline-section">
                        <div class="forms__check">
                            @for ($i = 0; $i < 5; $i++)
                                <input id="rate{{ $i + 1 }}" class="forms__radio forms__radio--hidden" type="radio"
                                    name="rate" value="{{ $i + 1 }}" {{ $i === 4 ? 'checked' : null }}>
                                <label for="rate{{ $i + 1 }}" class="forms__radio-title">
                                    <span class="icons icons--small rate__star rate__icons far fa-star"
                                        data-rating="icon"></span>
                                </label>
                            @endfor
                        </div>
                    </div>

                    <div class="forms__group">
                        <label class="forms__group-title" for="genres">
                            Tytuł
                            <span class="forms__required-info">*</span>
                        </label>
                        <input id="title" class="forms__input" type="text" name="title" value="{{ old('title') }}">

                        @error('title')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__group">
                        <label class="forms__group-title" for="review">
                            Recenzja
                            <span class="forms__required-info">*</span>
                        </label>
                        <textarea id="review" class="forms__input forms__input--textarea" name="review"
                            rows="10"></textarea>

                        @error('review')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    <div class="forms__buttons-group">
                        <button class="buttons buttons--primary forms__buttons" type="submit">Dodaj</button>
                    </div>
                </form>
            </section>
        </header>
    </section>
@endsection
