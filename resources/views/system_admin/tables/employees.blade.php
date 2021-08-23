<livewire:employees-datatable
    per-page="40"
/>

{{-- <table id="employeetable" class="table table-bordered table-sm table-hover" style="width: 100%">
    <thead class="thead-dark">
        <tr>
            <th></th>
            <th>ID Number</th>
            <th>Fullname</th>
            <th>Byname</th>
            <th>Designation</th>
            <th>With Picture</th>
            <th>Photo Name</th>
            <th>Division</th>
            <th>Section</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody class="employeetablebody">
        @foreach ($data['employees'] as $key => $user)
            <tr>
                <td>
                    {{$user->id}}
                </td>
                <td>
                    {{$user->IDNumber}}
                </td>
                <td>
                    {{$user->fullname}}
                </td>
                <td>
                    {{$user->byname}}
                </td>
                <td>
                    {{$user->designation}}
                </td>
                <td style="text-align:center;">
                @if (!empty($user->avatar))
                        <i class="far fa-check-square text-success fa-lg"></i>
                    @else
                        <i class="far fa-times-circle text-danger fa-lg"></i>
                    @endif
                </td>
                <td>
                    {{$user->avatar}}
                </td>
                <td>
                    {{$user->division_id}}
                </td>
                <td>
                    {{$user->section_id}}
                </td>
                <td class="align-middle text-right">
                    <div class="btn-group btn-group-sm">
                        <form action="{{route('api.services.redirect.pqes')}}" method="POST" target="_blank">
                            @csrf
                            <input type="hidden" value="none" name="redirect_value">
                            <input type="hidden" value="ID_SingleFront_ReThqwpK" name="redirect_key">
                            <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
                            <input type="hidden" name="redirect_value_forID" value="{{$user->fullname}}|||{{$user->designation}}|||{{$user->byname}}|||{{$user->IDNumber}}|||{{$user->avatar}}">
                            <button type="submit" id="comment{{$key}}" data-id="" class="btn btn-primary" data-placement="left" data-tt="tooltip" title="Print ID"><i class="fas fa-print"></i></button>
                        </form>
                        <button type="btn" id="upgrade" data-toggle="modal" data-target="#edit69" data-id="" class="btn btn-warning" data data-placement="left" data-tt="tooltip" title="Convert to System User"><i class="fas fa-level-up-alt"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table> --}}

