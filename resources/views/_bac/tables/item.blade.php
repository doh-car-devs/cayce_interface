<table id="mainitemsbids" class="table table-bordered table-sm table-hover">
    <thead>
        <tr>
            <th colspan="3" class="text-center u-tableLight"><h4 class="mt-3">Bidder Details</h4></th>
            <th colspan="3" class="text-center"><h4 class="mt-3">Item Specifications</h4></th>
            <th colspan="2" class="text-center u-tableDark text-white"><h4 class="mt-3">Status</h4></th>
            <th rowspan="2" class="text-center align-middle"><h4 class="mt-2">Action</h4></th>
        </tr>
        <tr>
            <th class="u-tableLight">Bidder Name</th>
            <th class="u-tableLight">Unit Cost <small>(Per Item)</small></th>
            <th class="u-tableLight">Total Cost</th>
            <th>Unit Cost</th>
            <th>Total Quantity</th>
            <th>Total Cost</th>
            <th class="u-tableDark text-white">Savings per item</th>
            <th class="u-tableDark text-white">Total Savings per item</th>
        </tr>
    </thead>
    <tbody class="wfptablebody">
        @foreach ($data['testBids'] as $i)
            </tr>
                <td class="u-tableLight2"><h4 class="font-weight-bold">{{$i['bidder_name']}}</h4></td>
                <td class="u-tableLight2">₱{{number_format($i['bid_amount'], 2, '.', ',')}}</td>
                <td class="u-tableLight2">₱{{number_format($i['qtyxabc'], 2, '.', ',')}}</td>

                <td>{{$i['price']}} /<small> {{$i['unit']}}</small></td>
                <td>{{$i['totalqty']}}</td>
                {{-- <td>{{$i['unit']}}</td> --}}
                <td>₱{{number_format($i['totalppmpamount'], 2, '.', ',')}}</td>
                <td class="u-tableDark2 text-white">₱{{number_format($i['itemplusminus'], 2, '.', ',')}}</td>
                <td class="u-tableDark2 text-white">₱{{number_format($i['plusminus'], 2, '.', ',')}}</td>


                <td class="text-right align-middle">
                    <div class="btn-group btn-group-sm">
                        <button href="{{route('api.bac.bidderWin.store')}}/{{$i['bidder_id']}}" data-id="{{$i['bidder_id']}}||{{$i['bidder_name']}}" id="awardwinbtn" data-toggle="modal" class="btn btn-success" data-target="#edit45" data-id="{{$i['bidder_id']}}" data-placement="left" data-tt="tooltip" title="Award {{$i['bidder_name']}} as Winner">
                            <i class="fas fa-award"></i>
                        </button>
                        {{-- <button type="button" id="addBidder" data-id="{{$i['id']}}" class="btn btn-success" data-toggle="modal" data-target="#addBidder" data-placement="left" data-tt="tooltip" title="Add Bid from Bidder"><i class="fas fa-plus"></i></button>
                        <button type="button" id="edt_id" data-id="" class="btn btn-primary" data-toggle="modal" data-target="#edit" data-placement="left" data-tt="tooltip" title="Edit this bid"><i class="fas fa-edit"></i></button>
                        <button type="button" id="dlt_id" data-id="" class="btn btn-danger" data-toggle="modal" data-target="#delete" data-placement="left" data-tt="tooltip" title="Delete this bid"><i class="fas fa-trash"></i></button> --}}
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
