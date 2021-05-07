@extends('layouts.admin')

@section('inner-content')

    <div class="container dashboard__container">
        <header class="headers dashboard__headers">
            <ol class="breadcrumbs dashboard__breadcrumbs">
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    Dashboard
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
                        666
                    </p>
                </div>
            </div>

            <div class="cards dashboard__cards">
                <span class="icons icons--xx-large cards__icons cards__icons--orange fas fa-users" aria-hidden="true">
                </span>

                <div class="cards__body">
                    <h2 class="titles titles--weight-normal cards__titles">
                        Użytkownicy:
                    </h2>
                    <p class="cards__text">
                        69
                    </p>
                </div>
            </div>

            <div class="cards dashboard__cards">
                <span class="icons icons--xx-large cards__icons cards__icons--red fab fa-teamspeak" aria-hidden="true">
                </span>

                <div class="cards__body">
                    <h2 class="titles titles--weight-normal cards__titles">
                        Członkowie zespołu:
                    </h2>
                    <p class="cards__text">
                        5
                    </p>
                </div>
            </div>
        </section>

        <table class="tables dashboard__tables">
            <thead class="tables__header">
                <tr class="tables__row">
                    <th class="tables__header-cell">
                        #
                    </th>
                    <th class="tables__header-cell">
                        Tytuł
                    </th>
                    <th class="tables__header-cell">
                        Wydawnictwo
                    </th>
                    <th class="tables__header-cell">
                        Ocena
                    </th>
                    <th class="tables__header-cell">
                        Opcje
                    </th>
                </tr>
            </thead>

            <tbody class="tables__body">
                @for ($i = 1; $i <= 10; $i++)
                    <tr class="tables__row">
                        <th class="tables__header-cell" data-label="Lp.">
                            {{ $i }}
                        </th>

                        <td class="tables__cell" data-label="Książka">
                            Jakiś tam tytuł
                        </td>
                        <td class="tables__cell" data-label="Wydawnictwo">
                            Sowa
                        </td>
                        <td class="tables__cell" data-label="Ocena">
                            6/9
                        </td>
                        <td class="tables__cell" data-label="Opcje">
                            <a href="#" class="links links--light tables__links">Szczegóły</a>
                        </td>
                    </tr>
                @endfor
            </tbody>

            <tfoot class="tables__footer">
                <tr class="tables__row">
                    <th class="tables__header-cell">
                        #
                    </th>
                    <th class="tables__header-cell">
                        Książka
                    </th>
                    <th class="tables__header-cell">
                        Wydawnictwo
                    </th>
                    <th class="tables__header-cell">
                        Ocena
                    </th>
                    <th class="tables__header-cell">
                        Opcje
                    </th>
                </tr>
            </tfoot>
        </table>

    </div>

@endsection
