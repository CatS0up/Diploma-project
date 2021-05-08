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

            <form class="forms dashboard__forms" action="#" method="post">
                <div class="forms__group">
                    <label class="forms__group-title" for="title">
                        Tytuł
                        <span class="forms__required-info">*</span>
                    </label>
                    <input id="title" class="forms__input" type="text" name="title">
                </div>

                <div class="forms__group">
                    <label class="forms__group-title" for="title">
                        ISBN
                        <span class="forms__required-info">*</span>
                    </label>
                    <input id="title" class="forms__input" type="text" name="title">
                </div>

                <div class="forms__group">
                    <label class="forms__group-title" for="title">
                        Wydawnictwo
                        <span class="forms__required-info">*</span>
                    </label>
                    <input id="title" class="forms__input" type="text" name="title">
                    <span class="forms__input-feedback">
                        Fraza zawiera niedozwolone znaki
                    </span>
                </div>

                <div class="forms__group">
                    <label class="forms__group-title" for="title">
                        Autor/Autorzy
                        <span class="forms__required-info">*</span>
                    </label>
                    <input id="title" class="forms__input" type="text" name="title">
                </div>

                <div class="forms__group">
                    <label class="forms__group-title" for="title">
                        Data wydania
                        <span class="forms__required-info">*</span>
                    </label>
                    <input id="title" class="forms__input" type="date" name="title">
                </div>

                <div class="forms__buttons-group">
                    <button class="buttons buttons--primary forms__buttons">Anuluj</button>
                    <button class="buttons buttons--primary forms__buttons">Dodaj</button>
                </div>
            </form>

            <div class="pictures dashboard__pictures">
                <img class="pictures__img" src="{{ asset('img/book_stack.jpg') }}" alt="Stos książek.">
            </div>

        </section>
    </div>

@endsection
