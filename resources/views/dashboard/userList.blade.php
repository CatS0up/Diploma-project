@extends('layouts.admin')

@section('inner-content')

    <div class="container dashboard__container">
        <header class="headers dashboard__headers">
            <ol class="breadcrumbs dashboard__breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="#" class="links links--light breadcrumbs__links">
                        Dashboard
                    </a>
                </li>
                <li class="breadcrumbs__item breadcrumbs__item--active">
                    Użytkownicy
                </li>
            </ol>
        </header>

        <section class="stats dashboard__stats">
            <div class="cards dashboard__cards">
                <div class="icons icons--xx-large cards__icons cards__icons--orange fas fa-users">
                </div>

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
                <div class="icons icons--xx-large cards__icons cards__icons--red fas fa-user-lock">
                </div>

                <div class="cards__body">
                    <h2 class="titles titles--weight-normal cards__titles">
                        Zablokowani:
                    </h2>
                    <p class="cards__text">
                        666
                    </p>
                </div>
            </div>

            <div class="cards dashboard__cards">
                <div class="icons icons--xx-large cards__icons cards__icons--red fab fa-teamspeak">
                </div>

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

        <section class="dashboard__section">
            <h2 class="titles titles--weight-normal dashboard__titles">Zespół</h2>

            <table class="tables dashboard__tables">
                <thead class="tables__header">
                    <tr class="tables__row">
                        <th class="tables__header-cell">
                            #
                        </th>
                        <th class="tables__header-cell">
                            Użytkownik
                        </th>
                        <th class="tables__header-cell">
                            Rola
                        </th>
                        <th class="tables__header-cell">
                            Ostatnia aktywność
                        </th>
                        <th class="tables__header-cell">
                            Status
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

                            <td class="tables__cell" data-label="Użytkownik">
                                Typ jakiś
                            </td>
                            <td class="tables__cell" data-label="Rola">
                                Admin
                            </td>
                            <td class="tables__cell" data-label="Ostatnia aktywność">
                                2005-05-06 21:37:11
                            </td>
                            <td class="tables__cell" data-label="Aktywny">
                                Aktywny
                            </td>
                            <td class="tables__cell" data-label="Opcje">
                                <div class="tables__group">
                                    <a class="buttons buttons--primary tables__buttons">Profil</a>
                                </div>
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
                            Użytkownik
                        </th>
                        <th class="tables__header-cell">
                            Rola
                        </th>
                        <th class="tables__header-cell">
                            Ostatnia aktywność
                        </th>
                        <th class="tables__header-cell">
                            Status
                        </th>
                        <th class="tables__header-cell">
                            Opcje
                        </th>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="dashboard__section">
            <h2 class="titles titles--weight-normal dashboard__titles">Użytkownicy</h2>

            <table class="tables dashboard__tables">
                <thead class="tables__header">
                    <tr class="tables__row">
                        <th class="tables__header-cell">
                            #
                        </th>
                        <th class="tables__header-cell">
                            Użytkownik
                        </th>
                        <th class="tables__header-cell">
                            Rola
                        </th>
                        <th class="tables__header-cell">
                            Ostatnia aktywność
                        </th>
                        <th class="tables__header-cell">
                            Status
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

                            <td class="tables__cell" data-label="Użytkownik">
                                Typ jakiś
                            </td>
                            <td class="tables__cell" data-label="Rola">
                                Admin
                            </td>
                            <td class="tables__cell" data-label="Ostatnia aktywność">
                                2005-05-06 21:37:11
                            </td>
                            <td class="tables__cell" data-label="Aktywny">
                                Aktywny
                            </td>
                            <td class="tables__cell" data-label="Opcje">
                                <div class="tables__group">
                                    <a class="buttons buttons--primary tables__buttons">Profil</a>
                                    <a class="buttons buttons--success tables__buttons">Edycja</a>
                                    <a class="buttons buttons--danger tables__buttons">Usuń</a>
                                </div>
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
                            Użytkownik
                        </th>
                        <th class="tables__header-cell">
                            Rola
                        </th>
                        <th class="tables__header-cell">
                            Ostatnia aktywność
                        </th>
                        <th class="tables__header-cell">
                            Status
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
