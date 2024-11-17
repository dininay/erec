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
                    <li>
                      <img src="{{ asset('front/assets/images/game-01.jpg') }}" alt="" class="templatemo-item">
                      <h5>Fortnite</h5>
                      <h6>Sandbox</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
                    <li>
                      <img src="{{ asset('front/assets/images/game-02.jpg') }}" alt="" class="templatemo-item">
                      <h5>CS-GO</h5>
                      <h6>Legendary</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
                    <li>
                      <img src="{{ asset('front/assets/images/game-03.jpg') }}" alt="" class="templatemo-item">
                      <h5>PugG</h5>
                      <h6>Battle Royale</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
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
                    <li>
                      <img src="{{ asset('front/assets/images/game-01.jpg') }}" alt="" class="templatemo-item">
                      <h5>Fortnite</h5>
                      <h6>Sandbox</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
                    <li>
                      <img src="{{ asset('front/assets/images/game-02.jpg') }}" alt="" class="templatemo-item">
                      <h5>CS-GO</h5>
                      <h6>Legendary</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
                    <li>
                      <img src="{{ asset('front/assets/images/game-03.jpg') }}" alt="" class="templatemo-item">
                      <h5>PugG</h5>
                      <h6>Battle Royale</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
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
                    <li>
                      <img src="{{ asset('front/assets/images/game-01.jpg') }}" alt="" class="templatemo-item">
                      <h5>Fortnite</h5>
                      <h6>Sandbox</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
                    <li>
                      <img src="{{ asset('front/assets/images/game-02.jpg') }}" alt="" class="templatemo-item">
                      <h5>CS-GO</h5>
                      <h6>Legendary</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
                    <li>
                      <img src="{{ asset('front/assets/images/game-03.jpg') }}" alt="" class="templatemo-item">
                      <h5>PugG</h5>
                      <h6>Battle Royale</h6>
                      <span><i class="fa fa-star" style="color: yellow;"></i> 4.9</span>
                      <span><i class="fa fa-download" style="color: #ec6090;"></i> 2.2M</span>
                      <div class="download">
                        <a href="#"><i class="fa fa-download"></i></a>
                      </div>
                    </li>
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
                    @foreach($jobs as $job)
                    <div class="col-lg-3 col-sm-6">
                    <div class="item">
                        <img src="{{ asset('front/assets/images/popular-01.jpg') }}" alt="">
                        <h5 class="mt-2 mx-2">{{ $job->job_title }}<br><p>{{ $job->workloc->workloc_name }}</p></h5>
                        <h4 class="mx-2" style="border-top: 1px solid #b0b0b0; padding-top: 10px; margin-top: 15px;">
                        <span>Diposting : <br>{{ \Carbon\Carbon::parse($job->created_at)->format('d F Y') }}</span>
                        </h4>
                    </div>
                    </div>
                    @endforeach
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


  </body>

</html>
