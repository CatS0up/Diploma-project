@extends('layouts.main')

@section('content')

    <main class="app site__app">

        <section class="app__content">
            <div class="container app__container">
                @yield('inner-content')
            </div>
        </section>
    </main>

@endsection
