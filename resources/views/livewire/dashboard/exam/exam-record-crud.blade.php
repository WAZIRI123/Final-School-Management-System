<div class="h-full bg-gray-200 p-8">
<div class="mt-8 min-h-screen">
    @livewire('livewire-toast')
    <div class="bg-white rounded-lg px-8 py-6 my-16 overflow-x-scroll custom-scrollbar">
    <div class="mt-8 min-h-screen">
        @if (session()->has('danger'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            {{ session('danger') }}
        </div>
        @endif
    <div class="flex justify-between">
        <div class="text-2xl">Exam_Records</div>

    </div>

    <div class="grid grid-cols-2 gap-8">
        <div class="mt-4">
            <x-tall-crud-label>Class</x-tall-crud-label>
            <x-tall-crud-select class="block mt-1 w-full" wire:model="class">
                <option value="">Please Select</option>
                @foreach($classes as $c)
                <option value="{{$c->id}}">{{$c->class_name}}</option>
                @endforeach
            </x-tall-crud-select>
            @error('class') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
        </div>
        <div class="mt-4">
            <x-tall-crud-label>Exam</x-tall-crud-label>
            <x-tall-crud-select class="block mt-1 w-full" wire:model="exam">
                <option value="">Please Select</option>
                @foreach($exams as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </x-tall-crud-select>
            @error('exam') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
        </div>
    </div> 
<div class="grid grid-cols-2 gap-8">
    <div class="mt-4">
        <x-tall-crud-label>Section</x-tall-crud-label>
        <x-tall-crud-select class="block mt-1 w-full" wire:model="section">
            <option value="">Please Select</option>
            <option value="{{App\Enums\ClassSectionEnum::A->value}}">A</option>
            <option value="{{App\Enums\ClassSectionEnum::B->value}}">B</option>
        </x-tall-crud-select>
        @error('section') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
    </div>
    <div class="mt-4">
        <x-tall-crud-label>Subject</x-tall-crud-label>
        <x-tall-crud-select class="block mt-1 w-full" wire:model="subject">
            <option value="">Please Select</option>
            @foreach($subjects as $c)
            <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </x-tall-crud-select>
        @error('subject') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
    </div>
</div>
    <div class="mt-6">
        <div class="flex justify-between">
            <div class="flex">
                <x-tall-crud-input-search />
            </div>
            <div class="flex">

                <x-tall-crud-page-dropdown />
            </div>
        </div>
        <table class="w-full whitespace-no-wrap mt-4 shadow-2xl" wire:loading.class.delay="opacity-50">
            <thead>
                <tr class="bg-secondary text-gray-100 font-bold">
                <td class="px-2 py-2 capitalize" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-2 py-2 capitalize" >parent</td>
                <td class="px-2 py-2 capitalize" >name</td>
                <td class="px-2 py-2 capitalize" >admission_no</td>
                <td class="px-2 py-2 capitalize" >Gender</td>
                <td class="px-2 py-2 capitalize" >Marks</td>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-400">
            @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? "bg-blue-100" : ""}}">
                    <td class="py-3 pl-2 capitalize" >{{ $loop->iteration }}</td>
                    <td class="py-3 pl-2 capitalize" >{{ $result->parent->user->name }}</td>
                    <td class="py-3 pl-2 capitalize" >{{ $result->user->name }}</td>
                    <td class="py-3 pl-2 capitalize" >{{ $result->admission_no }}</td>
                    <td class="py-3 pl-2 capitalize" >{{ $result->gender }}</td>
                     <td class="py-3 pl-2">
                            <!-- start::Rounded Select -->
                            <div class="flex flex-col">
                                <input name="" type="number" wire:model.defer="marks.{{ $result->id }}" placeholder="Marks" class="mt-2  px-3 py-1 border shadow appearance-none  focus:outline-none focus:ring-0 focus:border-gray-300 w-1/2 rounded-lg "/>
                            </div>
                            <!-- end::Rounded Select -->
                        </td>
               </tr>
            @endforeach
            </tbody>
        </table>
        @if ($results->count()>0)
        <div class="grid grid-cols-2 gap-8 pt-4 w-full justify-between justify-items-end">
            <div></div>
            <x-tall-crud-button mode="add" class="w-1/4" wire:loading.attr="disabled" wire:click="markStudents()">Save Marks</x-tall-crud-button>
    </div>  
        @endif

    </div>

    <div class="mt-4">
        {{ $results->links() }}
    </div>
    @livewire('dashboard.exam.exam-record-crud-child')
</div>
</div>
</div>
</div>