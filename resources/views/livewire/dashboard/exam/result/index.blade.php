<div class="h-full bg-gray-200 p-8">
    <div class="mt-8 min-h-screen">
        @livewire('livewire-toast')
        <div class="bg-white rounded-lg px-8 py-6 my-16 overflow-x-scroll custom-scrollbar">
            <div class="mt-8 min-h-screen">
                <div class="flex justify-between">
                    <div class="text-2xl" wire:click="test">Exam_Results</div>
                </div>
                <div class="grid grid-cols-2 gap-8">

                    <div class="mt-4">
                        <x-tall-crud-label>Academic Year</x-tall-crud-label>
                        <x-tall-crud-select class="block mt-1 w-full" wire:model="academic">
                            <option value="">Please Select</option>
                            @foreach($academics as $c)
                            <option value="{{$c->id}}">{{$c->name()}}</option>
                            @endforeach
                        </x-tall-crud-select>
                        @error('old_section') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
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
                                <td class="px-3 py-2 capitalize">Subjects</td>
                                <td class="px-3 py-2 capitalize">Marks</td>
                             
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-400">
                            @foreach($semester1_result as $result)
                            <tr class="hover:bg-blue-300 {{ ($loop->even ) ? " bg-blue-100" : "" }}">
                                <td class="px-3 py-2 capitalize">{{ $result->subjects?->name }}</td>
                                <td class="px-3 py-2 capitalize">{{ $result->marks }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @if (count($semester2_result))
                    <table class="w-full whitespace-no-wrap mt-4 shadow-2xl" wire:loading.class.delay="opacity-50">
                        <thead>
                            <tr class="bg-secondary text-gray-100 font-bold">
                                <td class="px-3 py-2 capitalize">Subjects</td>
                                <td class="px-3 py-2 capitalize">Marks</td>
                             
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-400">
                            @foreach($semester2_result as $result)
                            <tr class="hover:bg-blue-300 {{ ($loop->even ) ? " bg-blue-100" : "" }}">
                                <td class="px-3 py-2 capitalize">{{ $result->subjects?->name }}</td>
                                <td class="px-3 py-2 capitalize">{{ $result->marks }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>