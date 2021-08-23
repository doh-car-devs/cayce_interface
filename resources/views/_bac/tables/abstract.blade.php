<form action="{{route('api.services.redirect.pqes')}}" id="frm-bidder-add" method="POST">
    @csrf
    <input type="hidden" value="Bid_add_XxAdDDiB" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_value" name="redirect_value">
    @include('_interface.snip.hiddenInput')
    <span class="text-center">* to add multiple items to the same bidder, check all items first then click on the button below</span>
    <p><button class="btn btn-warning btn-block">Add bidder to multiple Items</button></p>

    <table id="mainabstractcanvas" class="table table-bordered table-sm table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Item & Specifications</th>
                <th>Total Quantity</th>
                <th>Unit</th>
                <th>Unit Cost</th>
                <th>Total Cost</th>
                <th>Bids</th>
                <th>Take Action</th>
            </tr>
        </thead>
        <tbody class="wfptablebody">
            @foreach ($data['app']['app'] as $i)
                </tr>
                    <td>{{$i['id']}}</td>
                    <td>{{$i['item']}}</td>
                    <td>{{$i['qtyTotal']}}</td>
                    <td>{{$i['itemUnit']}}</td>
                    <td>₱{{number_format($i['abc'], 2, '.', ',')}}</td>
                    <td>₱{{number_format($i['qtyxabc'], 2, '.', ',')}}</td>
                    <td>{0}</td>
                    <td class="text-right align-middle">
                        <div class="btn-group btn-group-sm">
                            <a href="{{route('bac.abstract.item')}}/{{$i['id']}}" class="btn btn-primary" data-id="{{$i['id']}}" data-placement="left" data-tt="tooltip" title="View all Bids">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" id="addBidder" data-id="{{$i['id'].'||'. $i['abc']}}" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add1" data-placement="left" data-tt="tooltip" title="Add Bid to item"><i class="fas fa-plus"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <span class="text-center">* to add multiple items to the same bidder, check all items first then click on the button below</span>
    <p><button class="btn btn-warning btn-block">Add bidder to multiple Items</button></p>
</form>
