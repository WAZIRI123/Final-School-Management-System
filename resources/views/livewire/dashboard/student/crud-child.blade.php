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
            <x-tall-crud-button mode="delete" wire:loading.attr="disabled" wire:click="deleteItem({{ $student }})">Delete
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
            <div class="grid grid-cols-3 gap-8">
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
                <div class="mt-4">
                    <x-tall-crud-label>Section</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.section">
                        <option value="">Please Select</option>
                        <option value="{{App\Enums\ClassSectionEnum::A->value}}">A</option>
                        <option value="{{App\Enums\ClassSectionEnum::B->value}}">B</option>
                    </x-tall-crud-select>
                    @error('item.section') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
            </div>
         <div class="grid grid-cols-2 gap-8" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
            <div class="mt-4">
                <input wire:model.defer="profile_picture" class="block mt-1 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 hidden" id="large_size1" type="file">
                <label class="block w-full text-lg text-gray-900 py-1.5 bg-blue-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none shadow-sm" for="large_size1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" inline feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                    <span class="inline">
                        @if ($profile_picture)
                            {{ $profile_picture->getClientOriginalName() }}
                            @else
                            Choose Image
                        @endif

                    </span>
                </label>

                    <span max="100" class="w-full" x-show="isUploading" x-bind:value="progress">Uploading......</span>
                @error('profile_picture') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
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
            <div class="grid grid-cols-3 gap-8">

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
                <div class="mt-4">
                    <x-tall-crud-label>Section</x-tall-crud-label>
                    <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.section">
                        <option value="">Please Select</option>
                        <option value="{{App\Enums\ClassSectionEnum::A->value}}">A</option>
                        <option value="{{App\Enums\ClassSectionEnum::B->value}}">B</option>
                    </x-tall-crud-select>
                    @error('item.section') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
                </div>
            </div>
        <div class="grid grid-cols-2 gap-8" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
            <div class="mt-4">
                <input wire:model.defer="profile_picture" class="block mt-1 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 hidden" id="large_size" type="file">
                <label class="block w-full text-lg text-gray-900 py-1.5 bg-blue-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none shadow-sm" for="large_size">

                    <span class="inline">
                        @if ($profile_picture)
                            {{ $profile_picture->getClientOriginalName() }}
                        @else         
                        @if ( str_contains($oldImage,'img/profile_picture/upload/'))
                        <img src="{{ asset('storage/' . $oldImage) }}" alt="profile photo" class=" inline w-10 h-10 rounded-full">
                        Change image
                        @else
                        <img src="{{$oldImage}}" alt="profile photo" class=" inline w-10 h-10 rounded-full">
                        Change image
                        @endif
                        @endif
                    </span>
                </label>
                    <span max="100" class="w-full" wire:target='profile_picture' x-show="isUploading" x-bind:value="progress">Uploading......</span>
                @error('profile_picture') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message>
                @enderror
            </div>
                        <div class="mt-4">
                <x-tall-crud-label>Section</x-tall-crud-label>
                <x-tall-crud-select class="block mt-1 w-full" wire:model.defer="item.section">
                    <option value="">Please Select</option>
                    <option value="{{App\Enums\ClassSectionEnum::A->value}}">A</option>
                    <option value="{{App\Enums\ClassSectionEnum::B->value}}">B</option>
                </x-tall-crud-select>
                @error('item.section') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
            </div>
    </div>

        </x-slot>

        <x-slot name="footer">
            <x-tall-crud-button wire:click="$set('confirmingItemEdit', false)">Cancel</x-tall-crud-button>
            <x-tall-crud-button mode="edit" wire:loading.attr="disabled" wire:click="editItem( {{ $student}})">Save
            </x-tall-crud-button>
        </x-slot>
    </x-tall-crud-dialog-modal>
</div>