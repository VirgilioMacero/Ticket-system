<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $ticket->title }}
        </h2>
    </x-slot>

    <div class="py-12 bg-yellow-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-between w-full">

                    <x-label class="ml-6 mt-4">
                        <a class="group" href="{{route('ticket.index')}}">

                            <svg class="w-6 h-6 text-yellow-500 group-hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                              </svg>

                        </a>

                    </x-label>

                    @if ($ticket->status->state != 'CLOSED')                    
                    <div class="p-4">
                        <div class="border-2 rounded-lg  flex flex-row">
                            <form method="POST" action="{{route('ticket.updateToOpen',['id'=>$ticket->id])}}">
                                @csrf
                                @method('put')
                                <button class=" w-full p-2 text-center hover:bg-green-200 rounded-l-lg @if ($ticket->status->state == 'OPEN') bg-green-500 @endif">Open</button>
                            </form>
                            <form method="POST" action="{{route('ticket.updateToInProgress',['id'=>$ticket->id])}}">
                                @csrf
                                @method('put')
                                <button class=" w-full p-2 border-l-2 text-center hover:bg-yellow-200 rounded-r-lg @if ($ticket->status->state == 'IN PROGRESS') bg-yellow-300 @endif" >In Progress</button>
                            </form>
                        </div>
                    </div>
                    @endif

                  

                </div>

                                {{-- Initial Values --}}

                                <div class="mx-6 p-4 rounded-lg grid grid-cols-3 gap-4 text-justify border-2 @if ($ticket->status->state == 'CLOSED') mt-4  @endif">

                                    <div>
                                        <h1 class="text-3xl">Company name</h1>
                                        <p class="text-lg">{{$ticket->entity->name}}</p>
                                    </div>                    
                                    <div>
                                        <h1 class="text-3xl">Contact name</h1>
                                        <p class="text-lg">@if ($ticket->employee != null)
                                            {{$ticket->employee->name}}
                                            @else
                                            {{$ticket->entity->name}}
                                            @endif</p>
                                    </div>                      
                                    <div>
                                        <h1 class="text-3xl">Contact number</h1>
                                        <p class="text-lg">@if ($ticket->employee != null)
                                            {{$ticket->employee->phone}}
                                            @else
                                            {{$ticket->entity->phone}}
                                            @endif</p>
                                    </div>                    
                                    <div>
                                        <h1 class="text-3xl">Contact mail</h1>
                                        <p class="text-lg">@if ($ticket->employee != null)
                                            {{$ticket->employee->mail}}
                                            @else
                                            {{$ticket->entity->mail}}
                                            @endif</p>
                                    </div>   
                                    <div>
                                        <h1 class="text-3xl">Description</h1>
                                        <p class="text-lg">{{$ticket->problem->description}}</p>
                                    </div>                                     
                                    <div>
                                        <h1 class="text-3xl">Service Area</h1>
                                        @if (auth()->user()->type == 'SUP_USER' && $ticket->status->state != 'CLOSED')
                                            @livewire('change-origin-problem',['ticket'=>$ticket])
                                        @else
                                        <p class="text-lg">{{$ticket->service->name}}</p>
                                        @endif

                                    </div>  
                                    {{-- @if ($ticket->service)
                                    <div>
                                        <h1 class="text-3xl">Quantity</h1>
                                        <p class="text-lg"></p>
                                    </div>
                                    @endif                  --}}
                
                
                
                                </div>

                <div class="p-6 pb-0">

                    <h1 class="text-2xl mb-4">Contracted Services</h1>

                    <div class="flex flex-col mb-10 border-2 rounded-lg">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-y-auto max-h-80">
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



                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 ">

                    @foreach ( $ticket->entity->services as $service)
                    

                    
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
                    
                    
                  
                                                
                                                
                                                @endforeach
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



                @if ($ticket->status->state == "OPEN" || $ticket->status->state == "IN PROGRESS" )
                
                                <form method="POST" action="{{route('ticket.update',['ticket'=>$ticket->id])}}">
                                    @csrf
                                    @method('put')
                                    <div class="p-4">
                    
                                        <x-label for="TicketSolution" class="ml-1">Solution</x-label>
                                        <x-textarea id="TicketSolution" class="h-64" name="TicketSolution">@if($ticket->problem->solution != null){{$ticket->problem->solution}}@endif</x-textarea>
                                        <x-label class="text-red-500 pl-1 font-bold">@error('TicketSolution')
                                            {{$message}}
                                        @enderror
                                        </x-label>
                                        <div class="w-full flex flex-row-reverse">
                                            <x-button name="send" class="bg-yellow-500" value="saveSolution">Save Temporary</x-button>
                                        </div>
                                            
                                    </div>

                                    <x-button name="send" class="w-full justify-center rounded-none bg-red-500 hover:bg-red-200 hover:text-red-500" value="saveTicket">Close Ticket</x-button>
                
                                </form>      
                                
                @else


                <form method="POST" action="{{route('ticket.update',['ticket'=>$ticket->id])}}">
                    @method('put')
                    @csrf
                    <div class="p-6 pt-0">
    
                        <h1 class="text-3xl">Solution</h1>
                        <p class="text-lg">{{$ticket->problem->solution}}</p>

    
                    </div>
    
                    <x-button class="w-full justify-center rounded-none bg-green-500 hover:bg-green-200 hover:text-green-500">Open Ticket</x-button>

                </form>
                

                @endif
                
                
                
                


            </div>
        </div>
    </div>
</x-app-layout>