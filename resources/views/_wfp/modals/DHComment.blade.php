<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <form action="{{route('api.wfp.manage.dhComment')}}" method="post">
        @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Revision Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input name="responsible_person" type="hidden" value="{{auth()->user()->id}}">
                <input id="comment_id" name="comment_id" type="hidden">
                <div class="row">
                    <div class="col">
                        <label for="chiefComment">Division Chief Comment</label>
                        <textarea class="form-control" id="chiefComment" name="chiefComment" rows="3" cols="30" placeholder="Write your comment here...."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    </div>
</div>