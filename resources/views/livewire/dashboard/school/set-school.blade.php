<div>
@role('super-admin')

<div class="grid grid-cols-1">
    <div class="mb-4">
        @error('school_id') <x-tall-crud-error-message>{{$message}}</x-tall-crud-error-message> @enderror
        <x-tall-crud-label class="text-center mb-4">Set working school branch</x-tall-crud-label>
        <x-tall-crud-select class="block mt-1 w-full text-center " wire:model.defer="school_id">
            @foreach($schools as $school)
            <option  value="{{$school->id}}" >{{$school->name}}</option>
            @endforeach
        </x-tall-crud-select>
    </div>
    <div class="grid grid-cols-1 flex items-center text-center ">
        <div class="mb-4">
    <x-tall-crud-button class="w- text-center" mode="add" wire:loading.attr="disabled" wire:click="setSchool()">Set School
    </x-tall-crud-button>
        </div>
    </div>

@endrole
</div>
