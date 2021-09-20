@include('_interface.snip.wfpnote')
<form action="{{route('api.services.redirect.pqes')}}" id="frm-wfp" method="POST" target="blank">
    @csrf
    <input type="hidden" value="WFP_Report_YtwqD0H2hC" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_value" name="redirect_value">
    @include('_interface.snip.hiddenInput')
    <table id="wfp" class="table-bordered table-hover table-striped overflow-auto">
        <thead>
            <tr>
                <th rowspan="2" class="px-1"></th>
                <th rowspan="2" class="px-1"></th>
                <th rowspan="2" class="text-center px-1">Function Type</th>
                <th rowspan="2" class="text-center px-1">Output Functions / Deliverables</th>
                <th rowspan="2" class="text-center px-1">Activities For Outputs</th>
                <th rowspan="2" class="text-center px-1">Timeframe</th>
                <th colspan="4" class="text-center px-1">Target</th>
                <th colspan="3" class="text-center px-1">Resource Requirements</th>
                <th rowspan="2" class="text-center px-1">Responsible Person</th>
                <th rowspan="2" class="text-center px-1">Program</th>
                <th rowspan="2" class="text-center px-1">Division Head Comment & Status</th>
            </tr>
            <tr>
                <th class="text-center px-1">Q1</th>
                <th class="text-center px-1">Q2</th>
                <th class="text-center px-1">Q3</th>
                <th class="text-center px-1">Q4</th>
                <th class="text-center px-1">Item</th>
                <th class="text-center px-1">Cost</th>
                <th class="text-center px-1">Fund Source</th>
            </tr>
        </thead>
        <tbody class="wfptablebody">
            @foreach ($data['wfpCategory'] as $category)
                    @foreach ($data['allApprovedWFP'] as $key => $i)
                        @if ($category == $i['function_type']  &&  $i['wfp_type'] !== 'supplemental')
                            <tr>
                                <td class="px-1">{{ $i['origwfp_id'] }}</td>
                                <td class="align-middle text-center px-1">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle btn-success" type="button" id="dropdownMenu2"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >

                                            @if($i['OTF_status'] == 'locked') <i class="fas fa-lock mr-1" style="color: red"></i> @else <i class="fas fa-lock-open mr-1" style="color: #ffff00"></i> @endif
                                            <b> ₱ {{number_format($i['cost'] - $i['total_cost_ppmp'], 2), '.', ','}}</b>
                                        </button>
                                        <div class="dropdown-menu " aria-labelledby="dropdownMenu2 p-2" style="z-index: 9999999999">
                                            <h5 class="text-center text-danger font-weight-bold" style="@if($i['OTF_status'] == 'locked') display: block @else display: none @endif ">* This WFP is currently locked. To delete this WFP, you must first delete all associated PPMPs</h5>
                                            <p class="dropdown-item" disabled>You have reamining budget of <br> <b style="color:green">{{number_format($i['cost'] - $i['total_cost_ppmp'], 2), '.', ','}}</b> out of <b style="color: rgb(0, 195, 255)">{{number_format($i['cost'], 2), '.', ','}}</b></p>
                                            <button @if ($i['cost'] - $i['total_cost_ppmp'] <= 0) disabled @endif type="button" id="add_ppmp" data-id="{{$i['devliverable_id']}}" data-cost="{{$i['cost'] - $i['total_cost_ppmp']}}" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#edit3" data-placement="left" data-tt="tooltip" title="Click here to add PPMP (You have ₱ {{number_format($i['cost'] - $i['total_cost_ppmp'], 2), '.', ','}} remaining budget for this WFP)">
                                                <i class="fas fa-plus mr-2"></i>ADD PPMP
                                            </button>
                                            <button type="button" id="edt_id" data-id="{{$i['function'].'||'. $i['activities'].'||'. $i['timeframe'].'||'. $i['q1'].'||'. $i['q2'].'||'. $i['q3'].'||'. $i['q4'].'||'. $i['item'].'||'. $i['cost'].'||'. $i['annual_budget_program_id'].'||'. $i['status'].'||'. $i['function_type'].'||'. $i['year'].'||'. $i['devliverable_id'].'||'. $i['resp_person']}}" class="btn btn-primary btn-block" data-toggle="modal" data-target="#edit" data-placement="left" data-tt="tooltip" title="Edit this entry"><i class="fas fa-edit"></i> Edit WFP</button>
                                            <button
                                                type="button" id="dlt_id" data-id="{{$i['devliverable_id']}}"
                                                tyty="{{ $i['OTF_status']}}"
                                                class="btn @if($i['OTF_status'] == 'locked') btn-secondary @else btn-danger @endif btn-block" @if($i['OTF_status'] == 'locked') disabled @else  @endif data-toggle="modal" data-target="#delete" data-placement="left" data-tt="tooltip" title="Delete this entry">
                                                <i class="fas fa-trash"></i>
                                                Delete WFP
                                            </button>
                                            <button type="button" id="peak_id" data-id="{{$i['origwfp_id']}}" class="btn btn-info text-white btn-block" data-toggle="modal" data-target="#edit4" data-placement="left" data-tt="tooltip" title="See PPMP entries associated with this WFP"><i class="far fa-eye"></i> View PPMPs</button>
                                            <button type="button" class="btn btn-warning btn-block">Re-plan WFP</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-1">{{ $i['function_type'] }}</td>
                                <td class="align-middle px-1">{{$i['function']}}</td>
                                <td class="px-1">{{$i['activities']}}</td>
                                <td class="px-1">{{$i['timeframe']}}</td>
                                <td class="px-1">{{$i['q1']}}</td>
                                <td class="px-1">{{$i['q2']}}</td>
                                <td class="px-1">{{$i['q3']}}</td>
                                <td class="px-1">{{$i['q4']}}</td>
                                <td class="px-1">{{$i['item']}}</td>
                                <td class="px-1">{{number_format($i['cost'], 2), '.', ','}}</td>
                                <td class="px-1">{{ $i['parent_type_abbr'].' - '.$i['source_name'].' - '.$i['type_abbr'].' - '.$i['budget_program_name'] }}</td>
                                <td class="px-1">{{$i['name_family']}},{{$i['name']}}</td>
                                <td class="px-1">{{$i['program_abbr']}}</td>
                                <td class="align-middle px-1">
                                    <span data-toggle="tooltip" title="Division chief comment" class="badge bg-warning d-flex justify-content-center"></span>{{$i['comment']}}
                                    @switch($i['status'])
                                        @case('pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">Pending</span> @break
                                        @case('dhComment-pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">For Division Head Approval</span> @break
                                        @case('section-revised') <span data-toggle="tooltip" title="Entry Status" class="badge bg-primary">Revised By Section</span> @break
                                        @case('dhApproved') <span data-toggle="tooltip" title="Entry Status" class="badge bg-success">Division Head Approved</span> @break
                                        @default
                                    @endswitch
                                </td>
                            </tr>
                        @endif
                    @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" style="text-align:right">Filtered Cost Total / Total of currently visible entries:</th>
                <th colspan="11"style="text-align:left" id="total-id"></th>
            </tr>
            <tr>
                <th colspan="5" style="text-align:right">Cost Grand Total:</th>
                <th colspan="11"style="text-align:left" id="page-total-id"></th>
            </tr>
        </tfoot>
    </table>

    <hr>

    <p>Select Items form the above table to print WFP form</p>

    <p><button class="btn btn-warning btn-block">Generate Printable WFP Form</button></p>
</form>
<form action="{{route('api.services.redirect.pqes')}}" id="frm-wfp" method="POST" target="blank">
    @csrf
    <input type="hidden" value="WFP_Report_allQweRTyui" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_value" name="redirect_value" value="*">
    @include('_interface.snip.hiddenInput')
    <hr>
    <p><button class="btn btn-success btn-block">Generate Consolidated WFP </button></p>
</form>

<script>
    $(document).ready(function () {
        $('table#wfp').DataTable({
            dom: '<"d-flex justify-content-between"<f><"d-flex align-items-center"<l><p>>>',
            order: [[2, 'desc']],
            autoWidth: false,
            columnDefs: [
                { targets: [0, 1], orderable: false },
                { targets: 0, checkboxes: { selectRow: true } },
            ],
            select: {
                style: 'os',
                selector: 'td:first-child',
            },
        });
    });
</script>
