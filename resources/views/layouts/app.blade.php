@extends('layouts.main')

@section('content')

    <main class="app site__app">

        <section class="app__content">
            @yield('inner-content')
        </section>
    </main>

@endsection
