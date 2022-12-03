<!-- start::Topbar -->
<div class="flex flex-col">
    <header class="flex justify-between items-center h-16 py-4 px-6 bg-white">
        <!-- start::Mobile menu button -->
        <div class="flex items-center">
            <button @click="menuOpen = true" class="text-gray-500 hover:text-primary focus:outline-none lg:hidden transition duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                </svg>
               
            </button>
        </div>
        <div class="flex items-center"> <h1> Academic Year: {{ AcademicYear()->academicYear->name() }}
            <br>
           Semester: {{ AcademicYear()->semester?->name }}
        </h1> 

        </div>
        <!-- end::Mobile menu button 239-->

        <!-- start::Right side top menu -->
        <div class="flex items-center">
            <!-- start::Profile -->
            <div x-data="{ linkActive: false }" class="relative">
               
                <div @click="linkActive = !linkActive" class="cursor-pointer">
                 @if (auth()->user()->profile_picture)

                    <img src="{{ Storage::url(auth()->user()->profile_picture)}}" alt="profile photo" class="w-10 rounded-full">
                @else
                    <img src="{{auth()->user()->avatarUrl()}}" alt="profile photo" class="w-10 rounded-full">
                @endif
                </div>
                <!-- start::Submenu -->
                <div x-show="linkActive" @click.away="linkActive = false" x-cloak class="absolute right-0 w-40 top-11 border border-gray-300 z-20">
                    <!-- start::Submenu content -->
                    <div class="bg-white rounded">
                        <!-- start::Submenu link -->
                        <a x-data="{ linkHover: false }" class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20" @mouseover="linkHover = true" @mouseleave="linkHover = false"  href="{{ route('dashboard.profile') }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <div class="text-sm ml-3">
                                    <p class="text-gray-600 font-bold capitalize" :class=" linkHover ? 'text-primary' : ''">Profile</p>
                                </div>
                            </div>
                        </a>

                        <hr>
                        <!-- start::Submenu link -->
                        <form method="POST" action="{{ route('logout') }}" x-data="{ linkHover: false }" class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20" @mouseover="linkHover = true" @mouseleave="linkHover = false">
                        @csrf
                        <a >
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <button class="text-sm ml-3 text-gray-600 font-bold capitalize" :class=" linkHover ? 'text-primary' : ''" href="{{ route('logout') }}">
                                    Log out
                                </button>

                            </div>
                            </a>
                        </form>
      
                        <!-- end::Submenu link -->
                    </div>
                    <!-- end::Submenu content -->
                </div>
                <!-- end::Submenu -->
            </div>
            <!-- end::Profile -->
        </div>
        <!-- end::Right side top menu -->
    </header>
</div>
<!-- end::Topbar -->


<!-- 

                <nav class="py-2 border-b border-gray-100 backdrop-blur-sm bg-white/30 fixed inset-x-0 top-0 z-50">
                    <div class="lg:px-14 px-8 flex justify-between items-center bg-transparent">
                        <div class="flex items-center gap-4">
                            <button x-on:click="sidebar = (window.innerWidth >= 1024) ? true : !sidebar" class="lg:hidden bg-gray-800 text-white h-10 w-10 grid place-items-center text-sm font-semibold hover:bg-gray-600 ring ring-offset-2 ring-transparent focus:ring-gray-800 focus:bg-gray-800 transition-all duration-300">
                                <i class='bx bx-menu-alt-left'></i>
                            </button>
                            <a href="/">
                                <img src="{{ asset("img/brand/logo-1.png") }}" class="w-25 h-25 object-cover rounded-tr-xl rounded-bl-xl" alt="Hollux">
                            </a>
                        </div>
                        <div class="flex items-center gap-2 bg-transparent">
                            <span>{{ auth()->user()->name }}</span>
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-10 h-10 object-cover rounded-tr-xl rounded-bl-xl" alt="{{ auth()->user()->name }}">
                        </div>
                    </div>
                </nav>
 -->