<div class="h-full bg-gray-200 p-8">
    @livewire('livewire-toast')
<div class="bg-white rounded-lg px-8 py-6 my-16 overflow-x-scroll custom-scrollbar">
<div class="mt-8 min-h-screen">
    <div class="flex justify-between">
        <div class="text-2xl">Exam_Slots</div>
        <button type="submit" wire:click="$emitTo('dashboard.exam.exam-slot-crud-child', 'showCreateForm');" class="text-blue-500">
            <x-tall-crud-icon-add />
        </button> 
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
                <td class="px-3 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-3 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('name')">Name</button>
                        <x-tall-crud-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-3 py-2" >Description</td>
                <td class="px-3 py-2" >Total Marks</td>
                <td class="px-3 py-2" >Exam</td>
                <td class="px-3 py-2" >Actions</td>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-400">
            @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? "bg-blue-100" : ""}}">
                    <td class="px-3 py-2" >{{ $result->id }}</td>
                    <td class="px-3 py-2" >{{ $result->name }}</td>
                    <td class="px-3 py-2" >{{ $result->description }}</td>
                    <td class="px-3 py-2" >{{ $result->total_marks }}</td>
                    <td class="px-3 py-2" >{{ $result->exam?->name }}</td>
                    <td class="px-3 py-2" >
                        <button type="submit" wire:click="$emitTo('dashboard.exam.exam-slot-crud-child', 'showEditForm', {{ $result->id}});" class="text-green-500">
                            <x-tall-crud-icon-edit />
                        </button>
                        <button type="submit" wire:click="$emitTo('dashboard.exam.exam-slot-crud-child', 'showDeleteForm', {{ $result->id}});" class="text-red-500">
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
    @livewire('dashboard.exam.create-exam-slot')

</div>
</div>
</div>