@extends('layouts.app', ['activePage' => 'register', 'title' => 'Help Desk System'])

@section('content')
    <div class="container">
        <div class="row">
            {{-- <div class="error404" style="background-image: url('{{ asset('img/erro404.png') }}')"></div> --}}
            <div class="col-md-12 error404">
                <h1 class="title">404</h1>
                <h2 class="sub-title">Page not found</h2>
                <p class="main_text">The page you are looking for might have been removed, had its name changed or is temporarily unavailable.</p>
                <small class="advice">Please try the following:</small>
                <ul class="advice_list">
                    <li class="advice_point">Make sure that the Web site address displayed in the address bar of your browser is spelled and formatted correctly.</li>
                    <li class="advice_point">Return to the <a href="{{ route('home') }}">home page</a></li>
                    <li class="advice_point">Click the <a href="{{ url()->previous() }}">Back</a> button</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
