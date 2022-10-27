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
                <x-tall-crud-label>Semester Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.semester_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.semester_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Class Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.class_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.class_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Section Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.section_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.section_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Exam Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.exam_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.exam_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Subject Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.subject_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.subject_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Student Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.student_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.student_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Marks</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.marks" />
                @error('item.marks') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
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
                <x-tall-crud-label>Semester Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.semester_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.semester_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Class Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.class_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.class_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Section Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.section_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.section_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
    
            <div class="mt-4">
                <x-tall-crud-label>Exam Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.exam_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.exam_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Subject Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.subject_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.subject_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
            <div class="mt-4">
                <x-tall-crud-label>Student Id</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.student_id"><option value="1">Yes</option><option value="0">No</option>
                </x-tall-crud-select> 
                @error('item.student_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Marks</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.marks" />
                @error('item.marks') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
        </div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemEdit', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="add" wire:loading.attr="disabled" wire:click="editItem()">Save</x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>
</div>
