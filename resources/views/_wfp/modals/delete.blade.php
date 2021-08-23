<div class="modal fade" id="delete" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-danger" id="staticBackdropLabel">Delete WFP Entry?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this entry?</p>
                <p class="text-muted">This will be logged as: Deleted by {{auth()->user()->name_family}}, {{auth()->user()->name}} {{auth()->user()->name_middle}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{route('api.wfp.delete')}}" method="post">
                    @csrf
                    <input name="responsible_person" type="hidden" value="{{auth()->user()->id}}">
                    <input class="form-control" type="hidden" name="delete_id" id="delete_id">
                    <button type="submit" class="btn btn-danger" id="deletewfp">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>