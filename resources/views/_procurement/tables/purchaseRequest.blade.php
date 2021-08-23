{{-- <form id="frm-pr" method="POST" action="{{route('api.services.redirect.pqes')}}"> --}}
    <h1 class="text-danger text-center font-weight-bold">*NOTICE: PLEASE MAKE SURE TO GROUP YOUR PURCHASE REQUEST BY CATEGORY BEFORE GENERATING PR</h1>
    <h5 class="text-danger text-center font-italic">*contact ICT section local 150 for issues and concerns</h5>
    <form id="frm-pr" method="POST" action="{{route('api.pt.rpr')}}">
    @csrf
    <input type="hidden" value="PR_request_YtwqD0H2hC" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_value" name="redirect_value">
    @include('_interface.snip.hiddenInput')
    <table id="prtable" class="table table-bordered table-sm table-hover"width="100%">
        <thead class="thead-dark">
            <tr>
                <th rowspan="2">Group</th>
                <th rowspan="2"></th>
                <th rowspan="2">General Description</th>
                <th rowspan="2">Quantity</th>
                <th rowspan="2">Unit</th>
                <th rowspan="2">ABC</th>
                <th rowspan="2">Estimated Budget</th>
                <th rowspan="2">Budget Line</th>
                <th rowspan="2">Mode of Procurement</th>
                <th colspan="1" class="text-center">Scheduled Milestone of Activities</th>
                <th rowspan="2">PR Status</th>
                {{-- <th rowspan="2">Division Head Comment</th>
                <th rowspan="2">Status</th> --}}
            </tr>
            <tr>
                <th>
                    January - December
                </th>
            </tr>
        </thead>
        <tbody class="prtable">
            @foreach ($data['allppmp'] as $key => $i)
                <tr @if (! is_null($i['pr_status']))
                    style="box-shadow:inset 0px 10px 0px 10px rgb(248, 252, 0, .5);"
                @endif>
                    <td colspan="18"></td>
                    <td>{{$i['ppmp_id']}}</td>
                    <td>{{$i['item_name']}}</td>
                    <td>{{$i['qty']}}</td>
                    <td>{{$i['unit']}}</td>
                    <td>₱{{number_format($i['abc'], 2), '.', ','}}</td>
                    <td>₱{{number_format($i['qty']*$i['abc'], 2), '.', ','}}</td>
                    <td>{{$i['parent_type_abbr']}} - {{$i['source_name']}} - {{$i['type_abbr']}} - ({{$i['budget_program_name']}}) </td>
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
                    <td>
                        @if (is_null($i['pr_status']))
                            <span> No Purchase Request </span>
                        @endif
                        @if (! is_null($i['pr_status']))
                            <span> With Purchase Request - ID:{{$i['pr_status']}}</span>
                        @endif

                    </td>
                    {{-- <td class="align-middle">@if ($i['comment'] !== NULL)<span data-toggle="tooltip" title="Division chief comment" class="badge bg-warning d-flex justify-content-center"></span>{{$i['comment']}}</td>@else - </td>@endif
                    <td class="align-middle">
                        @switch($i['ppmp_status'])
                            @case('pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">Pending</span> @break
                            @case('dhComment-pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">For Division Head Approval</span> @break
                            @case('section-revised') <span data-toggle="tooltip" title="Entry Status" class="badge bg-primary">Revised By Section</span> @break
                            @case('dhApproved') <span data-toggle="tooltip" title="Entry Status" class="badge bg-success">Division Head Approved</span> @break
                            @default
                        @endswitch
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <p>Select Items from the above table to generate Purchase Request</p>

    <p><button class="btn btn-primary btn-block">Generate Purchase Request</button></p>
    <small class="text-danger font-weight-bold">Please select atleast one of the entries above before generating a request</small>


    </form>

    {{-- <form action="{{route('api.services.redirect.pqes')}}" method="POST">

        <button class="btn btn-success mb-1" type="submit"><i class="fas fa-print mr-1"></i>Generate PQES Report</button>
    </form> --}}
