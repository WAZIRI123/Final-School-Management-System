<div class="mt-8 min-h-screen">
    @livewire('livewire-toast')
    <div class="flex justify-between">
        <div class="text-2xl">Students</div>
    </div>
    @if (session()->has('danger'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        {{ session('danger') }}
    </div>
@endif
            
    <div class="grid grid-cols-2 gap-8">
        <div class="mt-4">

            <x-tall-crud-label>Old Class</x-tall-crud-label>
            <x-tall-crud-select class="block mt-1 w-full" wire:model="old_class">
                <option value="">Please Select</option>
                @foreach($classes as $c)
                <option value="{{$c->id}}">{{$c->class_name}}</option>
                @endforeach
            </x-tall-crud-select>
            @error('old_class') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
        </div>
        <div class="mt-4">
            <x-tall-crud-label>Old Section</x-tall-crud-label>
            <x-tall-crud-select class="block mt-1 w-full" wire:model="old_section">
                <option value="">Please Select</option>
                <option value="{{App\Enums\ClassSectionEnum::A->value}}">A</option>
                <option value="{{App\Enums\ClassSectionEnum::B->value}}">B</option>
            </x-tall-crud-select>
            @error('old_section') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
        </div>
    </div>

    <div class="grid grid-cols-2 gap-8">
        <div class="mt-4">
            <x-tall-crud-label>New Class</x-tall-crud-label>
            <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="new_class">
                <option value="">Please Select</option>
                @foreach($classes as $c)
                <option value="{{$c->id}}">{{$c->class_name}}</option>
                @endforeach
            </x-tall-crud-select>
            @error('new_class') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
        </div>
        <div class="mt-4">
            <x-tall-crud-label>New Section</x-tall-crud-label>
            <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="new_section">
                <option value="">Please Select</option>
                <option value="{{App\Enums\ClassSectionEnum::A->value}}">A</option>
                <option value="{{App\Enums\ClassSectionEnum::B->value}}">B</option>
            </x-tall-crud-select>
            @error('new_section') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
        </div>
    </div>
  
    <div class="mt-6">
        <div class="flex justify-around">
            <div class="flex">
                <x-tall-crud-input-search />
            </div>
            <div x-data="{ dropdown: false }" class=" mr-auto ml-3 flex">
                <div class="w-36 items-center flex bg-primary justify-between text-gray-100 rounded transition duration-150">
                    <button class="flex-1 h-full hover:bg-primary-dark border-r rounded-l"wire:click="promoteStudents">Promote</button>
                </div>
                <span class="ml-2 my-auto">Selected {{ count($selectedRows) }} {{ Str::plural('student', count($selectedRows)) }}</span>
            </div>
            <div class="flex">

                <x-tall-crud-page-dropdown />
            </div>
        </div>
        <table class="w-full my-8 whitespace-nowrap" wire:loading.class.delay="opacity-50">
            <thead class="bg-secondary text-gray-100 font-bold">
                <td class="px-2 py-3 capitalize" >
                    <input type="checkbox" name="checkbox_checked" id="checkbox_checked" class="ml-2 focus:ring-0"  wire:model="selectedAllRows">
                    </td>
                <td class="px-2 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-2 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('user_id')">Name</button>
                        <x-tall-crud-sort-icon sortField="user_id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-2 py-2" >Admission </td>
                <td class="px-2 py-2" >Parent </td>
                <td class="px-2 py-2" >Class</td>
                <td class="px-2 py-2" >Gender</td>
                <td class="px-2 py-2" >Section</td>
                <td class="px-2 py-2" >Status</td>
            </thead>
            <tbody class="divide-y divide-blue-400">
            @if (count($results)>0)
            @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? "bg-blue-100" : ""}}">
                    <td class="px-2 py-3 capitalize" >
                        <input type="checkbox" name="checkbox_checked" id="{{ $result->id }}" value="{{ $result->id }}" class="ml-2 focus:ring-0"  wire:model="selectedRows" >
                        </td>
                    <td class="px-2 py-3 capitalize" >{{ $loop->iteration }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->user->name }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->admission_no }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->parent?->user->name }}</td>
                    <td class="px-2 py-3 capitalize" >{{$result->class?->class_name }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->gender }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->section }}</td>
                    <td class="px-2 py-3 capitalize" >{{ $result->Status }}</td>
               </tr>
            @endforeach
            @else
            <tr>
                <td>No students to promote</td>
            </tr>
            @endif
            </tbody>
        </table>


    </div>

    <div class="mt-4">
        {{ $results->links() }}
    </div>
</div>