<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ __('Help Desk System') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdownHelpDeskSystem" aria-controls="navbarNavDropdownHelpDeskSystem" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdownHelpDeskSystem">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">
                        <i class="fa-solid fa-home"></i> {{-- {{ __('Home') }} --}}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-user"></i> {{-- {{ __('User') }} --}}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a
                                class="dropdown-item @if($activePage == 'register') active @endif"
                                href="{{ route('register') }}"
                            >
                                <i class="fa-regular fa-address-book"></i> {{ __('Register') }}
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item @if($activePage == 'login') active @endif"
                                href="{{ route('login') }}"
                            >
                                <i class="fa-solid fa-user-shield"></i> {{ __('Login') }}
                            </a>
                        </li>
                        {{--
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="#"
                                >
                                    Something else here
                                </a>
                            </li>
                        --}}
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

