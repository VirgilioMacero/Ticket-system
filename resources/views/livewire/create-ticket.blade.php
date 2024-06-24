<form wire:submit.prevent="save" method="POST" class="p-4">
   
    @csrf


    <div class="grid grid-cols-4 gap-4">

        <div>

            <x-label for="entity" class="pl-1">Company/Entity</x-label>
            <x-select wire:model="entity" id="entity" name="entity" wire:change="loadSelects">
    
                <option value="" selected hidden>Select One Company</option>
                
                    @foreach ($entitys as $entity)
                    
                    <option value="{{$entity->id}}">{{$entity->name}}</option>
                
                    @endforeach
    
                <option value="Walk-In Company">Walk-In Company</option>
            </x-select>
            <x-label class="text-red-500 font-bold pl-1">
                @error('entity')
                    {{ $message }}
                @enderror
            </x-label>

        </div>
        <div>

            <x-label for="employee" class="pl-1">Employee</x-label>
            <x-select wire:model="employee" id="employee" name="employee">
                
                <option value="" selected hidden>Select an Employee </option>
                
                @if ($companyEmployees != null)
                
                
                @if (count($companyEmployees)>0)
                
                    @foreach ($companyEmployees as $employee)
                    
                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                    
                    @endforeach
                    
                    @else
                    
                    <option value="N/A" >N/A</option>
                    
                    @endif


                @endif

    
    
            </x-select>
            <x-label class="text-red-500 font-bold pl-1">
                @error('employee')
                    {{ $message }}
                @enderror
            </x-label>

        </div>       
        <div>

            <x-label for="service" class="pl-1">Service</x-label>
            <x-select wire:model="service" id="service" name="service">
                
                <option value="" selected hidden>Select a Service</option>
                @if ($contractedServices)
                    
                @foreach ($contractedServices as $service)
                
                <option value="{{$service->id}}">{{$service->name}}</option>
            
                @endforeach

                @endif

    
    
            </x-select>
            <x-label class="text-red-500 font-bold pl-1">
                @error('service')
                    {{ $message }}
                @enderror
            </x-label>

        </div>
        <div>

            <x-label for="type" class="pl-1">Method</x-label>
            <x-select wire:model="type" id="type" name="type">
                
                <option value="" selected hidden>Select Contacted Method</option>
                <option value="Call" >Call</option>
                <option value="Mail" >Mail</option>
                <option value="Message" >Message</option>                
                <option value="Presencial" >Presencial</option>
    
            </x-select>
            <x-label class="text-red-500 font-bold pl-1">
                @error('type')
                    {{ $message }}
                @enderror
            </x-label>
        </div>        
        <div class="@if($this->entity != "Walk-In Company") hidden  @endif">
            

            <x-label for="newEntityName" class="pl-1">Name</x-label>
            <x-input wire:model="newEntityName" name="newEntityName" class="w-full"></x-input>
            <x-label class="text-red-500 font-bold pl-1">
                @error('newEntityName')
                    {{ $message }}
                @enderror
            </x-label>

        </div>        
        <div class="@if($this->entity != "Walk-In Company") hidden  @endif">

            <x-label for="newEntitymail" class="pl-1">Mail</x-label>
            <x-input wire:model="newEntitymail" name="newEntitymail" class="w-full"></x-input>
            <x-label class="text-red-500 font-bold pl-1">
                @error('newEntitymail')
                    {{ $message }}
                @enderror
            </x-label>

        </div>        
        <div class="@if($this->entity != "Walk-In Company") hidden  @endif">

            <x-label for="newEntityphone" class="pl-1">Phone</x-label>
            <x-input wire:model="newEntityphone" name="newEntityphone" class="w-full"></x-input>
            <x-label class="text-red-500 font-bold pl-1">
                @error('newEntityphone')
                    {{ $message }}
                @enderror
            </x-label>

        </div>

    </div>
    <div class="mt-4">
        <x-label for="titleTicket" class="pl-1">Title</x-label>
        <x-input wire:model="titleTicket" id="titleTicket" name="titleTicket" class="w-full"></x-input>
        <x-label class="text-red-500 font-bold pl-1">
            @error('titleTicket')
                {{ $message }}
            @enderror
        </x-label>
    </div>
    <div class="mt-4">
        <x-label class="pl-1">Description</x-label>
        <x-textarea wire:model="descriptionTicket" id="descriptionTicket" name="descriptionTicket" class="w-full h-52"></x-textarea>
        <x-label class="text-red-500 font-bold pl-1">
            @error('descriptionTicket')
                {{ $message }}
            @enderror
        </x-label>
    </div>
    <x-button class="w-full justify-center mt-2">Create Ticket</x-button>

</form>
