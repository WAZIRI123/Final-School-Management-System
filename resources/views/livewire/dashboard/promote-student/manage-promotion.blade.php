<div class="mt-8 min-h-screen">
    @livewire('livewire-toast')

    {{-- show modal --}}
    <x-tall-crud-confirmation-dialog wire:model="confirmingItemShow">
        <x-slot name="title">
            Promotion Details
        </x-slot>
        <x-slot name="content">
        @if ($promotion)
        <div>
            <p>Old class: {{$promotion->oldClass?->class_name}}</p>
            <p>Old section: {{$promotion->old_section}}</p>
            <p>New class: {{$promotion->newClass?->class_name}}</p>
            <p>New Section: {{$promotion->new_section}}</p>
            <p>Students promoted: {{$promotion->student->user->name}}</p>
         </div>
         @endif
    </x-slot>
        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemShow', false)">Cancel</x-tall-crud-button>
        </x-slot>
    </x-tall-crud-confirmation-dialog>
    {{-- end modal --}}

    <div class="mt-6">
        <div class="flex justify-around">
            <div class="flex">
                <x-tall-crud-input-search />
            </div>
            <div x-data="{ dropdown: false }" class=" mr-auto ml-3 flex">
                <div class="w-36 items-center flex bg-primary justify-between text-gray-100 rounded transition duration-150">
                    <button class="flex-1 h-full hover:bg-primary-dark border-r rounded-l"wire:click="resetPromotion">Reset Promotion</button>
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
                    
                <td class="pl-2 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="pl-2 py-2" >Student</td>
                <td class="pl-2 py-2" >Old Class Id</td>
                <td class="pl-2 py-2" >New Class Id</td>
                <td class="pl-2 py-2" >Old Section</td>
                <td class="pl-2 py-2" >New Section</td>
                <td class="pl-2 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('academic_year_id')">Academic Year</button>
                        <x-tall-crud-sort-icon sortField="academic_year_id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-2 py-2" >Actions</td>
            </thead>
            <tbody class="divide-y divide-blue-400">
            @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? "bg-blue-100" : ""}}">
                    <td class="px-2 py-3 capitalize" >
                        <input type="checkbox" name="checkbox_checked" id="{{ $result->id }}" value="{{ $result->id }}" class="ml-2 focus:ring-0"  wire:model="selectedRows" >
                        </td>
                        <td class="px-2 py-3 capitalize" >{{ $loop->iteration }}</td>
                    <td class="px-2 py-2 capitalize" >{{ $result->student->user->name }}</td>
                    <td class="px-2 py-2 capitalize" >{{ $result->oldClass?->class_name}}</td>
                    <td class="px-2 py-2 capitalize" >{{ $result->newClass?->class_name  }}</td>
                    <td class="px-2 py-2 capitalize" >{{ $result->old_section }}</td>
                    <td class="px-2 py-2 capitalize" >{{ $result->new_section }}</td>
                    <td class="px-2 py-2 capitalize" >{{ $result->academicYear->name() }}</td>
                    <td class="px-2 py-2" >
                        <button type="submit" wire:click="$emit('promotionDetails', {{ $result->id}});" class="text-green-500">
                            <x-tall-crud-icon-add />
                        </button>
                    </td>
               </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $results->links() }}
    </div>
</div>