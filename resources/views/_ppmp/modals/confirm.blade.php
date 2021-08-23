<div class="modal fade" id="modalppmpdone" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title " id="staticBackdropLabel">Approve PPMP Entry?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to aprove this PPMP?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{route('api.ppmp.approve')}}" method="post">
                    @csrf
                    <input name="responsible_person" type="hidden" value="{{auth()->user()->id}}">
                    <input class="form-control" type="hidden" name="approve_id_ppmp" id="approve_id_ppmp" value="">
                    <button type="submit" class="btn btn-success" id="">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
