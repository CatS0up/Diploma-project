@extends('layouts.main')

@section('content')

    <main class="dashboard site__dashboard">
        @include('shared.sidebar')

        <section class="dashboard__content">
            @include('shared.navbar-dashboard')

            @yield('inner-content')
        </section>
    </main>

@endsection
