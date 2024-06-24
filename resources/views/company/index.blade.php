<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-yellow-500">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-between w-full">

                    <x-label class="ml-6 mt-4">
                        <a class="group" href="{{route('ticket.index')}}">

                            <svg class="w-6 h-6 text-yellow-500 group-hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                              </svg>

                        </a>

                    </x-label>

                    <x-add-button link="{{ route('company.create') }}" class="mr-4 mt-4">Add Company</x-add-button>


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
                                                    Mail</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                                    Phone</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                                    WebSite</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                                    Address</th>                                                
                                                    <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                                    Services</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-center text-sm font-bold text-black uppercase">
                                                    Options</th>

                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 ">




                                            @if (count($entities) == 0)
                                                <tr>
                                                    <td colspan="7"
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 ">
                                                        There is no Company Registered</td>
                                                </tr>
                                            @endif


                                            @foreach ($entities as $company)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        {{ $company->name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        {{ $company->mail }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        {{ $company->phone }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">
                                                        <a href="{{'https://'.$company->website }}" target="_blank"
                                                            class="text-blue-500 hover:text-blue-700">{{ $company->website }}</a>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        {{ $company->address }}
                                                    </td>
                                                    <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">
                                                    <a href="{{ route('company.showContractedServices',[$company->id])}}"
                                                        class="text-blue-500 hover:text-blue-700 border-2 p-2 border-yellow-500 hover:bg-yellow-500 rounded-lg"> Show Services</a>
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 grid grid-cols-2 gap-4">

                                                        <form
                                                            action="{{ route('company.edit', ['company' => $company->id]) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button type="submit" class=" w-full justify-center"><svg class="w-6 h-6 text-green-500 hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                              <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                                              <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                                                            </svg>
                                                            </button>

                                                        </form>                                                        
                                                        <form
                                                            action="{{ route('employee.indexCompany',['id'=>$company->id]) }}"
                                                            method="GET">
                                                            @csrf
                                                            <button type="submit" class=" w-full justify-center">
                                                                <svg class="w-6 h-6 text-blue-500 hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
                                                                  <path d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                                                                </svg>
                                                            </button>

                                                        </form>

                                                        {{-- <form
                                                            action="{{ route('company.destroy', ['company' => $company->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class=" w-full justify-center"><svg
                                                                    class="w-6 h-6  mr-0 text-red-500  hover:text-black"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 18 20">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                                </svg>
                                                            </button>

                                                        </form> --}}
                                                    </td>




                                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                   <a class="text-blue-500 hover:text-blue-700" href="#">Delete</a>
                                 </td> --}}
                                                </tr>
                                            @endforeach







                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($entities) > 0)
                <div class="px-6 pb-2">
                    {{$entities->links()}}

                </div>
                    
                @endif
            </div>
        </div>
    </div>


</x-app-layout>
