<div class="mt-8 min-h-screen">
    @livewire('livewire-toast')
    <div class="flex justify-between">
        <div class="text-2xl">Teachers</div>
        <button type="submit" wire:click="$emitTo('dashboard.teacher.crud-child', 'showCreateForm');" class="text-blue-500">
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
        <table class="w-full my-8 whitespace-nowrap" wire:loading.class.delay="opacity-50">
            <thead>
                <tr class="bg-secondary text-gray-100 font-bold">
                <td class="py-2 pl-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="py-2 pl-2" >Gender</td>
                <td class="py-2 pl-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('admission_no')">Admission No</button>
                        <x-tall-crud-sort-icon sortField="admission_no" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="py-2 pl-2" >Phone</td>
                <td class="py-2 pl-2" >Dateofbirth</td>
                <td class="py-2 pl-2" >Current Address</td>
                <td class="py-2 pl-2" >Permanent Address</td>
                <td class="py-2 pl-2" >Actions</td>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-400">
            @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? "bg-blue-100" : ""}}">
                    <td class="py-3 pl-2 capitalize" >{{ $result->id }}</td>
                    <td class="py-3 pl-2 capitalize" >{{ $result->gender }}</td>
                    <td class="py-3 pl-2 capitalize" >{{ $result->admission_no }}</td>
                    <td class="py-3 pl-2 capitalize" >{{ $result->phone }}</td>
                    <td class="py-3 pl-2 capitalize" >{{ $result->dateofbirth }}</td>
                    <td class="py-3 pl-2 capitalize" >{{ $result->current_address }}</td>
                    <td class="py-3 pl-2 capitalize" >{{ $result->permanent_address }}</td>
                    <td class="py-3 pl-2 capitalize" >
                        <button type="submit" wire:click="$emitTo('dashboard.teacher.crud-child', 'showEditForm', {{ $result->id}});" class="text-green-500">
                            <x-tall-crud-icon-edit />
                        </button>
                        <button type="submit" wire:click="$emitTo('dashboard.teacher.crud-child', 'showDeleteForm', {{ $result->id}});" class="text-red-500">
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
    @livewire('dashboard.teacher.crud-child')
</div>