<div class="modal fade bd-example-modal-xl" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            {{-- <form action=""> --}}
            <form action="{{route('api.wfp.update')}}" method="post">
                @csrf
                <input class="form-control" type="hidden" name="deliverable_id2" id="deliverable_id2">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover table-sm">
                        <thead class="text-center thead-dark">
                            <tr>
                                {{-- <th rowspan="2">#</th> --}}
                                <th rowspan="2">Output Functions / Deliverables</th>
                                <th rowspan="2">Activities For Outputs</th>
                                <th rowspan="2">Timeframe</th>
                                <th colspan="4">Target</th>
                                <th colspan="3">Resource Requirements</th>
                            </tr>
                            <tr>
                                <th>Q1</th>
                                <th>Q2</th>
                                <th>Q3</th>
                                <th>Q4</th>
                                <th>Item</th>
                                <th>Cost</th>
                                {{-- <th>Fund Source</th> --}}
                            </tr>
                        </thead>
                        <tbody class="myTbody">
                            {{-- input layer --}}
                            <tr>
                            <input name="responsible_person" type="hidden" value="{{auth()->user()->id}}">
                            <input name="section_id" type="hidden" value="{{session('section')->id}}">
                            <input name="division_id" type="hidden" value="{{session('division')->id}}">
                            <input name="devliverable_id2" id="devliverable_id2" type="hidden" >
                                {{-- <td>#</td> --}}
                                <td width="250px">
                                    <div class="form-group">
                                        <textarea required class="form-control" id="function2" name="function" rows="4"></textarea>
                                    </div>
                                </td>
                                <td width="200px">
                                    <div class="form-group">
                                        <textarea required class="form-control" id="activities2" name="activities" rows="4"></textarea>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <textarea required class="form-control" id="timeframe2" name="timeframe" rows="4"></textarea>
                                    </div>
                                </td>
                                    <td>
                                        <input type="text" class="form-control total-a" id="q12" name="q1" value="0" min="0">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control total-a" id="q22" name="q2" value="0" min="0">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control total-a" id="q32" name="q3"value="0" min="0">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control total-a" id="q42" name="q4" value="0" min="0">
                                    </td>
                                    <td width="200px">
                                        <div class="form-group">
                                            <textarea class="form-control" id="item2" name="item" rows="4" required></textarea>
                                        </div>
                                    </td>
                                <td>
                                    <input type="number" class="form-control total" id="cost2" name="cost" required value=0 min=0 step="any">
                                </td>
                                {{-- <td width="100px">
                                    <div class="form-group">
                                        <select class="form-control" id="fundSource_id" name="fundSource_id" >
                                        </select>
                                    </div>
                                </td> --}}
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">
                            <label for="function_type2">Select Function Type</label>
                            <select class="form-control" id="function_type2" name="function_type" required="required">
                                <option>Please Select...</option>
                                <option value="A. Strategic Functions">A. Strategic Functions</option>
                                <option value="B. Core Functions">B. Core Functions</option>
                                <option value="C. Support Functions">C. Support Functions</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="selected-year">Year</label>
                            <select class="form-control" id="selected-year2" name="selected-year2">
                                <option value="">Select Year...</option>
                                @for ($i = 2015; $i < now()->year+4; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            {{-- <input class="form-control" type="number" id="selected-year" name="year" value="2020" readonly=""> --}}
                        </div>
                        <div class="col">
                            <label for="function_type">Fund Source</label>
                            <div class="form-group" >
                                <select class="form-control single-basic" id="fundSource_id2" name="fundSource_id" style="width: 100%" required>
                                    <option disabled value="" selected hidden>Select Fund Source...</option>
                                    @foreach ($data['parentFunds'] as $i)
                                        @foreach ($data['typeFunds'] as $e)
                                                @foreach ($data['programFunds'] as $item)
                                                    @if ($i['id'] == $item['parent_id'] && $e['id'] == $item['type_id'])
                                                        <option value="{{$item['annual_budget_program_id']}}" class="text-navy" data-program="{{$item['program_id']}}" data-availableNEP="{{$item['allocatedNEP'] - $item['total_cost']}}" data-availableAmount="{{$item['allocatedAmount'] - $item['total_cost']}}" data-fundtype="{{$item['parent_type_abbr']}}">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;{{$i['parent']}} | {{$item['type_abbr']}} | {{$item['source_name']}} | {{$item['program_abbr']}} - {{$item['budget_program_name']}} <br>Amount: ₱{{number_format($item['allocatedNEP'] - $item['total_cost'])}}
                                                        </option>
                                                    @endif
                                                @endforeach

                                        @endforeach
                                    @endforeach
                                    <option value="11" class="text-navy" data-program="99" data-availableNEP="1" data-availableAmount="1" data-fundtype="sample">
                                        &nbsp;&nbsp;&nbsp;&nbsp; Choose if N/A<br>
                                    </option>
                                </select>
                                <small>IF N/A, manually select Program -></small>
                            </div>
                        </div>
                        <div class="col">
                            <label for="function_type">Program</label>
                            <select class="form-control"  name="wfpProgram" required="required" required>
                                <option selected="true" value="" disabled>Please Choose again...</option>
                                @foreach ($data['program'] as $i)
                                    @if (auth()->user()->section_id == $i['section_id'] && auth()->user()->division_id == $i['division_id'])
                                        <option value="{{$i['id']}}" class="text-truncate">{{$i['program']}} | {{$i['program_name' ?? '']}}</option>
                                    @endif
                                @endforeach
                                {{-- <option value="{{auth()->user()->section_id}}" class="text-truncate">None</option> --}}
                            </select>
                        </div>
                        <div class="col">
                            <label for="function_type">Responsible Person</label>
                            <select class="form-control single-basic" id="resp_person_edt" name="resp_person_edt" required style="width: 100%">
                                @foreach ($data['users'] as $users)
                                    <option value="{{$users['id']}}">{{$users['name_family']}}, {{$users['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
