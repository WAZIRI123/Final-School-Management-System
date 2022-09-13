<div>
    <!-- start:Page content -->
    <div class="h-full bg-gray-200 p-8">
        <!-- start::Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">
            <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-sm text-indigo-600">teacher</span>
                    <span class="text-xs bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default">teacher</span>
                </div>
                <div class="flex items-center justify-between mt-6">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-yellow-400 bg-opacity-20 rounded-full text-yellow-600 border border-yellow-600"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
    
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-end">
                            <span class="text-2xl 2xl:text-4xl font-bold">{{ $teacher }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-sm text-green-600">parents</span>
                    <span class="text-xs bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default">Parents</span>
                </div>
                <div class="flex items-center justify-between mt-6">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-green-400 bg-opacity-20 rounded-full text-green-600 border border-green-600"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                       
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-end">
                            <span class="text-2xl 2xl:text-4xl font-bold">{{ $parents }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-sm text-blue-600">Classes</span>
                    <span class="text-xs bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default">classes</span>
                </div>
                <div class="flex items-center justify-between mt-6">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-blue-400 bg-opacity-20 rounded-full text-yellow-600 border border-yellow-600"><path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"></path></svg>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-end">
                            <span class="text-2xl 2xl:text-4xl font-bold">{{ $classes }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between">
                    <span class="font-bold text-sm text-yellow-600">Student</span>
                    <span class="text-xs bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default">student</span>
                </div>
                <div class="flex items-center justify-between mt-6">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-yellow-400 bg-opacity-20 rounded-full text-yellow-600 border border-yellow-600"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
    
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-end">
                            <span class="text-2xl 2xl:text-4xl font-bold">{{ $student }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    </div>
    <!-- end:Page content -->
    </div>