<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contracted Services') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-yellow-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-6 pt-4 flex justify-between">

                    <x-label>
                        <a class="group" href="{{route('company.index')}}">

                            <svg class="w-6 h-6 text-yellow-500 group-hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                              </svg>

                        </a>

                    </x-label>                    
                </div>

                @livewire('entity-services',['company'=>$company])

                <div class="p-4 mt-4 text-center">

                    @if (count($Areas) == 0)
                    <tr>
                        <td colspan="6"
                            class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 ">
                            There are no Services Registered for This Company</td>
                    </tr>
                    @endif
                    
                    @foreach ($Areas as $Area)
                    
                    <h1 class="text-2xl bg-yellow-500 text-black p-4 rounded-t-lg">{{$Area}}</h1>
                    
                    <div class="flex flex-col mb-10 border-2 rounded-b-lg">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 ">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Description</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Quantity</th>                                                
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                    Options</th>


                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 ">

                    @foreach ( $company->services as $service)
                    
                    @if ($service->areaServices->name == $Area)
                    
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                                    {{ $service->name}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-left  text-sm text-gray-800 ">
                                                    {{$service->description}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-left  text-sm text-gray-800 ">
                                                @if ($service->pivot->quantity <= 0)
                                                N/A
                                                @else
                                                {{$service->pivot->quantity}}

                                                @endif    
                                                
                    
                    
                                            </td> 
                    
                                            <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                                <form method="POST"
                                                    action="{{ route('company.destroyContractedService', ['CompanyId'=>$company->id,'ServiceId' => $service->id]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        class="text-blue-500 hover:text-blue-700">Delete</button>
                                                </form>
                                            </td>
                    
                    @endif
                                                
                                                
                                                @endforeach
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>