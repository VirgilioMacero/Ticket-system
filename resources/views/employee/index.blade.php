<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-yellow-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="px-6 pt-4 flex justify-between">

                    <x-label>
                        <a class="group" href="{{ route('company.index') }}">

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
                        Add Employee</x-label>
                </div>

                <form id="EmployeeDataContainer" class="hidden grid-cols-1 " method="POST"
                    action="{{ route('employee.store') }}">
                    @csrf
                    <div class="grid grid-cols-3 max-sm:grid-cols-1 p-4 gap-4 ">

                        <div>
                            <x-label for="EmployeeName" class="pl-1">Employee's Name</x-label>
                            <x-input name="EmployeeName" value="{{ old('EmployeeName') }}" id="EmployeeName"
                                class="w-full" />
                            <x-label class="text-red-500 font-bold pl-1">
                                @error('EmployeeName')
                                    {{ $message }}
                                @enderror
                            </x-label>
                        </div>
                        <div>
                            <x-label for="EmployeeMail" class="pl-1">Employee's Mail</x-label>
                            <x-input name="EmployeeMail" value="{{ old('EmployeeMail') }}" id="EmployeeMail"
                                class="w-full" />
                            <x-label class="text-red-500 font-bold pl-1">
                                @error('EmployeeMail')
                                    {{ $message }}
                                @enderror
                            </x-label>
                        </div>
                        <div>
                            <x-label for="EmployeePhone" class="pl-1">Employee's Phone</x-label>
                            <x-input name="EmployeePhone" value="{{ old('EmployeePhone') }}" id="EmployeePhone"
                                class="w-full" />
                            <x-label class="text-red-500 font-bold pl-1">
                                @error('EmployeePhone')
                                    {{ $message }}
                                @enderror
                            </x-label>
                        </div>
                        <x-input name="Companyid" value="{{ $id }}" id="CompanyId" class="w-full" hidden />

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
                                                Mail</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Phone</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                                Options</th>

                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 ">

                                        @if (count($employee) == 0)
                                            <tr>
                                                <td colspan="4"
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 ">
                                                    There is no Employee Registered for this Company</td>
                                            </tr>
                                        @endif

                                        @foreach ($employee as $empleado)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">
                                                    {{ $empleado->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                    {{ $empleado->mail }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                    {{ $empleado->phone }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium grid grid-cols-2">
                                                    <button onclick="showEditEmployee(event)"
                                                        value="{{ $empleado->id }}"
                                                        class="text-blue-500 hover:text-blue-700">Edit</button>
                                                    @if ($empleado->tickets->isEmpty() && count($employee) > 1)
                                                        <form method="POST"
                                                            action="{{ route('employee.destroy', ['employee' => $empleado->id, 'id' => $id]) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                class="text-blue-500 hover:text-blue-700">Delete</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            <form method="POST" action="{{route('employee.update',['employee'=>$empleado->id])}}">
                                                @csrf
                                                @method('PUT')
                                                <tr class="hidden" id="{{'editEmployee - '.$empleado->id}}" >

                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">

                                                        <x-label>Name of Employee</x-label>
                                                        <x-input name="NewEmployeeName" class="w-full" value="{{$empleado->name}}"></x-input>
                                                        <x-label class="text-red-500 font-bold pl-1">
                                                            @error('NewEmployeeName')
                                                                {{ $message }}
                                                            @enderror
                                                        </x-label>

                                                    </td>                                                    
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        <x-label>Employee Mail</x-label>
                                                        <x-input name="NewEmployeeMail" class="w-full" value="{{$empleado->mail}}"></x-input>
                                                        <x-label class="text-red-500 font-bold pl-1">
                                                            @error('NewEmployeeMail')
                                                                {{ $message }}
                                                            @enderror
                                                        </x-label>
                                                    </td>                                                    
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                        <x-label>Employee Phone</x-label>
                                                        <x-input name="NewEmployeePhone" class="w-full" value="{{$empleado->phone}}"></x-input>
                                                        <x-label class="text-red-500 font-bold pl-1">
                                                            @error('NewEmployeePhone')
                                                                {{ $message }}
                                                            @enderror
                                                        </x-label>
                                                    </td>                                                    
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                                    <x-button class="w-full justify-center mt-3 bg-yellow-500">Update</x-button>
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
            </div>
        </div>
    </div>

    <script src="{{ asset('js/employee.js') }}"></script>

</x-app-layout>
