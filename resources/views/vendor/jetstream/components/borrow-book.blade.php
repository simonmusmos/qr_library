<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div> --}}

    <div class="text-xl">
        Borrow Book
    </div>

    
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <form class="p-6" id="add-book-form" method="POST" action="{{ route('books.store') }}">
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
        </div>
        <div class="ml-12">
            <x-jet-button class="mt-4 " id="add-book-submit-form" type="button">
                {{ __('Scan QR') }}
            </x-jet-button>
            <x-jet-button class="mt-4 " id="add-book-clear-form" type="button">
                {{ __('Clear') }}
            </x-jet-button>
        </div>
        
    </form>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex flex-col sm:justify-center items-center mt-4 hidden qr_display">
            
                <a href="javascript:void(0)">
                    <img class="logo" id="qr_logo_holder" src="{{ url('images/qr-code/sample.png') }}" />
                    <input type="hidden" name="qr_url" value="{{ url('images/qr-code/') }}">
                </a>
                <a id="download_qr_button" href="" download><x-jet-button class="mt-4 ">
                    {{ __('Download') }}
                </x-jet-button></a>
        </div>

        <div class="flex flex-col sm:justify-center items-center mt-4 h100 qr_initial_display">
            <h2>Your QR Code will display here</h2>
        </div>

    </div>

</div>
