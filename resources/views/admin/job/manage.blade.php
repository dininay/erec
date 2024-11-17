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
                        <img src="{{ asset('images/icons/search.svg')}}" alt="icon">
                    </button>
                </form>
                <div class="flex items-center gap-[30px]">
                    <div class="flex gap-[14px]">
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{ asset('images/icons/receipt-text.svg')}}" alt="icon">
                        </a>
                        <a href="" class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{ asset('images/icons/notification.svg')}}" alt="icon">
                        </a>
                    </div>
                    <div class="h-[46px] w-[1px] flex shrink-0 border border-[#EEEEEE]"></div>
                    <div class="flex gap-3 items-center">
                        <div class="flex flex-col text-right">
                            <p class="text-sm text-[#7F8190]">Howdy</p>
                            <p class="font-semibold">{{ $user->name }}</p>
                        </div>
                        <div class="w-[46px] h-[46px]">
                            <img src="{{ asset('images/photos/default-photo.svg')}}" alt="photo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-10 px-5 mt-5">
                <div class="breadcrumb flex items-center gap-[30px]">
                    <a href="{{ route('dashboard.job.index') }}" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Home</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="{{ route('dashboard.job.show', $job) }}" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Manage Job</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">Job Details</a>
                </div>
            </div>
            <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
                <div class="flex gap-6 items-center">
                    
                    <div class="flex flex-col gap-5">
                        <h1 class="font-extrabold text-[30px] leading-[45px]">{{ $job->job_title }}</h1>
                        <div class="flex items-center gap-5">
                            <span>Tanggal Dibuat : </span>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($job->created_at)->format('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <span>Job Description : </span>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $job->job_desc }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <span>Job Qualification : </span>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $job->qualification }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <span>Job Responsibilities : </span>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $job->job_respons }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <span>Division : </span>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $job->division->div_name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <span>Departement : </span>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $job->dept->dept_name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <span>Work Location : </span>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $job->workloc->workloc_name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <span>Job Type : </span>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $job->jobtype->jobtype_name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <span>Job Level : </span>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $job->joblevel->joblevel_name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <span>Status Job : </span>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $job->status_job }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuButton = document.getElementById('more-button');
            const dropdownMenu = document.querySelector('.dropdown-menu');
        
            menuButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
            });
        
            // Close the dropdown menu when clicking outside of it
            document.addEventListener('click', function (event) {
            const isClickInside = menuButton.contains(event.target) || dropdownMenu.contains(event.target);
            if (!isClickInside) {
                dropdownMenu.classList.add('hidden');
            }
            });
        });
    </script>
    
</body>
</html>