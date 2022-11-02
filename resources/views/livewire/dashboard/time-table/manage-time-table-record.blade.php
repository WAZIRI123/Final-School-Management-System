<div>
    <!-- start:Page content -->
<div class="h-full bg-gray-200 p-8">
<div class="mt-8 min-h-screen">
<div class="bg-white rounded-lg px-8 py-6 my-16 overflow-x-scroll custom-scrollbar">
    @livewire('livewire-toast')
    <div class="flex justify-between">
        <div class="text-2xl">Time_Tables</div>
    </div>
    @if (session()->has('danger'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
        {{ session('danger') }}
    </div>
    @endif
    @if (auth()->user()->roles->pluck('name')->toArray()[0] =='Admin'|auth()->user()->roles->pluck('name')->toArray()[0] =='super-admin')
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
            <x-tall-crud-select class="block mt-1 w-full" wire:model="selected_semester">
                <option value="">Please Select</option>
                @foreach($semesters as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </x-tall-crud-select>
            @error('selected_semester') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
        </div>
    </div> 
    @endif


    <div class="mt-6">
        <table class="w-full my-8 whitespace-nowrap" wire:loading.class.delay="opacity-50">
            <thead class="bg-secondary text-gray-100 font-bold">
                <td class="px-2 py-2 capitalize">
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-2 py-2 capitalize">Day</td>
                <td class="px-2 py-2 capitalize">Time Slot</td>
                <td class="px-2 py-2 capitalize">Subject</td>
            </thead>
            <tbody class="divide-y divide-blue-400">
                {{--creates a row for each day of the week--}}
                @foreach ($results as $result)
                @foreach ($weekdays as $weekday)
                <tr>
                    <td class="py-3 capitalize pl-2">{{ $weekday->id }}</td>
                    <td class="py-3 capitalize pl-2">{{$weekday->name}}</td>
                    {{--displays the time slots for each day of the week--}}
                    <td>
                    @foreach ($weekday->timeSlots as $timeSlot)
                    <p class="py-1 capitalize pl-2">
                        {{ $timeSlot->start_time }} - {{ $timeSlot->stop_time }}
                    </p>
                    @endforeach
                  </td>
                  <td>
                    @foreach ($weekday->timeSlots as $timeSlot)
                    <p class="py-1 capitalize pl-2">
                    {{ $timeSlot->timetableRecord->subjects->name }} 
                </p>
                @endforeach
                </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
</div>
</div>
