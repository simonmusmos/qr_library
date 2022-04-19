<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        @if(request()->routeIs('books.manage'))
            <form method="POST" action="{{ route('books.delete') }}" id="delete-form">
        @elseif(request()->routeIs('students.manage'))
            <form method="POST" action="{{ route('students.delete') }}" id="delete-form">
        @endif
        
            @csrf
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
            <input type="hidden" id="delete-id">
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Back</button>
          <button type="button" class="btn btn-outline-danger continue-delete" data-bs-dismiss="modal">Yes</button>
        </div>
      </div>
    </div>
</div>