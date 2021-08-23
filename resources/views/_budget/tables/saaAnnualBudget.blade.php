<table id="saaannualbudgettable" class="table table-bordered table-sm table-hover">
    <thead class="thead-dark">
        <tr>
            <th rowspan="2" class="text-center">Fund Source</th>
            {{-- <th rowspan="2">SAA Allocation </th> --}}
            {{-- <th rowspan="2">National Expenditure Program <small>(NEP)</small></th> --}}
            <th colspan="3" class="text-center">Sub Allotment Advice  Allocation<small>(SAA)</small></th>
            <th rowspan="2" class="text-right" style="width: 10%">Take Action</th>
        </tr>
        <tr>
            <th>SAA Allocation Status<small>(SAA)</small></th>
            <th>Allocated</th>
            <th>Unallocated</th>
        </tr>
    </thead>
    <tbody class="annualbudgetbody">
        @foreach ($data['annual'] as $item)
            @if ($item['parent_type_abbr'] == 'SAA')
            <tr>
                {{-- <td>{{$item['parent_type_abbr']}}</td> --}}
                <td>{{$item['type_abbr']}} | {{$item['source_abbr'] ?? $item['source_name']}}</td>
                {{-- <td></td> --}}
                <td>₱ {{number_format($item['amount'], 2, '.', ',')}}</td>
                {{-- <td>₱ {{number_format($item['NEP'])}}</td> --}}
                {{-- <td>
                    @foreach ($data['allocatedTotals'] as $i)
                        @if ($i['fund_source_id'] == $item['fund_source_id'])
                            ₱  {{number_format($i['annualAllocatedNEP'])}}
                        @endif
                    @endforeach
                </td> --}}
                <td>
                    @foreach ($data['allocatedTotals'] as $i)
                        @if ($i['fund_source_id'] == $item['fund_source_id'])
                            ₱  {{number_format($i['annualAllocatedAmount'], 2, '.', ',')}}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data['allocatedTotals'] as $i)
                        @if ($i['fund_source_id'] == $item['fund_source_id'])
                            ₱ {{number_format($item['remainingAmount'], 2, '.', ',')}}
                        @endif
                    @endforeach
 {{-- @foreach ($data['allocatedTotals'] as $i) @if ($i['fund_source_id'] == $item['fund_source_id']) {{$item['amount'] - $i['annualAllocatedAmount']}}  @endif @endforeach --}}
                </td>
                {{-- <td>₱ {{$item['NEP'] - $item['remainingNEP'] ?? 0}}</td>
                <td>₱ {{number_format($item['remainingNEP'] ?? 0)}}</td>--}}
                <td>
                    <div class="btn-group float-right">
                        @if ($item['remainingAmount']  == 0)
                            <button type="button" id="allocate_id"  class="btn btn-warning btn-sm"data-placement="left" data-tt="tooltip" title="All Budget has been allocated"><i class="fas fa-exclamation-triangle mr-1"></i></button>
                        @else
                            <button type="button" id="allocate_id" data-id="{{$item['fund_source_id'].'||'. $item['remainingNEP'].'||'. $item['remainingAmount'].'||'. $item['annual_id']}}" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit3" data-placement="left" data-tt="tooltip" title="Allocate Budget"><i class="fas fa-money-bill-wave mr-1"></i><i class="fas fa-level-down-alt mr-1"></i></button>
                        @endif

                        <button type="button" id="edt_id" data-id="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit1" data-placement="left" data-tt="tooltip" title="Edit this entry"><i class="fas fa-edit"></i></button>
                        <button type="button" id="dlt_id" data-id="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmation" data-placement="left" data-tt="tooltip" title="Delete this entry"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="1" style="text-align:right">Filtered SAA Total / Total of currently visible entries:</th>
            <th colspan="4"style="text-align:left" id="total-id"></th>
        </tr>
        <tr>
            <th colspan="1" style="text-align:right">SAA Grand Total:</th>
            <th colspan="4"style="text-align:left" id="page-total-id"></th>
        </tr>
    </tfoot>
</table>
