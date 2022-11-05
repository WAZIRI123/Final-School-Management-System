<div>
    <!-- start:Page content -->
<div class="h-full bg-gray-200 p-8">
<div class="mt-8 min-h-screen">
    <div class="bg-white rounded-lg px-8 py-6 my-16 overflow-x-scroll custom-scrollbar">
    @livewire('livewire-toast')
    <div class="flex justify-between">
        <div class="text-2xl">TimeTable Record</div>
        <button type="submit" wire:click="$emitTo('dashboard.time-table.create-time-table-record-slot', 'showCreateForm');" class="text-blue-500">
            <x-tall-crud-icon-add />
        </button> 
    </div>
    @if (session()->has('danger'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        {{ session('danger') }}
    </div>
@endif

<div class="grid grid-cols-2 gap-8">
    <div class="mt-4">

        <x-tall-crud-label>Class</x-tall-crud-label>
        <x-tall-crud-select class="block mt-1 w-full" wire:model="selected_class">
            <option value="">Please Select</option>
            @foreach($classes as $c)
            <option value="{{$c->id}}">{{$c->class_name}}</option>
            @endforeach
        </x-tall-crud-select>
        @error('selected_class') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
    </div>
    <div class="mt-4">

        <x-tall-crud-label>Subject</x-tall-crud-label>
        <x-tall-crud-select class="block mt-1 w-full" wire:model="selected_subject">
            <option value="">Please Select</option>
            @foreach($subjects as $c)
            <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </x-tall-crud-select>
        @error('selected_subject') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
    </div>
</div>

<div class="grid grid-cols-2 gap-8">

    <div class="mt-4">
        <x-tall-crud-label>Days</x-tall-crud-label>
        <x-tall-crud-select class="block mt-1 w-full" wire:model="selected_weekday">
            <option value="">Please Select</option>
            @foreach($weekdays as $c)
            <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </x-tall-crud-select>
        @error('selected_weekday') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
    </div>
</div>
    <div class="mt-6">
        <div class="flex justify-between">
            <div class="flex">

            </div>
            <div x-data="{ dropdown: false }" class=" mr-auto ml-3 flex">
                <div class="w-45 items-center px-4  flex bg-primary justify-between text-gray-100 rounded transition duration-150">
                    <button class="flex-1 h-full  rounded-l" wire:click="SyncSlotsWithDays">Create TimeTable Record</button>
                </div>
            </div>

            <div class="flex">

                <x-tall-crud-page-dropdown />
            </div>
        </div>
        <table class="w-full my-8 whitespace-nowrap" wire:loading.class.delay="opacity-50">
            <thead class="bg-secondary text-gray-100 font-bold">
                <td class="px-2 py-3 capitalize" >
                    
                    </td>
                <td class="px-2 py-2 capitalize" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-2 py-2 capitalize" >Timetable</td>
                <td class="px-2 py-2 capitalize" >Start Time</td>
                <td class="px-2 py-2 capitalize" >Stop Time</td>
                <td class="px-2 py-2 capitalize" >Actions</td>

            </thead>
            <tbody class="divide-y divide-blue-400">
            @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? "bg-blue-100" : ""}}">
                    <td class="px-2 py-3 capitalize" >
                        <input type="radio" name="checkbox_checked" id="{{ $result->id }}" value="{{ $result->id }}" class="ml-2 focus:ring-0"  wire:model="selectedSlots" >
                        </td>
                    <td class="px-3 py-2 capitalize" >{{ $result->id }}</td>
                    <td class="px-3 py-2 capitalize" >{{ $result->timetable->name }}</td>
                    <td class="px-3 py-2 capitalize" >{{ $result->start_time }}</td>
                    <td class="px-3 py-2 capitalize" >{{ $result->stop_time }}</td>
                    <td class="px-3 py-2 capitalize" >
                        <button type="submit" wire:click="$emitTo('dashboard.time-table.create-time-table-record-slot', 'showEditForm', {{ $result->id}});" class="text-green-500">
                            <x-tall-crud-icon-edit />
                        </button>
                        <button type="submit" wire:click="$emitTo('dashboard.time-table.create-time-table-record-slot', 'showDeleteForm', {{ $result->id}});" class="text-red-500">
                            <x-tall-crud-icon-delete />
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
    @livewire('dashboard.time-table.create-time-table-record-slot')
  
</div>
</div>
</div>
</div>
