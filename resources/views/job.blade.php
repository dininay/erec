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

          <!-- ***** Featured Games Start ***** -->
          <!-- ***** Featured Games End ***** -->

        <div class="most-popular">
          <div class="most-popular">
            <div class="row">
              <div class="col-lg-4">
                <div class="top-downloaded header-text">
                  <div class="heading-section">
                    <h6>Head Office</h6>
                  </div>
                  <ul>
                    @forelse($headOfficeJobs as $job)
                        <li>
                            <img src="{{ asset('front/assets/images/game-01.jpg') }}" alt="" class="templatemo-item">
                            <h5><a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}">{{ $job->job_title }}</a></h5>
                            <h6>{{ $job->division->div_name }}</h6>
                            <h6>{{ $job->dept->dept_name }}</h6>
                            <h6>{{ $job->jobtype->jobtype_name }}</h6>
                            <div class="download">
                                <a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}"><i class="fa fa-book"></i></a>
                            </div>
                        </li>
                    @empty
                        <li>No data available</li>
                    @endforelse
                  </ul>
                  <div class="text-button">
                    <a href="profile.html">View All in Head Office</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="top-downloaded">
                  <div class="heading-section">
                    <h6>Manufacture</h6>
                  </div>
                  <ul>
                    @forelse($manufactureJobs as $job)
                        <li>
                            <img src="{{ asset('front/assets/images/game-02.jpg') }}" alt="" class="templatemo-item">
                            <h5><a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}">{{ $job->job_title }}</a></h5>
                            <h6>{{ $job->division->div_name }}</h6>
                            <h6>{{ $job->dept->dept_name }}</h6>
                            <h6>{{ $job->jobtype->jobtype_name }}</h6>
                            <div class="download">
                                <a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}"><i class="fa fa-book"></i></a>
                            </div>
                        </li>
                    @empty
                        <li>No data available</li>
                    @endforelse
                  </ul>
                  <div class="text-button">
                    <a href="profile.html">View All in Manufacture <br> (Supply Chain Management)</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="top-downloaded header-text">
                  <div class="heading-section">
                    <h6>Resto</h6>
                  </div>
                  <ul>
                    @forelse($restoJobs as $job)
                        <li>
                            <img src="{{ asset('front/assets/images/game-03.jpg') }}" alt="" class="templatemo-item">
                            <h5><a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}"> {{ $job->job_title }}</a></h5>
                            <h6>{{ $job->division->div_name }}</h6>
                            <h6>{{ $job->dept->dept_name }}</h6>
                            <h6>{{ $job->jobtype->jobtype_name }}</h6>
                            <div class="download">
                                <a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}"><i class="fa fa-book"></i></a>
                            </div>
                        </li>
                    @empty
                        <li>No data available</li>
                    @endforelse
                  </ul>
                  <div class="text-button">
                    <a href="profile.html">View All in Resto</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
          <div class="most-popular">
            <div class="row">
                <div class="col-lg-12">
                <div class="heading-section">
                    <h4>All</h4>
                </div>
                <div class="row">
                    @forelse($jobs as $job)
                    <div class="col-lg-3 col-sm-6">
                    <div class="item">
                        <img src="{{ asset('front/assets/images/popular-01.jpg') }}" alt="">
                        <h5 class="mt-2 mx-2"><a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}"> {{ $job->job_title }}</a><br>
                          <p>{{ $job->workloc->workloc_name }}</p>
                          <p>{{ $job->division->div_name }} - {{ $job->jobtype->jobtype_name }}</p>
                        </h5>
                        <h4 class="mx-1" style="border-top: 1px solid #b0b0b0; padding-top: 10px; margin-top: 15px;">
                        <span>Diposting : {{ \Carbon\Carbon::parse($job->created_at)->format('d F Y') }}</span>
                        </h4>
                        <div class="main-border-button mt-2">
                          <a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}" class="btn btn-primary">Cek Details!</a>
                          <button class="" type="button" title="Simpan">
                              <i class="bi bi-heart"></i> 
                          </button>
                        </div>
                    </div>
                    </div>
                    @empty
                        <li>No data available</li>
                    @endforelse
                    {{-- <div class="col-lg-12">
                    <div class="main-button">
                        <a href="{{ route('job') }}">Telusuri Lowongan Lainnya</a>
                    </div>
                    </div> --}}
                </div>
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

  </body>

</html>
