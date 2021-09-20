{{-- <small class="text-danger">* Creating / editing PPMP is now disabled</small> --}}
<form action="{{route('api.services.redirect.pqes')}}" id="frm-ppmp" method="POST">
    @csrf
    <input type="hidden" value="PPMP_Report_ZhCbAqyce" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_value" name="redirect_value">
    @include('_interface.snip.hiddenInput')
    <table id="mainppmptable" class="table table-bordered table-sm table-hover">
        <thead class="thead-dark">
            <tr>
                {{-- hidden --}}
                <th rowspan="2">Group</th>
                {{-- hidden --}}
                <th rowspan="2">ID</th>
                <th rowspan="2">Section</th>
                <th rowspan="2">General Description</th>
                <th rowspan="2">Quantity</th>
                <th rowspan="2">Unit</th>
                <th rowspan="2">ABC</th>
                <th rowspan="2">Estimated Budget</th>
                <th rowspan="2">Fund Source</th>
                <th rowspan="2">Mode of Procurement</th>
                <th colspan="1" class="text-center">Scheduled Milestone of Activities</th>
                <th rowspan="2">Division Head Comment</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">regular / supplemental</th>
                <th rowspan="2">Take Action</th>
            </tr>
            <tr>
                <th>
                    January - December
                </th>
            </tr>
        </thead>
        <tbody class="mainppmptable">
            @foreach ($data['allppmp'] as $i)
            {{-- @foreach ($data['deletedWFPwithPPMP'] as $iiiiiii) --}}

                @if ($i['ppmp_type'] ==  'regular')
                        {{-- <tr> --}}
                        {{-- @foreach ($data['allApprovedWFP'] as $i) --}}
                        <tr
                        @if ($i['ppmp_type'] == 'supplemental')
                            style="background-color: black"
                        @endif
                        @if(
                        number_format($i['abc']*$i['qty'], 2) != number_format($i['estimated_budget'], 2) || $i['devliverable_id'] == null ||
                        $i['milestones1'] + $i['milestones2'] + $i['milestones3'] + $i['milestones4'] + $i['milestones5'] + $i['milestones6'] +
                        $i['milestones7'] + $i['milestones8'] + $i['milestones9'] + $i['milestones10'] + $i['milestones11'] + $i['milestones12'] != $i['qty']
                        ||$i['OTF_status'] !== null
                        ) style="background-color: rgb(252, 81, 81);" @endif>
                            <td colspan="18">{{$i['activities']}} (<small>{{$i['item']}}</small>)</td>
                            <td>{{$i['ppmp_id']}}</td>
                            <td>{{$i['program_abbr']}} -
                            @if ($i['division_id'] == 1)
                                RDARDvision
                            @endif
                            @if ($i['division_id'] == 2)
                                MSDivision
                            @endif
                            @if ($i['division_id'] == 3)
                                LHSDivision
                            @endif
                            @if ($i['division_id'] == 4)
                                RLEDivision
                            @endif
                            </td>
                            <td>{{$i['item_name']}} - {{$i['general_description']}}</td>
                            <td>{{$i['qty']}}</td>
                            <td>{{$i['unit']}}</td>
                            <td>₱{{number_format($i['abc'], 2), '.', ','}}</td>
                            <td>
                                ₱{{number_format($i['estimated_budget'], 2), '.', ','}}
                                {{-- <br>
                                <span class="text-success">₱{{number_format($i['abc']*$i['qty'], 2), '.', ','}}</span> --}}
                            </td>
                            {{-- <td>
                                ₱ {{$i['estimated_budget']}}
                                <br>
                                <span class="text-success">₱ {{$i['abc']*$i['qty']}}</span>
                            </td> --}}
                            {{-- <td>{{number_format($i['cost'], 2), '.', ','}}</td> --}}
                            <td>{{$i['parent_type_abbr']}} | {{$i['type_abbr']}}  | {{$i['source_name']}} | {{$i['budget_program_name']}}</td>
                            <td>{{$i['mode']}}</td>
                            <td class="">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><abbr title="January">{{$i['milestones1']}}</abbr></td>
                                            <td><abbr title="February">{{$i['milestones2']}}</abbr></td>
                                            <td><abbr title="March">{{$i['milestones3']}}</abbr></td>
                                            <td><abbr title="April">{{$i['milestones4']}}</abbr></td>
                                            <td><abbr title="May">{{$i['milestones5']}}</abbr></td>
                                            <td><abbr title="June">{{$i['milestones6']}}</abbr></td>
                                            <td><abbr title="July">{{$i['milestones7']}}</abbr></td>
                                            <td><abbr title="August">{{$i['milestones8']}}</abbr></td>
                                            <td><abbr title="September">{{$i['milestones9']}}</abbr></td>
                                            <td><abbr title="October">{{$i['milestones10']}}</abbr></td>
                                            <td><abbr title="November">{{$i['milestones11']}}</abbr></td>
                                            <td><abbr title="December">{{$i['milestones12']}}</abbr></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                            <td class="align-middle">@if ($i['ppmp_comment'] !== NULL)<span data-toggle="tooltip" title="Division chief comment" class="badge bg-warning d-flex justify-content-center"></span>{{$i['ppmp_comment']}}</td>@else - </td>@endif
                            <td>{{$i['OTF_status']}}@if (
                            number_format($i['abc']*$i['qty'], 2) != number_format($i['estimated_budget'], 2) || $i['devliverable_id'] == null||
                            $i['milestones1'] + $i['milestones2'] + $i['milestones3'] + $i['milestones4'] + $i['milestones5'] + $i['milestones6'] +
                            $i['milestones7'] + $i['milestones8'] + $i['milestones9'] + $i['milestones10'] + $i['milestones11'] + $i['milestones12'] != $i['qty']
                            )
                                Please check!
                            @elseif ($i['OTF_status'] !== null)
                                ERROR! This has a deleted WFP!
                            @else
                                ok!
                            @endif
                            @if ($i['ppmp_type'] == 'supplemental')
                                supplemental
                            @endif
                            </td>
                            <td class="align-middle">
                                {{-- @switch($i['ppmp_status'])
                                    @case('pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">Pending</span> @break
                                    @case('dhComment-pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">For Division Head Approval</span> @break
                                    @case('section-revised') <span data-toggle="tooltip" title="Entry Status" class="badge bg-primary">Revised By Section</span> @break
                                    @case('dhApproved') <span data-toggle="tooltip" title="Entry Status" class="badge bg-success">Division Head Approved</span> @break
                                    @default
                                @endswitch --}}
                                {{$i['ppmp_type']}}
                            </td>
                            <td class="text-right align-middle">
                                <div class="btn-group btn-group-sm">
                                    @if ($i['comment'] !== 'dhApproved-year')
                                        @if (auth()->user()->section_id == 24 || auth()->user()->section_id == 25 | auth()->user()->section_id == 26 | auth()->user()->section_id == 27)
                                            <button type="button" id="commentppmp" data-id="{{$i['ppmp_id']}}" class="btn btn-primary" data-toggle="modal" data-target="#examplePPMPModal" data-placement="left" data-tt="tooltip" title="Request for revision"><i class="fas fa-comment"></i></button>
                                            <button type="button" id="markppmpdone" data-id="{{$i['ppmp_id']}}" class="btn btn-success" data-toggle="modal" data-target="#modalppmpdone" data-placement="left" data-tt="tooltip" title="Mark as Approved"><i class="fas fa-check"></i></button>
                                        @endif
                                        @if (auth()->user()->section_id != 24 && auth()->user()->section_id != 25 && auth()->user()->section_id != 26 && auth()->user()->section_id != 27)
                                            {{-- <small class="text-danger">* Creating / editing PPMP is now disabled</small> --}}
{{--                                            Created at: {{$i['ppmp_make_date']}}<br>--}}
{{--                                            Updated at: {{$i['ppmp_update_date']}}<br>--}}
                                            {{-- @if ($i['pr_number'] !== null) disabled @endif --}}
                                            {{-- @if ($i['pr_number'] !== null) disabled @endif --}}
                                            <button type="button" id="edtPPMP_id"
                                                data-id="{{$i['devliverable_id'].'||'. $i['general_description'].'||'. $i['qty'].'||'. $i['unit'].'||'. $i['abc'].'||'. $i['estimated_budget'].'||'. $i['MOP'].'||'. $i['milestones1'].'||'. $i['milestones2'].'||'. $i['milestones3'].'||'. $i['milestones4'].'||'. $i['milestones5'].'||'. $i['milestones6'].'||'. $i['milestones7'].'||'. $i['milestones8'].'||'. $i['milestones9'].'||'. $i['milestones10'].'||'. $i['milestones11'].'||'. $i['milestones12'].'||'. $i['comment'].'||'. $i['ppmp_status'].'||'. $i['ppmp_id']}}"
                                                class="btn @if ($i['pr_number'] !== null) btn-secondary @else btn-primary @endif "
                                                data-toggle="modal"
                                                data-target="@if ($i['pr_number'] !== null) #nopenope @else #ppmpmodal @endif "
                                                data-placement="left" data-tt="tooltip"
                                                title="@if ($i['pr_number'] !== null) A PURCHASE REQUEST has already been made. you can no longer edit/delete this entry @else Edit this entry @endif "><i class="fas fa-edit"></i></button>
                                            <button type="button" id="dltPPMP_id"
                                                data-id="{{$i['ppmp_id']}}"
                                                class="btn @if ($i['pr_number'] !== null) btn-secondary @else btn-danger @endif "
                                                data-toggle="modal"
                                                data-target="@if ($i['pr_number'] !== null) #nopenope @else #delete_ppmp @endif "
                                                data-placement="left" data-tt="tooltip"
                                                title="@if ($i['pr_number'] !== null) A PURCHASE REQUEST has already been made. you can no longer edit/delete this entry @else Delete this entry @endif "><i class="fas fa-trash"></i></button>
                                        @endif
                                    @else
                                        <a href="#" class="btn btn-sm btn-primary">
                                            <i class="fas fa-user"></i> Approve DH
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
            {{-- @endforeach --}}
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" style="text-align:right">Filtered Cost Total / Total of currently visible entries:</th>
                <th colspan="6"style="text-align:left" id="total-id"></th>
            </tr>
            <tr>
                <th colspan="6" style="text-align:right">Cost Grand Total:</th>
                <th colspan="6"style="text-align:left" id="page-total-id"></th>
            </tr>
        </tfoot>
    </table>

    <hr>

    <p>Select Items form the above table to print PPMP form</p>

    <p><button class="btn btn-primary btn-block">Generate PPMP File</button></p>
</form>
