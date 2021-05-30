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
                    Autorzy
                </li>
            </ol>
        </header>

        <section class="stats dashboard__stats">
            <div class="cards cards--single dashboard__cards">
                <span class="icons icons--xx-large cards__icons cards__icons--red fas fa-at" aria-hidden="true">
                </span>

                <div class="cards__body">
                    <h2 class="titles titles--weight-normal cards__titles">
                        Autorzy:
                    </h2>
                    <p class="cards__text">
                        {{ $stats['all_amount'] }}
                    </p>
                </div>
            </div>
        </section>

        <section class="dashboard__sections">
            <h2 class="titles titles--weight-normal dashboard__titles">Autorzy</h2>

            <div class="dashboard__actions">
                <form class="forms forms--inline dashboard__forms" action="{{ route('admin.insert.author') }}"
                    method="post">
                    @csrf
                    <div class="forms__group">
                        <input id="authorFirstname" class="forms__input forms__input--bordered" type="text" name="firstname"
                            value="{{ old('firstname') }}" placeholder="Imię">

                        @error('firstname')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__group">
                        <input id="authorLastname" class="forms__input forms__input--bordered" type="text" name="lastname"
                            value="{{ old('lastname') }}" placeholder="Nazwisko">

                        @error('lastname')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__buttons-group">
                        <button class="buttons buttons--primary forms__buttons" type="submit">Dodaj</button>
                    </div>
                </form>
            </div>

            @if ($authors->isNotEmpty())
                <table class="tables dashboard__tables">
                    <thead class="tables__header">
                        <tr class="tables__row">
                            <th class="tables__header-cell">
                                ID
                            </th>
                            <th class="tables__header-cell">
                                Imię
                            </th>
                            <th class="tables__header-cell">
                                Nazwisko
                            </th>
                            <th class="tables__header-cell">
                                Opcje
                            </th>
                        </tr>
                    </thead>

                    <tbody class="tables__body">
                        @foreach ($authors as $author)
                            <tr class="tables__row">
                                <th class="tables__header-cell">
                                    {{ $author->id }}
                                </th>

                                <td class="tables__cell" data-label="Imię">
                                    {{ $author->firstname }}
                                </td>

                                <td class="tables__cell" data-label="Nazwisko">
                                    {{ $author->lastname }}
                                </td>

                                <td class="tables__cell" data-label="Opcje">
                                    <div class="tables__group">
                                        <form class="forms tables__forms"
                                            action="{{ route('admin.delete.author', ['id' => $author->id]) }}"
                                            method="post">
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
                                ID
                            </th>
                            <th class="tables__header-cell">
                                Imię
                            </th>
                            <th class="tables__header-cell">
                                Nazwisko
                            </th>
                            <th class="tables__header-cell">
                                Opcje
                            </th>
                        </tr>
                    </tfoot>
                </table>

                {{ $authors->links() }}
            @else
                <div class="notifications dashboard__notifications">
                    <span class="icons icons--x-large notifications__icons far fa-folder-open" aria-hidden="true"></span>
                    Brak autorów
                </div>
            @endif
    </div>

@endsection
