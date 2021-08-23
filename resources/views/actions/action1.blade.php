<div class="btn-group" role="group">
    <button  id="comment{{$id}}" data-id="" class="btn btn-secondary btn-sm" data-placement="left" data-tt="tooltip" title="Edit"><i class="fas fa-edit"></i></button>
    <form action="{{route('api.systemadmin.deleteEmployee')}}" method="GET">
        <input type="hidden" value="{{$id}}" name="redirect_value">
        <button  id="comment{{$id}}" data-id="" class="btn btn-danger btn-sm" data-placement="left" data-tt="tooltip" title="Delete"><i class="fas fa-trash"></i></button>
    </form>
    <form action="{{route('api.services.redirect.pqes')}}" method="POST" target="_blank">
        @csrf
        <input type="hidden" value="none" name="redirect_value">
        <input type="hidden" value="ID_SingleFront_ReThqwpK" name="redirect_key">
        <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
        {{-- <input type="hidden" name="redirect_value_forID" value="{{$user->fullname}}|||{{$user->designation}}|||{{$user->byname}}|||{{$user->IDNumber}}|||{{$user->avatar}}"> --}}
        <input type="hidden" name="redirect_value_forID" value="{{$fullname}}|||{{$designation}}|||{{$byname}}|||{{$IDNumber}}|||{{$avatar}}">
        <button type="submit" id="comment{{$id}}" data-id="" class="btn btn-primary btn-sm" data-placement="left" data-tt="tooltip" title="Print ID"><i class="fas fa-print"></i></button>
    </form>
</div>
