<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  
  <style>
    .button {
        background-color: rgb(97, 126, 155); 
        color: white; 
        border: none; 
        border-radius: 8px; 
        padding: 10px 20px; 
        font-size: 16px; 
        font-weight: bold; 
        text-align: center; 
        cursor: pointer; 
        transition: all 0.3s ease; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
    }

    .button:hover {
        background-color: rgb(0, 60, 128); 
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); 
        transform: translateY(-2px); 
    }

    .button:active {
        background-color: darkslategray; 
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2); 
        transform: translateY(0); 
    }

    label {
    margin-bottom: 5px;
    }

    .col-md-6 {
        margin-bottom: 10px;
    }

    .btn-group .btn {
        border-radius: 0;
    }

    .buttonunduh {
        display: inline-block; /* Pastikan tombol bersifat inline-block */
        background-color: rgb(97, 126, 155); 
        color: white; 
        border: none; 
        border-radius: 8px; 
        padding: 10px 20px; 
        font-size: 16px; 
        font-weight: bold; 
        text-align: center; 
        cursor: pointer; 
        transition: all 0.3s ease; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
    }

    .buttonunduh:hover {
        background-color: rgb(0, 60, 128); 
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); 
        transform: translateY(-2px); 
    }
  </style>
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
                        <p class="font-extrabold text-[30px] leading-[45px]">Information Detail Data Management</p>
                        <p class="text-[#7F8190]">Provide high quality for best students</p>
                    </div>
                    <div class="relative">
                        <a href="{{ route('dashboard.unduh.excel') }}" class="buttonunduh">
                            <p class="font-semibold text-lg">Unduh All</p>
                        </a>
                    </div>
                    
                    {{-- <a href="{{ route('dashboard.joblevel.create') }}" class="h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D]">Add New Status</a> --}}
                </div>
                <form action="{{ route('dashboard.reportfilter.index') }}" method="GET" class="mt-5 flex flex-wrap gap-4">
                    {{-- Dropdown Pilihan A, B, C, D --}}
                    <div class="col-md-12">
                        <div class="form-group col-md-4">
                            <label for="option" class="font-weight-bold font-bold">Select Option</label>
                            <select id="option" name="option" class="form-control" onchange="handleOptionChange(event)">
                                <option value="" disabled selected>-- Select Option --</option>
                                <option value="status_admin" @if(request()->input('option') == 'status_admin') selected @endif>Administration Screening Status</option>
                                <option value="status_interview" @if(request()->input('option') == 'status_interview') selected @endif>Interview Status</option>
                                <option value="status_docclear" @if(request()->input('option') == 'status_docclear') selected @endif>Document Clearance Status</option>
                                <option value="status_oje" @if(request()->input('option') == 'status_oje') selected @endif>OJE Status</option>
                                <option value="status_onboarding" @if(request()->input('option') == 'status_onboarding') selected @endif>Onboarding Status</option>
                                <option value="created_at" @if(request()->input('option') == 'created_at') selected @endif>Application Date</option>
                                <option value="join_date" @if(request()->input('option') == 'join_date') selected @endif>Join Date</option>
                                <option value="specwork_id" @if(request()->input('option') == 'specwork_id') selected @endif>Specified Work Area</option>
                            </select>
                        </div>
                    </div>
                
                    {{-- Additional Filter for Option --}}
                    <div id="dateFields" class="hidden">
                        <label for="start_date" class="font-semibold mr-2">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-input" value="{{ request()->input('start_date') ?? '' }}">
                
                        <label for="end_date" class="font-semibold mr-2 ml-4">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form-input" value="{{ request()->input('end_date') ?? '' }}">
                    </div>

                    <div id="cityCheckboxes" class="hidden">
                        <label class="font-weight-bold mb-2 d-block">Select Cities</label>
                        <div class="row">
                            @foreach($cities as $city)
                                <div class="col-md-12 align-items-center">
                                    <input type="checkbox" id="{{ $city->city_id }}" name="cities[]" value="{{ $city->city_id }}" 
                                           @if(is_array(request()->input('cities')) && in_array($city->city_id, request()->input('cities'))) checked @endif>
                                    <label for="{{ $city->city_id }}" class="ml-2">{{ $city->city }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div id="optionAdmin" class="hidden">
                        <div class="form-group">
                            <label for="status_admin" class="font-semibold">Administration Screening Status</label>
                            <select id="status_admin" name="status_admin" class="form-select">
                                <option value="" disabled selected>-- Select Status --</option>
                                <option value="Passed" @if(request()->input('status_admin') == 'Passed') selected @endif>Passed</option>
                                <option value="In Process" @if(request()->input('status_admin') == 'In Process') selected @endif>In Process</option>
                                <option value="Not Passed" @if(request()->input('status_admin') == 'Not Passed') selected @endif>Not Passed</option>
                            </select>
                        </div>
                    </div>
                
                    <div id="optionPsikotes" class="hidden">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status_psikotes" class="font-semibold mr-2">Psychotest Status</label>
                                <select id="status_psikotes" name="status_psikotes" class="form-select">
                                    <option value="" disabled selected>-- Select Status --</option>
                                    <option value="Passed" @if(request()->input('status_psikotes') == 'Passed') selected @endif>Passed</option>
                                    <option value="In Process" @if(request()->input('status_psikotes') == 'In Process') selected @endif>In Process</option>
                                    <option value="Not Passed" @if(request()->input('status_psikotes') == 'Not Passed') selected @endif>Not Passed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                
                    <div id="optionInterview" class="hidden">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status_interview" class="font-semibold mr-2">Interview Status</label>
                                <select id="status_interview" name="status_interview" class="form-select">
                                    <option value="" disabled selected>-- Select Status --</option>
                                    <option value="Passed" @if(request()->input('status_interview') == 'Passed') selected @endif>Passed</option>
                                    <option value="In Process" @if(request()->input('status_interview') == 'In Process') selected @endif>In Process</option>
                                    <option value="Not Passed" @if(request()->input('status_interview') == 'Not Passed') selected @endif>Not Passed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                
                    <div id="optionDocclear" class="hidden">
                        <div class="form-group">
                            <label for="status_docclear" class="font-semibold mr-2">Document Clearance Status</label>
                            <select id="status_docclear" name="status_docclear" class="form-select">
                                <option value="" disabled selected>-- Select Status --</option>
                                <option value="Passed" @if(request()->input('status_docclear') == 'Passed') selected @endif>Passed</option>
                                <option value="In Process" @if(request()->input('status_docclear') == 'In Process') selected @endif>In Process</option>
                                <option value="Not Passed" @if(request()->input('status_docclear') == 'Not Passed') selected @endif>Not Passed</option>
                            </select>
                        </div>
                    </div>
                
                    <div id="optionOje" class="hidden">
                        <div class="form-group">
                            <label for="status_oje" class="font-semibold mr-2">OJE Status</label>
                            <select id="status_oje" name="status_oje" class="form-select">
                                <option value="" disabled selected>-- Select Status --</option>
                                <option value="Passed" @if(request()->input('status_oje') == 'Passed') selected @endif>Passed</option>
                                <option value="In Process" @if(request()->input('status_oje') == 'In Process') selected @endif>In Process</option>
                                <option value="Not Passed" @if(request()->input('status_oje') == 'Not Passed') selected @endif>Not Passed</option>
                            </select>
                        </div>
                    </div>
                
                    <div id="optionOnboarding" class="hidden">
                        <div class="form-group">
                            <label for="status_onboarding" class="font-semibold mr-2">Onboarding Status</label>
                            <select id="status_onboarding" name="status_onboarding" class="form-select">
                                <option value="" disabled selected>-- Select Status --</option>
                                <option value="Passed" @if(request()->input('status_onboarding') == 'Passed') selected @endif>Passed</option>
                                <option value="In Process" @if(request()->input('status_onboarding') == 'In Process') selected @endif>In Process</option>
                                <option value="Not Passed" @if(request()->input('status_onboarding') == 'Not Passed') selected @endif>Not Passed</option>
                            </select>
                        </div>
                    </div>
                
                    {{-- Submit Button --}}
                    <div class="flex w-full">
                        <div class="btn-group w-100" role="group">
                            <button type="submit" class="button btn btn-primary w-50">
                                Search
                            </button>
                            <button type="reset" class="button btn btn-secondary w-50">
                                Reset
                            </button>
                            <a href="{{ route('dashboard.unduhfilter.excel') }}" class="button btn btn-secondary w-50">
                                Unduh
                            </a>
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="course-list-container flex flex-col px-5 mt-[30px] gap-[30px]">
                <div class="course-list-header flex flex-nowrap justify-between pb-4 pr-10 border-b border-[#EEEEEE]">
                    <div class="flex shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">ID Apply</p>
                    </div>
                    <div class="flex shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">Job Title</p>
                    </div>
                    <div class="flex shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">Work Location</p>
                    </div>
                    <div class="flex shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">Status Akhir</p>
                    </div>
                    <div class="flex justify-center shrink-0 w-[150px]">
                        <p class="text-[#7F8190]">Date Created</p>
                    </div>
                    <div class="flex justify-center shrink-0 w-[120px]">
                        <p class="text-[#7F8190]">Action</p>
                    </div>
                </div>
                @forelse($statusapplys as $status)
                    <div class="list-items flex flex-nowrap justify-between pr-10">
                        <div class="flex shrink-0 w-[150px] items-center justify-center">
                            <p class="font-semibold">{{ $status->apply_id }}</p>
                        </div>
                        <div class="flex shrink-0 w-[150px] items-center justify-center">
                            <p class="font-semibold">{{ $status->job_title }}</p>
                        </div>
                        <div class="flex shrink-0 w-[150px] items-center justify-center">
                            <p class="font-semibold">{{ $status->workloc->workloc_name }}</p>
                        </div>
                        <div class="flex shrink-0 w-[150px]">
                            <div class="flex items-center gap-4">
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-bold text-lg">
                                        @if($status->status_admin === 'In Process')
                                            In Process Seleksi Administrasi
                                        @elseif($status->status_admin === 'Not Passed')
                                            Not Passed
                                            @elseif($status->status_admin === 'Passed')
                                                Passed
                                        @elseif($status->status_interview === 'In Process')
                                            In Process Seleksi Interview
                                        @elseif($status->status_interview === 'Not Passed')
                                            Not Passed
                                            @elseif($status->status_interview === 'Passed')
                                                Passed
                                        @elseif($status->status_docclear === 'In Process')
                                            In Process Seleksi Document Clearance
                                        @elseif($status->status_docclear === 'Not Passed')
                                            Not Passed
                                            @elseif($status->status_docclear === 'Passed')
                                                Passed
                                        @elseif($status->status_onboarding === 'In Process')
                                            In Process Seleksi Document Clearance
                                        @elseif($status->status_onboarding === 'Not Passed')
                                            Not Passed
                                            @elseif($status->status_onboarding === 'Passed')
                                                Passed
                                        @elseif($status->status_onboarding === 'Passed')
                                            Lolos
                                        @elseif($status->status_onboarding === 'In Process')
                                            In Process Seleksi Onboarding
                                        @elseif($status->status_onboarding === 'Not Passed')
                                            Not Passed
                                        @else
                                            Status belum tersedia
                                        @endif
                                    </p>
                                    {{-- Optional Subtitle --}}
                                    {{-- <p class="text-[#7F8190]">Additional Information</p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="flex shrink-0 w-[150px] items-center justify-center">
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($status->created_at)->format('d F Y') }}</p>
                        </div>
                        <div class="flex shrink-0 w-[120px] items-center">
                            <div class="relative h-[41px]">
                                <div class="menu-dropdown w-[120px] max-h-[41px] overflow-hidden absolute top-0 p-[10px_16px] bg-white flex flex-col gap-3 border border-[#EEEEEE] transition-all duration-300 hover:shadow-[0_10px_16px_0_#0A090B0D] rounded-[18px]">
                                    <button onclick="toggleMaxHeight(this)" class="flex items-center justify-between font-bold text-sm w-full">
                                        menu
                                        <img src="{{asset('images/icons/arrow-down.svg')}}" alt="icon">
                                    </button>
                                    <a href="{{ route('dashboard.report.show', ['apply' => $status->apply_id]) }}" class="flex items-center justify-between font-bold text-sm w-full">
                                        Detail
                                    </a>
                                    {{-- <a href="{{ route('dashboard.statusapply.edit', $status) }}" class="flex items-center justify-between font-bold text-sm w-full">
                                        Update
                                    </a> --}}
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
    <script>
        function handleOptionChange(event) {
            const option = event.target.value;
            
            const optionAdmin = document.getElementById('optionAdmin');
            const optionPsikotes = document.getElementById('optionPsikotes');
            const optionInterview = document.getElementById('optionInterview');
            const optionDocclear = document.getElementById('optionDocclear');
            const optionOje = document.getElementById('optionOje');
            const optionOnboarding = document.getElementById('optionOnboarding');
            const dateFields = document.getElementById('dateFields');
            
            // Handle option visibility
            optionAdmin.classList.add('hidden');
            optionPsikotes.classList.add('hidden');
            optionInterview.classList.add('hidden');
            optionDocclear.classList.add('hidden');
            optionOje.classList.add('hidden');
            optionOnboarding.classList.add('hidden');
    
            if (option === 'status_admin') {
                optionAdmin.classList.remove('hidden');
            } else if (option === 'status_psikotes') {
                optionPsikotes.classList.remove('hidden');
            } else if (option === 'status_interview') {
                optionInterview.classList.remove('hidden');
            } else if (option === 'status_docclear') {
                optionDocclear.classList.remove('hidden');
            } else if (option === 'status_oje') {
                optionOje.classList.remove('hidden');
            }else if (option === 'status_onboarding') {
                optionOnboarding.classList.remove('hidden');
            }else if (option === 'specwork_id') {
                cityCheckboxes.classList.remove('hidden');
            }else if (option === 'created_at' || option === 'join_date') {
                dateFields.classList.remove('hidden');
            }
        }

        document.querySelector('form').addEventListener('reset', function() {
        const optionAdmin = document.getElementById('optionAdmin');
        const optionPsikotes = document.getElementById('optionPsikotes');
        const optionInterview = document.getElementById('optionInterview');
        const optionDocclear = document.getElementById('optionDocclear');
        const optionOje = document.getElementById('optionOje');
        const optionOnboarding = document.getElementById('optionOnboarding');
        const dateFields = document.getElementById('dateFields');
        const cityCheckboxes = document.getElementById('cityCheckboxes');

        optionAdmin.classList.add('hidden');
        optionPsikotes.classList.add('hidden');
        optionInterview.classList.add('hidden');
        optionDocclear.classList.add('hidden');
        optionOje.classList.add('hidden');
        optionOnboarding.classList.add('hidden');
        dateFields.classList.add('hidden');
        cityCheckboxes.classList.add('hidden');
        
        // Optionally, reset select value
        const optionSelect = document.getElementById('option');
        optionSelect.value = "";
    });
    </script>
    
</body>
</html>