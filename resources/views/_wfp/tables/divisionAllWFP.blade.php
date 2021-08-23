<form action="{{route('api.services.redirect.pqes')}}" id="frmdvsn-wfp" method="POST">
    @csrf
    <input type="hidden" value="WFP_Report_YtwqD0H2hC" name="redirect_key">
    <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
    <input type="hidden"  id="redirect_value" name="redirect_value">
    @include('_interface.snip.hiddenInput')
    <table id="maindivisionwfptable" class="table table-bordered table-sm table-hover" style="overflow: scroll; overflow: auto;">
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
                <th rowspan="2">Division Head Comment</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">Take Action</th>
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
                @foreach ($data['divisionWFP'] as $i)
                    @if ($category == $i['function_type'])
                        <tr>
                            @switch($category)
                                @case('A. Strategic Functions') <td class="font-weight-bold align-middle bg-gray-dark">{{$i['function_type']}}</td> @break
                                @case('B. Core Functions') <td class="font-weight-bold align-middle bg-gray-dark">{{$i['function_type']}}</td> @break
                                @case('C. Support Functions') <td class="font-weight-bold align-middle bg-gray-dark">{{$i['function_type']}}</td> @break
                                @default
                            @endswitch
                            <td>{{$i['wfp_id']}}</td>
                            <td class="align-middle">{{$i['function']}}</td>
                            <td>{{$i['activities']}}</td>
                            <td>{{$i['timeframe']}}</td>
                            <td>{{$i['q1']}}</td>
                            <td>{{$i['q2']}}</td>
                            <td>{{$i['q3']}}</td>
                            <td>{{$i['q4']}}</td>
                            <td>{{$i['item']}}</td>
                            <td>₱{{number_format($i['cost'],2), '.', ','}}</td>
                            <td>
                                @if ($i['cost'] == 0 )
                                    SRDS
                                @else
                                    {{$i['parent_type_abbr']}} | {{$i['source_name']}} | {{$i['type_abbr']}}
                                @endif
                            </td>
                            <td>{{$i['name_family']}},{{$i['name']}}</td>
                            <td>{{$i['program_abbr']}}</td>
                            <td class="align-middle">@if ($i['comment'] !== NULL)<span data-toggle="tooltip" title="Division chief comment" class="badge bg-warning d-flex justify-content-center"></span>{{$i['comment']}}</td>@else - </td>@endif
                            <td class="align-middle">
                                @switch($i['status'])
                                    @case('pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">Pending</span> @break
                                    @case('dhComment-pending') <span data-toggle="tooltip" title="Entry Status" class="badge bg-warning">For Division Head Approval</span> @break
                                    @case('section-revised') <span data-toggle="tooltip" title="Entry Status" class="badge bg-primary">Revised By Section</span> @break
                                    @case('dhApproved') <span data-toggle="tooltip" title="Entry Status" class="badge bg-success">Division Head Approved</span> @break
                                    @default
                                @endswitch
                            </td>
                            <td class="text-right align-middle">
                                <div class="btn-group btn-group-sm">
                                    @if ($i['comment'] !== 'dhApproved-year')
                                        @if (auth()->user()->section_id == 24 || auth()->user()->section_id == 25 | auth()->user()->section_id == 26 | auth()->user()->section_id == 27)
                                            <button type="button" id="comment" data-id="{{$i['devliverable_id']}}" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-placement="left" data-tt="tooltip" title="Request for revision"><i class="fas fa-comment"></i></button>
                                            <button type="button" id="markdone" data-id="{{$i['devliverable_id']}}" class="btn btn-success" data-toggle="modal" data-target="#modaldone" data-placement="left" data-tt="tooltip" title="Mark as Approved"><i class="fas fa-check"></i></button>
                                        @endif
                                        @if (auth()->user()->section_id != 24 && auth()->user()->section_id != 25 && auth()->user()->section_id != 26 && auth()->user()->section_id != 27)
                                            <button type="button" id="edt_id" data-id="{{$i['function'].'||'. $i['activities'].'||'. $i['timeframe'].'||'. $i['q1'].'||'. $i['q2'].'||'. $i['q3'].'||'. $i['q4'].'||'. $i['item'].'||'. $i['cost'].'||'. $i['source_abbr'].'||'. $i['status'].'||'. $i['function_type'].'||'. $i['year'].'||'. $i['devliverable_id']}}" class="btn btn-primary" data-toggle="modal" data-target="#edit" data-placement="left" data-tt="tooltip" title="Edit this entry"><i class="fas fa-edit"></i></button>
                                            <button type="button" id="dlt_id" data-id="{{$i['devliverable_id']}}" class="btn btn-danger" data-toggle="modal" data-target="#delete" data-placement="left" data-tt="tooltip" title="Delete this entry"><i class="fas fa-trash"></i></button>
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
                @endforeach
            @endforeach
        </tbody>
    </table>
{{--
    <hr>

    <p>Select Items form the above table to print WFP form</p>

    <p><button class="btn btn-primary btn-block">Generate WFP File</button></p> --}}
</form>

