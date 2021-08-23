<form id="frm-generatePR" method="POST" action="{{route('api.services.redirect.pqes')}}">
    @csrf
    <input type="hidden" value="PR_request_YtwqD0H2hC" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_valuepr" name="redirect_valuepr">
    @include('_interface.snip.hiddenInput')
    <small>if Date Created is blank, PR is made on or before 3/24/2021</small>
    <table id="generatePR" class="table table-bordered table-sm table-hover"width="100%">
        <thead class="thead-dark">
            <tr>
                <th>Date Created</th>
                <th>Section</th>
                <th>Division</th>
                <th>Purchase Request Contents</th>
                <th>Status</th>
                <th>PR Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="prtable">
            @foreach ($data['prItems'] as $key => $i)
            <tr>
                <td>{{$i['created_at']}}</td>
                <td>{{$i['division_id']}}</td>
                <td>{{$i['section_id']}}</td>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Total Quantity</th>
                                <th>Unit of Measure</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($i['itemsss'] as $k2 => $item)
                                <tr>
                                    <td><small>{{$item['item_name']}}</small></td>
                                    <td><small>{{$item['qtyTotal']}}</small></td>
                                    <td><small>{{$item['itemUnit']}}</small></td>
                                    <td><small>{{$item['abc']}}</small></td>
                                    <td><small>{{$item['qtyxabc']}}</small></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td class="align-middle">
                    @switch($i['status'])
                        @case('pending')pending @break
                        @case('approved') approved @break
                        @default
                    @endswitch
                    {{$i['created_at']}}
                </td>
                <td>
                    @switch($i['status'])
                        @case(!empty($i['status'])) {{$i['prnumber']}} @break
                        @default
                    @endswitch
                    @if (is_null($i['prnumber']))
                        <i>No PR Number</i>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" id="print_pr" data-id="{{$i['id']}}" class="btn btn-secondary" data-placement="left" data-tt="tooltip" title="Print Purchase Request">
                            <i class="fas fa-print"></i>
                        </button>
                        <button type="button" id="approve_pr" data-id="{{$i['id']}}" data-toggle="modal" data-target="#edit1"  class="btn btn-success" data-placement="left" data-tt="tooltip" title="Approve and assign PR number">
                            <i class="fas fa-thumbs-up"></i>
                        </button>
                        <button type="button" id="revoke_pr" data-id="{{$i['id']}}" class="btn btn-warning" data-placement="left" data-tt="tooltip" title="Revoke and remove PR number">
                            <i class="fas fa-minus-square"></i>
                        </button>
                        <button type="button" id="delete_pr" data-id="{{$i['id']}}" class="btn btn-danger" data-target="#edit2" data-placement="left" data-tt="tooltip" title="Delete PR entry">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    {{-- @switch($i['status'])
                        @case('approved')@break
                        @case('pending')<small class="text-primary font-weight-bold">Please wait for approval of Procurement Section</small> @break
                    @endswitch --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>
