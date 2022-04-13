<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-12 row mx-4">
        <div class="max-w-7xl mx-auto col-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-manage-book /> --}}
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    {{-- <div>
                        <x-jet-application-logo class="block h-12 w-auto" />
                    </div> --}}
                
                    <div class="text-xl">
                        Borrowed Books
                    </div>
                
                    
                </div>
                
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 p-6">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-center" scope="col">Student Name</th>
                            <th class="text-center" scope="col">Book Name</th>
                            <th class="text-center" scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($borrowed_books) > 0)
                            @foreach($borrowed_books as $borrowed_book)
                            <tr>
                                <th class="text-center">{{ $borrowed_book->student->student_name }}</th>
                                <td class="text-center">{{ $borrowed_book->book->book_title }}</td>
                                <td class="text-center">{{ date("F d, Y H:m:s", strtotime($borrowed_book->created_at)) }}</td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            
                            <td colspan=3 class="text-center">No Data Found</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $borrowed_books->links() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto col-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-manage-book /> --}}
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    {{-- <div>
                        <x-jet-application-logo class="block h-12 w-auto" />
                    </div> --}}
                
                    <div class="text-xl">
                        Returned Books
                    </div>
                
                    
                </div>
                
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 p-6">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-center" scope="col">Student Name</th>
                            <th class="text-center" scope="col">Book Name</th>
                            <th class="text-center" scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($returned_books) > 0)
                            @foreach($returned_books as $returned_book)
                            <tr>
                                <th class="text-center">{{ $returned_book->student->student_name }}</th>
                                <td class="text-center">{{ $returned_book->book->book_title }}</td>
                                <td class="text-center">{{ date("F d, Y H:m:s", strtotime($returned_book->created_at)) }}</td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            
                            <td colspan=3 class="text-center">No Data Found</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $returned_books->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
