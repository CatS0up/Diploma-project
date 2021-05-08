@extends('layouts.main')

@section('page-bg', 'bg-dashboard')

@section('content')

    <main class="dashboard site__dashboard">
        @include('shared.sidebar')

        <section class="dashboard__content">

            @yield('inner-content')
        </section>
    </main>

@endsection
