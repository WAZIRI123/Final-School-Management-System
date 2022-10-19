@props(['route','title'])
<div x-data="{ linkHover: false, linkActive: false }">
<div @mouseover="linkHover = true" @mouseleave="linkHover = false" @click="linkActive = !linkActive"
class="{{ (request()->is($route.'/*')) ? 'bg-black bg-opacity-30' : '' }} flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
<div class="flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200"
        :class=" linkHover || linkActive ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
        </path>
    </svg>
    <span class="ml-3">{{ $title }}</span>
</div>
<svg class="w-3 h-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none"
    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
</svg>
</div>