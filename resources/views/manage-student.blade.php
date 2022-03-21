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
                            <th scope="col">#</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Student Number</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($students) > 0)
                            @foreach($students as $student)
                            <tr>
                                <th scope="row">{{ $student->id }}</th>
                                <td>{{ $student->student_name }}</td>
                                <td>{{ $student->student_number }}</td>
                                <td>
                                    @if($student->qr_code != "")
                                        <a id="download_qr_button" href="{{ url('images/qr-code/') }}/{{ $student->qr_code }}" download><x-jet-button class="mt-4 ">
                                            {{ __('Download') }}
                                        </x-jet-button></a>
                                    @endif
                                    <x-jet-button class="mt-4 " id="delete-book-button" type="button">
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
