@if(1 == 1 && !Auth::check())
    <footer class="footer">
        <div class="container-fluid">
            <!-- 5 Columns

                First Column : Logo
                Second Column : Social Media
                Third Column : Menu and Newsletter
                Fourth Column : Map
            -->

            <div class="row footer_main_content">

                {{-- First Column - Logo --}}
                <div class="col-md-3">
                    <div class="footer-logo text-center">
                        <a href="{{ route('welcome') }}">
                            <img src="{{ asset('img/helpdesk_big_logo.png') }}" alt="logo">
                        </a>
                    </div>
                    <p class="text-center short-description-footer">{{ __('Your best solution for managing your IT Help Desk') }}</p>
                </div>

                {{-- Second Column - Social Media --}}
                <div class="col-md-3">
                    <div class="footer-social">
                        <ul>
                            <li>
                                <a href="https://github.com/ruiprogramador" class="btn btn-just-icon btn-link btn-github" target="_blank">
                                    <i class="fa-brands fa-github"></i> {{ __('Rui Programador') }}
                                </a>
                            </li>
                            <!-- LeetCode -->
                            <li>
                                <a
                                    href="https://leetcode.com/u/therdam/"
                                    target="_blank"
                                >
                                    <img
                                        src="{{ asset('img/services/leetcode.svg') }}"
                                        alt="leetcode"
                                        style="vertical-align:top; margin:4px"
                                    >
                                </a>
                            </li>

                            <!-- HackerRank -->
                            <li>
                                <a
                                    href="https://www.hackerrank.com/profile/therdam"
                                    target="_blank"
                                >
                                    <img
                                        src="{{ asset('img/services/hackerrank.svg') }}"
                                        alt="hackerrank"
                                        style="vertical-align:top; margin:4px"
                                    >
                                </a>
                            </li>

                            <!-- StrataScratch -->
                            <li>
                                <a
                                    href="https://platform.stratascratch.com/user/RDAM"
                                    class=""
                                    target="_blank"
                                >
                                    StrataScratch
                                </a>
                            </li>

                            <!-- CodeWars -->
                            <li>
                                <a
                                    href="https://www.codewars.com/users/TheRDAM"
                                    target="_blank"
                                >
                                    <img
                                        src="{{ asset('img/services/codewars.svg') }}"
                                        alt="codewars"
                                        style="vertical-align:top; margin:4px"
                                    >
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Third Column - Menu --}}
                <div class="col-md-3">
                    <nav class="footer-menu">
                        <ul>
                            <li>
                                <a
                                    href="{{ route('welcome') }}#about" class="nav-link">{{ __('About') }}
                                </a>
                            </li>
                            <li>
                                <a class="nav-link">{{ __('Blog') }}</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                {{-- Fourth Column - Map --}}
                <div class="col-md-3">
                    <div class="container-fluid ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d97475.70086317716!2d-8.49867541718849!3d40.22873073325376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22f9144aacd16d%3A0x634564477b42a6b9!2sCoimbra!5e0!3m2!1spt-PT!2spt!4v1729454265738!5m2!1spt-PT!2spt" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>


            {{--
                <nav>
                    <ul class="footer-menu">
                        <li>
                            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">{{ __('Creative Tim') }}</a>
                        </li>
                        <li>
                            <a href="https://www.updivision.com" class="nav-link" target="_blank">{{ __('Updivision') }}</a>
                        </li>
                        <li>
                            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">{{ __('About Us') }}</a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">{{ __('Blog') }}</a>
                        </li>
                    </ul>
                    <p class="copyright text-center">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.creative-tim.com">{{ __('Creative Tim') }}</a> &amp; <a href="https://www.updivision.com">{{ __('Updivision') }}</a> {{ __(', made with love for a better web') }}
                    </p>
                </nav>
            --}}
        </div>

        <div class="container-fluid row">
            <div class="col-sm-12">
                <p class="copyright text-center">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    {{ __('Made with love for a better web') }}
                    <br>
                    <i class="fa-solid fa-heart" style="width: 64px !important; height: 64px !important;"></i>
                    {{ __('by') }}
                    <span>
                        RDAM
                    </span>
                </p>
            </div>
        </div>
    </footer>
@endif
