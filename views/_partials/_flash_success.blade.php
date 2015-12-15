@if (isset($_SESSION['success']))
    @foreach(flash('success') as $msg)
        <div class="alert alert-success">{{ $msg }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endforeach
@endif