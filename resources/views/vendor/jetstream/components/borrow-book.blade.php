<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div> --}}

    <div class="text-xl">
        Borrow Book
    </div>

    
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <form class="p-6 borrow-form" id="book-borrow-book-form" method="POST" action="{{ route('books.store') }}">
        @csrf
        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Enter Book Title:
            </div>
            <div class="mt-2 text-sm text-gray-500">
                <input type="text" class="form-control" name="title" disabled>
            </div>
        </div>
        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Enter Book Author:
            </div>
            <div class="mt-2 text-sm text-gray-500">
                <input type="text" class="form-control" name="author" disabled>
            </div>
        </div>
        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Enter Book ISBN:
            </div>
            <div class="mt-2 text-sm text-gray-500">
                <input type="text" class="form-control" name="isbn" disabled>
            </div>
            <input type="hidden" name="book_id">
        </div>
        <div class="ml-12">
            <x-jet-button class="mt-4 " id="scan-book-qr-button" type="button">
                {{ __('Scan QR') }}
            </x-jet-button>
            <x-jet-button class="mt-4 " id="add-book-clear-form" type="button">
                {{ __('Clear') }}
            </x-jet-button>
        </div>
        <div style="width: 0; overflow:hidden;">
            <input type="text" id="book-qr" class="scanner-input">
        </div>
    </form>

    <div class="p-6 pl-0 border-t border-gray-200 md:border-t-0 md:border-l">
        <form class="borrow-form" id="student-borrow-book-form" method="POST">
            @csrf
        <div class="ml-12">
            <div class="mt-2 xtext-sm text-gray-500">
                Enter Student Name:
            </div>
            <div class="mt-2 text-sm text-gray-500">
                <input type="text" class="form-control" name="name" disabled>
            </div>
        </div>
        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Enter Student Number:
            </div>
            <div class="mt-2 text-sm text-gray-500">
                <input type="text" class="form-control" name="number" disabled>
            </div>
            <input type="hidden" name="student_id">
        </div>
        <div class="ml-12">
            <x-jet-button class="mt-4 " id="scan-student-qr-button" type="button">
                {{ __('Scan QR') }}
            </x-jet-button>
            <x-jet-button class="mt-4 " id="add-book-clear-form" type="button">
                {{ __('Clear') }}
            </x-jet-button>
        </div>
        <div style="width: 0; overflow:hidden;">
            <input type="text" id="student-qr" class="scanner-input">
        </div>
        </form>
    </div>



</div>
<div class="pb-4 border-t border-gray-200 md:border-t-0 md:border-l bg-gray-200">

    <div class="flex flex-col sm:justify-center items-center h100 qr_initial_display">
        <x-jet-button class="mt-4 " id="action-borrow-book" type="button">
            {{ __('Borrow') }}
        </x-jet-button>
    </div>

</div>
