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

    <section class="book-page main__book-page main__section--tight">
        <div class="book-page__thumbnail">
            <div class="pictures book-page__pictures">
                @if ($book->cover)
                    <img class="pictures__img" src="{{ Storage::url($book->cover) }}" alt="Okładka książki.">
                @else
                    <img class="pictures__img" src="{{ asset('img/book_cover.png') }}" alt="Okładka książki.">
                @endif
            </div>
        </div>

        <div class="book-page__details">
            <header class="headers book-page__headers">
                <h1 class="titles titles--transform-none book-page__titles">
                    {{ $book->title }}
                </h1>
            </header>

            <div class="book-page__details-body">
                <div class="book-page__info">
                    <ul class="lists book-page__lists">
                        <li class="lists__item lists__item--labeled-horizontal">
                            <span class="lists__item-label">Ocena</span>
                            @php
                                $rate = $book->rateAvg();
                                $amount = $book->countRates();
                            @endphp
                            <x-rate parentName="book-page" :rate="$rate" :ratesAmount="$amount" />
                        </li>

                        <li class=" lists__item lists__item--labeled-horizontal">
                            <span class="lists__item-label">ISBN</span>
                            {{ $book->isbn }}
                        </li>

                        <li class="lists__item lists__item--labeled-horizontal">
                            <span class="lists__item-label">Ilość stron</span>
                            {{ $book->pages }}
                        </li>

                        <li class="lists__item lists__item--labeled-horizontal">
                            <span class="lists__item-label">Data wydania</span>
                            {{ $book->publishing_date }}
                        </li>
                    </ul>

                    <ul class="lists book-page__lists">
                        <li class="lists__item lists__item--labeled-vertical">
                            <span class="lists__item-label">Wydawnictwo</span>
                            {{ $book->publisher->name }}
                        </li>

                        <li class="lists__item lists__item--labeled-vertical">
                            <span class="lists__item-label">Gatunek/Gatunki</span>
                            {{ $book->genres->implode('name', ', ') }}
                        </li>

                        <li class="lists__item lists__item--labeled-vertical">
                            <span class="lists__item-label">Autor/Autorzy</span>
                            {{ $book->authors->implode('fullname', ', ') }}
                        </li>
                    </ul>
                </div>

                <div class="book-page__description">
                    <h4 class="titles titles--transform-none book-page__titles">
                        Opis
                    </h4>

                    <p class="book-page__description-content">
                        {{ $book->description }}
                    </p>
                </div>
            </div>

            <div class="book-page__options">
                @auth
                    @if (Auth::user()->hasBook($book->id))
                        <form class="forms tables__forms" action="{{ route('me.remove.book', ['slug' => $book->slug]) }}"
                            method="post">
                            @csrf
                            @method('delete')
                            <button class="buttons buttons--bg-no book-item__buttons">
                                <span role="img" class="icons icons--small fas fa-minus" aria-label="Usuń"></span>
                            </button>
                        </form>
                    @else
                        <form class="forms tables__forms" action="{{ route('me.add.book', ['slug' => $book->slug]) }}"
                            method="post">
                            @csrf
                            <button class="buttons buttons--bg-no  book-item__buttons">
                                <span role="img" class="icons icons--small fas fa-plus" aria-label="Dodaj"></span>
                            </button>
                        </form>
                    @endif
                @endauth

                <a href="{{ route('book.download', ['slug' => $book->slug]) }}" class="links book-item__links">
                    <span role="img" class="icons icons--small fas fa-file-download" aria-label="Pobierz"></span>
                </a>
            </div>
        </div>
    </section>

    <section class="comments main__section--tight">
        <h3 class="titles titles--transform-none comments__titles">
            Recenzje ({{ $book->countReviews() }})
        </h3>

        @auth
            <div class="comments__add-section">
                @error('book_id')
                    <div class="messages comments__messages">
                        <div class="messages__icon-container messages__icon-container--warning">
                            <span class="icons icons messages__icons fas fas fa-exclamation-circle" aria-hidden="true"></span>
                        </div>

                        <div class="messages__body">

                            <h4 class="titles messages__titles">Ostrzeżenie</h4>

                            <p class="messages__text">
                                {{ $message }}
                            </p>

                        </div>

                        <button class="buttons buttons--bg-no  buttons--delete-text  messages__buttons" data-dismiss="alert">
                            <span role="img" class="icons icons--small buttons__icons fas fa-times" aria-label="Zamknij alert.">
                            </span>
                        </button>
                    </div>
                @enderror

                @error('user_id')
                    <div class="messages comments__messages">
                        <div class="messages__icon-container messages__icon-container--warning">
                            <span class="icons icons messages__icons fas fas fa-exclamation-circle" aria-hidden="true"></span>
                        </div>

                        <div class="messages__body">

                            <h4 class="titles messages__titles">Ostrzeżenie</h4>

                            <p class="messages__text">
                                {{ $message }}
                            </p>

                        </div>

                        <button class="buttons buttons--bg-no  buttons--delete-text  messages__buttons" data-dismiss="alert">
                            <span role="img" class="icons icons--small buttons__icons fas fa-times" aria-label="Zamknij alert.">
                            </span>
                        </button>
                    </div>
                @enderror

                <form class="forms comments__forms" action="{{ route('reviews.add') }}" method="post">
                    @csrf
                    <div class="forms__group">
                        <input class="forms__hidden-input" type="hidden" name="user_id" value="{{ Auth::id() }}">
                    </div>

                    <div class="forms__group">
                        <input class="forms__hidden-input" type="hidden" name="book_id" value="{{ $book->id }}">
                    </div>

                    <div class="forms__inline-section forms__inline-section--content-to-left">
                        @for ($i = 0; $i < 5; $i++)
                            <div class="forms__check">
                                <input id="rate{{ $i + 1 }}" class="forms__radio forms__radio--hidden" type="radio"
                                    name="rate" value="{{ $i + 1 }}">
                                <label for="rate{{ $i + 1 }}" class="forms__radio-title">
                                    <span role="img"
                                        class="rate rate__star
                                                                                                                                                                                                                                                                                                                                                                                    rate__icons far fa-star"
                                        data-rating="icon" aria-label="Gwiadka ocena"></span>
                                </label>
                            </div>
                        @endfor
                    </div>

                    <div class="forms__group">
                        <label class="forms__group-title" for="description">
                            Komentarz
                            <span class="forms__required-info">*</span>
                        </label>
                        <textarea id="description" class="forms__input forms__input--textarea" name="comment"
                            rows="10">{{ old('comment') }}</textarea>
                        @error('description')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__buttons-group">
                        <button class="buttons buttons--primary forms__buttons">Skomentuj</button>
                    </div>
                </form>
            </div>
        @else
            <div class="messages comments__messages">
                <div class="messages__icon-container messages__icon-container--info">
                    <span class="icons icons messages__icons fas fas fa-info-circle" aria-hidden="true"></span>
                </div>

                <div class="messages__body">

                    <h4 class="titles messages__titles">Info</h4>

                    <p class="messages__text">
                        Zaloguj się aby dodać recenzję.
                    </p>

                </div>
            </div>
        @endauth

        @forelse ($book->reviews as $review)
            <article class="comments__item">
                <header class="headers comments__headers">
                    <div class="comments__author">
                        <div class="pictures pictures--small comment__pictures">
                            @if ($book->avatar)
                                <img class="pictures__img" src="{{ Storage::url($review->user->avatar) }}"
                                    alt="Avatar użytkownika.">
                            @else
                                <img class="pictures__img" src="{{ asset('img/avatar_placeholder.jpg') }}"
                                    alt="Avatar użytkownika.">
                            @endif
                        </div>

                        <span class="comments__nickname">
                            {{ $review->user->uid }}
                        </span>
                    </div>

                    <span class="comments__timestamp">
                        {{ $review->user->created_at }}
                    </span>
                </header>

                <section class="comments__item-body">
                    @php
                        $rate = $review->rate;
                    @endphp
                    <x-rate parentName="comments" :rate="$rate" />

                    <p class="comments__item-content">
                        {{ $review->text_content }}
                    </p>
                </section>

                @can('delete', $review)
                    <div class="comments__item-options">
                        <form class="forms tables__forms" action="{{ route('reviews.delete', ['id' => $review->id]) }}"
                            method="post">
                            @csrf
                            @method('delete')
                            <button class="buttons buttons--danger-text buttons--bg-no forms__buttons">
                                <span class="buttons__text buttons__text--muted">
                                    Usuń
                                </span>

                                <span role="img" class="icons icons--small buttons__icons fas fa-times"
                                    aria-label="Usuń"></span>
                            </button>
                        </form>
                    </div>
                @endcan
            </article>
        @empty
            <div class="notifications dashboard__notifications">
                <span class="icons icons--x-large notifications__icons fas fa-folder-open" aria-hidden="true"></span>
                Brak recenzji
            </div>
        @endforelse
    </section>
@endsection
