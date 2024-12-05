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
        <!-- Ini adalah tempat untuk menampilkan countdown -->
        
        <div id="countdownSection" class="text-center mt-10">
            <p id="countdownDisplay" class="text-lg font-bold"></p>
        </div>

        <form method="POST" action="{{ route ('dashboard.learning.course.answer.storeessay', ['course' => $course->course_id, 'question' => $question->question_id]) }}" class="learning flex flex-col gap-[50px] items-center mt-[50px] w-full pb-[30px]">
            @csrf
            <h1 class="w-[821px] font-extrabold text-[46px] leading-[69px] text-center">
                {{ $question->question_name }}
            </h1>
            <div class="flex flex-col gap-[30px] max-w-[750px] w-full">
                @foreach($question->answers as $answer)
                <label for="{{ $answer->answer_id }}" class="group flex items-center justify-between rounded-full w-full border border-[#EEEEEE] p-[18px_20px] gap-[14px] transition-all duration-300 has-[:checked]:border-2 has-[:checked]:border-[#0A090B]">
                    <div class="flex items-center gap-[14px]">
                        <img src="{{ asset('images/icons/arrow-circle-right.svg') }}" alt="icon">
                        <span class="font-semibold text-xl leading-[30px]">{{ $answer->answer_name }}</span>
                    </div>
                    <div class="hidden group-has-[:checked]:block">
                        <img src="{{ asset('images/icons/tick-circle.svg') }}" alt="icon">
                    </div>
                    <input type="radio" name="answer" id="{{ $answer->answer_id }}" value="{{ $answer->answer_id }}" {{ $existingAnswer && $existingAnswer->answer == $answer->answer_id ? 'checked' : '' }} class="hidden">
                </label>
                @endforeach
            </div>
            {{-- <button type="submit" href="learning-finished.html" class="w-fit p-[14px_40px] bg-[#6436F1] rounded-full font-bold text-sm text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center align-middle">Save & Next Question</button> --}}
            
            <div class="flex gap-4">
                <a href="{{ route('dashboard.learning.course', ['course' => $course->course_id, 'question' => $prevQuestion->question_id ?? $question->question_id]) }}" class="w-fit p-[14px_40px] bg-[#6436F1] rounded-full font-bold text-sm text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center align-middle">Previous</a>
                
                <button type="submit" class="w-fit p-[14px_40px] bg-[#6436F1] rounded-full font-bold text-sm text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center align-middle">Save & Next Question</button>
            </div>
            @if (session('lastQuestion'))
                <!-- SweetAlert will trigger when it's the last question -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        title: 'Are you sure you want to submit?',
                        // text: "Once submitted, you won't be able to change your answers.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, submit!',
                        cancelButtonText: 'No, keep editing!',
                        customClass: {
                            confirmButton: 'btn-yes',
                            cancelButton: 'btn-no'
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('dashboard.learning.index') }}";
                        }
                    });
                </script>
                <style>
                    .swal2-confirm.btn-yes {
                        background-color: #0056b3; 
                        border-color: #0056b3;
                    }
            
                    .swal2-cancel.btn-no {
                        background-color: #ffc107; 
                        border-color: #ffc107;
                    }
            
                    .swal2-confirm.btn-yes, .swal2-cancel.btn-no {
                        color: #fff;
                        font-weight: bold;
                    }
                </style>
            @endif
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
        // Ambil waktu batas dari server
        const timeLimit = "{{ $timeLimit }}"; // Format HH:MM:SS
        const countdownDisplay = document.getElementById("countdownDisplay");
    
        // Konversi HH:MM:SS ke detik
        function timeToSeconds(time) {
            const [hours, minutes, seconds] = time.split(":").map(Number);
            return hours * 3600 + minutes * 60 + seconds;
        }
    
        // Hitung mundur
        let remainingTime = localStorage.getItem('remainingTime') ? parseInt(localStorage.getItem('remainingTime')) : timeToSeconds(timeLimit);
    
        function updateCountdown() {
            if (remainingTime <= 0) {
                countdownDisplay.textContent = "Waktu Habis!";
                // Opsional: Hentikan formulir atau kirim otomatis
                document.querySelector("form").submit();
                clearInterval(countdownInterval);
                return;
            }
    
            // Format ke HH:MM:SS
            const hours = String(Math.floor(remainingTime / 3600)).padStart(2, "0");
            const minutes = String(Math.floor((remainingTime % 3600) / 60)).padStart(2, "0");
            const seconds = String(remainingTime % 60).padStart(2, "0");
    
            countdownDisplay.textContent = `${hours}:${minutes}:${seconds}`;
            remainingTime--;

            localStorage.setItem('remainingTime', remainingTime);
        }
    
        // Update countdown setiap detik
        const countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown(); // Update segera saat dimuat
    </script>
    
</body>
</html>