<div>

    <x-tall-crud-confirmation-dialog wire:model="confirmingItemDeletion">
        <x-slot name="title">
            Delete Record
        </x-slot>

        <x-slot name="content">
            Are you sure you want to Delete Record?
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemDeletion', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="delete" wire:loading.attr="disabled" wire:click="deleteItem()">Delete</x-tall-crud-button>
        </x-slot>
    </x-tall-crud-confirmation-dialog>

    <x-tall-crud-dialog-modal wire:model="confirmingItemCreation">
        <x-slot name="title">
            Add Record
        </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Name</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.name" />
                @error('item.name') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Initials</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.initials" />
                @error('item.initials') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Address</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.address" />
                @error('item.address') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Email</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.email" />
                @error('item.email') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Phone</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.phone" />
                @error('item.phone') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Semester Id</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.semester_id" />
                @error('item.semester_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Academic Year Id</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.academic_year_id" />
                @error('item.academic_year_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Code</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.code" />
                @error('item.code') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemCreation', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="add" wire:loading.attr="disabled" wire:click="createItem()">Save</x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>

    <x-tall-crud-dialog-modal wire:model="confirmingItemEdit">
        <x-slot name="title">
            Edit Record
        </x-slot>

        <x-slot name="content">
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Name</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.name" />
                @error('item.name') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Initials</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.initials" />
                @error('item.initials') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Address</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.address" />
                @error('item.address') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Email</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.email" />
                @error('item.email') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Phone</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.phone" />
                @error('item.phone') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Semester Id</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.semester_id" />
                @error('item.semester_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Academic Year Id</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.academic_year_id" />
                @error('item.academic_year_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Code</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.code" />
                @error('item.code') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemEdit', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="add" wire:loading.attr="disabled" wire:click="editItem()">Save</x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>
</div>