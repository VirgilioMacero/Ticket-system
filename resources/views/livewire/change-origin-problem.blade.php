<x-select class="mt-2" wire:model="select" wire:change="updateService" >
    @foreach ( $services as $service)
    
    <option  value="{{$service->id}}">{{$service->name}}</option>

    @endforeach
</x-select>
