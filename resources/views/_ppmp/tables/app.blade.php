<table id="mainapptable" class="table table-bordered table-sm table-hover">
    <thead class="thead-dark" style="font-size: small">
        <tr>
            <th rowspan="2"></th>
            <th rowspan="2">Item & Specifications</th>
            <th rowspan="2">Unit of Measure</th>
            <th colspan="16" class="text-center">Monthly Quantity Requirement</th>
            <th rowspan="2">Total Quantity for the year</th>
            <th rowspan="2">Price Catalogue</th>
            <th rowspan="2">Total Amount for the year</th>
        </tr>
        <tr>
            <th>Jan</th><th>Feb</th><th>Mar</th><th>Q1 Amount</th>
            <th>Apr</th><th>May</th><th>June</th><th>Q2 Amount</th>
            <th>July</th><th>Aug</th><th>Sept</th><th>Q3 Amount</th>
            <th>Oct</th><th>Nov</th><th>Dec</th><th>Q4 Amount</th>
        </tr>
    </thead>
    <tbody class="wfptablebody">
        @foreach ($data['app'] as $i)
            <tr @if(($i['milestones1'] + $i['milestones2'] + $i['milestones3'] + $i['milestones4'] + $i['milestones5'] + $i['milestones6'] + $i['milestones7'] + $i['milestones8'] + $i['milestones9'] + $i['milestones10'] + $i['milestones11'] + $i['milestones12'])*$i['abc'] != $i['qtyxabc']) style="background-color: red;" @endif>
                <td>{{$i['id']}}</td>
                <td>{{$i['item']}}</td>
                <td>{{$i['itemUnit']}}</td>
                <td><abbr title="January">{{$i['milestones1']}}</abbr></td>
                <td><abbr title="February">{{$i['milestones2']}}</abbr></td>
                <td><abbr title="March">{{$i['milestones3']}}</abbr></td>
                <td class="u-tableLight"><abbr title="Q1 Amount">₱{{number_format($i['ppmpq1'], 2, '.', ',')}}</abbr></td>

                <td><abbr title="April">{{$i['milestones4']}}</abbr></td>
                <td><abbr title="May">{{$i['milestones5']}}</abbr></td>
                <td><abbr title="June">{{$i['milestones6']}}</abbr></td>
                <td class="u-tableLight"><abbr title="Q2 Amount">₱{{number_format($i['ppmpq2'], 2, '.', ',')}}</abbr></td>

                <td><abbr title="July">{{$i['milestones7']}}</abbr></td>
                <td><abbr title="August">{{$i['milestones8']}}</abbr></td>
                <td><abbr title="September">{{$i['milestones9']}}</abbr></td>
                <td class="u-tableLight"><abbr title="Q3 Amount">₱{{number_format($i['ppmpq3'], 2, '.', ',')}}</abbr></td>

                <td><abbr title="October">{{$i['milestones10']}}</abbr></td>
                <td><abbr title="November">{{$i['milestones11']}}</abbr></td>
                <td><abbr title="December">{{$i['milestones12']}}</abbr></td>
                <td class="u-tableLight"><abbr title="Q4 Amount">₱{{number_format($i['ppmpq4'], 2, '.', ',')}}</abbr></td>
                <td>{{$i['qtyTotal']}}</td>
                <td>₱{{number_format($i['abc'], 2, '.', ',')}}</td>
                {{-- <td>{{number_format($i['estimated_budget'])}}</td> --}}
                <td>₱{{number_format($i['qtyxabc'], 2, '.', ',')}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
