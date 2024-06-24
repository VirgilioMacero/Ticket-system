<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service - Area') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-yellow-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-6 pt-4 flex justify-between">

                    <x-label>
                        <a class="group" href="{{route('ticket.index')}}">

                            <svg class="w-6 h-6 text-yellow-500 group-hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                              </svg>

                        </a>

                    </x-label>

                    <x-label
                        class="group bg-yellow-500 text-white px-4 flex flex-row gap-2 py-3 cursor-pointer rounded-md hover:bg-yellow-300 hover:text-black"
                        link="" id="addButton">
                        <svg class="w-4 h-4 text-white group-hover:text-black self-center" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                        Add Service - Area</x-label>


                </div>

                <div id="addAreaNameContainer" class="p-4 hidden">

                    <form method="POST" action="{{route('area_service.store')}}">

                        @csrf

                        <div class="grid grid-cols-2 gap-2">

                            <div>

                                <x-label for="addAreaName" class="pl-1">Area Name</x-label>
                                <x-input id="addAreaName" name="addAreaName" value="{{old('addAreaName')}}" class="w-full"></x-input>
                                <x-label for="addAreaName" class="pl-1 text-red-500">@error('addAreaName')
                                    {{$message}}
                                @enderror</x-label>

                            </div>

                            <div>

                                <x-label for="addAreaMail" class="pl-1">Area Mail</x-label>
                                <x-input id="addAreaMail" name="addAreaMail" value="{{old('addAreaMail')}}" class="w-full"></x-input>
                                <x-label for="addAreaMail" class="pl-1 text-red-500">@error('addAreaMail')
                                    {{$message}}
                                @enderror</x-label>

                            </div>
                        </div>

                        <x-button type="submit" class="w-full justify-center mt-4">Save</x-button>
                    </form>

                </div>



                <div class="mt-4">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 ">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                                    Area - Mail</th>                                                
                                                    <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                                    # Number Of Services</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-center text-sm font-bold text-black uppercase">
                                                    Options</th>


                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 ">




                                            @if (count($AreaService) == 0)
                                                <tr>
                                                    <td colspan="6"
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 ">
                                                        There is no Area - Service Registered</td>
                                                </tr>
                                            @endif


                                            @foreach ($AreaService as $Area)

                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        {{ $Area->name }}</td>                                                    
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        @if ($Area->mail != null)
                                                        
                                                        {{ $Area->mail }}

                                                        @else

                                                        Not Yet...

                                                        @endif</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        {{ count($Area->services) }}</td>


                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 grid grid-cols-3 ">


                                                            <x-label  id="{{$Area->id}}" class="w-full justify-center label-clickable"><svg
                                                                    class=" h-6 cursor-pointer text-green-500 hover:text-black w-full justify-center"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    fill="currentColor" viewBox="0 0 20 18">
                                                                    <path
                                                                        d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                                    <path
                                                                        d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                                                </svg>
                                                            </x-label>
                                                            <input id="" hidden>
                                                        <form
                                                            action="{{ route('service.indexServices' , ['id' => $Area->id]) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button type="submit" class=" w-full">
                                                                <svg class="w-full h-6 text-blue-500 hover:text-black justify-center" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M9.546.5a9.5 9.5 0 1 0 9.5 9.5 9.51 9.51 0 0 0-9.5-9.5ZM13.788 11h-3.242v3.242a1 1 0 1 1-2 0V11H5.304a1 1 0 0 1 0-2h3.242V5.758a1 1 0 0 1 2 0V9h3.242a1 1 0 1 1 0 2Z"/>
                                                                  </svg>
                                                            </button>

                                                        </form>
                                                        @if ($Area->services->isEmpty() && $Area->users->isEmpty())
                                                            
                                                        <form
                                                            action="{{ route('area_service.destroy', ['area_service'=>$Area->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class=" w-full justify-center"><svg
                                                                    class="w-full h-6  mr-0 justify-center text-red-500  hover:text-black"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 18 20">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                                </svg>
                                                            </button>

                                                        </form>
                                                        @endif
                                                    </td>




                                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                   <a class="text-blue-500 hover:text-blue-700" href="#">Delete</a>
                                 </td> --}}
                                                </tr>

                                                <tr id="EditAreaNameContainer-{{$Area->id}}" class="hidden">
                                                    <td colspan="4">
                                                        <div class="p-4">

                                                            <form method="POST" action="{{route('area_service.update',['area_service'=>$Area->id])}}" >
                                                                @method('PUT')
                                                                @csrf

                                                                <div class="grid grid-cols-2 gap-2">
                                                                    <div class="">
                                                                        <x-label for="EditAreaName" class="pl-1">New Area Name</x-label>
                                                                        <x-input id="EditAreaName" value="{{$Area->name}}" name="EditAreaName" class="w-full"></x-input>
                                                                        <x-label for="EditAreaName" class="pl-1 text-red-500">
                                                                            @error('EditAreaName')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </x-label>
                                                                    </div>
                                                                    <div class="">
                                                                        <x-label for="EditAreaMail" class="pl-1">New Area Mail</x-label>
                                                                        <x-input id="EditAreaMail" value="{{$Area->mail}}" name="EditAreaMail" class="w-full"></x-input>
                                                                        <x-label for="EditAreaMail" class="pl-1 text-red-500">
                                                                            @error('EditAreaMail')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </x-label>
                                                                    </div>
                                                                </div>


                                                                <x-button type="submit" class="w-full justify-center mt-4">Update</x-button>
                                                            </form>
                                        
                                                        </div>
                                                    </td>

                                                </tr>


                                            @endforeach







                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($AreaService) > 0)
                    <div class="px-6 pb-2">
                        {{ $AreaService->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script src="{{ asset('js/areaService.js') }}"></script>

</x-app-layout>
