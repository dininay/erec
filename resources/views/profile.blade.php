<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Cyborg - Awesome HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/templatemo-cyborg-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css') }}"/>
<!--

TemplateMo 579 Cyborg Gaming

https://templatemo.com/tm-579-cyborg-gaming

-->
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
        <div class="flex">
            @include('layouts.header')
            <div class="content w-full">
                @yield('content')
            </div>
        </div>
  <!-- ***** Header Area End ***** -->

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

            @auth
            @foreach($jobs as $job)
          <!-- ***** Banner Start ***** -->
          <div class="row">
            <div class="col-lg-12">
              <div class="main-profile ">
                <div class="row">
                  <div class="col-lg-4">
                    <img src="{{ asset('front/assets/images/profile.jpg') }}" alt="" style="border-radius: 23px;">
                  </div>
                  <div class="col-lg-4 align-self-center">
                    <div class="main-info header-text">
                      {{-- <span>Offline</span> --}}
                      <h5>{{ $user->name }}</h5>
                      <p>Yuk, apply pada lowongan kerja yang tersedia sekarang !</p>
                      {{-- <div class="main-border-button">
                        <a href="#"></a>
                      </div> --}}
                    </div>
                  </div>
                  <div class="col-lg-4 align-self-center">
                    <ul>
                      <li>Email <span>{{ $user->email }}</span></li>
                      <li>Jenis Kelamin <span>None</span></li>
                      <li>Tempat, Tanggal Lahir <span>29</span></li>
                      <li>Usia <span>29</span></li>
                      <li>NIK <span>29</span></li>
                      <li>Status <span>29</span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Banner End ***** -->

          <!-- ***** Gaming Library Start ***** -->
          <div class="gaming-library profile-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h6>Daftar pekerjaan</h6>
              </div>
            @if($applys->isEmpty())
              <span>Anda belum apply pekerjaan</span>
              @else
            @foreach($applys as $apply)
              <div class="item">
                <ul>
                  <li><img src="{{ asset('front/assets/images/game-01.jpg') }}" alt="" class="templatemo-item"></li>
                  <li><h6>Job Title</h6><span>{{ $apply->registjob->job_title }}</span></li>
                  <li><h6>Work Location</h6><span>{{ $apply->workloc->workloc_name }}</span></li>
                  <li><h6>Job Type</h6><span>{{ $apply->jobtype->jobtype_name }}</span></li>
                  <li><h6>Job Division</h6><span>{{ $apply->division->div_name }}</span></li>
                  <li><h6>Job Department</h6><span>{{ $apply->dept->dept_name }}</span></li>
                  <li><h6>Application Date</h6><span>{{ \Carbon\Carbon::parse($apply->created_at)->format('d F Y') }}</span></li>
                  <li>
                    <h6>Status</h6>
                    <span>
                        @if($apply->status_admin === 'Approve')
                            Lolos Seleksi Administrasi
                        @elseif($apply->status_interview === 'Approve')
                            Lolos Seleksi Interview
                        @elseif($apply->status_docclear === 'Approve')
                            Lolos Seleksi Document Clearance
                        @elseif($apply->status_oje === 'Approve')
                            Lolos Seleksi OJE
                        @elseif($apply->status_onboarding === 'Approve')
                            Selamat bergabung menjadi tim PT. Pesta Pora Abadi
                        @else
                            Status belum tersedia
                        @endif
                    </span>
                </li>
                  <li><div class="main-border-button border-no-active"><a href="#">Status</a></div></li>
                </ul>
              </div>
              @endforeach
              @endif
            </div>
          </div>
          @endforeach
          @endauth

          @guest
          <div class="col-lg-12">
            <div class="alert alert-warning text-center ">
                <h5>Anda belum login</h5>
                <p>Silakan login untuk mengakses halaman ini.</p>
              </div>
          </div>
          @endguest
          <!-- ***** Gaming Library End ***** -->
        </div>
      </div>
    </div>
  </div>
  
  {{-- <footer style="background-color: #efeff0;" class="py-4 mt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 text-center">
          <p>Copyright © 2024 by IT EAD <br> PT.Pesta Pora Abadi. All rights reserved.</p>
        </div>
      </div>
    </div>
</footer> --}}


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('front/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

  <script src="{{ asset('front/assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('front/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('front/assets/js/tabs.js') }}"></script>
  <script src="{{ asset('front/assets/js/popup.js') }}"></script>
  <script src="{{ asset('front/assets/js/custom.js') }}"></script>


  </body>

</html>
