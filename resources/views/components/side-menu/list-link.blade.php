@props(['route','title'])
<li
class="{{ !Route::currentRouteNamed($route) ? '' : 'bg-black bg-opacity-30' }} flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
<a href="{{ route($route ) }}" class="flex items-center">
    <span class="mr-2 text-sm">•</span>
    <span class="overflow-ellipsis">  {{ $title }}</span>
</a>
</li>