<div>
    @php
        use Carbon\Carbon;
    @endphp
    <div class="grid grid-cols-4 gap-4">
        <div>
            <x-label class="pl-1" for="CompanyName">Company Name</x-label>
            <x-select name="CompanyName" id="CompanyName" wire:model="Entity" wire:change="loadSelects">
                <option value="ALL" hidden selected>Select a Company</option>
                @foreach ($entities as $entity)
                    <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                @endforeach
            </x-select>
        </div>
        <div>
            <x-label class="pl-1" for="CompanyEmployee">Company employee</x-label>
            <x-select name="CompanyEmployee" id="CompanyEmployee" wire:change="FilterByTime"
                wire:model="EntityEmployee">
                <option value="" hidden selected>Select an Employee</option>
                @if (isset($this->Employees))

                    @foreach ($this->Employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach

                @endif
            </x-select>
        </div>
        <div>

            <x-label class="pl-1" for="Area">Area - Service</x-label>
            <x-select name="Area" id="Area" wire:change="FilterByTime" wire:model="Area">
                <option value="" hidden selected>Select an Area</option>
                @if (isset($areas))

                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach

                @endif
            </x-select>

        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-label class="pl-1" for="TicketMonth">Month</x-label>
                <x-select name="TicketMonth" id="TicketMonth" wire:model="SelectedMonth" wire:change="FilterByTime">
                    <option value="" hidden selected>Select a Month</option>
                    @if (!empty($this->TicketsMonth))

                        @foreach ($this->TicketsMonth as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach

                    @endif
                </x-select>
            </div>
            <div>
                <x-label class="pl-1" for="TicketYear">Year</x-label>
                <x-select name="TicketYear" id="TicketYear" wire:model="SelectedYear" wire:change="FilterByTime">
                    <option value="" hidden selected>Select a Year</option>
                    @if (!empty($this->TicketsYear))

                        @foreach ($this->TicketsYear as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach

                    @endif
                </x-select>
            </div>
        </div>


    </div>

    <div
        class="border-2 border-yellow-500 p-4 mt-4 rounded-lg  @if ($Entity != null) grid grid-cols-3 gap-4 @endif">

        @if ($this->SelectedMonth != null || $this->SelectedYear != null)

            @if ($this->SelectedMonth != null && $this->SelectedYear != null)
                <div>
                    <h1 class="text-2xl font-bold">N# tickets made in
                        {{ Carbon::create()->month((int) $this->SelectedMonth)->format('F') }}
                        {{ ' ' . $this->SelectedYear }}</h1>
                    <h1>{{ count($this->ticketsFiltered) }}</h1>
                </div>
                <div></div>
                <div>
                    <h1 class="text-2xl font-bold">Total time made in
                        {{ Carbon::create()->month((int) $this->SelectedMonth)->format('F') }}
                        {{ ' ' . $this->SelectedYear }}</h1>
                    <h1>{{ $formattedTotalTime }}</h1>
                </div>
                @if (count($this->ticketsFiltered) != 0)
                    <div class="w-full">
                        <livewire:livewire-column-chart key="{{ $chart->reactiveKey() }}" :column-chart-model="$chart" />
                    </div>
                    <div>
                        <livewire:livewire-pie-chart key="{{ $chartEntity->reactiveKey() }}" :pie-chart-model="$chartEntity" />
                    </div>
                    <div>
                        <livewire:livewire-pie-chart key="{{ $pieChart->reactiveKey() }}" :pie-chart-model="$pieChart" />
                    </div>
                @endif
            @elseif ($this->SelectedMonth != null)
                <div>
                    <h1 class="text-2xl font-bold">N# tickets made in
                        {{ Carbon::create()->month((int) $this->SelectedMonth)->format('F') }}</h1>
                    <h1>{{ count($this->ticketsFiltered) }}</h1>
                </div>
                <div></div>
                <div>
                    <h1 class="text-2xl font-bold">Total time made in
                        {{ Carbon::create()->month((int) $this->SelectedMonth)->format('F') }}</h1>
                    <h1>{{ $formattedTotalTime }}</h1>
                </div>
                @if (count($this->ticketsFiltered) != 0)
                    <div class="w-full">
                        <livewire:livewire-column-chart key="{{ $chart->reactiveKey() }}" :column-chart-model="$chart" />
                    </div>
                    <div>
                        <livewire:livewire-pie-chart key="{{ $chartEntity->reactiveKey() }}" :pie-chart-model="$chartEntity" />
                    </div>
                    <div>
                        <livewire:livewire-pie-chart key="{{ $pieChart->reactiveKey() }}" :pie-chart-model="$pieChart" />
                    </div>
                @endif
            @elseif ($this->SelectedYear != null)
                <div>
                    <h1 class="text-2xl font-bold">N# tickets made in year: {{ $this->SelectedYear }}</h1>
                    <h1>{{ count($this->ticketsFiltered) }}</h1>
                </div>
                <div></div>
                <div>
                    <h1 class="text-2xl font-bold">Total time made in year: {{ $this->SelectedYear }}</h1>
                    <h1>{{ $formattedTotalTime }}</h1>
                </div>
                @if (count($this->ticketsFiltered) != 0)
                    <div class="w-full">
                        <livewire:livewire-column-chart key="{{ $chart->reactiveKey() }}" :column-chart-model="$chart" />
                    </div>
                    <div>
                        <livewire:livewire-pie-chart key="{{ $chartEntity->reactiveKey() }}" :pie-chart-model="$chartEntity" />
                    </div>
                    <div>
                        <livewire:livewire-pie-chart key="{{ $pieChart->reactiveKey() }}" :pie-chart-model="$pieChart" />
                    </div>
                @endif
            @endif
        @else
            <div class="col-span-3">

                <h1 class="text-center">Please select a month or year for filtering</h1>

            </div>

        @endif

    </div>



    @if ($this->SelectedMonth != null || $this->SelectedYear != null)

        <div class="flex flex-col mt-10">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-y-auto max-h-[600px]">
                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead>
                                <tr>
                                    {{-- <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Description</th> --}}
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                        Company</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                        Employee</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                        Area</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                        Title</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                        Via</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                        Opened By</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                        Opened At</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                        Closed At</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-sm font-bold text-black uppercase">
                                        Total Time</th>

                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 ">


                                @foreach ($areas as $area)
                                    @if (in_array($area->name, $this->shownAreas))
                                        <tr class="bg-yellow-500">

                                            <td colspan="10"
                                                class="px-6 py-4 whitespace-nowrap text-center text-sm text-white ">

                                                {{ $area->name }}

                                            </td>

                                        </tr>
                                    @endif


                                    @foreach ($this->ticketsFiltered as $ticket)
                                        @if ($area->id == $ticket->service->area_service_id)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                                    {{ $ticket->entity->name }}</td>

                                                @if (isset($ticket->employee->name))
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                                        {{ $ticket->employee->name }}</td>
                                                @else
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                                        N/A</td>
                                                @endif

                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                                    {{ $ticket->service->areaServices->name }}</td>

                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">
                                                    <a href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}"
                                                        class="text-blue-500 hover:text-blue-700">{{ $ticket->title }}</a>
                                                </td>

                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                                    {{ $ticket->type }}</td>


                                                @if ($ticket->status->state == 'OPEN')
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-left text-sm text-green-500 ">
                                                        {{ $ticket->status->state }}</td>
                                                @elseif($ticket->status->state == 'CLOSED')
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-left text-sm text-red-500 ">
                                                        {{ $ticket->status->state }}</td>
                                                @else
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-left text-sm text-yellow-500 ">
                                                        {{ $ticket->status->state }}</td>
                                                @endif



                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                                    {{ $ticket->user->name }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">
                                                    {{ $ticket->status->created_at }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">

                                                    @if (
                                                        $ticket->status->updated_at != $ticket->status->created_at &&
                                                            $ticket->status->state != 'OPEN' &&
                                                            $ticket->status->state != 'IN PROGRESS')
                                                        {{ $ticket->status->updated_at }}
                                                    @else
                                                        Not Yet..
                                                    @endif

                                                </td>

                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-left text-sm text-gray-800 ">

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
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif




</div>
