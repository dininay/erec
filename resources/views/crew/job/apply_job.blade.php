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

        <div class="container">
            <div class="row">
              <div class="col-lg-12 justify-content-center align-items-center">
                <div class="page-content">
                  @auth
                    <div class="container mt-5">
                        <h3 class="text-center mb-5" style="color: #b0b0b0">User Information Form</h3>
                        <form action="{{ route('submitapply') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="row">
                                <input type="hidden" name="reg_code" value="{{ $jobs->reg_code }}">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label class="form-label">Posisi yang dituju : {{ $jobs->job_title }}</label><br>
                                            <label class="form-label">Lokasi Kerja : {{ $jobs->workloc->workloc_name }}</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Job Type : {{ $jobs->jobtype->jobtype_name }}</label><br>
                                            <label class="form-label">Job Level : {{ $jobs->joblevel->joblevel_name }}</label>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="" style="border-top: 5px solid #b0b0b0; padding-top: 10px; margin: 15px;"></h4>
                                <div class="col-lg-6 mb-5">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap" value="{{ $user->name }}" readonly required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Aktif</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{ $user->email }}" readonly required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nik_ktp" class="form-label">NIK KTP</label>
                                        <input type="text" class="form-control" id="nik_ktp" name="nik_ktp" placeholder="Masukkan NIK KTP" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="wa_aktif" class="form-label">No Whatsapp Aktif</label>
                                        <input type="text" class="form-control" id="wa_aktif" name="wa_aktif" placeholder="Masukkan No Whatsapp Aktif" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ttl" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="ttl" name="ttl" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="age" class="form-label">Usia</label>
                                        <input type="text" class="form-control" id="age" name="age" placeholder="Masukkan Age" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="domisili" class="form-label">Domisili</label>
                                        <input type="text" class="form-control" id="domisili" name="domisili" placeholder="Masukkan Domisili" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jk" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="jk" id="jk">
                                            <option value="">Pilih</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bb" class="form-label">Berat Badan</label>
                                        <input type="text" class="form-control" id="bb" name="bb" placeholder="Masukkan BB" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tb" class="form-label">Tinggi Badan</label>
                                        <input type="text" class="form-control" id="tb" name="tb" placeholder="Masukkan TB" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status_nikah" class="form-label">Status Pernikahan</label>
                                        <select class="form-select" name="status_nikah" id="status_nikah">
                                            <option value="">Pilih</option>
                                            <option value="Belum Menikah">Belum Menikah</option>
                                            <option value="Menikah">Menikah</option>
                                        </select>
                                    </div>
                                    <div class="mb-3" style="">
                                        <label for="jml_anak" class="form-label">Jumlah Anak</label>
                                        <input type="text" class="form-control" id="jml_anak" name="jml_anak" placeholder="Masukkan Jumlah Anak" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="riwayat_kesehatan" class="form-label">Riwayat Sakit</label>
                                        <textarea type="text" class="form-control" id="riwayat_kesehatan" name="riwayat_kesehatan" placeholder="Masukkan Riwayat Sakit" required>
                                        </textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_pendidikan" class="form-label">Pendidikan Terakhir</label>
                                        <select class="form-select" name="last_pendidikan" id="last_pendidikan">
                                            <option value="">Pilih</option>
                                            <option value="SMA / SMK / MA">SMA / SMK / MA</option>
                                            <option value="D3">D3</option>
                                            <option value="S1 / D4">S1 / D4</option>
                                            <option value="S2">S2</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" placeholder="Masukkan Asal Sekolah" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jurusan" class="form-label">Jurusan</label>
                                        <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="th_lulus" class="form-label">Tahun Lulus</label>
                                        <input type="date" class="form-control" id="th_lulus" name="th_lulus" placeholder="Masukkan Tahun Lulus" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ipk" class="form-label">IPK / Nilai Rata-Rata</label>
                                        <input type="text" class="form-control" id="ipk" name="ipk" placeholder="Masukkan IPK / Nilai Rata-Rata" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-5">
                                    <div class="mb-3">
                                        <label for="quest_1" class="form-label">APAKAH SAUDARA SUDAH PERNAH BEKERJA DI MIE GACOAN?</label>
                                        <select class="form-select" name="quest_1" id="quest_1" onchange="toggleJobDetails()">
                                            <option value="">Pilih</option>
                                            <option value="Belum">Belum</option>
                                            <option value="Sudah">Sudah</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Conditional Fields -->
                                    <div id="jobDetails" style="display: none;">
                                        <div class="mb-3">
                                            <label for="from">KAPAN SAUDARA BEKERJA DI GACOAN?</label>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="from" class="form-label">From</label>
                                                        <input type="date" class="form-control" id="from" name="from" placeholder="Masukkan from">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="to" class="form-label">To</label>
                                                        <input type="date" class="form-control" id="to" name="to" placeholder="Masukkan to">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="quest_3" class="form-label">APA POSISI TERAKHIR SAUDARA SAAT BEKERJA DI GACOAN?</label>
                                            <input type="text" class="form-control" id="quest_3" name="quest_3" placeholder="Masukkan APA POSISI TERAKHIR SAUDARA SAAT BEKERJA DI GACOAN?">
                                        </div>
                                        <div class="mb-3">
                                            <label for="quest_4" class="form-label">APA ALASAN SAUDARA RESIGN DARI GACOAN?</label>
                                            <textarea class="form-control" id="quest_4" name="quest_4" placeholder="Masukkan Alasan Resign"></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">APAKAH SAUDARA SEBELUMNYA SUDAH PERNAH MELAMAR PEKERJAAN DI MIE GACOAN?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="quest_5" id="quest_5_belum" value="Belum Pernah" required>
                                            <label class="form-check-label" for="quest_5_belum">Belum Pernah</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="quest_5" id="quest_5_gagal_psikotes" value="Sudah, Gagal Di Psikotes">
                                            <label class="form-check-label" for="quest_5_gagal_psikotes">Sudah, Gagal Di Psikotes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="quest_5" id="quest_5_gagal_interview" value="Sudah, Gagal Di Interview">
                                            <label class="form-check-label" for="quest_5_gagal_interview">Sudah, Gagal Di Interview</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="quest_5" id="quest_5_gagal_oje" value="Sudah, Tidak Lolos Seleksi OJE (On The Job)">
                                            <label class="form-check-label" for="quest_5_gagal_oje">Sudah, Tidak Lolos Seleksi OJE (On The Job)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="quest_5" id="quest_5_gagal_training" value="Sudah, Tidak Melanjutkan Tahap Training">
                                            <label class="form-check-label" for="quest_5_gagal_training">Sudah, Tidak Melanjutkan Tahap Training</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="experience_1" class="form-label">PENGALAMAN KERJA 1</label>
                                        <textarea type="text" class="form-control" id="experience_1" name="experience_1" placeholder="Masukkan  NAMA PERUSAHAAN – POSISI – LAMA BEKERJA- GAJI TERAKHIR" required>
                                        </textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="experience_2" class="form-label">PENGALAMAN KERJA 2</label>
                                        <textarea type="text" class="form-control" id="experience_2" name="experience_2" placeholder="Masukkan  NAMA PERUSAHAAN – POSISI – LAMA BEKERJA- GAJI TERAKHIR" required>
                                        </textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cv" class="form-label">Upload CV (Curriculum Vitae) Terupdate</label>
                                        <input type="file" class="form-control" id="cv" name="cv" placeholder="Masukkan Upload CV (Curriculum Vitae) Terupdate" accept=".pdf,.doc,.docx" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Upload Photo Full Body Terbaru</label>
                                        <input type="file" class="form-control" id="photo" name="photo" placeholder="Masukkan Upload Photo Full Body Terbaru" accept=".jpg,.jpeg,.png,.pdf" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="info_vacancy" class="form-label">MENGETAHUI INFORMASI LOWONGAN PEKERJAAN DARI?</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_instagram" value="Instagram" required>
                                            <label class="form-check-label" for="info_vacancy_instagram">Instagram</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_facebook" value="Facebook">
                                            <label class="form-check-label" for="info_vacancy_facebook">Facebook</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_linkedin" value="Linkedin">
                                            <label class="form-check-label" for="info_vacancy_linkedin">Linkedin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_telegram" value="Telegram">
                                            <label class="form-check-label" for="info_vacancy_telegram">Telegram</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_employee_referral" value="Employee Referral">
                                            <label class="form-check-label" for="info_vacancy_employee_referral">Employee Referral</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_bkk" value="BKK Sekolah">
                                            <label class="form-check-label" for="info_vacancy_bkk">BKK Sekolah</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_jobstreet" value="Jobstreet">
                                            <label class="form-check-label" for="info_vacancy_jobstreet">Jobstreet</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_kitalulus" value="Kitalulus">
                                            <label class="form-check-label" for="info_vacancy_kitalulus">Kitalulus</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_pintarnya" value="Pintarnya">
                                            <label class="form-check-label" for="info_vacancy_pintarnya">Pintarnya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_glints" value="Glints">
                                            <label class="form-check-label" for="info_vacancy_glints">Glints</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_dealls" value="Dealls">
                                            <label class="form-check-label" for="info_vacancy_dealls">Dealls</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_kupu" value="Kupu.id">
                                            <label class="form-check-label" for="info_vacancy_kupu">Kupu.id</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_blk" value="BLK (Balai Latihan Kerja)">
                                            <label class="form-check-label" for="info_vacancy_blk">BLK (Balai Latihan Kerja)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="info_vacancy" id="info_vacancy_karang" value="Karang Taruna">
                                            <label class="form-check-label" for="info_vacancy_karang">Karang Taruna</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="button btn w-100">Submit</button>
                        </form>
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
                </div>
              </div>
            </div>
        </div>

  <!-- Include Bootstrap JS and Popper.js -->
  <script src="{{ asset('front/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

  <script src="{{ asset('front/assets/js/isotope.min.js') }}"></script>
  <script src="{{ asset('front/assets/js/owl-carousel.js') }}"></script>
  <script src="{{ asset('front/assets/js/tabs.js') }}"></script>
  <script src="{{ asset('front/assets/js/popup.js') }}"></script>
  <script src="{{ asset('front/assets/js/custom.js') }}"></script>
  <script>
    function toggleJobDetails() {
        const quest1 = document.getElementById('quest_1').value;
        const jobDetails = document.getElementById('jobDetails');

        if (quest1 === "Sudah") {
            jobDetails.style.display = "block";
        } else {
            jobDetails.style.display = "none";
        }
    }
</script>
</body>
</html>