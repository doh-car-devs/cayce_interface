<div class="modal fade" id="modaldone" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title " id="staticBackdropLabel">Approve WFP Entry?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to aprove this entry?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{route('api.wfp.manage.wfpApprove')}}" method="post">
                    @csrf
                    <input name="responsible_person" type="hidden" value="{{auth()->user()->id}}">
                    <input class="form-control" type="hidden" name="approve_id" id="approve_id" value="">
                    <button type="submit" class="btn btn-success" id="deletewfp">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>