@extends('layouts.admin')

@section('inner-content')

    <div class="container dashboard__container">
        <header class="header dashboard__header">
            <ol class="breadcrumbs dashboard__breadcrumbs">
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    Dashboard
                </li>
            </ol>
        </header>

        <section class="stats dashboard__stats">
            <div class="cards dashboard__cards">
                <div class="icons icons--xx-large cards__icons fas fa-book">
                </div>

                <div class="cards__body">
                    <p class="cards__text cards__text--muted">

                    </p>
                    <p class="cards__text">

                    </p>
                </div>
            </div>

            <div class="cards dashboard__cards">
                <div class="icons icons--xx-large cards__icons fas fa-users">
                </div>

                <div class="cards__body">
                    <p class="cards__text cards__text--muted">

                    </p>
                    <p class="cards__text">

                    </p>
                </div>
            </div>
        </section>

        <section class="sections dashboard_sections">
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
                    <tr class="tables__row">
                        <th class="tables__header-cell">
                            1
                        </th>

                        <td class="tables__cell">
                            Jakiś tam tytuł
                        </td>
                        <td class="tables__cell">
                            Sowa
                        </td>
                        <td class="tables__cell">
                            6/9
                        </td>
                        <td class="tables__cell">
                            <a href="#" class="links tables__links">Szczegóły</a>
                        </td>
                    </tr>
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
        </section>
    </div>

@endsection
