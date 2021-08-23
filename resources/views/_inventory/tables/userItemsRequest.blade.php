<table id="twg_itemsRequest" class="table table-bordered table-sm table-hover">
    <thead class="thead-dark">
        <tr>
            <th>First Category</th>
            <th>Second Category</th>
            <th>Description</th>
            <th>Category</th>
            <th>Item Cost</th>
            <th>Unit</th>
            <th>Status</th>
            {{-- <th>Action</th> --}}
        </tr>
    </thead>
    <tbody class="itemsRequesttable">
        @foreach($data['items'] as $i)
        <tr>
            <td class="align-middle">{{$i['firstCategory']}}</td>
            <td class="align-middle">{{$i['secondCategory']}}</td>
            <td class="align-middle">{{$i['description']}}</td>
            <td class="align-middle">{{$i['branch']}}</td>
            <td class="align-middle">₱{{number_format($i['itemCost'], 2, '.', ',')}}</td>
            <td class="align-middle">{{$i['unit']}}</td>
            <td class="align-middle">
                @switch($i['status'])
                    @case('pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">Pending</span> @break
                    @default
                @endswitch
            </td>
            {{-- <td>
                <button type="button" id="markdone" data-id="{{$i['firstCategory'].'||'.$i['secondCategory'].'||'.$i['description'].'||'.$i['category'].'||'.$i['itemCost'].'||'.$i['unit']. '||'. $i['category_ID']. '||'. $i['id']}}" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add1" data-placement="left" data-tt="tooltip" title="Edit/Approve Item"><i class="fas fa-check"></i></button>
            </td> --}}
        </tr>
        @endforeach
    </tbody>
</table>
