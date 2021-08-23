<div class="modal fade bd-example-modal-xl" id="duplicate_wfp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            {{-- <form action="{{route('api.wfp.update')}}" method="post"> --}}
                @csrf
                <input class="form-control" type="hidden" name="deliverable_id2" id="deliverable_id2">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('_wfp.cards.create')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>
