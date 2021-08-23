<form id="frm-generatePR" method="POST" action="{{route('api.services.redirect.pqes')}}">
    @csrf
    <input type="hidden" value="PR_request_YtwqD0H2hC" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_valuepr" name="redirect_valuepr">
    <input type="hidden"  id="redirect_value" name="redirect_value" value="empty_not_used">
    @include('_interface.snip.hiddenInput')
    <table id="generatePR" class="table table-bordered table-sm table-hover"width="100%">
        <thead class="thead-dark">
            <tr>
                <th></th>
                <th>Action</th>
                <th>Purchase Request Contents</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="prtable">
            @foreach ($data['prItems'] as $key => $i)
            <tr>
                <td>{{$i['items']}}</td>
                <td>
                    <button type="button" id="prnt_pr" data-id="{{$i['items']}}" class="btn btn-danger" data-placement="left" data-tt="tooltip" title="Delete"><i class="fas fa-trash"></i></button>
                    @switch($i['status'])
                        @case('approved')<button type="button" id="prnt_pr" data-id="{{$i['items']}}" class="btn btn-primary" data-placement="left" data-tt="tooltip" title="Print This Entry"><i class="fas fa-print"></i></button>@break
                        @case('pending')<small class="text-primary font-weight-bold">Please wait for approval of Procurement Section</small> @break
                    @endswitch
                </td>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Total Quantity</th>
                                <th>Unit of Measure</th>
                                <th>Price</th>
                                <th>Total Price</th>
                                <th>Procurement Mode</th>
                                <th>Fund Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($i['itemsss'] as $k2 => $item)
                                @if ($item['requestID'] == $i['id'])
                                    <tr>
                                        <td width="50%"><small>{{$item['item_name']}}</small></td>
                                        <td><small>{{$item['qtyTotal']}}</small></td>
                                        <td><small>{{$item['itemUnit']}}</small></td>
                                        <td><small>{{$item['abc']}}</small></td>
                                        <td><small>{{$item['qtyxabc']}}</small></td>
                                        <td><small>{{$item['MOP']}}</small></td>
                                        <td><small>{{$item['source_name']}}</small></td>
                                        {{-- <td><small>{{$item['parent_type_abbr']}} | {{$item['type_abbr']}}  | {{$item['source_name']}} | {{$item['budget_program_name']}}</small></td> --}}
                                    </tr>
                                @endif
                            @endforeach
                            {{-- {{$i['contentIDs']}} --}}
                        </tbody>
                    </table>
                </td>
                <td class="align-middle">
                    @switch($i['status'])
                        @case('pending')  Pending @break
                        @case('approved') Approved @break
                        @default
                    @endswitch
                </td>

            </tr>
                    {{-- <td class="align-middle">@if ($i['comment'] !== NULL)<span data-toggle="tooltip" title="Division chief comment" class="badge bg-warning d-flex justify-content-center"></span>{{$i['comment']}}</td>@else - </td>@endif --}}
                    {{-- <td class="align-middle">
                        @switch($i['ppmp_status'])
                            @case('pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">Pending</span> @break
                            @case('dhComment-pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">For Division Head Approval</span> @break
                            @case('section-revised') <span data-toggle="tooltip" title="Entry Status" class="badge bg-primary">Revised By Section</span> @break
                            @case('dhApproved') <span data-toggle="tooltip" title="Entry Status" class="badge bg-success">Division Head Approved</span> @break
                            @default
                        @endswitch
                    </td> --}}
            @endforeach
        </tbody>
    </table>
    {{-- <hr>

    <p>Select Items from the above table to generate Purchase Request</p>

    <p><button class="btn btn-primary btn-block">Generate Purchase Request</button></p>
    <small class="text-danger font-weight-bold">Please select atleast one of the entries above before generating a request</small> --}}
<br>
<br>
<br>
<br>

{{-- <table id="generatePR2" class="table table-bordered table-sm table-hover"width="100%">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Inital Purchase Request Number</th>
            <th>Item Name</th>
            <th>Total Quantity</th>
            <th>Unit of Measure</th>
            <th>ABC</th>
            <th>Total Price</th>
            <th>Procurement Mode</th>
        </tr>
    </thead>
</table> --}}
</form>
