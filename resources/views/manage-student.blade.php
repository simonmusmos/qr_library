<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Students') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-manage-book /> --}}
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    {{-- <div>
                        <x-jet-application-logo class="block h-12 w-auto" />
                    </div> --}}
                
                    <div class="text-xl">
                        Manage Students
                    </div>
                
                    
                </div>
                
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 p-6">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-center" scope="col">#</th>
                            <th class="text-center" scope="col">Student Name</th>
                            <th class="text-center" scope="col">Student Number</th>
                            <th class="text-center" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($students) > 0)
                            @foreach($students as $student)
                            <tr>
                                <th class="text-center" scope="row">{{ $student->id }}</th>
                                <td class="text-center">{{ $student->student_name }}</td>
                                <td class="text-center">{{ $student->student_number }}</td>
                                <td class="text-center">
                                    @if($student->qr_code != "")
                                        <a id="download_qr_button" href="{{ url('images/qr-code/') }}/{{ $student->qr_code }}" download><x-jet-button class="mt-4 ">
                                            {{ __('Download') }}
                                        </x-jet-button></a>
                                    @endif
                                    <a href="{{ route('books.logs', ['student' => $student->id]) }}"><x-jet-button class="mt-4 " id="view-book-log-button" type="button">
                                        {{ __('Borrow Log') }}
                                    </x-jet-button></a>

                                    <a href="{{ route('students.logs', ['student' => $student->id]) }}"><x-jet-button class="mt-4 " id="view-book-log-button" type="button">
                                        {{ __('Student Log') }}
                                    </x-jet-button></a>

                                    <x-jet-button class="delete-student-button" type="button" onClick="deleteAction({{ $student->id }})">
                                        {{ __('Delete') }}
                                    </x-jet-button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            
                            <td colspan=4 class="text-center">No Data Found</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $students->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
