<form id="poitem-frm" method="POST" action="{{route('api.services.redirect.pqes')}}">
    @csrf
    <input type="hidden" value="PO_request_JptRMD0Hq1" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_value" name="redirect_value">
    {{-- <input type="text"  id="pono" name="pono" value="{{$data['officePR']['POLast']}}"> --}}
    @include('_interface.snip.hiddenInput')
    <table id="purchaseOrderTable" class="table table-bordered table-sm table-hover">
        <thead class="thead-dark">
            <tr>
                <th></th>
                <th>Item & Specifications</th>
                <th>Total Quantity</th>
                <th>Unit</th>
                <th>Winners Unit Cost</th>
                <th>Winners Total Cost</th>
                {{-- <th>Take Action</th> --}}
            </tr>
        </thead>
        <tbody class="wfptablebody">
            @foreach ($data['allppmp'] as $i)
                <input type="text"  id="bidder_id" name="bidder_id" value="{{$i['bidder_id']}}" style="display: none">
                @break
            @endforeach
                @foreach ($data['allppmp'] as $i)
                <tr>
                    <td>{{$i['ppmpTable_id']}}</td>
                    <td>{{$i['item_name']}}</td>
                    <td>{{$i['qty']}}</td>
                    <td>{{$i['unit']}}</td>
                    <td>{{$i['bid_amount']}}</td>
                    <td>{{$i['bid_amount'] * $i['qty']}}</td>
                    {{-- <td class="text-right align-middle">
                        <div class="btn-group btn-group-sm">
                            <a href="{{route('bac.abstract.item')}}/{{$i['item_id']}}" class="btn btn-primary" data-id="{{$i['item_id']}}" data-placement="left" data-tt="tooltip" title="View all Bids">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" id="addBidder" data-id="{{$i['item_id'].'||'. $i['bid_amount']}}" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add1" data-placement="left" data-tt="tooltip" title="Add Bid to item"><i class="fas fa-plus"></i></button>
                        </div>
                    </td> --}}
                </tr>
            @endforeach
            {{-- @foreach ($data['app']['app'] as $i)
                </tr>
                    <td>{{$i['item']}}</td>
                    <td>{{$i['qtyTotal']}}</td>
                    <td>{{$i['itemUnit']}}</td>
                    <td>₱{{number_format($i['abc'], 2, '.', ',')}}</td>
                    <td>₱{{number_format($i['qtyxabc'], 2, '.', ',')}}</td>
                    <td>{0}</td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>

    <hr>

    <div class="card">
        <div class="card-body">
            <h3 class="my-auto">Select Items from the above table to generate Purchase Request</h3>
            <div class="row mt-3 mb-2">
                <div class="col-md-6">
                    <label for="budget_parent_id">Purchase Order Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">{{$data['officePR']['POprep']}}-</div>
                        </div>
                        <input type="text" class="form-control" name="pono" id="pono" value="" onclick="blur()" readonly>
                        {{-- <input type="text" class="form-control" name="prnumber" value="{{$data['PRLast']}}"> --}}
                    </div>
                    <input type="hidden" class="form-control" name="fullponumber" id="fullponumber" value="{{$data['officePR']['POLast']}}" onclick="blur()" readonly>
                </div>
                <div class="col-md-6">
                    <label for="budget_parent_id">Last Stored Purchase Order Number</label>
                    <input type="text" class="form-control" disabled readonly onclick="blur()" value="{{$data['officePR']['lastPO']['assigned_id']}}">
                </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit" name="addGenPO" id="addGenPO">Generate Purchase Order</button>

        </div>
    </div>

</form>
