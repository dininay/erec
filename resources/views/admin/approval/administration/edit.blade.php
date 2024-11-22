<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
        <div class="flex">
            @include('layouts.sidebar-dashboard')
            <div class="content w-full">
                @yield('content')
            </div>
        </div>
        <div id="menu-content" class="flex flex-col w-full pb-[30px]">
            <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
                <form class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]">
                    <input type="text" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Search by report, student, etc" name="search">
                    <button type="submit" class="ml-[10px] w-8 h-8 flex items-center justify-center">
                        <img src="{{asset('images/icons/search.svg')}}" alt="icon">
                    </button>
                </form>
                <div class="flex items-center gap-[30px]">
                    <div class="flex gap-[14px]">
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{asset('images/icons/receipt-text.svg')}}" alt="icon">
                        </a>
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{asset('images/icons/notification.svg')}}" alt="icon">
                        </a>
                    </div>
                    <div class="h-[46px] w-[1px] flex shrink-0 border border-[#EEEEEE]"></div>
                    <div class="flex gap-3 items-center">
                        <div class="flex flex-col text-right">
                            <p class="text-sm text-[#7F8190]">Howdy</p>
                            <p class="font-semibold">Fany Alqo</p>
                        </div>
                        <div class="w-[46px] h-[46px]">
                            <img src="{{asset('images/photos/default-photo.svg')}}" alt="photo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-10 px-5 mt-5">
                <div class="breadcrumb flex items-center gap-[30px]">
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Home</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="index.html" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Manage Status Administration</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">New Status Administration</a>
                </div>
            </div>
            <div class="header flex flex-col gap-1 px-5 mt-5">
                <h1 class="font-extrabold text-[30px] leading-[45px]">New Status Administration</h1>
                <p class="text-[#7F8190]">Provide high quality for best students</p>
            </div>

            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="py-5 px-5 bg-red-700 text-white">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" enctype="multipart/form-data" action="{{ route('dashboard.approval.administration.update', $status->people_status_id) }}" class="flex flex-col gap-[30px] w-[500px] mx-[70px] mt-10" id="updateForm">
                @csrf
                @method('PUT')
                <div class="group/status flex flex-col gap-[10px]">
                    <p class="font-semibold">Status Administration</p>
                    <div class="peer flex items-center p-[12px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                        <div class="mr-[10px] w-6 h-6 flex items-center justify-center overflow-hidden">
                            <img src="{{asset('images/icons/security-user.svg')}}" class="w-full h-full object-contain" alt="icon">
                        </div>
                        <select id="status" class="pl-1 font-semibold focus:outline-none w-full text-[#0A090B] invalid:text-[#7F8190] invalid:font-normal appearance-none bg-[url('{{asset('images/icons/arrow-down.svg')}}')] bg-no-repeat bg-right" name="status_admin" required>
                            <option value="{{ $status->status_admin }}" selected>{{ $status->status_admin }}</option>
                            <option value="In Process" class="font-semibold">In Process</option>
                            <option value="Approve" class="font-semibold">Approve</option>
                        </select>
                    </div>
                </div>
                <label class="font-semibold flex items-center gap-[10px]">
                    <input type="radio" name="tnc" class="w-[24px] h-[24px] appearance-none checked:border-[3px] checked:border-solid checked:border-white rounded-full checked:bg-[#2B82FE] ring ring-[#EEEEEE]" checked/>
                    I have read terms and conditions
                </label>
                <div class="flex items-center gap-5">
                    <button type="button" id="saveButton" class="w-full h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Save Course</button>
                </div>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert2 konfirmasi sebelum submit form
        document.getElementById('saveButton').addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah form untuk langsung disubmit
    
            // SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data yang sudah diupdate status tidak dapat diubah lagi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6436F1',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user mengonfirmasi, submit form
                    document.getElementById('updateForm').submit();
                }
            });
        });
    </script>
    <script>
        document.getElementById('hours').addEventListener('input', updateCourseTime);
        document.getElementById('minutes').addEventListener('input', updateCourseTime);
        
        function updateCourseTime() {
            let hours = document.getElementById('hours').value.padStart(2, '0');
            let minutes = document.getElementById('minutes').value.padStart(2, '0');
            
            // Ensure hours and minutes are set, if not, default to '00'
            if (hours === '') hours = '00';
            if (minutes === '') minutes = '00';
            
            // Set the formatted time in HH:MM:59 format
            document.getElementById('courseTimeHidden').value = `${hours}:${minutes}:00`;
        }
        </script>

    <script>
        function previewFile() {
            var preview = document.querySelector('.file-preview');
            var fileInput = document.querySelector('input[type=file]');

            if (fileInput.files.length > 0) {
                var reader = new FileReader();
                var file = fileInput.files[0]; // Get the first file from the input

                reader.onloadend = function () {
                    var img = preview.querySelector('.thumbnail-icon'); // Get the thumbnail image element
                    img.src = reader.result; // Update src attribute with the uploaded file
                    preview.classList.remove('hidden'); // Remove the 'hidden' class to display the preview
                }

                reader.readAsDataURL(file);
                fileInput.setAttribute('data-empty', 'false');
            } else {
                preview.classList.add('hidden'); // Hide preview if no file selected
                fileInput.setAttribute('data-empty', 'true');
            }
        }
    </script>

    <script>
        function handleActiveAnchor(element) {
            event.preventDefault();

            const group = element.getAttribute('data-group');
            
            // Reset all elements' aria-checked to "false" within the same data-group
            const allElements = document.querySelectorAll(`[data-group="${group}"][aria-checked="true"]`);
            allElements.forEach(el => {
                el.setAttribute('aria-checked', 'false');
            });
            
            // Set the clicked element's aria-checked to "true"
            element.setAttribute('aria-checked', 'true');
        }
    </script>
    
</body>
</html>