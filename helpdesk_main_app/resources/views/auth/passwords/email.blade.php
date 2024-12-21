@extends('layouts.app', ['activePage' => 'login', 'title' => 'Help Desk System'])

@section('content')
    <div
        class="full-page section-image reset_password"
        data-image="{{asset('img/full-screen-image-2.jpg')}}"
        style="width: 100%; height: calc(100vh - 50px); background-position: center; background-repeat: no-repeat; background-size: cover; position: relative; display: block;"
    >
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="card card-reset-password card-hidden">
                                <div class="card-header" data-text-color="white" align="center">
                                    <h1>
                                        {{ __('Reset Password') }}
                                    </h1>
                                </div>

                                <div class="card-body" data-text-color="white">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                        </div>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mt-2">
                                        <div>
                                            <button type="submit" class="btn btn-outline-dark">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)

            window.onload = function() {
                var div = document.querySelector('.full-page.section-image');

                var imageUrl = div.getAttribute('data-image');

                div.style.backgroundImage = 'url(' + imageUrl + ')';
                div.style.color = textColor;

                var divCardHeader = document.querySelector('.card-header');
                var textColor = divCardHeader.getAttribute('data-text-color');

                if (textColor === 'white') {
                    divCardHeader.style.color = 'white';
                } else {
                    divCardHeader.style.color = 'black';
                }

                var divCardBody = document.querySelector('.card-body');
                var textColor = divCardBody.getAttribute('data-text-color');
                if (textColor === 'white') {
                    divCardBody.style.color = 'white';
                } else {
                    divCardBody.style.color = 'black';
                }
            }
        });
    </script>
@endpush
