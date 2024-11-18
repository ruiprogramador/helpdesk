@extends('layouts/app', ['activePage' => 'login', 'title' => 'Help Desk System'])

@section('content')
    <div class="full-page section-image container-fluid" data-color="black">
        <div class="row row_user_form">
            {{-- Right side --}}
            <div class="col-md-3 col-sm-3 user_form_right_side side_background_form" style="background-image: url('{{ asset('img/helpdesk_night.gif') }}');"></div>
            {{-- Form --}}
            <div class="col-md-6 col-sm-6 login-image" style="background-image: url('{{ asset('img/helpdesk_trip.jpg') }}');">
                <form class="form user_form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card card-login card-hidden">
                        <div class="card-header ">
                            <h3 class="header text-center title_user_form">{{ __('Login') }}</h3>
                        </div>
                        <div class="card-body ">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="email_label" for="email" class="col-md-6 col-form-label">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-14">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="password_label" for="password" class="col-md-6 col-form-label">{{ __('Password') }}</label>

                                    <div class="col-md-14">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="current-password" placeholder="Enter password"

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="remember"  id="remember">
                                            <span class="form-check-sign"></span>
                                            {{ __('Remember me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <div class="container text-center" >
                                    <button type="submit" class="btn btn-outline-dark btn-wd btn-user-form">{{ __('Login') }}</button>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-link"  style="color:#23CCEF" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                    </a>
                                    <a class="btn btn-link" style="color:#23CCEF" href="{{ route('register') }}">
                                        {{ __('Create account') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Left side --}}
            <div class="col-md-3 col-sm-3 user_form_right_side side_background_form" style="background-image: url('{{ asset('img/helpdesk_graphs.gif') }}');"></div>
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
        });
    </script>
@endpush
