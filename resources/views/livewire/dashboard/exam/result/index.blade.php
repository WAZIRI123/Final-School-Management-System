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
                        @error('academic') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                    </div>
                    @if (auth()->user()->hasRole('Parent'))
                    <div class="mt-4">
                        <x-tall-crud-label>Student</x-tall-crud-label>
                        <x-tall-crud-select class="block mt-1 w-full" wire:model='student'>
                            <option value="">Please Select</option>
                            @foreach($students as $c)
                            <option value="{{$c->id}}">{{$c->user->name}}</option>
                            @endforeach
                        </x-tall-crud-select>
                        @error('student') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                    </div> 
                    @endif
                    
                </div>
                <div class="mt-6">
                    <table class="w-full whitespace-no-wrap mt-4 mb-4 shadow-2xl" wire:loading.class.delay="opacity-50">
                       
                        <thead>
                            @if ($semester1_result->count())
                            <tr> <td>semester 1 Result</td></tr>
                            <tr class="bg-secondary text-gray-100 font-bold">
                                <td class="px-3 py-2 capitalize">Subjects</td>
                                <td class="px-3 py-2 capitalize">Marks</td>
                                <td class="px-3 py-2 capitalize">Remark</td>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-400">

                         <button wire:click="pdfData()">print</button>
                            @foreach($semester1_result as $result)
                            <tr class="hover:bg-blue-300 {{ ($loop->even ) ? " bg-blue-100" : "" }}">
                                <td class="px-3 py-2 capitalize">{{ $result->subjects?->name }}</td>
                                <td class="px-3 py-2 capitalize">{{ $result->marks }}</td>
                                @switch($result->marks)
                                @case($result->marks>=80)
                                <td class="px-3 py-2 capitalize">Excellence</td>
                                    @break

                                    @case($result->marks>=70 && $result->marks<80 )
                                    <td class="px-3 py-2 capitalize">Very Good</td>
                                    @break

                                    @case($result->marks>=60 && $result->marks<70 )
                                    <td class="px-3 py-2 capitalize">Good</td>
                                    @break
                            
                                    @case($result->marks>=50 && $result->marks<60 )
                                    <td class="px-3 py-2 capitalize">Credit</td>
                                    @break

                                    @case($result->marks>=30 && $result->marks<50 )
                                    <td class="px-3 py-2 capitalize">Average</td>
                                    @break

                                    @case($result->marks<30 )
                                    <td class="px-3 py-2 capitalize">Fail</td>
                                    @break

                                @default                               
                            @endswitch
                            </tr>
                            @endforeach
                            <td>Total Marks:{{ $semester1_result->count()*100 }}  Acquired: {{ $semester1_result->sum('marks') }}</td>
                        </tbody>
                    </table>
                    @endif
                    @if (count($semester2_result))
                    <table class="w-full whitespace-no-wrap mt-8 shadow-2xl" wire:loading.class.delay="opacity-50">
                        <thead>
                            <tr> <td>semester 2 Result</td></tr>
                            <tr class="bg-secondary text-gray-100 font-bold">
                                <td class="px-3 py-2 capitalize">Subjects</td>
                               
                                <td class="px-3 py-2 capitalize">Marks</td>
                               
                                <td class="px-3 py-2 capitalize">Remark</td>
                                <td class="px-3 py-2 capitalize">Rank</td>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-400">
                            @foreach($semester2_result as $result)
                            <tr class="hover:bg-blue-300 {{ ($loop->even ) ? " bg-blue-100" : "" }}">
                                <td class="px-3 py-2 capitalize">{{ $result->subjects?->name }}</td>
                          
                                <td class="px-3 py-2 capitalize">{{ $result->marks }}</td>
                              
                            
                                @switch($result->marks)
                                    @case($result->marks>=80)
                                    <td class="px-3 py-2 capitalize">Excellence</td>
                                        @break

                                        @case($result->marks>=70 && $result->marks<80 )
                                        <td class="px-3 py-2 capitalize">Very Good</td>
                                        @break

                                        @case($result->marks>=60 && $result->marks<70 )
                                        <td class="px-3 py-2 capitalize">Good</td>
                                        @break
                                
                                        @case($result->marks>=50 && $result->marks<60 )
                                        <td class="px-3 py-2 capitalize">Credit</td>
                                        @break

                                        @case($result->marks>=30 && $result->marks<50 )
                                        <td class="px-3 py-2 capitalize">Average</td>
                                        @break

                                        @case($result->marks<30 )
                                        <td class="px-3 py-2 capitalize">Fail</td>
                                        @break

                                    @default
                                        
                                @endswitch
                                <td class="px-3 py-2 capitalize">{{ $result->rank }}</td>
                            </tr>
                            @endforeach
                            <td>Total Marks:{{ $semester2_result->count()*100 }} <br> Acquired Marks: {{ $semester2_result->sum('marks') }} <br> Student Position: {{ $rank }} of {{ $studentss }} students</td>
                        </tbody>
                    </table>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>