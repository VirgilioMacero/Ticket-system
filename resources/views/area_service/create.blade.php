<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Area - Service') }}
        </h2>
    </x-slot>

    <div class="py-12 ">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-1" action="{{route('area_service.store')}}" method="POST">
                @csrf
                <div class=" px-4 py-10 grid grid-cols-2 gap-2">
              
                    <div>
    
                        <x-label for="CompanyName" class="pl-1">Area Name</x-label>
                        <x-input value="{{old('CompanyName')}}" id="CompanyName" name="CompanyName" class="w-full" />
                        <x-label class="text-red-500 pl-1 font-bold">@error('CompanyName')
                           
                            {{$message}}
                        @enderror</x-label>
                    </div>                    
                    <div>
    
                        <x-label for="CompanyPhone" class="pl-1">Company Phone</x-label>
                        <x-input value="{{old('CompanyPhone')}}" id="CompanyPhone" name="CompanyPhone" class="w-full" />
                        <x-label class="text-red-500 pl-1 font-bold">@error('CompanyPhone')
                           
                            {{$message}}
                        @enderror</x-label>
                    </div>                     
                    <div>
    
                        <x-label for="CompanyMail" class="pl-1">Company Mail</x-label>
                        <x-input value="{{old('CompanyMail')}}" id="CompanyMail" name="CompanyMail" class="w-full" />
                        <x-label class="text-red-500 pl-1 font-bold">@error('CompanyMail')
                           
                            {{$message}}
                        @enderror</x-label>
                    </div>                     
                    <div>
    
                        <x-label for="CompanyAddress" class="pl-1">Company Address</x-label>
                        <x-input value="{{old('CompanyAddress')}}" id="CompanyAddress" name="CompanyAddress" class="w-full" />
                        <x-label class="text-red-500 pl-1 font-bold">@error('CompanyAddress')
                           
                            {{$message}}
                        @enderror</x-label>
                    </div>                     
                    <div>
    
                        <x-label for="CompanyWebPage" class="pl-1">Company WebPage</x-label>
                        <x-input value="{{old('CompanyWebPage')}}" id="CompanyWebPage" name="CompanyWebPage" class="w-full" />
                    </div> 
    
                </div>

                <x-button type="submit" class="justify-center rounded-tr-none rounded-tl-none py-4">Save</x-button>

            </form>
        </div>
    </div>


</x-app-layout>