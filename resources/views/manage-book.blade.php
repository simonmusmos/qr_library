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
                            <th scope="col">#</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($books as $book)
                          <tr>
                            <th scope="row">{{ $book->id }}</th>
                            <td>{{ $book->book_title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>
                                @if($book->qr_code != "")
                                    <a id="download_qr_button" href="{{ url('images/qr-code/') }}/{{ $book->qr_code }}" download><x-jet-button class="mt-4 ">
                                        {{ __('Download') }}
                                    </x-jet-button></a>
                                @endif
                                <x-jet-button class="mt-4 " id="delete-book-button" type="button">
                                    {{ __('Delete') }}
                                </x-jet-button>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
