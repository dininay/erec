<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
            <div class="flex flex-col px-5 mt-5">
                <div class="w-full flex justify-between items-center">
                    <div class="flex flex-col gap-1">
                        <p class="font-extrabold text-[30px] leading-[45px]">Manage Status Administration</p>
                        <p class="text-[#7F8190]">Provide high quality for best students</p>
                    </div>
                    {{-- <a href="{{ route('dashboard.joblevel.create') }}" class="h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D]">Add New Status</a> --}}
                </div>
            </div>
            <div class="course-list-container flex flex-col px-5 mt-[30px] gap-[30px]">
                <div class="course-list-header flex flex-nowrap justify-between pb-4 pr-10 border-b border-[#EEEEEE]">
                    <div class="flex shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">User</p>
                    </div>
                    <div class="flex shrink-0 w-[200px]">
                        <p class="text-[#7F8190]">ID Apply</p>
                    </div>
                    <div class="flex shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">Job Title</p>
                    </div>
                    <div class="flex shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">CV</p>
                    </div>
                    <div class="flex shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">Photos</p>
                    </div>
                    <div class="flex shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">Status Administration</p>
                    </div>
                    <div class="flex justify-center shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">Administration Date</p>
                    </div>
                    <div class="flex justify-center shrink-0 w-[120px]">
                        <p class="text-[#7F8190]">Action</p>
                    </div>
                </div>
                @forelse($statuss as $status)
                    <div class="list-items flex flex-nowrap justify-between pr-10">
                        <div class="flex shrink-0 w-[150px] items-center justify-center">
                            <p class="font-semibold">{{ $status->apply->user->name }}</p>
                        </div>
                        <div class="flex shrink-0 w-[150px] items-center justify-center">
                            <p class="font-semibold">{{ $status->apply_id }}</p>
                        </div>
                        <div class="flex shrink-0 w-[150px] items-center justify-center">
                            <p class="font-semibold">{{ $status->apply->registjob->job_title }}</p>
                        </div>
                        <div class="flex shrink-0 w-[150px] items-center justify-center">
                            <div class="flex gap-2 items-center">
                                <a 
                                    href="{{ asset('images/' . $status->apply->reg_id . '/' . $status->apply->details->cv) }}" 
                                    target="_blank" 
                                    class="text-blue-500 hover:text-blue-700"
                                >
                                    <i class="fa fa-eye h-6 w-6"></i>
                                </a>
                                <a 
                                    href="{{ asset('images/' . $status->apply->reg_id . '/' . $status->apply->details->cv) }}" 
                                    download 
                                    class="text-green-500 hover:text-green-700"
                                >
                                    <i class="fa fa-download h-6 w-6"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex shrink-0 w-[150px] items-center justify-center">
                            <div class="flex gap-2 items-center">
                                <a 
                                    href="{{ asset('images/' . $status->apply->reg_id . '/' . $status->apply->details->photo) }}" 
                                    target="_blank" 
                                    class="text-blue-500 hover:text-blue-700"
                                >
                                    <i class="fa fa-eye h-6 w-6"></i>
                                </a>
                                <a 
                                    href="{{ asset('images/' . $status->apply->reg_id . '/' . $status->apply->details->photo) }}" 
                                    download 
                                    class="text-green-500 hover:text-green-700"
                                >
                                    <i class="fa fa-download h-6 w-6"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex shrink-0 w-[150px]">
                            <div class="flex items-center gap-4">
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-bold text-lg">{{ $status->status_admin }}</p>
                                    {{-- <p class="text-[#7F8190]">Beginners</p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="flex shrink-0 w-[150px] items-center justify-center">
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($status->admin_date)->format('d F Y') }}</p>
                        </div>
                        <div class="flex shrink-0 w-[120px] items-center">
                            <div class="relative h-[41px]">
                                <div class="menu-dropdown w-[120px] max-h-[41px] overflow-hidden absolute top-0 p-[10px_16px] bg-white flex flex-col gap-3 border border-[#EEEEEE] transition-all duration-300 hover:shadow-[0_10px_16px_0_#0A090B0D] rounded-[18px]">
                                    <button onclick="toggleMaxHeight(this)" class="flex items-center justify-between font-bold text-sm w-full">
                                        menu
                                        <img src="{{asset('images/icons/arrow-down.svg')}}" alt="icon">
                                    </button>
                                    <a href="{{ route('dashboard.approval.administration.edit', $status->people_status_id) }}" class="flex items-center justify-between font-bold text-sm w-full">
                                        Edit
                                    </a>
                                    {{-- <form method="POST" action="{{ route('dashboard.approval.administration.destroy', $status) }}" class="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center justify-between font-bold text-sm w-full text-[#FD445E]">
                                            Delete
                                        </button>
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
            {{-- <div id="pagiantion" class="flex gap-4 items-center mt-[37px] px-5">
                <button class="flex items-center justify-center border border-[#EEEEEE] rounded-full w-10 h-10 font-semibold transition-all duration-300 hover:text-white hover:bg-[#0A090B] text-[#7F8190]">1</button>
                <button class="flex items-center justify-center border border-[#EEEEEE] rounded-full w-10 h-10 font-semibold transition-all duration-300 hover:text-white hover:bg-[#0A090B] text-[#7F8190]">2</button>
                <button class="flex items-center justify-center border border-[#EEEEEE] rounded-full w-10 h-10 font-semibold transition-all duration-300 hover:text-white hover:bg-[#0A090B] text-white bg-[#0A090B]">3</button>
                <button class="flex items-center justify-center border border-[#EEEEEE] rounded-full w-10 h-10 font-semibold transition-all duration-300 hover:text-white hover:bg-[#0A090B] text-[#7F8190]">4</button>
                <button class="flex items-center justify-center border border-[#EEEEEE] rounded-full w-10 h-10 font-semibold transition-all duration-300 hover:text-white hover:bg-[#0A090B] text-[#7F8190]">5</button>
            </div> --}}
        </div>
    </section>

    <script>
        function toggleMaxHeight(button) {
            const menuDropdown = button.parentElement;
            menuDropdown.classList.toggle('max-h-fit');
            menuDropdown.classList.toggle('shadow-[0_10px_16px_0_#0A090B0D]');
            menuDropdown.classList.toggle('z-10');
        }

        document.addEventListener('click', function(event) {
            const menuDropdowns = document.querySelectorAll('.menu-dropdown');
            const clickedInsideDropdown = Array.from(menuDropdowns).some(function(dropdown) {
                return dropdown.contains(event.target);
            });
            
            if (!clickedInsideDropdown) {
                menuDropdowns.forEach(function(dropdown) {
                    dropdown.classList.remove('max-h-fit');
                    dropdown.classList.remove('shadow-[0_10px_16px_0_#0A090B0D]');
                    dropdown.classList.remove('z-10');
                });
            }
        });
    </script>
</body>
</html>