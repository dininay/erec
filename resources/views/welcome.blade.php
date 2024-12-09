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

                    <!-- ***** Banner Start ***** -->
                    <div class="main-banner">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="header-text">
                                    <h6>Let's Join To Be Part of</h6>
                                    <h4><em>Pesta Pora Abadi</em> Menyala Gacoanku !</h4>
                                    <div class="main-button">
                                        <a href="">Gabung Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Banner End ***** -->

                    <!-- ***** Most Popular Start ***** -->
                    <div id="page-job" class="most-popular">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class=" d-flex heading-section justify-content-center text-align-center">
                                    <h6>Lowongan Kerja Terbaru</h6>
                                    {{-- <h4>Lowongan Terbuka</h4> --}}
                                </div>
                                <div id="jobResults" class="row">
                                    @forelse($jobs as $job)
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="item">
                                                {{-- <img src="{{ asset('front/assets/images/popular-01.jpg') }}" alt=""> --}}
                                                <h5 class="mt-2 mx-2"><a
                                                        href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}">
                                                        {{ $job->job_title }}</a><br>
                                                    <p>{{ $job->workloc->workloc_name ?? '-' }} - {{ $job->specwork->city ?? '-' }}</p>
                                                </h5>
                                                <h4 class="mx-2"
                                                    style="border-top: 1px solid #b0b0b0; padding-top: 10px; margin-top: 15px;">
                                                    <span>Diposting :
                                                        {{ \Carbon\Carbon::parse($job->created_at)->format('d F Y') }}</span>
                                                </h4>
                                                <div class="main-border-button mt-2">
                                                    <a href="{{ route('jobdetail', ['reg_code' => $job->reg_code]) }}"
                                                        class="btn btn-primary">Cek Details!</a>
                                                    <button class="" type="button" title="Simpan">
                                                        <i class="bi bi-heart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <li>No data available</li>
                                    @endforelse
                                    <div class="col-lg-12">
                                        <div class="main-button">
                                            <a href="{{ route('job') }}">Telusuri Lowongan Lainnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Most Popular End ***** -->
                </div>
            </div>
        </div>
    </div>
    
  <div id="services" class="services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
            <h4>PPA <em>Career</em> Information</h4>
            <img src="assets/images/heading-line-dec.png" alt="">
            <p>Pusat Informasi lowongan kerja pada PT. Pesta Pora Abadi. Seluruh proses recruitment baik pendaftaran lowongan kerja maupun status penerimaan dapat dilakukan secara online melalui sistem ini. Proses rekrutmen tidak dipungut biaya sama sekali.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mb-30">
        <div class="col-lg-4 mb-3">
          <div class="service-item first-service">
            <div class="icon"></div>
            <h4>Visi</h4>
            <p>Menjadi brand retail F&B terbaik dan terbesar kebanggaan Indonesia dengan standar
                produk, pelayanan dan kebersihan bertaraf internasional.</p>
            <div class="text-button">
              {{-- <a href="#">Read More <i class="fa fa-arrow-right"></i></a> --}}
            </div>
          </div>
        </div>
        <div class="col-lg-8 mb-3">
          <div class="service-item second-service">
            <div class="icon"></div>
            <h4>Misi</h4>
            <p>1. Menyediakan produk terbaik dengan harga terjangkau. <br>
                2. Menciptakan customer experience yang terbaik dan berkelanjutan. <br>
                3. Membawa nama F&B Indonesia ke tingkat dunia Internasional. <br>
                4. Menjadikan PT. Pesta Pora Abadi sebagai perusahaan ideal dalam berkarir (Great
                Workplace).</p>
            <div class="text-button">
              {{-- <a href="#">Read More <i class="fa fa-arrow-right"></i></a> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8 mt-3">
          <div class="service-item third-service">
            <div class="icon"></div>
            <h4>Value</h4>
            <p>A. Integrity : <br> Menjunjung tinggi bekerja dan bertindak dengan etika kerja; jujur dan
                juga secara konsisten antara apa yang dikatakan dengan tingkah lakunya sesuai
                nilai-nilai. <br>
                B. Agility : <br> Gesit dalam menerima perubahan atau peluang baru dan gesit dalam
                berfikir. <br>
                C. AChieving : <br> Selalu punya tujuan atau hasil dalam bekerja. Gigih dalam mencapai
                tujuan yang ada untuk menunjukkan prestasi. <br>
                D Teamwork : <br> Kemampuan berkerjasama, mengelola perbedaan-perbedaan pendapat dan
                berkolaborasi untuk mencapai tujuan organisasi.</p>
            <div class="text-button">
              {{-- <a href="#">Read More <i class="fa fa-arrow-right"></i></a> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div id="about" class="about-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="section-heading">
            <h4>About <em>Pesta Pora Abadi</em> &amp; Who We Are</h4>
            {{-- <img src="{{ asset('front/assets/images/heading-line-dec.png') }}" alt=""> --}}
            <p>PT. Pesta Pora Abadi (Mie Gacoan) merupakan merk dari jaringan Restaurant Mie yang sedang berkembang
                dengan pesat di Indonesia.</p>
          </div>
          <div class="row">
            <div class="col-lg-12 section-heading">
              <p>PT. Pesta Pora Abadi berdiri sejak awal tahun 2016. Saat ini merk kami telah tumbuh menjadi
                Market Leader No. 1 utamanya di Provinsi Jawa Timur, Jawa Tengah, Jawa Barat, Jabodetabek
                dan sedang dalam jalur kuat untuk berekspansi menjadi Merk nomor 1 secara Nasional.
                Mengusung konsep bersantap yang modern namun dengan harga terjangkau, kehadiran kami telah
                mendapatkan apresiasi luar biasa di setiap market dimana kami hadir untuk melayani puluhan
                ribu pelanggan setiap bulannya. Produk utama kami adalah Mie dan Dimsum, dan kami akan
                senantiasa berinovasi dalam produk maupun layanan untuk menjaga agar merk Mie Gacoan tetap
                dicintai oleh para pelanggan fanatiknya.</p>
              {{-- <span>*No Credit Card Required</span> --}}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 section-heading">
              <div class="box-item">
                <h4><a href="#">Head Office Jakarta</a></h4>
                {{-- <p>Lorem Ipsum Text</p> --}}
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Head Office Malang</a></h4>
                {{-- <p>Lorem Ipsum Text</p> --}}
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Manufacture</a></h4>
                {{-- <p>Lorem Ipsum Text</p> --}}
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box-item">
                <h4><a href="#">Resto</a></h4>
                {{-- <p>Lorem Ipsum Text</p> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-image">
            <img src="{{ asset('front/assets/images/about-right-dec.png') }}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>


    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <div class="start-stream">
                        <div class="col-lg-12">
                            <div class="heading-section">
                                <h4><em>Work Location</em> Pesta Pora Abadi</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="item">
                                        <div class="icon">
                                            <img src="{{ asset('front/assets/images/service-01.jpg') }}" alt=""
                                                style="max-width: 60px; border-radius: 50%;">
                                        </div>
                                        <h6>Head Office</h6>
                                        <p>Terletak di Malang Jawa Timur dan menara BCA Jakarta.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="item">
                                        <div class="icon">
                                            <img src="{{ asset('front/assets/images/service-02.jpg') }}" alt=""
                                                style="max-width: 60px; border-radius: 50%;">
                                        </div>
                                        <h6>Manufacture <br>(Supply Chain Management)</h6>
                                        <p>Terletak di Jawa Timur & Jawa Tengah</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="item">
                                        <div class="icon">
                                            <img src="{{ asset('front/assets/images/service-03.jpg') }}" alt=""
                                                style="max-width: 60px; border-radius: 50%;">
                                        </div>
                                        <h6>Resto</h6>
                                        <p>Tersebar di seluruh kota yang ada di Indonesia dan Kualalumpur Malaysia.</p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="main-button">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <section id="testimonials">
        <div class="container">
            <div class="title-block">
                <h4>Visi, Misi, Value</h4>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="testimonial-box">
                        <div class="row personal-info">
                            <div class="col-md-10 col-xs-10">
                                <h6>Visi Misi</h6>
                            </div>
                        </div>
                        <p>Visi : <br>Menjadi brand retail F&B terbaik dan terbesar kebanggaan Indonesia dengan standar
                            produk, pelayanan dan kebersihan bertaraf internasional.</p>
                        <p>Misi :
                        <ul>
                            <p>1. Menyediakan produk terbaik dengan harga terjangkau. <br>
                                2. Menciptakan customer experience yang terbaik dan berkelanjutan. <br>
                                3. Membawa nama F&B Indonesia ke tingkat dunia Internasional. <br>
                                4. Menjadikan PT. Pesta Pora Abadi sebagai perusahaan ideal dalam berkarir (Great
                                Workplace).</p>
                        </ul>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="testimonial-box">
                        <div class="row personal-info">
                            <div class="col-md-10 col-xs-10">
                                <h6>Value</h6>
                            </div>
                        </div>
                        <p>
                        <ul>
                            <p>A. Integrity : <br> Menjunjung tinggi bekerja dan bertindak dengan etika kerja; jujur dan
                                juga secara konsisten antara apa yang dikatakan dengan tingkah lakunya sesuai
                                nilai-nilai. <br>
                                B. Agility : <br> Gesit dalam menerima perubahan atau peluang baru dan gesit dalam
                                berfikir. <br>
                                C. AChieving : <br> Selalu punya tujuan atau hasil dalam bekerja. Gigih dalam mencapai
                                tujuan yang ada untuk menunjukkan prestasi. <br>
                                D Teamwork : <br> Kemampuan berkerjasama, mengelola perbedaan-perbedaan pendapat dan
                                berkolaborasi untuk mencapai tujuan organisasi.</p>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <!-- ***** Gaming Library Start ***** -->
                    <div class="gaming-library">
                        <div class="col-lg-12">
                            <div class="heading-section">
                                <h4><em>Your Gaming</em> Library</h4>
                            </div>
                            <div class="item">
                                <ul>
                                    <li><img src="{{ asset('front/assets/images/game-01.jpg') }}" alt=""
                                            class="templatemo-item"></li>
                                    <li>
                                        <h4>Dota 2</h4><span>Sandbox</span>
                                    </li>
                                    <li>
                                        <h4>Date Added</h4><span>24/08/2036</span>
                                    </li>
                                    <li>
                                        <h4>Hours Played</h4><span>634 H 22 Mins</span>
                                    </li>
                                    <li>
                                        <h4>Currently</h4><span>Downloaded</span>
                                    </li>
                                    <li>
                                        <div class="main-border-button border-no-active"><a
                                                href="#">Donwloaded</a></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="item">
                                <ul>
                                    <li><img src="{{ asset('front/assets/images/game-02.jpg') }}" alt=""
                                            class="templatemo-item"></li>
                                    <li>
                                        <h4>Fortnite</h4><span>Sandbox</span>
                                    </li>
                                    <li>
                                        <h4>Date Added</h4><span>22/06/2036</span>
                                    </li>
                                    <li>
                                        <h4>Hours Played</h4><span>740 H 52 Mins</span>
                                    </li>
                                    <li>
                                        <h4>Currently</h4><span>Downloaded</span>
                                    </li>
                                    <li>
                                        <div class="main-border-button"><a href="#">Donwload</a></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="item last-item">
                                <ul>
                                    <li><img src="{{ asset('front/assets/images/game-03.jpg') }}" alt=""
                                            class="templatemo-item"></li>
                                    <li>
                                        <h4>CS-GO</h4><span>Sandbox</span>
                                    </li>
                                    <li>
                                        <h4>Date Added</h4><span>21/04/2036</span>
                                    </li>
                                    <li>
                                        <h4>Hours Played</h4><span>892 H 14 Mins</span>
                                    </li>
                                    <li>
                                        <h4>Currently</h4><span>Downloaded</span>
                                    </li>
                                    <li>
                                        <div class="main-border-button border-no-active"><a
                                                href="#">Donwloaded</a></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="main-button">
                                <a href="profile.html">View Your Library</a>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Gaming Library End ***** -->
                </div>
            </div>
        </div>
    </div> --}}

    
  <footer id="newsletter">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h4>Join our mailing list to receive the news &amp; latest trends</h4>
          </div>
        </div>
        <div class="col-lg-6 offset-lg-3">
          <form id="search" action="#" method="GET">
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <input type="address" name="address" class="email" placeholder="Email Address..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <button type="submit" class="main-button">Subscribe Now <i class="fa fa-angle-right"></i></button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>Contact Us</h4>
            <p>Rio de Janeiro - RJ, 22795-008, Brazil</p>
            <p><a href="#">010-020-0340</a></p>
            <p><a href="#">info@company.co</a></p>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>About Us</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Testimonials</a></li>
              <li><a href="#">Pricing</a></li>
            </ul>
            <ul>
              <li><a href="#">About</a></li>
              <li><a href="#">Testimonials</a></li>
              <li><a href="#">Pricing</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Free Apps</a></li>
              <li><a href="#">App Engine</a></li>
              <li><a href="#">Programming</a></li>
              <li><a href="#">Development</a></li>
              <li><a href="#">App News</a></li>
            </ul>
            <ul>
              <li><a href="#">App Dev Team</a></li>
              <li><a href="#">Digital Web</a></li>
              <li><a href="#">Normal Apps</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="footer-widget">
            <h4>About Our Company</h4>
            <div class="logo">
              <img src="assets/images/white-logo.png" alt="">
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="copyright-text">
            <p>Copyright © 2022 Chain App Dev Company. All Rights Reserved. 
          <br>Design: <a href="https://templatemo.com/" target="_blank" title="css templates">TemplateMo</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>
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
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('searchText').addEventListener('input', function() {
                const searchText = this.value;
                console.log("searchText", searchText);

                fetch(`/search-jobs?searchKeyword=${encodeURIComponent(searchText)}`)
                    .then((response) => response.json())
                    .then((jobs) => {
                        const resultsDiv = document.getElementById('jobResults');
                        resultsDiv.innerHTML = '';

                        if (jobs.length === 0) {
                            resultsDiv.innerHTML = '';
                        } else {
                            jobs.forEach((job) => {
                                const jobElement = document.createElement('div');
                                jobElement.classList.add('col-lg-3', 'col-sm-6');
                                jobElement.innerHTML = `
                                  <div class="item">
                                      <h5 class="mt-2 mx-2">
                                          <a href="/jobdetail/${job.reg_code}">${job.job_title}</a><br>
                                          <p>${job.workloc ? job.workloc.workloc_name : '-'}</p>
                                      </h5>
                                      <h4 class="mx-2" style="border-top: 1px solid #b0b0b0; padding-top: 10px; margin-top: 15px;">
                                          <span>Diposting: ${new Date(job.created_at).toLocaleDateString()}</span>
                                      </h4>
                                      <div class="main-border-button mt-2">
                                          <a href="/jobdetail/${job.reg_code}" class="btn btn-primary">Cek Details!</a>
                                          <button type="button" title="Simpan">
                                              <i class="bi bi-heart"></i>
                                          </button>
                                      </div>
                                  </div>
                              `;
                                resultsDiv.appendChild(jobElement);
                            });
                        }

                        document.getElementById('page-job').scrollIntoView({
                            behavior: 'smooth'
                        });
                    })
                    .catch((error) => {
                        console.error('Error fetching jobs:', error);
                    });
            });
        });
    </script>
</body>

</html>