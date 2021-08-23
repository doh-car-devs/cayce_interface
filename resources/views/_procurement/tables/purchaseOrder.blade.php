<form id="frm-pr" method="GET" action="{{route('pt.poItem')}}">
    @csrf
    {{-- <input type="hidden" value="PO_request_JptRMD0Hq1" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_value" name="redirect_value"> --}}
    <input type="hidden" name="bidder_id" id="bidder_id">
    {{-- @include('_interface.snip.hiddenInput') --}}
    <table id="mainbidderpo" class="table table-bordered table-sm table-hover">
        <thead>
            <tr>
                <th colspan="2" class="text-center"><h4 class="mt-3">Bidder Details</h4></th>
                {{-- <th colspan="3" class="text-center"><h4 class="mt-3">Item Specifications</h4></th> --}}
                {{-- <th colspan="2" class="text-center u-tableDark text-white"><h4 class="mt-3">Status</h4></th> --}}
                <th rowspan="1" class="text-center align-middle"><h4 class="mt-2">Action</h4></th>
            </tr>
            <tr>
                <th class="">Bidder ID</th>
                <th class="">Bidder Name</th>
                {{-- <th class="u-tableLight">Unit Cost <small>(Per Item)</small></th>
                <th class="u-tableLight">Total Cost</th> --}}
                {{-- <th>Unit Cost</th>
                <th>Total Quantity</th>
                <th>Total Cost</th> --}}
                {{-- <th class="u-tableDark text-white">Savings per item</th>
                <th class="u-tableDark text-white">Total Savings per item</th> --}}
            </tr>
        </thead>
        <tbody class="wfptablebody">
            @foreach ($data['items'] as $i)
                </tr>
                    <td class="">{{$i['id']}}</td>
                    <td class="">{{$i['bidder_name']}}</td>
                    <td class="text-right align-middle">
                        <div class="btn-group btn-group-sm">
                            <button type="submit" id="edt_id" data-id="{{$i['id']}}" class="btn btn-primary" data-placement="left" data-tt="tooltip" title="Print Purchase Order"><i class="fas fa-print"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
