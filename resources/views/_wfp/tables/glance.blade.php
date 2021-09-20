<div class="row">
    <div class="col-md-6">
        <div class="row border m-2 d-flex justify-content-between">
            <div class="col-md-6">
                @include('_interface.includes.glance.wfp_gaa_knob')
            </div>
            <div class="col-md-6">
                @include('_interface.includes.glance.wfp_saa_knob')
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <table class="table table-bordered table-sm table-hover table-condensed" id="dashboard_budget" style="width: 100%">
            <thead>
                <tr>
                    <th>Parent</th>
                    <th>Type</th>
                    <th>Source</th>
                    <th>Purpose</th>
                    <th>Program</th>
                    <th>Total</th>
                </tr>
            </thead>
            <thead>
                @if ($data['programBudget']['annual_budget_programs'] )
                    @foreach ($data['programBudget']['annual_budget_programs'] as $i)
                        <tr>
                            <th>{{$i['parent_type_abbr']}}</th>
                            <th>{{$i['type_abbr']}}</th>
                            <th>{{$i['source_name']}}</th>
                            <th>{{$i['budget_program_name']}}</th>
                            <th>{{$i['program_abbr']}}</th>
                            {{-- <th>{{$i['allocatedNEP']}}</th> --}}
                            @if ($i['parent_type_abbr'] == 'GAA')
                                <th>₱ {{number_format($i['allocatedNEP'],2, '.', ',')}}</th>
                            @endif
                            @if ($i['parent_type_abbr'] == 'SAA' || $i['parent_type_abbr'] == 'Trust Funds')
                                <th class="text-primary">₱ {{number_format($i['allocatedAmount'],2, '.', ',')}}</th>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </thead>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right h4 font-weight-bold">Total GAA:</th>
                    <th class="h4 font-weight-bold text-success">₱ {{number_format($data['programBudget']['GAA']), '.', ',' ?? 'No budget Allocated'}}</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-right h4 font-weight-bold">Total SAA:</th>
                    <th class="h4 font-weight-bold text-primary">₱ {{number_format($data['programBudget']['SAA']), '.', ',' ?? 'No budget Allocated'}}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
