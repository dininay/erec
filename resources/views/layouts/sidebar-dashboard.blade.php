<div id="sidebar" class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
    <div class="w-full flex flex-col gap-[30px]">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center">
            <img src="{{asset('images/logo/ppa.png')}}" alt="logo">
        </a>
        <ul class="flex flex-col gap-3">
            <li>
                <h3 class="font-bold text-xs text-[#A5ABB2]">Data Test</h3>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 
                    @if(request()->routeIs('dashboard')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/home-hashtag.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard')) text-white @else hover:text-white @endif">
                        Dashboard
                    </p>
                </a>
            </li>
            @role('Crew')
            <li>
                <a href="{{ route('welcome') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 
                    @if(request()->routeIs('welcome')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/home-hashtag.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('welcome')) text-white @else hover:text-white @endif">
                        Home
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.statusapply.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.statusapply.index')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/arrow-circle-right.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.statusapply.index')) text-white @else hover:text-white @endif">
                        Applied Job
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.learning.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.learning.index', 'dashboard.learning.create', 'dashboard.learning.edit', 'dashboard.learning.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/sms.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.learning.index', 'dashboard.learning.create', 'dashboard.learning.edit', 'dashboard.learning.manage')) text-white @else hover:text-white @endif">
                        Job Test
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                    <div>
                        <img src="{{asset('images/icons/lock.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 hover:text-white">Logout</p>
                </a>
            </li>
            @endrole
            @role('HR')
            <li>
                <a href="{{ route('dashboard.course.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.course.index', 'dashboard.course.create', 'dashboard.course.edit', 'dashboard.course.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/sms-tracking.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.course.index', 'dashboard.course.create', 'dashboard.course.edit', 'dashboard.course.manage')) text-white @else hover:text-white @endif">
                        Courses
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.people.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.people.index', 'dashboard.people.create', 'dashboard.people.edit', 'dashboard.people.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/profile-2user.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.people.index', 'dashboard.people.create', 'dashboard.people.edit', 'dashboard.people.manage')) text-white @else hover:text-white @endif">
                        People
                    </p>
                </a>
            </li>
            @endrole
        </ul>
        @role('HR')
        <ul class="flex flex-col gap-3">
            <li>
                <h3 class="font-bold text-xs text-[#A5ABB2]">About Job</h3>
            </li>
            <li>
                <a href="{{ route('dashboard.job.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.job.index', 'dashboard.job.create', 'dashboard.job.edit', 'dashboard.job.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/arrow-circle-right.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.job.index', 'dashboard.job.create', 'dashboard.job.edit', 'dashboard.job.manage')) text-white @else hover:text-white @endif">
                        Regist Job
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.apply.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.apply.index', 'dashboard.apply.create', 'dashboard.apply.edit', 'dashboard.apply.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/profile.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.apply.index', 'dashboard.apply.create', 'dashboard.apply.edit', 'dashboard.apply.manage')) text-white @else hover:text-white @endif">
                        List Applicant
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.approval.administration.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.approval.administration.index', 'dashboard.approval.administration.create', 'dashboard.approval.administration.edit', 'dashboard.approval.administration.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/sms.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.approval.administration.index', 'dashboard.approval.administration.create', 'dashboard.approval.administration.edit', 'dashboard.approval.administration.manage')) text-white @else hover:text-white @endif">
                        Status Administration
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.approval.interview.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.approval.interview.index', 'dashboard.approval.interview.create', 'dashboard.approval.interview.edit', 'dashboard.approval.interview.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/security-user.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.approval.interview.index', 'dashboard.approval.interview.create', 'dashboard.approval.interview.edit', 'dashboard.approval.interview.manage')) text-white @else hover:text-white @endif">
                        Status Interview
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.approval.docclear.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.approval.docclear.index', 'dashboard.approval.docclear.create', 'dashboard.approval.docclear.edit', 'dashboard.approval.docclear.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/bill.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.approval.docclear.index', 'dashboard.approval.docclear.create', 'dashboard.approval.docclear.edit', 'dashboard.approval.docclear.manage')) text-white @else hover:text-white @endif">
                        Status Doc Clearance
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.approval.oje.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.approval.oje.index', 'dashboard.approval.oje.create', 'dashboard.approval.oje.edit', 'dashboard.approval.oje.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/note-favorite-outline.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.approval.oje.index', 'dashboard.approval.oje.create', 'dashboard.approval.oje.edit', 'dashboard.approval.oje.manage')) text-white @else hover:text-white @endif">
                        Status OJE
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.approval.onboarding.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.approval.onboarding.index', 'dashboard.approval.onboarding.create', 'dashboard.approval.onboarding.edit', 'dashboard.approval.onboarding.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/tick-circle.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.approval.onboarding.index', 'dashboard.approval.onboarding.create', 'dashboard.approval.onboarding.edit', 'dashboard.approval.onboarding.manage')) text-white @else hover:text-white @endif">
                        Status Onboarding
                    </p>
                </a>
            </li>
        </ul>
        <ul class="flex flex-col gap-3">
            <li>
                <h3 class="font-bold text-xs text-[#A5ABB2]">Master Data</h3>
            </li>
            <li>
                <a href="{{ route('dashboard.category.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.category.index', 'dashboard.category.create', 'dashboard.category.edit', 'dashboard.category.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/note-text.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.category.index', 'dashboard.category.create', 'dashboard.category.edit', 'dashboard.category.manage')) text-white @else hover:text-white @endif">
                        Category
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.jobtype.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.jobtype.index', 'dashboard.jobtype.create', 'dashboard.jobtype.edit', 'dashboard.jobtype.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/note-text.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.jobtype.index', 'dashboard.jobtype.create', 'dashboard.jobtype.edit', 'dashboard.jobtype.manage')) text-white @else hover:text-white @endif">
                        Job Type
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.joblevel.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.joblevel.index', 'dashboard.joblevel.create', 'dashboard.joblevel.edit', 'dashboard.joblevel.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/crown-outline.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.joblevel.index', 'dashboard.joblevel.create', 'dashboard.joblevel.edit', 'dashboard.joblevel.manage')) text-white @else hover:text-white @endif">
                        Job Level
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.workloc.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.workloc.index', 'dashboard.workloc.create', 'dashboard.workloc.edit', 'dashboard.workloc.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/notification.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.workloc.index', 'dashboard.workloc.create', 'dashboard.workloc.edit', 'dashboard.workloc.manage')) text-white @else hover:text-white @endif">
                        Work Location
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.division.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.division.index', 'dashboard.division.create', 'dashboard.division.edit', 'dashboard.division.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/receipt-text.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.division.index', 'dashboard.division.create', 'dashboard.division.edit', 'dashboard.division.manage')) text-white @else hover:text-white @endif">
                        Division
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.dept.index') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300
                    @if(request()->routeIs('dashboard.dept.index', 'dashboard.dept.create', 'dashboard.dept.edit', 'dashboard.dept.manage')) bg-[#2B82FE] text-white @else hover:bg-[#2B82FE] @endif">
                    <div>
                        <img src="{{asset('images/icons/sms.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 @if(request()->routeIs('dashboard.dept.index', 'dashboard.dept.create', 'dashboard.dept.edit', 'dashboard.dept.manage')) text-white @else hover:text-white @endif">
                        Department
                    </p>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                    <div>
                        <img src="{{asset('images/icons/lock.svg')}}" alt="icon">
                    </div>
                    <p class="font-semibold transition-all duration-300 hover:text-white">Logout</p>
                </a>
            </li>
        </ul>
        @endrole
    </div>
    <a href="">
        <div class="w-full flex gap-3 items-center p-4 rounded-[14px] bg-[#0A090B] mt-[30px]">
            <div>
                <img src="{{asset('images/icons/crown-round-bg.svg')}}" alt="icon">
            </div>
            <div class="flex flex-col gap-[2px]">
                <p class="font-semibold text-white">Get Pro</p>
                <p class="text-sm leading-[21px] text-[#A0A0A0]">Unlock features</p>
            </div>
        </div>
    </a>
</div>