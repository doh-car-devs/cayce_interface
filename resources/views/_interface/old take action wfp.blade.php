<td class="text-right align-middle">
    <div class="btn-group btn-group-sm">
        @if ($i['comment'] !== 'dhApproved-year')
            @if (auth()->user()->section_id == 24 || auth()->user()->section_id == 25 | auth()->user()->section_id == 26 | auth()->user()->section_id == 27)
                <button type="button" id="comment" data-id="{{$i['devliverable_id']}}" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-placement="left" data-tt="tooltip" title="Request for revision"><i class="fas fa-comment"></i></button>
                <button type="button" id="markdone" data-id="{{$i['devliverable_id']}}" class="btn btn-success" data-toggle="modal" data-target="#modaldone" data-placement="left" data-tt="tooltip" title="Mark as Approved"><i class="fas fa-check"></i></button>
            @endif
            @if (auth()->user()->section_id != 24 && auth()->user()->section_id != 25 && auth()->user()->section_id != 26 && auth()->user()->section_id != 27)
            {{-- ID No.: {{$i['origwfp_id']}} --}}
            {{-- Remaining ₱{{number_format($i['cost'] - $i['total_cost_ppmp'], 2), '.', ','}} --}}
            {{$i['origwfp_id']}}
                <button @if ($i['cost'] - $i['total_cost_ppmp'] <= 0) disabled @endif type="button" id="add_ppmp" data-id="{{$i['devliverable_id']}}" data-cost="{{$i['cost'] - $i['total_cost_ppmp']}}" class="btn btn-outline-success" data-toggle="modal" data-target="#edit3" data-placement="left" data-tt="tooltip" title="Add PPMP (You have ₱ {{number_format($i['cost'] - $i['total_cost_ppmp'], 2), '.', ','}} remaining budget for this WFP)"><i class="fas fa-angle-double-up"> ₱ {{number_format($i['cost'] - $i['total_cost_ppmp'], 2), '.', ','}}</i></button>
                {{-- @if ($i['origwfp_id'] !== 300) disabled @endif --}}
                {{-- <button type="button" id="dup_id" data-id="{{$i['function'].'||'. $i['activities'].'||'. $i['timeframe'].'||'. $i['q1'].'||'. $i['q2'].'||'. $i['q3'].'||'. $i['q4'].'||'. $i['item'].'||'. $i['cost'].'||'. $i['annual_budget_program_id'].'||'. $i['status'].'||'. $i['function_type'].'||'. $i['year'].'||'. $i['devliverable_id']}}" class="btn btn-warning" data-toggle="modal" data-target="#duplicate_wfp" data-placement="left" data-tt="tooltip" title="Duplicate this entry"><i class="fas fa-copy"></i></button> --}}
                <button type="button" id="edt_id" data-id="{{$i['function'].'||'. $i['activities'].'||'. $i['timeframe'].'||'. $i['q1'].'||'. $i['q2'].'||'. $i['q3'].'||'. $i['q4'].'||'. $i['item'].'||'. $i['cost'].'||'. $i['annual_budget_program_id'].'||'. $i['status'].'||'. $i['function_type'].'||'. $i['year'].'||'. $i['devliverable_id'].'||'. $i['resp_person']}}" class="btn btn-primary" data-toggle="modal" data-target="#edit" data-placement="left" data-tt="tooltip" title="Edit this entry"><i class="fas fa-edit"></i></button>
                <button type="button" id="dlt_id" data-id="{{$i['devliverable_id']}}" class="btn btn-danger" data-toggle="modal" data-target="#delete" data-placement="left" data-tt="tooltip" title="Delete this entry"><i class="fas fa-trash"></i></button>
                <button type="button" id="peak_id" data-id="{{$i['origwfp_id']}}" class="btn btn-info text-white" data-toggle="modal" data-target="#edit4" data-placement="left" data-tt="tooltip" title="See PPMP entries associated with this WFP"><i class="far fa-eye"></i></button>
            @endif
        @else
            <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-user"></i> Approve DH
            </a>
        @endif
    </div>
</td>
