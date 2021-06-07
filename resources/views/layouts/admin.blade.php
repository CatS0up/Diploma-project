@extends('layouts.main')

@section('page-bg', 'bg-dashboard')

@section('content')

    <main class="dashboard site__dashboard">
        @include('shared.sidebar')

        <section class="dashboard__content">
            @include('shared.messages')

            <div class="container dashboard__container">
                @yield('inner-content')
            </div>
        </section>
    </main>

@endsection
