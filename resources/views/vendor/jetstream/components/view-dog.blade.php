<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div> --}}

    <div class="text-xl">
        View Dog
    </div>

    
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">


    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex flex-col sm:justify-center items-center mt-4 qr_display">
            
                <a href="javascript:void(0)">
                    <img class="logo" id="dog-image-holder" src="" />
                </a>
                <x-jet-button class="mt-4 " id="view-dog-button" type="button">
                    {{ __('View Dog Button') }}
                </x-jet-button>
        </div>

        <div class="flex flex-col sm:justify-center items-center mt-4 h100 qr_initial_display">
            {{-- <h2>Your QR Code will display here</h2> --}}
        </div>

    </div>

</div>

<script>
    $("#view-dog-button").on("click", function(){
        $.get("{{ route('dog.generate') }}", function(data, status){
            // console.log(JSON.parse(data));
            $("#dog-image-holder").attr("src", JSON.parse(data).message);
        });
    });
</script>
