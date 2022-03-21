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
                        Manage Books
                    </div>
                
                    
                </div>
                
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 p-6">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Book Name</th>
                            <th class="text-center">Author</th>
                            <th class="text-center">ISBN</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(count($books) > 0)
                        @foreach($books as $book)
                        <tr>
                            <th scope="row"  class="text-center">{{ $book->id }}</th>
                            <td class="text-center">{{ $book->book_title }}</td>
                            <td class="text-center">{{ $book->author }}</td>
                            <td class="text-center">{{ $book->isbn }}</td>
                            <td colspan=1 class="text-center">
                                @if($book->qr_code != "")
                                    <a id="download_qr_button" href="{{ url('images/qr-code/') }}/{{ $book->qr_code }}" download="book {{ $book->book_title }}({{ $book->isbn }})"><x-jet-button >
                                        {{ __('Download') }}
                                    </x-jet-button></a>
                                @endif
                                <x-jet-button id="delete-book-button" type="button">
                                    {{ __('Delete') }}
                                </x-jet-button>
                            </td>
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
                        {!! $books->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
