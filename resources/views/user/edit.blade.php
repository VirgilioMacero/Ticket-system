<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-yellow-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-between w-full">

                    <x-label class="ml-6 mt-4">
                        <a class="group" href="{{ route('user.index') }}">

                            <svg class="w-6 h-6 text-yellow-500 group-hover:text-black" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>

                        </a>

                    </x-label>

                    
                </div>
                <form class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-1" action="{{route('user.update',['user'=>$user->id])}}" method="POST">
                    @method('put')
                    @csrf
                    <div class=" px-4 py-10 grid grid-cols-2 gap-2">
                  
                        <div>
        
                            <x-label for="UserName" class="pl-1">User Name</x-label>
                            <x-input value="{{$user->name}}" id="UserName" name="UserName" class="w-full" />
                            <x-label class="text-red-500 pl-1 font-bold">@error('UserName')
                               
                                {{$message}}
                            @enderror</x-label>
                        </div>                    
                        <div>
        
                            <x-label for="UserMail" class="pl-1">User Mail</x-label>
                            <x-input value="{{$user->email}}" id="UserMail" name="UserMail" class="w-full" />
                            <x-label class="text-red-500 pl-1 font-bold">@error('UserMail')
                               
                                {{$message}}
                            @enderror</x-label>
                        </div>                     
                        <div>
        
                            <x-label for="UserType" class="pl-1">User Type</x-label>
                            <x-select id="UserType" name="UserType" class="w-full">
                            
                                <option hidden value>Select a Value</option>
                                <option {{$user->type == "USER" ? 'selected' : '' }} value="USER">User</option>
                                <option {{$user->type == "ADMIN" ? 'selected' : '' }} value="ADMIN">Admin</option>
                                <option {{$user->type == "SUP_USER" ? 'selected' : '' }} value="SUP_USER">Super User</option>


                            </x-select>
                            <x-label class="text-red-500 pl-1 font-bold">@error('UserType')
                               
                                {{$message}}
                            @enderror</x-label>
                        </div>                     
                        <div>
        
                            <x-label for="AreaService" class="pl-1">Area - Service</x-label>
                            <x-select  id="AreaService" name="AreaService" class="w-full">
                            
                                <option hidden value="" selected>Select a Value</option>

                                @foreach ($areas as $area)

                                <option {{$user->area_service_id== $area->id ? 'selected' : '' }} value="{{$area->id}}">{{$area->name}}</option>
                                
                                @endforeach

                            
                            </x-select>
                            <x-label class="text-red-500 pl-1 font-bold">@error('AreaService') 
                                {{$message}}
                            @enderror</x-label>
                        </div>                     
        
                        <p class="border-2 p-2 rounded-lg border-yellow-500">Note: The Password will not change</p>
                    </div>
                    <x-button type="submit" class="justify-center rounded-tr-none rounded-tl-none py-4">Update</x-button>
    
                </form>

            </div>
        </div>
    </div>

</x-app-layout>
