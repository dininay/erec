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
                    <a href="{{ route('dashboard.apply.index') }}" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Home</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="{{ route('dashboard.apply.show',  ['apply' => $statusapply->apply_id]) }}" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Manage Status Apply</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">Status Apply Details</a>
                </div>
            </div>
            <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
                <div class="flex gap-6 items-center">
                    
                    <div class="flex flex-col gap-5">
                        <h1 class="font-extrabold text-[30px] leading-[45px]">ID Apply : {{ $statusapply->status->apply_id }}</h1>
                        <div class="flex items-center gap-5">
                            <h4>User ID</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->user_id }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Register ID</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->reg_id }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Email</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Nama Lengkap</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>No Whatsapp Aktif</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->wa_aktif }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Applied Department</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->registjob->dept->dept_name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Applied Job Title</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->registjob->job_title }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Job Expertise</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->registjob->job_desc }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Applied Work Location</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->registjob->workloc->workloc_name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Specified Work Area</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->registjob->workloc->workloc_name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Application Date</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->created_at }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Administration Screening Status</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->status->status_admin }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Psychotest Status Psychotest Status </h4>
                            <div class="flex gap-[10px] items-center">
                                @if($statusapply->status === 'Passed')
                                    <p class="bg-green-500 font-semibold">Passed</p>
                                @else
                                    <p class="bg-red-500 font-semibold">Not Passed</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Interview Status</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->status->status_interview }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Document Clearance Status</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->status->status_docclear }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>OJE Status</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->status->status_oje }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Onboarding Status</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->status->status_onboarding }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Join Date</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->status->join_date }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Last Modified By</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->status->modified_by }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <h4>Modified date</h4>
                            <div class="flex gap-[10px] items-center">
                                <p class="font-semibold">{{ $statusapply->status->updated_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="relative">
                    <a href="#" id="more-button" class="toggle-button w-[46px] h-[46px] flex shrink-0 rounded-full items-center justify-center border border-[#EEEEEE]">
                        <img src="{{ asset('images/icons/more.svg')}}" alt="icon">
                    </a>
                    <div class="dropdown-menu absolute hidden right-0 top-[66px] w-[270px] flex flex-col gap-4 p-5 border border-[#EEEEEE] bg-white rounded-[18px] transition-all duration-300 shadow-[0_10px_16px_0_#0A090B0D]">
                        <a href="" class="flex gap-[10px] items-center">
                            <div class="w-5 h-5">
                                <img src="{{ asset('images/icons/profile-2user-outline.svg')}}" alt="icon">
                            </div>
                            <span class="font-semibold text-sm">Add Students</span>
                        </a>
                        <a href="" class="flex gap-[10px] items-center">
                            <div class="w-5 h-5">
                                <img src="{{ asset('images/icons/note-favorite-outline.svg')}}" alt="icon">
                            </div>
                            <span class="font-semibold text-sm">Edit Division Details</span>
                        </a>
                        <a href="" class="flex gap-[10px] items-center">
                            <div class="w-5 h-5">
                                <img src="{{ asset('images/icons/crown-outline.svg')}}" alt="icon">
                            </div>
                            <span class="font-semibold text-sm">Upload Certificate</span>
                        </a>
                        <a href="" class="flex gap-[10px] items-center text-[#FD445E]">
                            <div class="w-5 h-5">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5 4.98332C14.725 4.70832 11.9333 4.56665 9.15 4.56665C7.5 4.56665 5.85 4.64998 4.2 4.81665L2.5 4.98332" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.08325 4.14163L7.26659 3.04996C7.39992 2.25829 7.49992 1.66663 8.90825 1.66663H11.0916C12.4999 1.66663 12.6083 2.29163 12.7333 3.05829L12.9166 4.14163" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.7084 7.6167L15.1667 16.0084C15.0751 17.3167 15.0001 18.3334 12.6751 18.3334H7.32508C5.00008 18.3334 4.92508 17.3167 4.83341 16.0084L4.29175 7.6167" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.6084 13.75H11.3834" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.91675 10.4166H12.0834" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span class="font-semibold text-sm">Delete Course</span>
                        </a>
                    </div>
                </div> --}}
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