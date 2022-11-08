<div class="h-full bg-gray-200 p-8">
    <div class="mt-8 min-h-screen">
        @can('read student')
        <!-- end::Stats -->
        <!-- start::Table -->
        <div class="bg-white rounded-lg px-8 py-6 my-16 overflow-x-scroll custom-scrollbar">
          
            @livewire('dashboard.student.crud')
        
            {{-- <h4 class="text-xl font-semibold">Recent Reservations</h4>
            <table class="w-full my-8 whitespace-nowrap">
                <thead class="bg-secondary text-gray-100 font-bold">
                    <td>
                    </td>
                    <td class="py-2 pl-2">
                        name
                    </td>
                    <td class="py-2 pl-2">
                        Email
                    </td>
                    <td class="py-2 pl-2">
                        Phone
                    </td>
                    <td class="py-2 pl-2">
                    Gender
                    </td>
                    <td class="py-2 pl-2">
                        Address
                    </td>
                </thead>
                <tbody class="text-sm">
                    @forelse ($students as $student)
                    <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                        <td class="py-3 pl-2">
                            <input type="checkbox" class="rounded focus:ring-0 checked:bg-red-500 ml-2">
                        </td>
                        <td class="py-3 pl-2">
                            {{$student->name}}
                        </td>
                        <td class="py-3 pl-2 capitalize">
                            {{$student->email}}
                        </td>
                        <td class="py-3 pl-2">
                            <span class="bg-green-500 px-1.5 py-0.5 rounded-lg text-gray-100">{{$student->phone}}</span>
                        </td>
                        <td class="py-3 pl-2">
                        {{$student->gender}}
                        </td>
                        <td class="py-3 pl-2">
                            <a href="#" class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg">${{$student->gender}}</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="td">There is nothing here</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $students->links() }} --}}
        </div>
        <!-- end::Table -->
        @endcan
    </div>
    <!-- end:Page content -->
    </div>