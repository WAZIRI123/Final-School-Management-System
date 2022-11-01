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
                <x-tall-crud-label>Description</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.description" />
                @error('item.description') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Semester Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.semester_id">
                    @foreach($semester as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </x-tall-crud-select> 
                @error('item.semester_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Start Date</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.start_date" />
                @error('item.start_date') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Stop Date</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.stop_date" />
                @error('item.stop_date') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Active</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.active"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.active') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Publish Result</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.publish_result"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.publish_result') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
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
                <x-tall-crud-label>Description</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.description" />
                @error('item.description') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Semester Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.semester_id">
                    @foreach($semester as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </x-tall-crud-select> 
                @error('item.semester_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Start Date</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.start_date" />
                @error('item.start_date') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Stop Date</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.stop_date" />
                @error('item.stop_date') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Active</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.active">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.active') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Publish Result</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.publish_result">
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </x-tall-crud-select> 
                @error('item.publish_result') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemEdit', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="add" wire:loading.attr="disabled" wire:click="editItem()">Save</x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>
</div>
