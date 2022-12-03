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
        <!-- end::Mobile menu button -->

        <!-- start::Right side top menu -->
        <div class="flex items-center">
            <!-- start::Profile -->
            <div x-data="{ linkActive: false }" class="relative">
                <!-- start::Main link -->
                <div @click="linkActive = !linkActive" class="cursor-pointer">
 
                </div>
                <!-- end::Main link -->

                <!-- start::Submenu -->
                <div x-show="linkActive" @click.away="linkActive = false" x-cloak class="absolute right-0 w-40 top-11 border border-gray-300 z-20">
                    <!-- start::Submenu content -->
                    <div class="bg-white rounded">
                        <!-- start::Submenu link -->
                        <a x-data="{ linkHover: false }" href="{{ route('dashboard.profile.index') }}" class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20" @mouseover="linkHover = true" @mouseleave="linkHover = false">
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
                        <a href="{{ route('logout') }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <button class="text-sm ml-3 text-gray-600 font-bold capitalize" :class=" linkHover ? 'text-primary' : ''">
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
