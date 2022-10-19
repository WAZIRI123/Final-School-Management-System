<div class="mt-8 min-h-screen">
    @livewire('livewire-toast')
    <div class="flex justify-between">
        <div class="text-2xl">Exams</div>
        <button type="submit" wire:click="$emitTo('dashboard.exam.crud-child', 'showCreateForm');" class="text-blue-500">
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
        <table class="w-full whitespace-no-wrap my-8" wire:loading.class.delay="opacity-50">
            <thead class="bg-secondary text-gray-100 font-bold">
                <td class="px-2 py-2 capitalize" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-2 py-2 capitalize" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('name')">Name</button>
                        <x-tall-crud-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-2 py-2 capitalize" >Description</td>
                <td class="px-2 py-2 capitalize" >Start Date</td>
                <td class="px-2 py-2 capitalize" >Stop Date</td>
                <td class="px-2 py-2 capitalize" >Active</td>
                <td class="px-2 py-2 capitalize" >Publish Result</td>
                <td class="px-2 py-2 capitalize" >Semester</td>
                <td class="px-2 py-2 capitalize" >Actions</td>
            </thead>
            <tbody class="divide-y divide-blue-400">
            @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? "bg-blue-100" : ""}}">
                    <td class="px-3 py-2 capitalize" >{{ $result->id }}</td>
                    <td class="px-3 py-2 capitalize" >{{ $result->name }}</td>
                    <td class="px-3 py-2 capitalize" >{{ $result->description }}</td>
                    <td class="px-3 py-2 capitalize" >{{ $result->start_date }}</td>
                    <td class="px-3 py-2 capitalize" >{{ $result->stop_date }}</td>
                    <td class="px-3 py-2 capitalize" >
                     @if( $result->active == 'true')
                        
                        <span class="bg-green-200 text-green-600 px-2 py-1 text-sm rounded">Active</span>
                    @else
                        <span class="bg-red-200 text-red-600 px-2 py-1 text-sm rounded">Inactive</span>
                    @endif
                    </td>
                    <td class="px-3 py-2 capitalize" >
                        @if( $result->publish_result== 'true')
                        
                        <span class="bg-green-200 text-green-600 px-2 py-1 text-sm rounded">Published</span>
                    @else
                        <span class="bg-red-200 text-red-600 px-2 py-1 text-sm rounded">NotPublished</span>
                    @endif
                    
                    </td>
                    <td class="px-3 py-2 capitalize" >{{ $result->semester?->name }}</td>
                    <td class="px-3 py-2 capitalize" >
                        <button type="submit" wire:click="$emitTo('dashboard.exam.crud-child', 'showEditForm', {{ $result->id}});" class="text-green-500">
                            <x-tall-crud-icon-edit />
                        </button>
                        <button type="submit" wire:click="$emitTo('dashboard.exam.crud-child', 'showDeleteForm', {{ $result->id}});" class="text-red-500">
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
    @livewire('dashboard.exam.crud-child')
    @livewire('livewire-toast')
</div>