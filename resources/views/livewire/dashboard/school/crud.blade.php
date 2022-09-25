<div class="mt-8 min-h-screen">
    @livewire('livewire-toast')
    <div>
        @livewire('dashboard.school.set-school')
    </div>
    <div class="flex justify-between">
        <div class="text-2xl">Schools</div>
        <button type="submit" wire:click="$emitTo('dashboard.school.crud-child', 'showCreateForm');"
            class="text-blue-500">
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
            <thead class="bg-secondary text-gray-100 font-bold">
                <td class="px-3 py-2">
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">S/N</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-3 py-2">
                    <div class="flex items-center">
                        <button wire:click="sortBy('name')">Name</button>
                        <x-tall-crud-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="py-2 pl-2">Initials</td>
                <td class="py-2 pl-2">Email</td>
                <td class="py-2 pl-2">Phone</td>
                <td class="py-2 pl-2">Code</td>
                <td class="py-2 pl-2">Actions</td>
            </thead>
            <tbody class="text-sm truncate">
                @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? " bg-blue-100" : "" }}">
                    <td class="py-3 pl-2 capitalize">{{ $result->id }}</td>
                    <td class="py-3 pl-2 capitalize">{{ $result->name }}</td>
                    <td class="py-3 pl-2 capitalize">{{ $result->initials }}</td>
                    <td class="py-3 pl-2 capitalize">{{ $result->email }}</td>
                    <td class="py-3 pl-2 capitalize">{{ $result->phone }}</td>
                    <td class="py-3 pl-2 capitalize">{{ $result->code }}</td>
                    <td class="py-3 pl-2 capitalize">
                        <button type="submit"
                            wire:click="$emitTo('dashboard.school.crud-child', 'showEditForm', {{ $result->id}});"
                            class="text-green-500">
                            <x-tall-crud-icon-edit />
                        </button>
                        <button type="submit"
                            wire:click="$emitTo('dashboard.school.crud-child', 'showDeleteForm', {{ $result->id}});"
                            class="text-red-500">
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
    @livewire('dashboard.school.crud-child')

</div>