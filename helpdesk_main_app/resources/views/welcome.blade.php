@php dd("welcome"); @endphp

@extends('layouts/app', ['activePage' => 'welcome'])

@section('content')
    <div class="full-page section-image" data-color="black" data-image="{{asset('light-bootstrap/img/full-screen-image-2.jpg')}}">
        <div class="content">
            <div class="header waves">
                <!--Content before waves-->
                <div class="inner-header flex">
                <!--Just the logo.. Don't mind this-->
                    <h1 class="text-center">{{ __('Welcome to Help Desk System') }}</h1>
                </div>

                {{-- Introducing the system --}}
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- About the system --}}
                            {{-- Check if the id about is set --}}
                            <div
                                id="about"
                                class="card card-plain card-body about_system"
                            >
                                <h2 class="text-center">{{ __('About the System') }}</h2>
                                <p
                                    class="text-center"
                                >
                                    {{ __('Help Desk System is a web-based application that allows users to report issues or request help from the IT department.') }}
                                </p>
                                <ul>
                                    <li>{{ __('Users can report issues or request help from the IT department.') }}</li>
                                    <li>{{ __('IT department can assign the issue to a technician.') }}</li>
                                    <li>{{ __('Technicians can resolve the issue and update the status.') }}</li>
                                    <li>{{ __('Users can view the status of their issue.') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Waves Container-->
                <div>
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
                </svg>
                </div>
                <!--Waves end-->
            </div>

            {{-- Presentation --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div
                            id="presentation"
                            class="card card-plain card-body presentation_system"
                        >
                            <div class="row">
                                <div class="col-md-6 col-parallax">
                                    <div class="col-parallax ratio ratio-16x9">
                                        <img
                                            src="{{ asset('img/helpdesk_solutions.jpg') }}"
                                            alt="helpdesk solutions"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="text-center">{{ __('Presentation') }}</h2>
                                    <p
                                        class="text-center"
                                    >
                                        {{ __('Help Desk System was founded in October 2024 and operates in the IT industry.') }}
                                    </p>
                                    <p>
                                        {{ __('The company is headquartered in Coimbra, Portugal.') }}
                                    </p>
                                    <p>
                                        {{ __('We offer the market a wide variety of solutions for managing IT Help Desks.') }}
                                    </p>

                                    <nav class="nav-pills nav-pills-primary">
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission" type="button" role="tab" aria-controls="nav-mission" aria-selected="true">Mission</button>
                                            <button class="nav-link" id="nav-vision-tab" data-bs-toggle="tab" data-bs-target="#nav-vision" type="button" role="tab" aria-controls="nav-vision" aria-selected="false">Vision</button>
                                            <button class="nav-link" id="nav-values-tab" data-bs-toggle="tab" data-bs-target="#nav-values" type="button" role="tab" aria-controls="nav-values" aria-selected="false">Values</button>
                                            {{-- <button class="nav-link" id="nav-commitment-tab" data-bs-toggle="tab" data-bs-target="#nav-commitment" type="button" role="tab" aria-controls="nav-commitment" aria-selected="false">Commitment</button> --}}
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                            {{-- {{ __('Our mission is to provide the best solution for managing IT Help Desks.') }} --}}
                                            <ul>
                                                <li>{{ __('Provide the best solution for managing IT Help Desks.') }}</li>
                                                <li>{{ __('Connect users with the IT department to report issues or request help.') }}</li>
                                                <li>{{ __('Give the IT department the tools to manage and fix issues.') }}</li>
                                                <li>{{ __('Become the best company in the IT industry.') }}</li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="nav-vision" role="tabpanel" aria-labelledby="nav-vision-tab">
                                            <ul>
                                                <li>{{ __('Integrate all IT Help Desks into a single platform.') }}</li>
                                                <li>{{ __('Provide a user-friendly interface for users to report issues.') }}</li>
                                                <li>{{ __('Adapter the platform to the needs of the IT department.') }}</li>
                                                <li>{{ __('Team up with the best companies in the IT industry.') }}</li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="nav-values" role="tabpanel" aria-labelledby="nav-values-tab">
                                            {{-- {{ __('Our values are innovation, quality, and customer satisfaction.') }} --}}
                                            <ul>
                                                <li><i class="fa-regular fa-circle-check"></i> {{ __('Innovation') }}</li>
                                                <li>{{ __('Quality') }}</li>
                                                <li>{{ __('Customer satisfaction') }}</li>
                                                <li>{{ __('Trust') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        });
    </script>
@endpush
