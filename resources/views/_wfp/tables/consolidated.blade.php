@include('_interface.snip.wfpnote')
<form action="{{route('api.services.redirect.pqes')}}" id="frm-wfp123" method="POST" target="blank">
    @csrf
    <input type="hidden" value="WFP_Report_YtwqD0H2hC" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_value" name="redirect_value">
    @include('_interface.snip.hiddenInput')
    <table id="mainwfptableconsolidated" class="table table-bordered table-sm table-hover compact" style="overflow: scroll; overflow: auto; width:100%">
        <thead class="thead-dark">
            <tr>
                {{-- hidden --}}
                <th rowspan="2">Function Type</th>
                <th rowspan="2"></th>
                {{-- hidden --}}
                <th rowspan="2">Output Functions / Deliverables</th>
                <th rowspan="2">Activities For Outputs</th>
                <th rowspan="2">Timeframe</th>
                <th colspan="4" class="text-center">Target</th>
                <th colspan="3" class="text-center">Resource Requirements</th>
                <th rowspan="2">Responsible Person</th>
                <th rowspan="2">Program</th>
                <th rowspan="2">Division</th>
                <th rowspan="2">Division Head Comment</th>
                <th rowspan="2">Action</th>
                {{-- <th rowspan="2">Status</th> --}}
                {{-- <th rowspan="2">Take Action</th> --}}
            </tr>
            <tr>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
                <th>Q4</th>
                <th>Item</th>
                <th>Cost</th>
                <th>Fund Source</th>
            </tr>
        </thead>
        <tbody class="wfptablebody">
            @foreach ($data['wfpCategory'] as $category)
                {{-- @foreach ($data['allwfp'] as $i) --}}
                @foreach ($data['allApprovedWFP'] as $i)
                    @if ($category == $i->function_type)
                        <tr
                        @if (isset($i->cost) && isset($i->total_cost_ppmp))
                            @if(
                                number_format($i->cost - $i->total_cost_ppmp) < 0
                                ) style="background-color: rgb(252, 81, 81);" @endif
                            @if(
                                number_format($i->cost - $i->total_cost_ppmp) > 0
                                ) style="box-shadow:inset 0px 10px 0px 10px rgb(248, 252, 0, .5);" @endif
                        @endif
                        {{-- @if(
                            number_format($i->cost - $i->total_cost_ppmp) > 0
                            ) style="outline: 3px dashed  rgba(146, 255, 191, 0.658);" @endif --}}
                        >
                            @switch($category)
                                @case('A. Strategic Functions') <td class="font-weight-bold align-middle bg-gray-dark">{{$i->function_type}}</td> @break
                                @case('B. Core Functions') <td class="font-weight-bold align-middle bg-gray-dark">{{$i->function_type}}</td> @break
                                @case('C. Support Functions') <td class="font-weight-bold align-middle bg-gray-dark">{{$i->function_type}}</td> @break
                                @default
                            @endswitch
                            <td>
                                {{$i->wfp_id}}
                            </td>
                            <td class="align-middle">{{$i->function}}</td>
                            <td>{{$i->activities}}</td>
                            <td>{{$i->timeframe}}</td>
                            <td>{{$i->q1}}</td>
                            <td>{{$i->q2}}</td>
                            <td>{{$i->q3}}</td>
                            <td>{{$i->q4}}</td>
                            <td>{{$i->item}}</td>
                            <td>{{number_format($i->cost, 2), '.', ','}}</td>
                            <td>
                                {{-- @if ($i->cost == 0 ) --}}
                                    {{-- SRDS --}}
                                {{-- @else --}}
                                    {{$i->parent_type_abbr}} | {{$i->source_name}} | {{$i->type_abbr}} | {{$i->budget_program_name}}
                                {{-- @endif --}}
                            </td>
                            <td>{{$i->name_family}},{{$i->name}}</td>
                            <td>{{$i->program_abbr}}</td>
                            <td>{{$i->division_abbr}}</td>
                            <td class="align-middle">@if ($i->comment !== NULL)<span data-toggle="tooltip" title="Division chief comment" class="badge bg-warning d-flex justify-content-center"></span>{{$i->comment}}</td>@else - </td>@endif
                            <td class="align-middle">
                                @switch($i->status)
                                    @case('pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">Pending</span> @break
                                    @case('dhComment-pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">For Division Head Approval</span> @break
                                    @case('section-revised') <span data-toggle="tooltip" title="Entry Status" class="badge bg-primary">Revised By Section</span> @break
                                    @case('dhApproved') <span data-toggle="tooltip" title="Entry Status" class="badge bg-success">Division Head Approved</span> @break
                                    @default
                                @endswitch
                                <button type="button" id="peak_id" data-id="{{$i->origwfp_id}}" class="btn btn-info text-white" data-toggle="modal" data-target="#edit4" data-placement="left" data-tt="tooltip" title="See PPMP entries associated with this WFP"><i class="far fa-eye"></i></button>
                                {{$i->wfp_id}}
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" style="text-align:right">Filtered Cost Total / Total of currently visible entries:</th>
                <th colspan="12"style="text-align:left" id="total-id"></th>
            </tr>
            <tr>
                <th colspan="5" style="text-align:right">Cost Grand Total:</th>
                <th colspan="12"style="text-align:left" id="page-total-id"></th>
            </tr>
        </tfoot>
    </table>

    <hr>

    <p>Select Items form the above table to print WFP form</p>

    <p><button class="btn btn-warning btn-block">Generate Printable WFP Form</button></p>
</form>
{{-- <form action="{{route('api.services.redirect.pqes')}}" id="frm-wfp" method="POST" target="blank">
    @csrf
    <input type="hidden" value="WFP_Report_allQweRTyui" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_value" name="redirect_value" value="*">
    @include('_interface.snip.hiddenInput')
    <hr>
    <p><button class="btn btn-success btn-block">Generate Consolidated WFP </button></p>
</form> --}}
    {{-- <p><button class="btn btn-warning btn-block disabled">Generation of WFP file is currently disabled for updates. Please checkback in later or call ICT section local 150</button></p> --}}

