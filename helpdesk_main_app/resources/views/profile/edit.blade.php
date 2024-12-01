@extends('layouts.app', ['activePage' => 'user', 'title' => 'Help Desk System - User Profile', 'navName' => 'User Profile', 'activeButton' => 'user'])

@php
    // dd(session()->all());
@endphp

@section('content')
    <div class="content">
        <div class="container-fluid container_user_auth">
            <div class="section-card">
                <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                <div class="row">

                    <div class="card col-md-12">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h3 class="mb-0">{{ __('Edit Profile') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update', auth()->user()->id) }}" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

                                <div class="pl-lg-4">
                                    {{-- First Name --}}
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="first_name">
                                            <i class="w3-xxlarge fa fa-user"></i>{{ __('First Name') }}
                                        </label>
                                        <input type="text" name="first_name" id="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}" value="{{ old('first_name', auth()->user()->first_name) }}" autofocus>
                                    </div>
                                    {{-- Last Name --}}
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="last_name">
                                            <i class="w3-xxlarge fa fa-user"></i>{{ __('Last Name') }}
                                        </label>
                                        <input type="text" name="last_name" id="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}" value="{{ old('last_name', auth()->user()->last_name) }}" autofocus>
                                    </div>

                                    {{-- Profile picture --}}

                                    {{-- Email --}}
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="email"><i class="w3-xxlarge fa fa-envelope-o"></i>{{ __('Email') }}</label>
                                        <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}">
                                    </div>
                                    {{-- Save button --}}
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-default mt-4">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </form>
                            <hr class="my-4" />
                            <form method="POST" action="{{ route('profile.password', auth()->user()) }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @method('PATCH')

                                <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                                <div class="pl-lg-4">
                                    {{-- New password --}}
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="password" onclick="togglePassword(this)">
                                            <i class="w3-xxlarge fa fa-eye-slash" id="toggle-password"></i>{{ __('New Password') }}
                                        </label>
                                        <input type="password" name="password" id="input-password" class="toggle-password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="{{ old('password') }}">
                                    </div>
                                    {{-- Confirm new password --}}
                                    <div class="form-group">
                                        <label class="form-control-label" for="password_confirmation" onclick="togglePassword(this)">
                                            <i class="w3-xxlarge fa fa-eye-slash" id="toggle-password_confirmation"></i>{{ __('Confirm New Password') }}
                                        </label>
                                        <input type="password" name="password_confirmation" id="input-password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="">
                                    </div>
                                    {{-- Change password button --}}
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-default mt-4">{{ __('Change password') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{--<div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="{{ asset('light-bootstrap/img/faces/face-3.jpg') }}" alt="...">
                                        <h5 class="title">{{ __('Mike Andrew') }}</h5>
                                    </a>
                                    <p class="description">
                                        {{ __('michael24') }}
                                    </p>
                                </div>
                                <p class="description text-center">
                                {{ __(' "Lamborghini Mercy') }}
                                    <br> {{ __('Your chick she so thirsty') }}
                                    <br> {{ __('I am in that two seat Lambo') }}
                                </p>
                            </div>
                            <hr>
                            <div class="button-container mr-auto ml-auto">
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-facebook-square"></i>
                                </button>
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-twitter"></i>
                                </button>
                                <button href="#" class="btn btn-simple btn-link btn-icon">
                                    <i class="fa fa-google-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>

    <script>

        /*var togglePassword = document.getElementsByClassName('toggle-password');

        for (var i = 0; i < togglePassword.length; i++) {
            togglePassword[i].addEventListener('click', function () {
                // var input = document.querySelector(this.getAttribute('toggle'));
                var input = this.htmlFor;

                if (input.getAttribute('type') === 'password') {
                    input.setAttribute('type', 'text');
                } else {
                    input.setAttribute('type', 'password');
                }
            });
        }*/

        /**
         * Toggle eye-icon for password field
         */
        /*$(".toggle-password").click(function () {
            alert('clicked');
            // $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });*/
    </script>

@endsection
