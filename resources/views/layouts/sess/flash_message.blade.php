{{-- for Flash Message Success --}}
@if (session('success'))
    <div class="col-12">
        <div class="alert alert-success text-white" >
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" 
                style=
                "margin-left: 0.5rem;
                color: white;">&times;</span>
            </button>
        </div>
    </div>

    @elseif(session('danger'))
    <div class="col-12">
        <div class="alert alert-danger text-black">
            {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-white" 
                style=
                "margin-left: 0.5rem;
                color: white;">&times;</span>
            </button>
        </div>
    </div>

@elseif(session('warning'))
<div class="col-12">
    <div class="alert alert-warning text-black">
        {{ session('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="text-white" 
            style=
            "margin-left: 0.5rem;
            color: white;">&times;</span>
        </button>
    </div>
</div>
@endif

{{-- For Error Validation --}}
@foreach ($errors->all() as $message)
    <div class="col-12">
        <div class="alert alert-danger">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" 
                style=
                "margin-left: 0.5rem;
                color: white;">&times;</span>
            </button>
        </div>
    </div>
@endforeach