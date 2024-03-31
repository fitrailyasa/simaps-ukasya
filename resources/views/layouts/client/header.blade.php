<header class="px-3 border-bottom text-white mb-3 fixed-top" style="background-color: #0e54bd">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-center">
                <img class="img-fluid bg-white rounded mx-3" width="60" src="{{ asset('assets/img/logo.png') }}"
                    alt="Logo">
                <h2 class="mb-0 font-weight-bold">SIMAPS</h2>
            </div>
            <div class="d-none d-lg-block">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 mx-3 justify-content-center mb-md-0">
                    <li><a href="{{ route('beranda') }}"
                            class="nav-link py-3 px-3 text-white fw-bold fs-5 @yield('textHome')">Home</a></li>
                    <li><a href="{{ route('login') }}"
                            class="nav-link py-3 px-3 text-white fw-bold fs-5 @yield('textLogin')"><i
                                class="fa-solid fa-right-to-bracket me-1"></i> Login</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
