 <!DOCTYPE html>

 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" href="{{ asset('img/helpdesk.png') }}">

        {{-- <link rel="icon" type="image/png" href="{{ asset('resources/css/img/favicon.ico') }}"> --}}
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        {{-- <title>{{ $title }}</title> --}}
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

        {{-- <title>{{ config('app.name', 'Help Desk System') }}</title> --}}
        <title>{{ config('app.name', isset($title) ? $title : 'Help Desk System') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        {{-- Font Awesome --}}
        <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet" />

        {{-- DataTables --}}
        <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" />

        {{-- <link href="{{ asset('light-bootstrap/css/light-bootstrap-dashboard.css?v=2.0.0') }} " rel="stylesheet" /> --}}
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/assets/sass/app.scss', 'resources/assets/js/app.js'])

    </head>
    {{-- route name --}}
    @php
        // dd(request()->route()->getName());
    @endphp

    <body style="background-color: black !important;">

        <div class="wrapper @if (!auth()->check() || request()->route()->getName() == "") wrapper-full-page @endif">
            {{-- @php
                dd(auth()->check() && request()->route()->getName());
            @endphp --}}
            @if (auth()->check() && request()->route()->getName() != "")
                @include('layouts.navbars.sidebar')
                @include('pages/sidebarstyle')
            @endif

            <div class="@if (auth()->check() && request()->route()->getName() != "") main-panel @endif">
                @include('layouts.navbars.navbar')
                @yield('content')
                @include('layouts.footer.nav')
            </div>

        </div>

        @include('sweetalert::alert')

    </body>
    <!--   Core JS Files   -->
    {{--
        <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    --}}

    <script src="{{ asset('js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>

    {{-- Font Awesome --}}
    <script src="{{ asset('js/core/fontawesome.min.js') }}" type="text/javascript"></script>
    {{-- DataTables --}}
    <script src="{{ asset('js/core/datatables.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/plugins/jquery.sharrre.js') }}"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!--  Chartist Plugin  -->
    <script src="{{ asset('js/plugins/chartist.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
    <script src="{{ asset('js/light-bootstrap-dashboard.js?v=2.0.0') }}" type="text/javascript"></script>
    <!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('js/demo.js') }}"></script>


    <!-- Place for stacked scripts (like DataTable init for specific pages) -->
    @stack('scripts')
    @stack('js')
     <script>

       $(document).ready(function () {

         $('#facebook').sharrre({
           share: {
             facebook: true
           },
           enableHover: false,
           enableTracking: false,
           enableCounter: false,
           click: function(api, options) {
             api.simulateClick();
             api.openPopup('facebook');
           },
           template: '<i class="fab fa-facebook-f"></i> Facebook',
           url: 'https://light-bootstrap-dashboard-laravel.creative-tim.com/login'
         });

         $('#google').sharrre({
           share: {
             googlePlus: true
           },
           enableCounter: false,
           enableHover: false,
           enableTracking: true,
           click: function(api, options) {
             api.simulateClick();
             api.openPopup('googlePlus');
           },
           template: '<i class="fab fa-google-plus"></i> Google',
           url: 'https://light-bootstrap-dashboard-laravel.creative-tim.com/login'
         });

         $('#twitter').sharrre({
           share: {
             twitter: true
           },
           enableHover: false,
           enableTracking: false,
           enableCounter: false,
           buttons: {
             twitter: {
               via: 'CreativeTim'
             }
           },
           click: function(api, options) {
             api.simulateClick();
             api.openPopup('twitter');
           },
           template: '<i class="fab fa-twitter"></i> Twitter',
           url: 'https://light-bootstrap-dashboard-laravel.creative-tim.com/login'
         });
       });

        function togglePassword(element) {

            var htmlFor = element.htmlFor;

            var passwordField = document.getElementById("input-" + htmlFor);
            var eyeIcon = document.getElementById('toggle-' + htmlFor);

            if (passwordField.type === "password") {
                passwordField.type = "text";  // Change to text to show password
                eyeIcon.classList.remove("fa-eye-slash");  // Remove the eye-slash icon
                eyeIcon.classList.add("fa-eye");  // Add the eye icon
            } else {
                passwordField.type = "password";  // Change back to password to hide text
                eyeIcon.classList.remove("fa-eye");  // Remove the eye icon
                eyeIcon.classList.add("fa-eye-slash");  // Add the eye-slash icon
            }
        }

    </script>
 </html>
