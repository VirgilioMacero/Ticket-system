<div class="p-4">
    <div class="flex justify-between max-sm:grid max-sm:grid-cols-1">
        <div>
            <x-label class="pl-1">Sort By:</x-label>
            <div>
                <div class="border-2 rounded-lg max-sm:w-[237px]">
                    <button
                        class="p-2 border-r-2 text-center hover:bg-green-300 rounded-l-lg @if ($state == 'OPEN') bg-green-500 @endif"
                        wire:click="setOpen">Open</button>
                    <button
                        class="p-2 border-x-2 text-center hover:bg-yellow-200 @if ($state == 'IN PROGRESS') bg-yellow-300 @endif"
                        wire:click="setInProgress">In Progress</button>
                    <button
                        class="p-2 border-l-2 text-center hover:bg-red-300 rounded-r-lg @if ($state == 'CLOSED') bg-red-500 @endif"
                        wire:click="setClosed">Closed</button>
                </div>
            </div>
        </div>
        
        <div>
            <x-label>Sort by working area:</x-label>
            <div class="">
                <div class="max-sm:w-[166px] rounded-lg border-2">
                    <button
                        class="p-2 border-r-2 text-center hover:bg-yellow-200 rounded-l-lg @if ($workArea == auth()->user()->area_service_id) bg-yellow-300 @endif"
                        wire:click="setMyArea">My Area</button>
                    <button
                        class="p-2 border-l-2 text-center hover:bg-yellow-200 rounded-r-lg @if ($workArea != auth()->user()->area_service_id) bg-yellow-300 @endif"
                        wire:click="setAllAreas">All Areas</button>
                </div>
            </div>
        </div>
        <x-add-button link="{{ route('ticket.create') }}" class="max-sm:justify-center">Create Ticket</x-add-button>
    </div>
    <div class="flex flex-row mt-4 mb-2 gap-2">
        <x-label class="pl-1 self-center">Search:</x-label>

    </div>
    <x-input wire:model="value" wire:input="search" class="w-full"></x-input>

    <div class="flex flex-col mt-10">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 ">
                        <thead>
                            <tr>
                                {{-- <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Description</th> --}}
                                <th scope="col" wire:click="order('entity')"
                                    class="px-6 py-3 text-left hover:cursor-pointer hover:border-2 text-sm font-bold text-black uppercase">
                                    Company</th>
                                <th scope="col" wire:click="order('employee')"
                                    class="px-6 py-3 text-left hover:cursor-pointer hover:border-2 text-sm font-bold text-black uppercase">
                                    Employee</th>                                
                                    <th scope="col" wire:click="order('area')"
                                    class="px-6 py-3 text-left hover:cursor-pointer hover:border-2 text-sm font-bold text-black uppercase">
                                    Area</th>
                                <th scope="col" wire:click="order('title')"
                                    class="px-6 py-3 text-left hover:cursor-pointer hover:border-2 text-sm font-bold text-black uppercase">
                                    Title</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                    Via</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                    Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                    Expert in it</th>
                                <th scope="col" wire:click="order('created_at')"
                                    class="px-6 py-3 text-left hover:cursor-pointer hover:border-2 text-sm font-bold text-black uppercase">
                                    Opened At</th>
                                <th scope="col" wire:click="order('updated_at')"
                                    class="px-6 py-3 text-left hover:cursor-pointer hover:border-2 text-sm font-bold text-black uppercase">
                                    Closed At</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                    Total Time</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 ">
                            {{-- 
                            @if ($tickets->count() == 0)
                                <tr>
                                    <td colspan="10"
                                        class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 ">
                                        There are no tickets Registered</td>
                                </tr>
                            @endif --}}

                            @foreach ($tickets as $ticket)
                            
                           
                            
                            <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                        {{ $ticket->entity->name }}</td>

                                    @if (isset($ticket->employee->name))
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                            {{ $ticket->employee->name }}</td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                            N/A</td>
                                    @endif

                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                        {{ $ticket->service->areaServices->name }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">
                                        <a href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}"
                                            class="text-blue-500 hover:text-blue-700">{{ $ticket->title }}</a>
                                    </td>

                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                        {{ \Illuminate\Support\Str::limit($ticket->problem->description,40)}}</td> --}}


                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                        {{ $ticket->type}}</td>
                                    @if ($ticket->status->state == 'OPEN')
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-green-500 ">
                                            {{ $ticket->status->state }}</td>
                                    @elseif($ticket->status->state == 'CLOSED')
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-red-500 ">
                                            {{ $ticket->status->state }}</td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-yellow-500 ">
                                            {{ $ticket->status->state }}</td>
                                    @endif

                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                        {{ $ticket->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                        {{ $ticket->status->created_at }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">

                                        @if (
                                            $ticket->status->updated_at != $ticket->status->created_at &&
                                                $ticket->status->state != 'OPEN' &&
                                                $ticket->status->state != 'IN PROGRESS')
                                            {{ $ticket->status->updated_at }}
                                        @else
                                            Not Yet..
                                        @endif

                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">

                                        @if (
                                            $ticket->status->updated_at != $ticket->status->created_at &&
                                                $ticket->status->state != 'OPEN' &&
                                                $ticket->status->state != 'IN PROGRESS')
                                            {{ $ticket->status->updated_at->diffForHumans($ticket->status->created_at) }}
                                        @else
                                            Not Yet..
                                        @endif

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if (count($tickets) > 0)
            <div class="px-6 pb-2">
                {{ $tickets->links() }}

            </div>
        @endif
    </div>




</div>
