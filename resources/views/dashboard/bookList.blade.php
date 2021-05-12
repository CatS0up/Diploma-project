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
                    Książki
                </li>
            </ol>
        </header>

        <section class="stats dashboard__stats">
            <div class="cards dashboard__cards">
                <span class="icons icons--xx-large cards__icons cards__icons--orange fas fa-book" aria-hidden="true">
                </span>

                <div class="cards__body">
                    <h2 class="titles titles--weight-normal cards__titles">
                        Książki:
                    </h2>
                    <p class="cards__text">
                        976
                    </p>
                </div>
            </div>

            <div class="cards dashboard__cards">
                <span class="icons icons--xx-large cards__icons cards__icons--purple fas fa-star-half-alt"
                    aria-hidden="true">
                </span>

                <div class="cards__body">
                    <h2 class="titles titles--weight-normal cards__titles">
                        Książki 7+:
                    </h2>
                    <p class="cards__text">
                        65
                    </p>
                </div>
            </div>
        </section>

        <section class="dashboard__sections">
            <h2 class="titles titles--weight-normal dashboard__titles">Książki</h2>

            <div class="dashboard__actions">
                <form class="forms forms--inline dashboard__forms" action="{{ route('admin.insert.genre') }}"
                    method="post">
                    @csrf
                    <div class="forms__group">
                        <input id="bookGenre" class="forms__input forms__input--bordered" type="search" name="genre"
                            value="{{ old('genres') }}" placeholder="Wyszukaj">

                        @error('genre')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__group">
                        <select class="forms__input forms__input--bordered" name="genre">
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>

                        @error('genre')
                            <span class="forms__input-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="forms__buttons-group">
                        <button class="buttons buttons--primary forms__buttons" type="submit">Filtruj</button>
                        <a class="buttons buttons--success forms__buttons" href="{{ route('admin.add.book') }}">Dodaj</a>
                    </div>
                </form>
            </div>

            <section class="dashboard__sections">
                <h2 class="titles titles--weight-normal dashboard__titles">Książki</h2>

                <table class="tables dashboard__tables">
                    <thead class="tables__header">
                        <tr class="tables__row">
                            <th class="tables__header-cell">
                                ID
                            </th>
                            <th class="tables__header-cell">
                                Użytkownik
                            </th>
                            <th class="tables__header-cell">
                                Rola
                            </th>
                            <th class="tables__header-cell">
                                Opcje
                            </th>
                        </tr>
                    </thead>

                    <tbody class="tables__body">
                        {{-- @foreach ($users as $user) --}}
                        <tr class="tables__row">
                            <th class="tables__header-cell" data-label="ID">
                                ID
                            </th>

                            <td class="tables__cell" data-label="Użytkownik">
                                Tytuł
                            </td>
                            <td class="tables__cell" data-label="Rola">
                                Ocena
                            </td>
                            <td class="tables__cell" data-label="Opcje">
                                <div class="tables__group">
                                    <form class="forms tables__forms" action="#" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="buttons buttons--danger forms__buttons">Usuń</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>

                    <tfoot class="tables__footer">
                        <tr class="tables__row">
                            <th class="tables__header-cell">
                                ID
                            </th>
                            <th class="tables__header-cell">
                                Użytkownik
                            </th>
                            <th class="tables__header-cell">
                                Rola
                            </th>
                            <th class="tables__header-cell">
                                Opcje
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </section>

    </div>

@endsection
