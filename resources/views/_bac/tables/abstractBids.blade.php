<div id="bidsabstract"></div>
<table id="mainabstractbids" class="table table-bordered table-sm table-hover" style="width: 100%">
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
        @foreach ($data['appBids']['app'] as $i)
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
