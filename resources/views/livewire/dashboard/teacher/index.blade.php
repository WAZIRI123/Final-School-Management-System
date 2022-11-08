
    <div class="h-full bg-gray-200 p-8">
        <div class="mt-8 min-h-screen">
        <!-- start::Table -->
        <div class="bg-white rounded-lg px-8 py-6 my-16 overflow-x-scroll custom-scrollbar">
            @can('read teacher')
            @livewire('dashboard.teacher.crud')
            @endcan
        </div>
        </div>
        <!-- end::Table -->
    </div>
    <!-- end:Page content -->
