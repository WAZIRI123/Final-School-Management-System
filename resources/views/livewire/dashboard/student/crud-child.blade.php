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
            <x-tall-crud-button mode="delete" wire:loading.attr="disabled" wire:click="deleteItem()">Delete
            </x-tall-crud-button>
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
                    <x-tall-crud-label>Email</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.email" />
                    @error('item.email') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div class="mt-4">
                    <x-tall-crud-label>Admission No</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.admission_no"
                        value="1" disabled />
                    @error('item.admission_no') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-tall-crud-label>Gender</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.gender">
                        <option value="">Please Select</option>
                        <option value="{{App\Enums\GenderEnum::Male->value}}">Male</option>
                        <option value="{{App\Enums\GenderEnum::Female->value}}">Female</option>
                    </x-tall-crud-select>
                    @error('item.gender') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div class="mt-4">
                    <x-tall-crud-label>Phone</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.phone" />
                    @error('item.phone') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
                <div class="mt-4">
                    <x-tall-crud-label>Dateofbirth</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.dateofbirth" />
                    @error('item.dateofbirth') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div class="mt-4">
                    <x-tall-crud-label>Current Address</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.current_address" />
                    @error('item.current_address') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-tall-crud-label>Permanent Address</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text"
                        wire:model.defer="item.permanent_address" />
                    @error('item.permanent_address') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div class="mt-4">
                    <x-tall-crud-label>Parent</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.parent_id">
                        <option value="">Please Select</option>
                        @foreach($parents as $c)
                        <option value="{{$c->id}}">{{$c->user->name}}</option>
                        @endforeach
                    </x-tall-crud-select>
                    @error('item.parent_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-tall-crud-label>Class</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.class_id">
                        <option value="">Please Select</option>
                        @foreach($classes as $c)
                        <option value="{{$c->id}}">{{$c->class_name}}</option>
                        @endforeach
                    </x-tall-crud-select>
                    @error('item.class_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
            </div>
         <div class="grid grid-cols-2 gap-8">
            <div class="mt-4">
                <x-tall-crud-label>Profile_picture</x-tall-crud-label>
                <x-tall-crud-input class="block mt-1 w-full" type="file"
                    wire:model.defer="profile_picture" />
                @error('item.profile_picture') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                @enderror
            </div>
         </div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemCreation', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="add" wire:loading.attr="disabled" wire:click="createItem()">Save
            </x-tall-crud-button>
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
                    <x-tall-crud-label>Email</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.email" />
                    @error('item.email') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div class="mt-4">
                    <x-tall-crud-label>Admission No</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.admission_no" disabled />
                    @error('item.admission_no') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-tall-crud-label>Gender</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.gender">
                        <option value="">Please Select</option>
                        <option value="{{App\Enums\GenderEnum::Male->value}}">Male</option>
                        <option value="{{App\Enums\GenderEnum::Female->value}}">Female</option>
                    </x-tall-crud-select>
                    @error('item.gender') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div class="mt-4">
                    <x-tall-crud-label>Phone</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.phone" />
                    @error('item.phone') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>

                <div class="mt-4">
                    <x-tall-crud-label>Dateofbirth</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.dateofbirth" />
                    @error('item.dateofbirth') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div class="mt-4">
                    <x-tall-crud-label>Current Address</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text" wire:model.defer="item.current_address" />
                    @error('item.current_address') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-tall-crud-label>Permanent Address</x-tall-crud-label>
                    <x-tall-crud-input class="block mt-1 w-full" type="text"
                        wire:model.defer="item.permanent_address" />
                    @error('item.permanent_address') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">

                <div class="mt-4">
                    <x-tall-crud-label>Parent</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.parent_id">
                        <option value="">Please Select</option>
                        @foreach($parents as $c)
                        <option value="{{$c->id}}">{{$c->user->name}}</option>
                        @endforeach
                    </x-tall-crud-select>
                    @error('item.parent_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-tall-crud-label>Class</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.class_id">
                        <option value="">Please Select</option>
                        @foreach($classes as $c)
                        <option value="{{$c->id}}">{{$c->class_name}}</option>
                        @endforeach
                    </x-tall-crud-select>
                    @error('item.class_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                    @enderror
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemEdit', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="edit" wire:loading.attr="disabled" wire:click="editItem()">Save
            </x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>
</div>