<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

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
          <!-- ***** Banner Start ***** -->
          <div class="row">
              <div class="col-lg-12">
                  <div class="main-profile">
                      <div class="row">
                          <div class="col-lg-4">
                              <img src="{{ asset('front/assets/images/profile.jpg') }}" alt="" style="border-radius: 23px;">
                          </div>
                          <div class="col-lg-4 align-self-center">
                              <div class="main-info header-text">
                                  <h5>{{ $user->name }}</h5>
                                  <p>Yuk, apply pada lowongan kerja yang tersedia sekarang!</p>
                              </div>
                          </div>
                          <div class="col-lg-4 align-self-center">
                              <ul>
                                  <li>Email <span>{{ $user->email }}</span></li>
                                  <li>Jenis Kelamin <span>{{ $jobDetails->jk ?? '-' }}</span></li>
                                  <li>Tempat, Tanggal Lahir <span>{{ $jobDetails->ttl ?? '-' }}</span></li>
                                  <li>Usia <span>{{ $jobDetails->age ?? '-' }}</span></li>
                                  <li>NIK <span>{{ $jobDetails->nik_ktp ?? '-' }}</span></li>
                                  <li>Status <span>{{ $jobDetails->status_nikah ?? '-' }}</span></li>
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
                  @if($jobs->isEmpty())
                  <div class="alert alert-info">Anda belum apply pekerjaan</div>
                  @else
                  @foreach($jobs as $job)
                      <div class="item">
                        <ul class="job-details">
                            <li>
                                <div class="job-detail">
                                    <h6 class="label">ID Apply</h6>
                                    <span>{{ $job->apply_id ?? '-' }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="job-detail">
                                    <h6 class="label">Job Title</h6>
                                    <span>{{ $job->job_title ?? '-' }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="job-detail">
                                    <h6 class="label">Work Location</h6>
                                    <span>{{ $job->workloc->workloc_name ?? '-' }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="job-detail">
                                    <h6 class="label">Application Date</h6>
                                    <span>{{ $job->created_at ? \Carbon\Carbon::parse($job->created_at)->format('d F Y') : 'Kosong' }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="job-detail">
                                    <h6 class="label">Status</h6>
                                    <span>
                                        @if($job->status_admin === 'Approve')
                                            Lolos Seleksi Administrasi
                                        @elseif($job->status_admin === 'In Process')
                                            In Process Seleksi Administrasi
                                        @elseif($job->status_interview === 'Approve')
                                            Lolos Seleksi Interview
                                        @elseif($job->status_interview === 'In Process')
                                            In Process Seleksi Interview
                                        @elseif($job->status_docclear === 'Approve')
                                            Lolos Seleksi Document Clearance
                                        @elseif($job->status_docclear === 'In Process')
                                            In Process Seleksi Document Clearance
                                        @elseif($job->status_oje === 'Approve')
                                            Lolos Seleksi OJE
                                        @elseif($job->status_onboarding === 'In Process')
                                            In Process Seleksi OJE
                                        @elseif($job->status_onboarding === 'Approve')
                                            Selamat bergabung menjadi tim PT. Pesta Pora Abadi
                                        @elseif($job->status_onboarding === 'In Process')
                                            In Process Seleksi Onboarding
                                        @else
                                            Status belum tersedia
                                        @endif
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                
                  @endforeach
                  @endif
              </div>
          </div>
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
