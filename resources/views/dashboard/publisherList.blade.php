@extends('layouts.admin')

@section('inner-content')

    <header class="headers dashboard__headers">
        <ol class="breadcrumbs dashboard__breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('admin.index') }}" class="links links--light breadcrumbs__links">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item--active">
                Wydawcy
            </li>
        </ol>
    </header>

    <section class="stats dashboard__stats">
        <div class="cards cards--single dashboard__cards">
            <span class="icons icons--xx-large cards__icons cards__icons--orange-two fas fa-book-open" aria-hidden="true">
            </span>

            <div class="cards__body">
                <h2 class="titles titles--weight-normal cards__titles">
                    Wydawcy:
                </h2>
                <p class="cards__text">
                    {{ $stats['all_amount'] }}
                </p>
            </div>
        </div>
    </section>

    <section class="dashboard__sections">
        <h2 class="titles titles--weight-normal dashboard__titles">Wydawcy</h2>

        <div class="dashboard__actions">
            <form class="forms forms--inline dashboard__forms" action="{{ route('admin.insert.publisher') }}"
                method="post">
                @csrf
                <div class="forms__group">
                    <input id="bookGenre" class="forms__input forms__input--bordered" type="text" name="name"
                        value="{{ old('name') }}" placeholder="Nowy wydawca">

                    @error('name')
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

        @if ($publishers->isNotEmpty())
            <table class="tables dashboard__tables">
                <thead class="tables__header">
                    <tr class="tables__row">
                        <th class="tables__header-cell">
                            #
                        </th>
                        <th class="tables__header-cell">
                            Wydawca
                        </th>
                        <th class="tables__header-cell">
                            Opcje
                        </th>
                    </tr>
                </thead>

                <tbody class="tables__body">
                    @foreach ($publishers as $publisher)
                        <tr class="tables__row">
                            <th class="tables__header-cell">
                                {{ $loop->iteration }}
                            </th>

                            <td class="tables__cell" data-label="Wydawca">
                                {{ $publisher->name }}
                            </td>
                            <td class="tables__cell" data-label="Opcje">
                                <div class="tables__group">
                                    <form class="forms tables__forms"
                                        action="{{ route('admin.delete.publisher', ['id' => $publisher->id]) }}"
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
                            #
                        </th>
                        <th class="tables__header-cell">
                            Wydawca
                        </th>
                        <th class="tables__header-cell">
                            Opcje
                        </th>
                    </tr>
                </tfoot>
            </table>

            {{ $publishers->links() }}
        @else
            <div class="notifications dashboard__notifications">
                <span class="icons icons--x-large notifications__icons far fa-folder-open" aria-hidden="true"></span>
                Brak wydawców
            </div>
        @endif

    @endsection
