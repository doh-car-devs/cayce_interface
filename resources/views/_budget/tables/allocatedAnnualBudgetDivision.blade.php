<table id="allocatedAnnualBudgetDivision" class="table table-bordered table-sm table-hover">
    <thead class="thead-dark">
        <tr>
            <th colspan="4" class="text-center">Fund Source</th>
            <th rowspan="2">Purpose</th>
            <th colspan="3">Section/Cluster/Program</th>
            <th rowspan="2">Allocated Amount</th>
            {{-- <th colspan="3" class="text-center">National Expenditure Program Status<small>(NEP)</small></th> --}}
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            <th>Annual Budget ID</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>Division</th>
            <th>Section</th>
            <th>Program</th>
            {{-- <th>National Expenditure Program <small>(NEP)</small></th>
            <th>Utilized by program</th>
            <th>Unutilized by program</th> --}}
        </tr>
    </thead>
    <tbody class="divisionannualbudgetbody">
        @foreach ($data['annualPrograms'] as $item)
            @if ($item['allocatedNEP'] !== 1)
                <tr>
                    <td>{{$item['annual_budget_id']}}</td>
                    <td>{{$item['parent_type_abbr']}}</td>
                    <td>{{$item['type_abbr']}}</td>
                    <td>{{$item['source_abbr'] ?? $item['source_name']}}</td>
                    <td>{{$item['budget_program_name']}}</td>
                    <td>{{$item['division_abbr']}}</td>
                    <td>{{$item['section_abbr']}}</td>
                    <td>{{$item['program_abbr']}}</td>
                    <td>
                        @if ($item['parent_type_abbr'] == 'Trust Funds' || $item['parent_type_abbr'] == 'SAA')
                            ₱ {{number_format($item['allocatedAmount'], 2, '.', ',')}}
                        @else
                            ₱ {{number_format($item['allocatedNEP'], 2, '.', ',')}}
                        @endif
                    </td>
                    {{-- <td>₱ {{number_format($item['allocatedAmount'], 2, '.', ',')}}</td>
                    <td>blank</td>
                    <td>blank</td> --}}
                    <td class="text-right align-middle">
                        <div class="btn-group btn-group-sm">
                            <button type="button" id="edt_id_budget" data-id="{{$item['program_id'].'||'. $item['fund_source_id'].'||'. $item['allocatedNEP'].'||'. $item['allocatedAmount'].'||'. $item['budget_program_name'].'||'. $item['annual_budget_programs_id'].'||'. $item['annual_budget_id']}}" class="btn btn-primary" data-toggle="modal" data-target="#edit5" data-placement="left" data-tt="tooltip" title="Edit this entry"><i class="fas fa-edit"></i></button>
                            {{-- <button type="button" id="dlt_id_budget" data-id="{{$item['q1'].'||'. $item['q2'].'||'. $item['q3'].'||'. $item['q4']}}" class="btn btn-danger" data-toggle="modal" data-target="#delete5" data-placement="left" data-tt="tooltip" title="Delete this entry"><i class="fas fa-trash"></i></button> --}}
                        </div>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="8" style="text-align:right">Filtered Total / Total of currently visible entries:</th>
            <th colspan="2"style="text-align:left" id="total-id"></th>
        </tr>
        <tr>
            <th colspan="8" style="text-align:right">Grand Total:</th>
            <th colspan="2"style="text-align:left" id="page-total-id"></th>
        </tr>
    </tfoot>
</table>
