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
                    Książki
                </li>
            </ol>
        </header>

        <section class="stats dashboard__stats">
            <div class="cards dashboard__cards">
                <div class="icons icons--xx-large cards__icons cards__icons--orange fas fa-book">
                </div>

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
                <div class="icons icons--xx-large cards__icons cards__icons--purple fas fa-star-half-alt">
                </div>

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
            <h2 class="titles titles--weight-normal dashboard__titles">Informacje</h2>

            <table class="tables dashboard__tables">
                <thead class="tables__header">
                    <tr class="tables__row">
                        <th class="tables__header-cell">
                            Ocena
                        </th>
                        <th class="tables__header-cell">
                            Ilość
                        </th>
                    </tr>
                </thead>

                <tbody class="tables__body">
                    @for ($i = 1; $i <= 10; $i++)
                        <tr class="tables__row">
                            <th class="tables__header-cell">
                                {{ $i }}
                            </th>

                            <td class="tables__cell" data-label="Ilość">
                                Miliun
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </section>

        <section class="dashboard__sections">
            <h2 class="titles titles--weight-normal dashboard__titles">Książki</h2>


        </section>

    </div>

@endsection
