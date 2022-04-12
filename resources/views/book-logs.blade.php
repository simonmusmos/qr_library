<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Books') }}
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
                        View Logs
                    </div>
                
                    
                </div>
                
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 p-6">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            @if($all)
                                <th class="text-center">Book Name</th>
                                <th class="text-center">Book ISBN</th>
                                <th class="text-center">Borrower Name</th>
                                <th class="text-center">Borrower Student Number</th>
                            @elseif($is_student)
                                <th class="text-center">Book Name</th>
                                <th class="text-center">Book ISBN</th>
                            @elseif($is_book)
                                <th class="text-center">Student Name</th>
                                <th class="text-center">Student Number</th>
                            @endif
                            <th class="text-center">Type</th>
                            <th class="text-center">Date and Time</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($logs) > 0)
                        @foreach($logs as $log)
                        <tr>
                            <th scope="row"  class="text-center">{{ $log->id }}</th>
                            @if($all)
                                <td class="text-center">{{ $log->book->book_title }}</td>
                                <td class="text-center">{{ $log->book->isbn }}</td>
                                <td class="text-center">{{ $log->student->student_name }}</td>
                                <td class="text-center">{{ $log->student->student_number }}</td>
                            @elseif($is_student)
                                <td class="text-center">{{ $log->book->book_title }}</td>
                                <td class="text-center">{{ $log->book->isbn }}</td>
                            @elseif($is_book)
                                <td class="text-center">{{ $log->student->student_name }}</td>
                                <td class="text-center">{{ $log->student->student_number }}</td>
                            @endif

                            @if($log->is_returned)
                                <td class="text-center text-success">Returned</td>
                            @else
                                <td class="text-center text-danger">Borrowed</td>
                            @endif
                            
                            <td class="text-center">{{ date("F d, Y H:m:s", strtotime($log->created_at)) }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan=5 class="text-center">No Data Found</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $logs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
