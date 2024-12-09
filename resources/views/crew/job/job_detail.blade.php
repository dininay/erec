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

        <div class="most-popular">
          <div class="game-details">
            <div class="row">
              <div class="col-lg-12">
                <h2>Job Details</h2>
              </div>
              <div class="col-lg-12">
                <div class="content">
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="">
                        <div class="">
                          <h3>{{ $jobs->job_title }}</h3>
                          <p>{{ $jobs->division->div_name }} - {{ $jobs->dept->dept_name }}</p>
                          <p>{{ $jobs->workloc->workloc_name }} - {{ $jobs->specwork->city }}</p>
                        </div>
                        <div class="col-lg-12 d-flex align-items-center">
                            @if($applyExists)
                                <div class="main-border-button">
                                    <a href="{{ route('profil') }}">Cek Status Lamaran</a>
                                </div>
                            @else
                                <div class="main-border-button">
                                    <button id="applyNowBtn" class="btn btn-primary">Apply Now!</button>
                                </div>
                            @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="right-info">
                        <ul>
                          <li><i class="fa fa-server"></i> 
                            <p>Job Type <br>{{ $jobs->jobtype->jobtype_name }}</p></li>
                          <li><i class="fa fa-gamepad"></i>
                            <p>Job Level <br>{{ $jobs->joblevel->joblevel_name }}</p></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                      <div class="col-lg-12 mt-2">
                          <h5>Qualification</h5>
                        <p>{{ $jobs->qualification }}</p>
                      </div>
                    <div class="col-lg-12 mt-5">
                      <h5>Responsibilities</h5>
                      <p>{{ $jobs->job_respons }}</p>
                    </div>
                    <div class="col-lg-12 mt-5 mb-5">
                        <h5>General Requirements</h5>
                      <p>{{ $jobs->general_req }}</p>
                    </div>
                    {{-- <div class="col-lg-12 mt-5">
                        <h5>Qualification</h5>
                      <p>{{ $jobs->qualification }}</p>
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
        <div class="container">
              <div class="row">
                <div class="col-lg-12 mt-5">
                  <div class="heading-section">
                    <h4>Other Related</h4>
                  </div>
                </div>
                <div class="other-games">
                    @foreach ($jobrelated as $job)
                    <div class="col-lg-4">
                      <div class="item">
                        <img src="assets/images/game-01.jpg" alt="" class="templatemo-item">
                        <h5><a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}">{{ $job->job_title }}</a> </h5>
                        <span>{{ $job->workloc->workloc_name }} - {{ $jobs->specwork->city }}</span>
                        <span>{{ $job->jobtype->jobtype_name }}</span>
                        <div class="main-border-button mt-4">
                          <a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}" class="btn btn-primary">Cek Details!</a>
                          <button class="" type="button" title="Simpan">
                              <i class="bi bi-heart"></i> 
                          </button>
                        </div>
                      </div>
                    </div>
                    @endforeach
                </div>
              </div>
        </div>

      </div>
    </div>
  </div>
  
  <footer style="background-color: #efeff0;" class="py-4 mt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 text-center">
          <p>Copyright © 2024 by IT EAD <br> PT.Pesta Pora Abadi. All rights reserved.</p>
        </div>
      </div>
    </div>
</footer>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('front/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

  <script src="{{ asset('front/assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('front/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('front/assets/js/tabs.js') }}"></script>
  <script src="{{ asset('front/assets/js/popup.js') }}"></script>
  <script src="{{ asset('front/assets/js/custom.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('alert'))
        <script>
            Swal.fire({
                icon: "{{ session('alert.type') }}", // "error", "success", "info", etc.
                title: "{{ session('alert.title') }}",
                text: "{{ session('alert.message') }}",
            });
        </script>
    @endif

    <script>
        // Cek apakah ada tombol Apply Now
        const applyBtn = document.getElementById('applyNowBtn');
        if (applyBtn) {
            applyBtn.addEventListener('click', function(e) {
                // Cek apakah user sudah melamar atau belum
                @if($applyExists)
                    // Jika sudah melamar, tampilkan SweetAlert
                    Swal.fire({
                        icon: 'info',
                        title: 'Anda Sudah Melamar',
                        text: 'Silahkan cek akses halaman profil untuk melihat status lamaran anda.',
                        confirmButtonText: 'OK'
                    });
                @else
                    // Jika belum melamar, arahkan ke halaman lamaran
                    window.location.href = '{{ route('applyjob', ['reg_code' => $jobs->reg_code]) }}';
                @endif
            });
        }
    </script>


  </body>

</html>
