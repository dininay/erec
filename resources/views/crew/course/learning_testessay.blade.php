<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0A090B]">
    <section id="content">
        <div class="border-b border-[#EEEEEE]">
            <div class="nav flex items-center w-full h-[92px] max-w-[1280px] mx-auto justify-between p-5">
                <div class="flex items-center gap-4">
                    <div class="w-[50px] h-[50px] flex shrink-0 overflow-hidden rounded-full">
                        <img src="{{ Storage::url($course->cover) }}" class="object-cover" alt="thumbnail">
                    </div>
                    <div class="flex flex-col gap-[2px]">
                        <p class="font-bold text-lg">{{ $course->course_name }}</p>
                        {{-- <p class="text-[#7F8190] text-sm">Beginners</p> --}}
                    </div>
                </div>
                <div class="flex gap-3 items-center">
                    <div class="flex flex-col text-right">
                        <p class="text-sm text-[#7F8190]">{{ $user->email}}</p>
                        <p class="font-semibold">{{ $user->name }}</p>
                    </div>
                    <div class="w-[46px] h-[46px]">
                        <img src="{{ asset('images/photos/default-photo.svg') }}" alt="photo">
                    </div>
                </div>
            </div>
        </div>
        <div id="countdownSection" class="text-center mt-4">
            <p id="countdownDisplay" class="text-lg font-bold">00:00</p>
        </div>
        <form method="POST" action="{{ route ('dashboard.learning.course.answer.storeessay', ['course' => $course->course_id, 'question' => $question->question_id]) }}" class="learning flex flex-col gap-[50px] items-center mt-[50px] w-full pb-[30px]">
            @csrf
            <h1 class="w-[821px] font-extrabold text-[46px] leading-[69px] text-center">
                {{ $question->question_name }}
            </h1>
            <div class="flex flex-col gap-[30px] max-w-[750px] w-full">
                <label for="a" class="group flex items-center justify-between rounded-full w-full border border-[#EEEEEE] p-[18px_20px] gap-[14px] transition-all duration-300 has-[:checked]:border-2 has-[:checked]:border-[#0A090B]">
                    <div class="flex items-center gap-[14px]">
                        <img src="{{ asset('images/icons/arrow-circle-right.svg') }}" alt="icon">
                        <span class="font-semibold text-xl leading-[30px]"></span>
                    </div>
                    <div class="hidden group-has-[:checked]:block">
                        <img src="{{ asset('images/icons/tick-circle.svg') }}" alt="icon">
                    </div>
                    <!-- Input text biasa -->
                    <input type="text" name="answer" id="a" class="w-full px-4 py-2 rounded-md focus:outline-none focus:border-[#6436F1]" placeholder="Your answer here...">
                </label>
            </div>
            <button type="submit" href="learning-finished.html" class="w-fit p-[14px_40px] bg-[#6436F1] rounded-full font-bold text-sm text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center align-middle">Save & Next Question</button>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmFinish(redirectUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to change your answers after this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6436F1',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = redirectUrl;
                }
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil waktu yang dikirim dari backend
            var countdownTime = @json($timeLimit); // Waktu dalam detik (misalnya 300 detik)
            
            // Ambil elemen untuk menampilkan countdown
            var countdownDisplay = document.getElementById('countdownDisplay');
    
            // Fungsi untuk update hitung mundur setiap detik
            var countdownInterval = setInterval(function() {
                var minutes = Math.floor(countdownTime / 60);
                var seconds = countdownTime % 60;
    
                // Format waktu dengan 2 digit
                countdownDisplay.textContent = 
                    (minutes < 10 ? '0' : '') + minutes + ':' + 
                    (seconds < 10 ? '0' : '') + seconds;
    
                if (countdownTime <= 0) {
                    clearInterval(countdownInterval);
                    countdownDisplay.textContent = 'Time\'s up!';
                    // Di sini Anda bisa menambahkan logika untuk mengarahkan pengguna ke halaman lain setelah waktu habis
                } else {
                    countdownTime--;
                }
            }, 1000); // Update setiap detik
        });
    </script>
    
</body>
</html>