<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-yellow-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="px-6 pt-4 flex justify-between">

                    <x-label>
                        <a class="group" href="{{ route('area_service.index') }}">

                            <svg class="w-6 h-6 text-yellow-500 group-hover:text-black" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
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
                        Add Service</x-label>
                </div>

                <form id="ServiceDataContainer" class="hidden grid-cols-1 " method="POST"
                    action="{{ route('service.store') }}">
                    @csrf
                    <div class="grid grid-cols-2 max-sm:grid-cols-1 p-4 gap-4 ">

                        <div>
                            <x-label for="ServiceName" class="pl-1">Service Name</x-label>
                            <x-input name="ServiceName" value="{{ old('ServiceName') }}" id="ServiceName"
                                class="w-full" />
                            <x-label class="text-red-500 font-bold pl-1">
                                @error('ServiceName')
                                    {{ $message }}
                                @enderror
                            </x-label>
                        </div>
                        <div>
                            <x-label for="ServiceDescription" class="pl-1">Service Description</x-label>
                            <x-input name="ServiceDescription" value="{{ old('ServiceDescription') }}"
                                id="ServiceDescription" class="w-full" />
                            <x-label class="text-red-500 font-bold pl-1">
                                @error('ServiceDescription')
                                    {{ $message }}
                                @enderror
                            </x-label>
                        </div>

                        <x-input name="Areaid" value="{{ $id }}" id="AreaId" class="w-full" hidden />

                    </div>

                    <x-button class="justify-center mx-4">Save</x-button>
                </form>


                <div class="flex flex-col mt-10">
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
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                                Options</th>


                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 ">

                                        @if (count($services) == 0)
                                            <tr>
                                                <td colspan="4"
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 ">
                                                    There is no Service Registered for this Area</td>
                                            </tr>
                                        @endif

                                        @foreach ($services as $service)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">
                                                    {{ $service->name }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                    {{ $service->description }}</td>
                                                <td
                                                    class="px-6 py-4  whitespace-nowrap text-center text-sm font-medium grid 
                                                    @if ($service->tickets->isEmpty() && $service->entity->isEmpty()) grid-cols-3 @else grid-cols-2 @endif
                                                    ">
                                                    <button onclick="showMoveArea(event)" value="{{ $service->id }}"
                                                        class="text-blue-500 hover:text-blue-700">Move</button>
                                                    <button onclick="showEditService(event)"
                                                        value="{{ $service->id }}"
                                                        class="text-blue-500 hover:text-blue-700">Edit</button>
                                                    @if ($service->tickets->isEmpty() && $service->entity->isEmpty())
                                                        <form method="POST"
                                                            action="{{ route('service.destroy', ['service' => $service->id]) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                class="text-blue-500 hover:text-blue-700">Delete</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            <form method="PUT"
                                                action="{{ route('service.move', ['idService' => $service->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <tr id="{{ 'moveArea - ' . $service->id }}" class="hidden">

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        <x-label for="MoveServiceSelect" class="pl-1">Area to
                                                            move:</x-label>

                                                        <x-select id="MoveServiceSelect" name="MoveServiceSelect">
                                                            <option value="" selected hidden>Select an Area
                                                            </option>
                                                            @foreach ($areas as $area)
                                                                @if ($id != $area->id)
                                                                    <option value="{{ $area->id }}">
                                                                        {{ $area->name }}</option>
                                                                @endif
                                                            @endforeach

                                                        </x-select>
                                                        <x-label class="text-red-500 font-bold pl-1">
                                                            @error('MoveServiceSelect')
                                                                {{ $message }}
                                                            @enderror
                                                        </x-label>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">

                                                        <x-button
                                                            class="w-full justify-center mt-3 bg-yellow-500">Move</x-button>

                                                    </td>
                                                </tr>
                                            </form>
                                            <form method="POST"
                                                action="{{ route('service.update', ['service' => $service->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <tr class="hidden" id="{{ 'editService - ' . $service->id }}">

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">

                                                        <x-label>Name of Service</x-label>
                                                        <x-input name="NewServiceName" class="w-full"
                                                            value="{{ $service->name }}"></x-input>
                                                        <x-label class="text-red-500 font-bold pl-1">
                                                            @error('NewServiceName')
                                                                {{ $message }}
                                                            @enderror
                                                        </x-label>

                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        <x-label>Description of Service</x-label>
                                                        <x-input name="NewServiceDescription" class="w-full"
                                                            value="{{ $service->description }}"></x-input>
                                                        <x-label class="text-red-500 font-bold pl-1">
                                                            @error('NewServiceDescription')
                                                                {{ $message }}
                                                            @enderror
                                                        </x-label>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        <x-button
                                                            class="w-full justify-center mt-3 bg-yellow-500">Update</x-button>
                                                    </td>

                                                </tr>
                                            </form>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @if (count($services) > 0)
                    <div class="px-6 pb-2">
                        {{ $services->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
    <script>
        function showMoveArea(event) {

            let moveAreaContainer = document.getElementById('moveArea - ' + event.target.value)

            moveAreaContainer.classList.toggle('hidden')

        }

        function showEditService(event) {

            let showEditContainer = document.getElementById('editService - ' + event.target.value)

            showEditContainer.classList.toggle('hidden')

        }
    </script>
    <script src="{{ asset('js/service.js') }}"></script>

</x-app-layout>
