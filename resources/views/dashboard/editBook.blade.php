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
                <li class="breadcrumbs__item">
                    <a href="{{ route('admin.get.books') }}" class="links links--light breadcrumbs__links">
                        Książki
                    </a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="{{ route('admin.show.book', ['id' => $book->id]) }}"
                        class="links links--light breadcrumbs__links">
                        {{ $book->title }}
                    </a>
                </li>
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    Edycja
                </li>
            </ol>
        </header>

        <section class="dashboard__sections">
            <h2 class="titles titles--weight-normal dashboard__titles">Profil</h2>

            <div class="show dashboard__show">

                <div class="show__main-info">
                    <div class="show__main-info-group show__main-info-group--text-centered">

                        <div class="pictures pictures--centered show__pictures show__pictures">
                            @if ($book->cover)
                                <img class="pictures__img" src="{{ Storage::url($book->cover) }}" alt="Okładka książki.">
                            @else
                                <img class="pictures__img" src="{{ asset('img/book_cover.png') }}"
                                    alt="Okładka książki.">
                            @endif
                        </div>

                        <p class="show__name">
                            {{ $book->title }}
                        </p>

                        <p class="show__info">
                            {{ $book->isbn }}
                        </p>

                        <p class="show__info">
                            {{ $book->publishing_date ?? '(brak)' }}
                        </p>
                    </div>

                    <div class="show__main-info-group">
                        <h5 class="titles titles--transform-none show__titles show__titles--group-titles">
                            Opis
                        </h5>

                        <p class="show__description">
                            {{ $book->description ?? '(brak)' }}
                        </p>
                    </div>
                </div>

                <div class="show__data">
                    <header class="headers show__headers">
                        <h3 class="titles titles--transform-none show__titles show__titles--subtitle">ID Książki:
                            {{ $book->id }}</h3>
                    </header>

                    <div class="show__update">
                        <form class="forms dashboard__forms" action="{{ route('admin.insert.book') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="forms__group">

                                <div class="forms__inline-section">
                                    <div class="forms__group">
                                        <label class="forms__group-title" for="bookCover">
                                            Okładka
                                        </label>
                                        <input id="bookCover" class="forms__file" type="file" name="cover">

                                        @error('cover')
                                            <span class="forms__input-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="forms__group">
                                        <label class="forms__group-title" for="bookPdf">
                                            PDF
                                        </label>
                                        <input id="bookPdf" class="forms__file" type="file" name="pdf">

                                        @error('pdf')
                                            <span class="forms__input-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                 <div class="forms__inline-section">
                                <span class="forms__section-name forms__section-name--all-cols">Reset okładki</span>
                                <div class="forms__check">
                                    <input id="resetCoverBook" class="forms__radio" type="radio" name="reset_cover"
                                        value="true">
                                    <label for="resetAvatarTrue" class="forms__radio-title">Tak</label>
                                </div>

                                <div class="forms__check">
                                    <input id="resetCoverBook" class="forms__radio" type="radio" name="reset_cover"
                                        value="false" checked>
                                    <label for="resetCoverBook" class="forms__radio-title">Nie</label>
                                </div>
                            </div>


                                <label class="forms__group-title" for="title">
                                    Tytuł
                                    <span class="forms__required-info">*</span>
                                </label>
                                <input id="title" class="forms__input" type="text" name="title"
                                    value="{{ old('title') }}">

                                @error('title')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="isbn">
                                    ISBN
                                    <span class="forms__required-info">*</span>
                                </label>
                                <input id="isbn" class="forms__input" type="text" name="isbn" value="{{ old('isbn') }}">

                                @error('isbn')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="authors">
                                    Autor/Autorzy
                                    <span class="forms__required-info">*</span>
                                </label>
                                <input id="authors" class="forms__input" type="text" name="authors"
                                    value="{{ old('authors') }}">

                                @error('authors')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="genres">
                                    Gatunek/Gatunki
                                    <span class="forms__required-info">*</span>
                                </label>
                                <input id="genres" class="forms__input" type="text" name="genres"
                                    value="{{ old('genres') }}">

                                @error('genres')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="forms__inline-section">
                                <div class="forms__group">
                                    <label class="forms__group-title" for="publisher">
                                        Wydawnictwo
                                        <span class="forms__required-info">*</span>
                                    </label>
                                    <select id="publisher" class="forms__input forms__input--bordered" name="publisher">
                                        @foreach ($publishers as $publisher)
                                            <option value="{{ $publisher->id }}"
                                                {{ $publisher->id == old('publisher') ? 'selected' : null }}>
                                                {{ $publisher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="forms__group">
                                    <label class="forms__group-title" for="publishingDate">
                                        Data wydania
                                        <span class="forms__required-info">*</span>
                                    </label>
                                    <input id="publishingDate" class="forms__input" type="date" name="publishing_date"
                                        value="{{ old('publishing_date') }}">

                                    @error('publishing_date')
                                        <span class="forms__input-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="forms__group">
                                <label class="forms__group-title" for="description">
                                    Opis
                                    <span class="forms__required-info">*</span>
                                </label>
                                <textarea id="description" class="forms__input forms__input--textarea" name="description"
                                    rows="10">{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="forms__input-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="forms__buttons-group">
                                <a class="buttons buttons--primary forms__buttons"
                                    href="{{ route('admin.get.books') }}">Anuluj</a>
                                <button class="buttons buttons--primary forms__buttons" type="submit">Edytuj</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
