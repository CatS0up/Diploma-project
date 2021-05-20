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
                    Nowa książka
                </li>
            </ol>
        </header>

        <section class="dashboard__add-form">

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
                                <span class="forms__required-info">*</span>
                            </label>
                            <input id="bookPdf" class="forms__file" type="file" name="pdf">

                            @error('pdf')
                                <span class="forms__input-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <label class="forms__group-title" for="title">
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
                    <label class="forms__group-title" for="author">
                        Autor
                        <span class="forms__required-info">*</span>
                    </label>
                    <input id="author" class="forms__input" type="text" name="author" value="{{ old('author') }}">

                    @error('author')
                        <span class="forms__input-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="forms__group">
                    <label class="forms__group-title" for="genre">
                        Gatunek
                        <span class="forms__required-info">*</span>
                    </label>
                    <input id="genre" class="forms__input" type="text" name="genre" value="{{ old('genre') }}">

                    @error('genre')
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
                    <a class="buttons buttons--primary forms__buttons" href="{{ route('admin.get.books') }}">Anuluj</a>
                    <button class="buttons buttons--primary forms__buttons" type="submit">Dodaj</button>
                </div>
            </form>

            <div class="pictures dashboard__pictures">
                <img class="pictures__img" src="{{ asset('img/book_stack.jpg') }}" alt="Stos książek.">
            </div>

        </section>
    </div>

@endsection
