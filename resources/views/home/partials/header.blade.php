    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container">
            <div class="header-container d-flex align-items-center">
                <div class="logo mr-auto">
                    <h1 class="text-light"><a href="{{ route('landing.page') }}"><span>Harapan Bangsa</span></a></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <a href="index.html"><img src="{{ asset('assets//img/logo.png') }}" alt="" class="img-fluid"></a>-->
                </div>

                <nav class="nav-menu d-none d-lg-block">
                    <ul>
                        <li class="active"><a href="{{ route('landing.page') }}">Home</a></li>
                        <li><a href="{{ route('hasil') }}">Hasil Pendaftaran</a></li>
                        <li class="get-started"><a href="{{ route('daftar') }}">Daftar</a></li>
                    </ul>
                </nav><!-- .nav-menu -->
            </div><!-- End Header Container -->
        </div>
    </header>
