
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <img src="{{ asset('front/assets/images/logo.png') }}" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Search End ***** -->
                    <div class="search-input">
                        <form id="search" action="#">
                            <input type="text" placeholder="Cari Lowongan Kerja" id='searchText' name="searchKeyword" />
                            <i class="fa fa-search"></i>
                        </form>
                    </div> 
                    <!-- ***** Search End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{ route('welcome') }}" class="{{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a></li>
                        <li><a href="{{ route('job') }}" class="{{ request()->routeIs('job') ? 'active' : '' }}">Job</a></li>
                        <li><a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profile</a></li>
                        
                        @if (Route::has('login'))
                                @auth
                                    <li>
                                        <a href="{{ url('/dashboard') }}">
                                            Dashboard<img src="{{ asset('front/assets/images/profile-header.jpg') }}" alt="">
                                        </a>
                                    </li>
                                @else
                                    @if (Route::has('login'))
                                    <li>
                                        <a href="{{ route('login') }}">
                                            Login<img src="{{ asset('front/assets/images/profile-header.jpg') }}" alt="">
                                        </a>
                                    </li>
                                    @endif
                                @endauth
                        @endif
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>