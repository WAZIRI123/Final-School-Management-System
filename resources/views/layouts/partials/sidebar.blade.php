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
        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            href="{{ route('dashboard.index') }}"
            class="{{ !Route::currentRouteNamed('dashboard.index') ? '' : 'bg-black bg-opacity-30' }}
                    flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                Dashboard
            </span>
        </a>
        <!-- end::Menu link -->

        <p class="text-xs text-gray-600 mt-10 mb-2 px-6 uppercase">school activities</p>

        <!-- start::Menu link -->
        @can('menu-school')
        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            href="{{ route('dashboard.schools.index') }}"
            class="{{ !Route::currentRouteNamed('dashboard.schools.index') ? '' : 'bg-black bg-opacity-30' }} flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                School
            </span>
        </a>
        {{-- schoool Setting --}}
        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            href="{{ route('dashboard.schools.settings-school') }}"
            class="{{ !Route::currentRouteNamed('dashboard.schools.settings-school') ? '' : 'bg-black bg-opacity-30' }} flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                school settings
            </span>
        </a>
        @endcan
        <!-- end::Menu link -->

        <!-- start::Menu link -->
        @can('menu-student')

        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            href="{{ route('dashboard.students.index') }}"
            class="{{ !Route::currentRouteNamed('dashboard.students.index') ? '' : 'bg-black bg-opacity-30' }} flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                Students
            </span>
        </a>
        @endcan
        <!-- end::Menu link -->

        <!-- start::Menu link -->
        @can('menu-parent')

        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            href="{{ route('dashboard.parents.index') }}"
            class="{{ !Route::currentRouteNamed('dashboard.parents.index') ? '' : 'bg-black bg-opacity-30' }} flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                Parents
            </span>
        </a>
        @endcan
        <!-- end::Menu link -->
        <!-- start::Menu link -->
        @can('menu-teacher')

        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            href="{{ route('dashboard.teachers.index') }}"
            class="{{ !Route::currentRouteNamed('dashboard.teachers.index') ? '' : 'bg-black bg-opacity-30' }} flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                Teacher
            </span>
        </a>
        @endcan
        <!-- end::Menu link -->

                <!-- start::Menu link -->
                @can('menu-class')

                <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
                    href="{{ route('dashboard.classes.index') }}"
                    class="{{ !Route::currentRouteNamed('dashboard.classes.index') ? '' : 'bg-black bg-opacity-30' }} flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                        :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                        Classes
                    </span>
                </a>
                @endcan
                <!-- end::Menu link -->

        <!-- start::Menu link -->
        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            class="{{ !Route::currentRouteNamed('dashboard.car-reservations.index') ? '' : 'bg-black bg-opacity-30' }} flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                Car Reantal
            </span>
        </a>
        <!-- end::Menu link -->
        <!-- start::Menu link -->
        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            class="{{ !Route::currentRouteNamed('dashboard.package-reservations.index') ? '' : 'bg-black bg-opacity-30' }} flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                Packagies
            </span>
        </a>
        <!-- end::Menu link -->

        <p class="text-xs text-gray-600 mt-10 mb-2 px-6 uppercase">Account</p>

        <!-- start::Menu link -->
        <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
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
            <a x-data="{ linkHover: false }" @mouseover="linkHover = true" @mouseleave="linkHover = false"
                class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
                    :class=" linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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