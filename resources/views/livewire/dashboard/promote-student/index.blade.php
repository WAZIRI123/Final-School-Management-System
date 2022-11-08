<div class="h-full bg-gray-200 p-8">
    <div class="mt-8 min-h-screen">
        <!-- start::Table -->
        <div class="bg-white rounded-lg px-8 py-6 my-16 overflow-x-scroll custom-scrollbar">

            
            @can('promote student')
            @livewire('dashboard.promote-student.promote-student',['old_class'=>$old_class,'old_section'=>$old_section,'new_class'=>$new_class,'new_section'=>$new_section])
            @endcan
        </div>
        <!-- end::Table -->
    </div>
    <!-- end:Page content -->
    </div>