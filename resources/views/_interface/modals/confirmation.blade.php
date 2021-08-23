<div class="modal fade" id="confirmation" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title " id="staticBackdropLabel">{{$include_title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <span>{{$include_body}}</span>
                <span class="text-danger text-bold">{{auth()->user()->name_last . auth()->user()->name}}</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input class="form-control" type="hidden" name="approve_id" id="approve_id" value="">
                <button type="submit" class="btn btn-success" id="deletewfp">Confirm</button>
            </div>
        </div>
    </div>
</div>