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
                            <p class="font-semibold">{{ $user->name }}</p>
                        </div>
                        <div class="w-[46px] h-[46px]">
                            <img src="{{asset('images/photos/default-photo.svg')}}" alt="photo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-10 px-5 mt-5">
                <div class="breadcrumb flex items-center gap-[30px]">
                    <a href="{{ route('dashboard.course.index') }}" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Home</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="{{ route('dashboard.course.show', $course) }}" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Manage Courses</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">New Course</a>
                </div>
            </div>
            <div class="header flex flex-col gap-1 px-5 mt-5">
                <h1 class="font-extrabold text-[30px] leading-[45px]">New Course</h1>
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

            <form method="POST" enctype="multipart/form-data" action="{{ route('dashboard.course.update', $course) }}" class="flex flex-col gap-[30px] w-[500px] mx-[70px] mt-10">
                @csrf
                @method('PUT')
                <div class="flex gap-5 items-center">
                    <input type="file" name="cover" id="icon" class="peer hidden" onchange="previewFile()" data-empty="true">
                    <div class="relative w-[100px] h-[100px] rounded-full overflow-hidden peer-data-[empty=true]:border-[3px] peer-data-[empty=true]:border-dashed peer-data-[empty=true]:border-[#EEEEEE]">
                        <div class="relative file-preview z-10 w-full h-full">
                            <img src="{{ Storage::url($course->cover) }}" class="thumbnail-icon w-full h-full object-cover" alt="thumbnail">
                        </div>
                        <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 text-center font-semibold text-sm text-[#7F8190]">Icon <br>Course</span>
                    </div>
                    <button type="button" class="flex shrink-0 p-[8px_20px] h-fit items-center rounded-full bg-[#0A090B] font-semibold text-white" onclick="document.getElementById('icon').click()">
                        Add Icon
                    </button>
                </div>
                <div class="flex flex-col gap-[10px]">
                    <p class="font-semibold">Course Name</p>
                    <div class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                        <div class="mr-[14px] w-6 h-6 flex items-center justify-center overflow-hidden">
                            <img src="{{asset('images/icons/note-favorite-outline.svg')}}" class="w-full h-full object-contain" alt="icon">
                        </div>
                        <input value="{{ $course->course_name }}" type="text" class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none" placeholder="Write your better course name" name="course_name" required>
                    </div>
                </div>
                @php
                    $courseTime = explode(':', $course->course_time);
                    $hours = $courseTime[0];
                    $minutes = $courseTime[1];
                @endphp
                    <div class="flex flex-col gap-[10px]">
                        <p class="font-semibold">Course Time</p>
                        <div class="flex items-center w-[500px] h-[52px] p-[14px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B] gap-[10px]">
                            <div class="flex items-center">
                                <label for="hours" class="mr-2 font-semibold">Hours:</label>
                                <input value="{{ $hours }}" type="number" id="hours" min="0" max="23" placeholder="HH" class="w-16 p-2 text-center border rounded" required>
                            </div>
                            <div class="flex items-center">
                                <label for="minutes" class="mr-2 font-semibold">Minutes:</label>
                                <input value="{{ $minutes }}" type="number" id="minutes" min="0" max="59" placeholder="MM" class="w-16 p-2 text-center border rounded" required>
                            </div>
                            <input type="hidden" name="course_time" id="courseTimeHidden">
                        </div>
                    </div>
                <div class="group/category flex flex-col gap-[10px]">
                    <p class="font-semibold">Category</p>
                    <div class="peer flex items-center p-[12px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                        <div class="mr-[10px] w-6 h-6 flex items-center justify-center overflow-hidden">
                            <img src="{{asset('images/icons/bill.svg')}}" class="w-full h-full object-contain" alt="icon">
                        </div>
                        <select id="category" class="pl-1 font-semibold focus:outline-none w-full text-[#0A090B] invalid:text-[#7F8190] invalid:font-normal appearance-none bg-[url('{{asset('images/icons/arrow-down.svg')}}')] bg-no-repeat bg-right" name="cat_id" required>
                            <option value="{{ $course->category->cat_id }}" selected>{{ $course->category->cat_name }}</option>
                            @forelse($categories as $category)
                            <option value="{{ $category->cat_id }}" class="font-semibold">{{ $category->cat_name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="flex flex-col gap-[10px]">
                    <p class="font-semibold">Course Type</p>
                    <input type="hidden" name="course_type" id="course_type" value="">
                    <div class="flex gap-5 items-center">
                        <a href="#" class="group relative flex flex-col w-full items-center gap-5 p-[30px_16px] border border-[#EEEEEE] rounded-[30px] transition-all duration-300 aria-checked:border-2 aria-checked:border-[#0A090B]" data-group="course-type" aria-checked="false" onclick="handleActiveAnchor(this)">
                            <div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden">
                                <img src="{{asset('images/icons/onboarding.svg')}}" class="w-full h-full" alt="icon">
                            </div>
                            <span class="text-center mx-auto font-semibold">Onboarding</span>
                            <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-[24px] right-0 hidden transition-all duration-300 group-aria-checked:block">
                                <img src="{{asset('images/icons/tick-circle.svg')}}" alt="icon">
                            </div>
                        </a>
                        <a href="#" class="group relative flex flex-col w-full items-center gap-5 p-[30px_16px] border border-[#EEEEEE] rounded-[30px] transition-all duration-300 aria-checked:border-2 aria-checked:border-[#0A090B]" data-group="course-type" aria-checked="false" onclick="handleActiveAnchor(this)">
                            <div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden">
                                <img src="{{asset('images/icons/module.svg')}}" class="w-full h-full" alt="icon">
                            </div>
                            <span class="text-center mx-auto font-semibold">CBT Module</span>
                            <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-[24px] right-0 hidden transition-all duration-300 group-aria-checked:block">
                                <img src="{{asset('images/icons/tick-circle.svg')}}" alt="icon">
                            </div>
                        </a>
                        <a href="#" class="group relative flex flex-col w-full items-center gap-5 p-[30px_16px] border border-[#EEEEEE] rounded-[30px] transition-all duration-300 aria-checked:border-2 aria-checked:border-[#0A090B]" data-group="course-type" aria-checked="false" onclick="handleActiveAnchor(this)">
                            <div class="w-[70px] h-[70px] flex shrink-0 overflow-hidden">
                                <img src="{{asset('images/icons/job.svg')}}" class="w-full h-full" alt="icon">
                            </div>
                            <span class="text-center mx-auto font-semibold">Job-Ready</span>
                            <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-[24px] right-0 hidden transition-all duration-300 group-aria-checked:block">
                                <img src="{{asset('images/icons/tick-circle.svg')}}" alt="icon">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="flex flex-col gap-[10px]">
                    <p class="font-semibold">Publish Date</p>
                    <div class="flex gap-[10px] items-center" name="publish_date">
                        <a href="#" class="group relative flex w-full items-center gap-[14px] p-[14px_16px] border border-[#EEEEEE] rounded-full transition-all duration-300 aria-checked:border-2 aria-checked:border-[#0A090B]" data-group="publish-date" aria-checked="false" onclick="handleActiveAnchor(this)">
                            <div class="w-[24px] h-[24px] flex shrink-0 overflow-hidden">
                                <img src="{{asset('images/icons/clock.svg')}}" class="w-full h-full" alt="icon">
                            </div>
                            <span value="Active Now" class="font-semibold">Active Now</span>
                            <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 right-0 hidden transition-all duration-300 group-aria-checked:block">
                                <img src="{{asset('images/icons/tick-circle.svg')}}" alt="icon">
                            </div>
                        </a>
                        <a href="#" class="group relative flex w-full items-center gap-[14px] p-[14px_16px] border border-[#EEEEEE] rounded-full transition-all duration-300 aria-checked:border-2 aria-checked:border-[#0A090B] disabled:border-[#EEEEEE]" data-group="publish-date" aria-checked="false" onclick="event.preventDefault()" disabled>
                            <div class="w-[24px] h-[24px] flex shrink-0 overflow-hidden">
                                <img src="{{asset('images/icons/calendar-add-disabled.svg')}}" class="w-full h-full" alt="icon">
                            </div>
                            <span value="Schedule Later" class="font-semibold text-[#EEEEEE]">Schedule for Later</span>
                            <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 right-0 hidden transition-all duration-300 group-aria-checked:block">
                                <img src="{{asset('images/icons/tick-circle.svg')}}" alt="icon">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="group/access flex flex-col gap-[10px]">
                    <p class="font-semibold">Access Type</p>
                    <div class="peer flex items-center p-[12px_16px] rounded-full border border-[#EEEEEE] transition-all duration-300 focus-within:border-2 focus-within:border-[#0A090B]">
                        <div class="mr-[10px] w-6 h-6 flex items-center justify-center overflow-hidden">
                            <img src="{{asset('images/icons/security-user.svg')}}" class="w-full h-full object-contain" alt="icon">
                        </div>
                        <select id="access" class="pl-1 font-semibold focus:outline-none w-full text-[#0A090B] invalid:text-[#7F8190] invalid:font-normal appearance-none bg-[url('{{asset('images/icons/arrow-down.svg')}}')] bg-no-repeat bg-right" name="access_type" required>
                            <option value="{{ $course->access_type }}" selected >{{ $course->access_type }}</option>
                            <option value="Invitation Only" class="font-semibold">Invitation Only</option>
                        </select>
                    </div>
                </div>
                <label class="font-semibold flex items-center gap-[10px]"
                    ><input
                    type="radio"
                    name="tnc"
                    class="w-[24px] h-[24px] appearance-none checked:border-[3px] checked:border-solid checked:border-white rounded-full checked:bg-[#2B82FE] ring ring-[#EEEEEE]"
                    checked/>
                    I have read terms and conditions
                </label>
                <div class="flex items-center gap-5">
                    {{-- <a href="" class="w-full h-[52px] p-[14px_20px] bg-[#0A090B] rounded-full font-semibold text-white transition-all duration-300 text-center">Add to Draft</a> --}}
                    <button type="submit" class="w-full h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Save Course</button>
                </div>
            </form>
        </div>
    </section>

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