{{-- <div class="modal fade" id="modaldone" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div> --}}
<div class="modal-header">
    <h5 class="modal-title " id="staticBackdropLabel">{{$include_title}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <p>By Clicking confirm you will be awarding the win to - <span id="biddername" class="font-weight-bold"></span></p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{-- <form action="{{route('api.wfp.manage.wfpApprove')}}" method="post"> --}}
            {{-- @csrf --}}
        <input name="responsible_person" type="hidden" value="{{auth()->user()->id}}">
        <input class="form-control" type="hidden" name="approve_id" id="approve_id" value="">
        <input type="hidden" id="awardnow" name="awardnow">
        <input type="text" name="entry" value="@foreach ($data['item'] as $key => $i){{$i['ppmp_id']}}||@endforeach">
        <button type="submit" class="btn btn-success" id="deletewfp">{{$button}}</button>
        {{-- </form> --}}
</div>
