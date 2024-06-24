<form id="AddServiceEntityContainer" wire:submit.prevent="save" class="grid grid-cols-1 mt-6">

    <div class="pt-4 px-4 grid gap-2 grid-cols-3">
        <div>
            <x-label for="areaService" class="pl-1">Service Area</x-label>
            <x-select wire:change="updateSelectService" wire:model="areaService" id="areaService" name="areaService" class="w-full">
                
                <option selected>Select an Area Service</option>
                @foreach ($areasServices as $area)
                
                <option value="{{$area->id}}">{{$area->name}}</option>

                @endforeach

            </x-select>
            <x-label class="text-red-500 font-bold pl-1">
                @error('areaService')
                    {{ $message }}
                @enderror
            </x-label>
        </div>                
            <div>
            <x-label for="Service" class="pl-1">Service</x-label>
            <x-select wire:model="Service" id="Service" name="Service" class="w-full">
                
                <option selected>Select a Service</option>
                @if ($services)                
                @foreach ($services as $service)
                <option value="{{$service->id}}">{{$service->name}}</option>
                @endforeach
                @endif
                
            </x-select>
            <x-label class="text-red-500 font-bold pl-1">
                @error('Service')
                    {{ $message }}
                @enderror
            </x-label>
        </div>            
        <div>
            <x-label for="Quantity" class="pl-1">Quantity</x-label>
            <x-select wire:model="Quantity" id="Quantity" name="Quantity" class="w-full">
                
                <option selected>Select a Service</option>
                <option value="N/A">N/A</option>
                <option value="Apply">Apply</option>
            
            </x-select>
            <x-label class="text-red-500 font-bold pl-1">
                @error('Quantity')
                    {{ $message }}
                @enderror
            </x-label>
            </div>
        </div>
        <div class="p-4">
            <x-label class="pl-1" for="InsertQuantity">Insert Quantity</x-label>
            <x-input wire:model="InsertQuantity" name="InsertQuantity" id="InsertQuantity" class="w-full"></x-input>
            <x-label class="text-red-500 font-bold pl-1">
                @error('InsertQuantity')
                    {{ $message }}
                @enderror
            </x-label>
        </div>
        <x-button class="mx-4 justify-center">Add Service</x-button>

</form>
