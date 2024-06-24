<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Company') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-yellow-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-1" action="{{route('company.update',['company'=>$company])}}" method="POST">
                @csrf

                <x-label class="pl-6 pt-4 pb-0">
                    <a class="group" href="{{route('company.index')}}">

                        <svg class="w-6 h-6  text-yellow-500 group-hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                          </svg>

                    </a>

                </x-label>

                @method("put")
                <div class=" px-4 py-10 grid grid-cols-2 gap-2">
              
                    <div>
    
                        <x-label for="CompanyName" class="pl-1">Company Name</x-label>
                        <x-input value="{{$company->name}}" id="CompanyName" name="CompanyName" class="w-full" />
                        <x-label class="text-red-500 pl-1 font-bold">@error('CompanyName')
                           
                            {{$message}}
                        @enderror</x-label>
                    </div>                    
                    <div>
    
                        <x-label for="CompanyPhone" class="pl-1">Company Phone</x-label>
                        <x-input value="{{$company->phone}}" id="CompanyPhone" name="CompanyPhone" class="w-full" />
                        <x-label class="text-red-500 pl-1 font-bold">@error('CompanyPhone')
                           
                            {{$message}}
                        @enderror</x-label>
                    </div>                     
                    <div>
    
                        <x-label for="CompanyMail" class="pl-1">Company Mail</x-label>
                        <x-input value="{{$company->mail}}" id="CompanyMail" name="CompanyMail" class="w-full" />
                        <x-label class="text-red-500 pl-1 font-bold">@error('CompanyMail')
                           
                            {{$message}}
                        @enderror</x-label>
                    </div>                     
                    <div>
    
                        <x-label for="CompanyAddress" class="pl-1">Company Address</x-label>
                        <x-input value="{{$company->address}}" id="CompanyAddress" name="CompanyAddress" class="w-full" />
                        <x-label class="text-red-500 pl-1 font-bold">@error('CompanyAddress')
                           
                            {{$message}}
                        @enderror</x-label>
                    </div>                     
                    <div>
    
                        <x-label for="CompanyWebPage" class="pl-1">Company WebPage</x-label>
                        <x-input value="{{$company->website}}" id="CompanyWebPage" name="CompanyWebPage" class="w-full" />
                    </div> 
    
                </div>

                <x-button type="submit" class="justify-center rounded-tr-none rounded-tl-none py-4">Update</x-button>

            </form>
        </div>
    </div>

</x-app-layout>