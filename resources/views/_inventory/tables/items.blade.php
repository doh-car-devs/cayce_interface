<table id="twg_items" class="table table-bordered table-sm table-hover">
    <thead class="thead-dark">
        <tr>
                <th>Primary Title</th>
                <th>Secondary Title</th>
                {{-- <th>Description</th> --}}
                <th>Branch</th>
                <th>Category</th>
                <th>unit</th>
                <th>Cost</th>
                <th>Edit</th>
        </tr>
    </thead>
    <tbody class="itemstable">
        @if ($data['allitems'] !== 'time_out')
            @foreach ($data['allitems'] as $i)
                <tr>
                    <td>{{$i['firstCategory']}}</td>
                    <td>{{$i['secondCategory']}}</td>
                    {{-- <td>{{$i['description']}}</td> --}}
                    <td>{{$i['branch']}}</td>
                    <td>{{$i['category']}}</td>
                    <td>{{$i['unit']}}</td>
                    <td class="align-middle">₱{{number_format($i['itemCost'], 2, '.', ',')}}</td>
                    <td>
                        <button type="button" id="editite_id" data-id="{{$i['firstCategory'].'||'.$i['secondCategory'].'||'.$i['branch_id'].'||'.$i['category_id'].'||'.$i['unit_id'].'||'.$i['itemCost'].'||'.$i['id']}}" class="btn btn-primary" data-toggle="modal" data-target="#add454" data-placement="left" data-tt="tooltip" title="Edit this entry"><i class="fas fa-edit"></i></button>
                    </td>
                    {{-- <td class="align-middle">₱{{number_format($i['itemCost'], 2, '.', ',')}}</td> --}}
                    {{-- <button type="button" id="markdone" data-id="{{$i['firstCategory'].'||'.$i['secondCategory'].'||'.$i['description'].'||'.$i['category_ID'].'||'.$i['itemCost'].'||'.$i['unit']. '||'. $i['category_ID']. '||'. $i['id']. '||'. $i['branch']. '||'. $i['status']}}" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add1" data-placement="left" data-tt="tooltip" title="Edit/Approve Item"><i class="fas fa-check"></i></button> --}}
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
