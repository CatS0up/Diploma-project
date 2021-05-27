@extends('layouts.main')

@section('content')

    <main class="main site__main">
        <section class="app__content">
            @include('shared.messages')

            <div class="container app__container">
                @yield('inner-content')
            </div>
        </section>
    </main>

@endsection
