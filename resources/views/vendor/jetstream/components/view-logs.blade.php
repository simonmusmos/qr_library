
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
                <x-jet-button class="mt-4 " id="download-qr-button" type="button">
                    {{ __('Download QR') }}
                </x-jet-button>
                <x-jet-button class="mt-4 " id="delete-book-button" type="button">
                    {{ __('Delete') }}
                </x-jet-button>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>
