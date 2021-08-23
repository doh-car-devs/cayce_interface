<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
           <h3 class="card-title">
               <i class="fas fa-plus-square mr-2"></i>
               Add New WFP/SWFP
           </h3>
           <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                   <i class="fas fa-plus"></i>
               </button>
           </div>
    </div>
    <div class="card-body">
        <form action="{{route('api.wfp.store')}}" method="post">
        <label for="function_type" class="text-danger">WFP TYPE</label>
        {{-- <p>* Last encoding of REGULAR WFP APRIL26 2021 for BAC Consolidation</p> --}}
        <select class="form-control single-basic mb-3" style="width: 100%" id="wfp_type" name="wfp_type" required="required">
            <option value="supplemental" selected>supplemental work and financial plan</option>
            {{-- <option value="regular">Regular</option> --}}
        </select>
        <div class="row mb-3 mt-3">
            <div class="col-md-2">
                <label for="function_type">Function Type</label>
                <select class="form-control" id="function_type" name="function_type" required="required">
                    <option value="" selected hidden>Please Select...</option>
                    <option value="A. Strategic Functions">A. Strategic Functions</option>
                    <option value="B. Core Functions">B. Core Functions</option>
                    <option value="C. Support Functions">C. Support Functions</option>
                </select>
            </div>
            <div class="col">
                <label for="function_type">Fund Source</label>
                <div class="form-group" >
                    <select class="form-control single-basic" id="fundSource_id" name="fundSource_id" style="width: 100%" required>
                        <option disabled value="" selected hidden>Select Fund Source...</option>
                        @if (strpos(Request::url(), 'supplemental') )
                            @foreach ($data['parentFunds'] as $i)
                                @foreach ($data['typeFunds'] as $e)
                                        @foreach ($data['programFunds'] as $item)
                                            @if ($i['id'] == $item['parent_id'] && $e['id'] == $item['type_id'] && $item['parent_type_abbr'] == 'SAA')
                                                <option value="{{$item['annual_budget_program_id']}}" class="text-navy" data-program="{{$item['program_id']}}" data-availableNEP="{{$item['allocatedNEP'] - $item['total_cost']}}" data-availableAmount="{{$item['allocatedAmount'] - $item['total_cost']}}" data-fundtype="{{$item['parent_type_abbr']}}">
                                                    @if ($item['parent_type_abbr'] == 'GAA')
                                                        &nbsp;&nbsp;&nbsp;&nbsp;{{$i['parent']}} | {{$item['type_abbr']}} | {{$item['source_name']}} | {{$item['program_abbr']}} - {{$item['budget_program_name']}} <br>Amountttt: ₱{{number_format($item['allocatedNEP'] - $item['total_cost'])}}
                                                    @endif

                                                    @if($item['parent_type_abbr'] == 'SAA' || $item['parent_type_abbr'] == 'SARO' || $item['parent_type_abbr'] == 'Trust Funds')
                                                        &nbsp;&nbsp;&nbsp;&nbsp;{{$i['parent']}} | {{$item['type_abbr']}} | {{$item['source_name']}} | {{$item['program_abbr']}} - {{$item['budget_program_name']}} <br>Amount: ₱{{number_format($item['allocatedAmount'] - $item['total_cost'])}}
                                                    @endif
                                                </option>
                                            @endif
                                        @endforeach
                                @endforeach
                            @endforeach
                        @endif
                        @if (strpos(Request::url(), 'index') )
                        @foreach ($data['parentFunds'] as $i)
                            @foreach ($data['typeFunds'] as $e)
                                    @foreach ($data['programFunds'] as $item)
                                        @if ($i['id'] == $item['parent_id'] && $e['id'] == $item['type_id'] && $item['parent_type_abbr'] == 'GAA')
                                            <option value="{{$item['annual_budget_program_id']}}" class="text-navy" data-program="{{$item['program_id']}}" data-availableNEP="{{$item['allocatedNEP'] - $item['total_cost']}}" data-availableAmount="{{$item['allocatedAmount'] - $item['total_cost']}}" data-fundtype="{{$item['parent_type_abbr']}}">
                                                @if ($item['parent_type_abbr'] == 'GAA')
                                                    &nbsp;&nbsp;&nbsp;&nbsp;{{$i['parent']}} | {{$item['type_abbr']}} | {{$item['source_name']}} | {{$item['program_abbr']}} - {{$item['budget_program_name']}} <br>Amountttt: ₱{{number_format($item['allocatedNEP'] - $item['total_cost'])}}
                                                @endif

                                                @if($item['parent_type_abbr'] == 'SAA' || $item['parent_type_abbr'] == 'SARO' || $item['parent_type_abbr'] == 'Trust Funds')
                                                    &nbsp;&nbsp;&nbsp;&nbsp;{{$i['parent']}} | {{$item['type_abbr']}} | {{$item['source_name']}} | {{$item['program_abbr']}} - {{$item['budget_program_name']}} <br>Amount: ₱{{number_format($item['allocatedAmount'] - $item['total_cost'])}}
                                                @endif
                                            </option>
                                        @endif
                                    @endforeach
                            @endforeach
                        @endforeach
                        @endif
                        {{-- <option value="11" class="text-navy" data-program="99" data-availableNEP="1" data-availableAmount="1" data-fundtype="sample">
                            &nbsp;&nbsp;&nbsp;&nbsp; Choose if N/A<br>
                        </option> --}}
                    </select>
                    <small>IF N/A, manually select Program -></small>
                </div>
                {{-- <div class="row">
                    <div class="col">
                        <span>Remaining: </span> <span class="red"></span>
                    </div>
                    <div class="col">
                        <span>Allocated: </span> <span class="green"></span>
                    </div>
                </div> --}}
            </div>
            <div class="col">
                <label for="wfpProgram">Section Program</label>
                <select class="form-control" id="wfpProgram" name="wfpProgram" required="required" readonly>
                    @foreach ($data['program'] as $i)
                        @if (auth()->user()->section_id == $i['section_id'] && auth()->user()->division_id == $i['division_id'])
                            <option value="{{$i['id']}}" class="text-truncate">{{$i['program']}} | {{$i['program_name' ?? '']}}</option>
                        @endif
                    @endforeach
                    <option value="{{auth()->user()->section_id}}" class="text-truncate">None</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="selected-year">Year</label>
                <input class="form-control" type="number" id="selected-year" name="year" value="{{$data['year']}}" readonly>
            </div>
        </div>
        <table class="table table-bordered table-hover table-sm">
            <thead class="text-center thead-dark">
                <tr>
                    <th rowspan="2">Output Functions / Deliverables</th>
                    <th rowspan="2">Activities For Outputs</th>
                    <th rowspan="2">Timeframe</th>
                    <th colspan="4">Target</th>
                    <th colspan="2">Resource Requirements</th>
                    <th rowspan="2">Responsible Person</th>
                </tr>
                <tr>
                    <th>Q1</th>
                    <th>Q2</th>
                    <th>Q3</th>
                    <th>Q4</th>
                    <th>Item</th>
                    <th>QTY / Cost</th>
                </tr>
            </thead>
            <tbody class="myTbody">
                @csrf
                <tr>
                <input name="responsible_person" type="hidden" value="{{auth()->user()->id}}">
                <input name="section_id" type="hidden" value="{{auth()->user()->section_id}}">
                <input name="division_id" type="hidden" value="{{auth()->user()->division_id}}">
                    <td width="250px">
                        <div class="form-group">
                            {{-- <textarea required class="form-control" id="function" name="function" rows="4"></textarea> --}}
                            <select id="wfpDeliverable" name="function" style="width: 100%;" data-placeholder="Search for deliverable/s" required>
                            </select>
                            <small id="helpblock" class="form-text text-muted">
                                Search for <b>deliverables</b> with the search box / dropdown provided above.
                                <u class="text-info" type="button" data-toggle="modal" data-target="#edit2" aria-expanded="false" aria-controls="collapseExample"> or CREATE new Deliverable</u>
                            </small>
                        </div>
                    </td>
                    <td width="200px">
                        <div class="form-group">
                            <textarea required class="form-control" id="activities" name="activities" rows="4"></textarea>
                        </div>
                    </td>
                    <td width="100px">
                        <div class="form-group">
                            <textarea required class="form-control" id="timeframe" name="timeframe" rows="4"></textarea>
                        </div>
                    </td>
                        <td>
                            <input type="text" class="form-control total-a" id="q1" name="q1" value="0" min="0" required>
                        </td>
                        <td>
                            <input type="text" class="form-control total-a" id="q2" name="q2" value="0" min="0" required>
                        </td>
                        <td>
                            <input type="text" class="form-control total-a" id="q3" name="q3"value="0" min="0" required>
                        </td>
                        <td>
                            <input type="text" class="form-control total-a" id="q4" name="q4" value="0" min="0" required>
                        </td>
                        <td width="200px">
                            <div class="form-group">
                                <textarea class="form-control" id="item" name="item" rows="4" required></textarea>
                                <small>Note: you can leave this field blank or indicate N/A</small>
                            </div>
                        </td>
                    <td>
                        <input type="number" class="form-control total" id="cost" name="cost" required value=0 min=0 step=".01">
                        {{-- <button type="button" id="calc_target_wfp" class="btn btn-block btn-outline-secondary mt-2">Calculate</button> --}}
                        <span class="form-text text-muted">Available: ₱ <span id="viewperdev3" class="font-weight-bold"></span></span>
                    </td>
                    <td>
                        <div class="form-group">
                            <select class="form-control single-basic" id="resp_person[]" name="resp_person[]" multiple="multiple" required>
                                @foreach ($data['users'] as $users)
                                    <option value="{{$users['id']}}">{{$users['name_family']}}, {{$users['name']}}</option>
                                    {{-- <option value="9999">Research Utilization Committee</option> --}}
                                @endforeach
                            </select>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success btn-block">Save WFP Entry</button>
        </form>
    </div>
</div>
