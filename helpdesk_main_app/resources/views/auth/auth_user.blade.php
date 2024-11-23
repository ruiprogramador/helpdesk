@extends('layouts/app', ['activePage' => 'login', 'title' => 'Help Desk System'])


@section('content')
    <div class="full-page section-image container-fluid" data-color="black">
        <div class="row row_user_form">
            {{-- Right side --}}
            <div class="col-md-3 col-sm-3 user_form_right_side side_background_form" style="background-image: url('{{ asset('img/helpdesk_night.gif') }}');"></div>
            {{-- Form --}}
            <div class="col-md-6 col-sm-6 login-image" style="background-image: url('{{ asset('img/helpdesk_trip.jpg') }}');">
                <form
                    class="form user_form"
                    method="POST"
                    action="{{ route(data_get($params, 'action') ) }}"
                >
                    @csrf
                    <div class="card card-login card-hidden">
                        <div class="card-header ">
                            <h3 class="header text-center title_user_form">
                                {{ ucfirst(data_get($params, 'action')) }}
                            </h3>
                        </div>
                        <div class="card-body ">
                            <div class="card-body">

                                @isset($params['action'])
                                    @if ($params['action'] == 'register')
                                        {{-- First name --}}
                                        <div class="form-group">
                                            <label class="label_stylish" for="first_name" class="col-md-6 col-form-label">{{ __('First Name') }}</label>

                                            <div class="col-md-14">
                                                <input name="first_name" id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="Enter first name">

                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Last name --}}
                                        <div class="form-group">
                                            <label class="label_stylish" for="last_name" class="col-md-6 col-form-label">{{ __('Last Name') }}</label>

                                            <div class="col-md-14">
                                                <input name="last_name" id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Enter first name">

                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                @endisset

                                {{-- Email --}}
                                <div class="form-group">
                                    <label class="label_stylish" for="email" class="col-md-6 col-form-label">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-14">
                                        <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="form-group">
                                    <label class="label_stylish" for="password" class="col-md-6 col-form-label">{{ __('Password') }}</label>

                                    <div class="col-md-14">
                                        <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required autocomplete="current-password" placeholder="Enter password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                @isset($params['action'])
                                    @if ($params['action'] == 'register')
                                        {{-- Confirm password --}}
                                        <div class="form-group">
                                            <label class="label_stylish" for="password_confirmation" class="col-md-6 col-form-label">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-14">
                                                <input name="password_confirmation" id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required autocomplete="current-password" placeholder="Confirm password">

                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Agree with terms and conditions --}}
                                        <div class="form-group d-flex justify-content-center">
                                            <div class="form-check rounded col-md-12 text-left">
                                                <label class="form-check-label text-white">
                                                    <input class="form-check-input" name="agree" type="checkbox" required >
                                                    <span class="form-check-sign"></span>
                                                    <b>
                                                        {{-- {{ __('Agree with terms and conditions') }} --}}
                                                        <a data-bs-toggle="modal" data-bs-target="#terms_conditions" style="color:#23CCEF">Agree with terms and conditions</a>
                                                    </b>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endisset

                                {{-- Remember me --}}
                                {{-- <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="remember"  id="remember">
                                            <span class="form-check-sign"></span>
                                            {{ __('Remember me') }}
                                        </label>
                                    </div>
                                </div> --}}
                            </div>

                            {{-- Submit button --}}
                            <div class="card-footer ml-auto mr-auto">
                                <div class="container text-center" >
                                    <button type="submit" class="btn btn-outline-dark btn-wd btn-user-form">
                                        {{ ucfirst(data_get($params, 'action')) }}
                                    </button>
                                </div>
                            </div>

                            @isset($params['action'])
                                @if ($params['action'] == 'login')
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-link"  style="color:#23CCEF" href="{{ route('password.request') }}">
                                        {{ __('Forgot password?') }}
                                        </a>
                                        <a class="btn btn-link" style="color:#23CCEF" href="{{ route('register') }}">
                                            {{ __('Create account') }}
                                        </a>
                                    </div>
                                @endif

                                @if ($params['action'] == 'register')
                                    <div class="d-flex justify-content-between">
                                        <a class="btn btn-link" style="color:#23CCEF" href="{{ route('login') }}">
                                            {{ __('Already have an account?') }}
                                        </a>
                                    </div>
                                @endif
                            @endisset
                        </div>
                    </div>
                </form>
            </div>
            {{-- Left side --}}
            <div class="col-md-3 col-sm-3 user_form_right_side side_background_form" style="background-image: url('{{ asset('img/helpdesk_graphs.gif') }}');"></div>

            <!-- Terms And Conditions Modal -->
            <div class="modal fade modal-mini modal-primary" id="terms_conditions" tabindex="-1" role="dialog" aria-labelledby="termsConditionsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Terms and Conditions</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-justify">
                            <p><strong>Welcome to Help Desk System!</strong></p>

                            <p>Before you proceed with your registration, we kindly ask you to read and understand our <strong>Terms and Conditions</strong>. By signing up and using our services, you agree to the following terms, which are designed to ensure a safe and fair experience for all users.</p>

                            <p>Our <strong>Terms and Conditions</strong> outline your rights and responsibilities when using our Help Desk System, including but not limited to:</p>
                            <ul>
                            <li><strong>User Account:</strong> The information you provide must be accurate and kept up-to-date.</li>
                            <li><strong>Privacy and Security:</strong> We respect your privacy and are committed to protecting your personal information. Please review our <strong><a data-bs-toggle="modal" data-bs-target="#privacy_policy" style="color:#23CCEF; cursor: pointer;">Privacy Policy</a></strong> for details.</li>
                            <li><strong>Acceptable Use:</strong> You agree not to misuse our services, engage in harmful activity, or violate any applicable laws.</li>
                            <li><strong>Support and Service Levels:</strong> The scope of our support, response times, and service limitations are detailed in our agreement.</li>
                            <li><strong>Liability:</strong> Our liability is limited to the extent permitted by law. We do not take responsibility for indirect or unforeseen issues.</li>
                            </ul>

                            <p>By registering, you confirm that you have read, understood, and agreed to these <strong>Terms and Conditions</strong>.</p>

                            <p>If you have any questions or need further clarification, please don’t hesitate to reach out to our support team!</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link btn-simple" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--  End Terms And Conditions Modal -->

            <!-- Privacy Policy Modal -->
            <div class="modal fade modal-mini modal-primary" id="privacy_policy" tabindex="-1" role="dialog" aria-labelledby="privacyPolicyModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Privacy Policy</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-justify">
                            <p>At our Help Desk System, we take your privacy seriously. We collect <strong>personal information</strong> such as your name, email address, and phone number to provide better service and <strong>respond to your surveys</strong>. We also gather <strong>usage data</strong> to improve our platform's performance and user experience. Your data is securely stored using <strong>industry-standard encryption</strong> protocols to ensure your information is protected. Rest assured, we will never <strong>sell or share</strong> your personal data without your consent, except when required by law. For any questions or concerns about how we handle your data, feel free to contact us.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link btn-simple" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--  End Privacy Policy Modal -->
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
