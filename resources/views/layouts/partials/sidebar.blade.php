<!-- start::Black overlay -->
<div :class="menuOpen ? 'block' : 'hidden'" @click="menuOpen = false"
    class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
<!-- end::Black overlay -->
<aside :class="menuOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 bg-secondary overflow-y-auto lg:translate-x-0 lg:inset-0 custom-scrollbar">
    <!-- start::Logo -->
    <div class="flex items-center justify-center bg-black bg-opacity-30 h-16">
        <h1 class="text-gray-100 text-lg font-bold uppercase tracking-widest">
            Sms System
        </h1>
    </div>
    <!-- end::Logo -->

    <!-- start::Navigation -->
    <nav class="py-10 custom-scrollbar">
        <!-- start::Menu link -->
        <x-side-menu.div-link route="dashboard.index" title="Dashboard" />
        <!-- end::Menu link -->

        <p class="text-xs text-gray-600 mt-10 mb-2 px-6 uppercase">school activities</p>

        <!-- start::Menu link -->
        @can('menu-school')
        <x-side-menu.div-link route="dashboard.schools.index" title="School" />
        {{-- schoool Setting --}}
        <x-side-menu.div-link route="dashboard.schools.settings-school" title="School Settings" />
        @endcan
        <!-- end::Menu link -->
        <!-- start::menu link -->
        @can('menu-timetable')
        <div x-data="{ linkHover: false, linkActive: false }">

            <div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
                class="{{ (request()->is('dashboard/time-table/*')) ? 'bg-black bg-opacity-30' : '' }} flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class=" linkHover || linkActive ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    <span class="ml-3">TimeTable</span>
                </div>
                <svg class="w-3 h-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
            <!-- start::Submenu -->
            <ul x-show="linkActive" x-collapse.duration.300ms="" class="text-gray-400"
                style="overflow: hidden; height: 0px;">
                @can('create timetable')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.time-tables.index" title="Create Timetable" />
               
                <!-- end::Submenu link -->
                @endcan
                @can('create timetabletimeslot')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.time-tables.timetable-record-slot" title="Create TimeTableRecord" />
            
                <!-- end::Submenu link -->
                @endcan
                @can('read timetable')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.time-tables.manage-timetable-record" title="view Timetable" />
                <!-- end::Submenu link -->
                @endcan

            </ul>
            <!-- end::Submenu  graduations-->
        </div>
        @endcan
        <!-- end::Menu link -->
        <!-- start::Menu link -->
        @can('menu-parent')
        <x-side-menu.div-link route="dashboard.parents.index" title="Parent" />

        @endcan
        <!-- end::Menu link -->

        <!-- start::Menu link -->

        <!-- end::Menu link -->
        @can('menu-student')
        <div x-data="{ linkHover: false, linkActive: false }">
            <div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
                class="{{ (request()->is('dashboard/students/*')) ? 'bg-black bg-opacity-30' : '' }} flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class=" linkHover || linkActive ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    <span class="ml-3">Student</span>
                </div>
                <svg class="w-3 h-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
            <!-- start::Submenu -->
            <ul x-show="linkActive" x-collapse.duration.300ms="" class="text-gray-400"
                style="overflow: hidden; height: 0px;">
                @can('read student')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.students.index" title="Students" />

                <!-- end::Submenu link -->
                @endcan
                @can('graduate student')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.graduate-students.index" title="Student Graduate" />
                <!-- end::Submenu link -->
                @endcan
                @can('view graduations')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.graduate-students.graduations" title="Manage Graduation" />


                <!-- end::Submenu link -->
                @endcan
                @can('promote student')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.promote-students.index" title="Promote Student" />

                <!-- end::Submenu link -->
                @endcan

                @can('promote student')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.promote-students.promotion" title="Manage Promotion" />
    

                <!-- end::Submenu link -->
                @endcan

            </ul>
            <!-- end::Submenu  graduations-->
        </div>
        @endcan
        <!-- start::Menu link -->
        @can('menu-teacher')
        <x-side-menu.div-link route="dashboard.teachers.index" title="Teacher" />
        @endcan
        <!-- end::Menu link -->

                <!-- start::Menu link -->
                @can('menu-admin')
                <x-side-menu.div-link route="dashboard.admins.index" title="Admin" />
                @endcan
                <!-- end::Menu link -->

        <!-- start::Menu link -->
        @can('menu-class')
        <x-side-menu.div-link route="dashboard.classes.index" title="Classes" />
        @endcan
        <!-- end::Menu link -->

        @can('menu-academic-year')
        {{-- start menu wrapper --}}
        <div x-data="{ linkHover: false, linkActive: false }">
            <x-side-menu.menu-wrapper route="dashboard/academic" title="Academic" />
            <!-- start::Submenu -->
            <ul x-show="linkActive" x-collapse.duration.300ms="" class="text-gray-400"
                style="overflow: hidden; height: 0px;">
                @can('menu-subject')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.subjects.index" title="Subject" />

                <!-- end::Submenu link -->
                @endcan
                @can('menu-academic-year')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.academic-years.index" title="Academic Year" />
                <!-- end::Submenu link -->
                @endcan
                @can('menu-academic-year')
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.semesters.index" title="Semester" />

                <!-- end::Submenu link -->
                @endcan

            </ul>
            <!-- end::Submenu  graduations-->
        </div>
       {{-- end menu wrapper --}}
       @endcan
 {{-- start menu wrapper --}}
 <div x-data="{ linkHover: false, linkActive: false }">
    <x-side-menu.menu-wrapper route="dashboard/exam" title="Exam" />
    <!-- start::Submenu -->
    <ul x-show="linkActive" x-collapse.duration.300ms="" class="text-gray-400"
        style="overflow: hidden; height: 0px;">
        @can('create exam')
        <!-- start::Submenu link -->
        <x-side-menu.list-link route="dashboard.exams.index" title="Create Exam" />

        <!-- end::Submenu link -->
        @endcan
             @can('menu-exam')

                      <!-- start::Submenu link -->
                      <x-side-menu.list-link route="dashboard.exams.marking.mark-exam" title="Mark Exam" />

                      <!-- end::Submenu link -->
                <!-- start::Submenu link -->
                <x-side-menu.list-link route="dashboard.exams.marking.manage-exam-mark" title="Manage ExamMark" />

                <!-- end::Submenu link -->
        @endcan
@if (auth()->user()->hasAnyRole(['Admin', 'Teacher','Parent','Student']))
@can('menu-result')

<x-side-menu.list-link route="dashboard.exams.result.index" title="Results" />

@endcan 
@endif

  

    </ul>
    <!-- end::Submenu  graduations-->
</div>
{{-- end menu wrapper --}}


        <p class="text-xs text-gray-600 mt-10 mb-2 px-6 uppercase">Account</p>

        <!-- start::Menu link -->
        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200" href="{{ route('dashboard.profile') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                :class=" linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                Profile
            </span>
        </a>
        <!-- end::Menu link  -->

                    <!-- start::Menu link -->
                    <form method="POST" action="{{ route('logout') }}" class="grid gap-2">
                        @csrf
                        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"  class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class=" linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                                Logout
                            </span>
                        </a>
                        </form>
                        <!-- end::Menu link -->

    </nav>
    <!-- end::Navigation -->
</aside>