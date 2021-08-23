<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            {{$include_title}} | {{$data['year']}}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="selected-year">Year</label>
                    <input class="form-control" type="number" id="selected-year{{$include_id}}" name="selected-year" value="{{$data['year']}}" readonly>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="fundSource_id">Budget Source</label>
                    <select class="form-control single-basic" id="fundSource_id{{$include_id}}" name="fundSource_id" style="width: 100%" aria-placeholder="hi" required>
                        <option disabled value="" selected hidden>Select Fund Source...</option>
                        @foreach ($data['parentFunds'] as $i)
                            <optgroup label="{{$i['parent']}}" class="text-white bg-olive">
                            @foreach ($data['typeFunds'] as $e)
                                <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;{{$e['type']}}" class="text-olive">
                                    @foreach ($data['funds'] as $item)
                                        @if ($i['id'] == $item['parent_id'] && $e['id'] == $item['type_id'])
                                            <option value="{{$item['fund_id']}}" class="text-navy" data-parent="{{$i['parent']}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$i['parent']}} | {{$item['type_abbr']}} | {{$item['source_name']}}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    <small id="helpblock" class="form-text text-muted">
                        Search for <b>budget sources</b> with the search box / dropdown provided above.
                        {{-- <button type="button" id="dlt_id" data-id="{{$i['devliverable_id']}}" class="btn btn-danger" data-toggle="modal" data-target="#delete" data-placement="left" data-tt="tooltip" title="Delete this entry"><i class="fas fa-trash"></i></button> --}}
                        <u class="text-info" type="button" data-toggle="modal" data-target="#edit2" aria-expanded="false" aria-controls="collapseExample"> or CREATE a new budget source</u>
                    </small>
                    <div class="collapse" id="budget_create">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- @include('_budget.cards.createBudgetSource') --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border p-4 m-2 rounded">
            <span class="m-auto lead text-info" id="budget-message"><i class="fas fa-caret-up"></i> Please select Budget Source first <i class="fas fa-caret-up"></i></span>
            <div class="col-md-12" id="GAA-GROUP" style="display: none;">
                <div class="form-group">
                    <label for="projectedTA">National Expenditure Program Amount</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">₱</div>
                        </div>
                        <input type="number" class="form-control" id="NEPTA{{$include_id}}" name="projectedTA" value="0" min="0" value="0" step="any">
                    </div>
                </div>
                {{-- <div class="row"> --}}
                    {{-- <div class="col-md-9"> --}}
                        {{-- <div class="form-group">
                            <label for="actualTA">Approved Amount</label>
                            <div class="input-group mb-2">
                                @include('_interface.snip.inputPrepend')
                                <input type="number" class="form-control" id="actualTA{{$include_id}}" name="actualTA" value="0" min="0" readonly>
                                <div class="input-group-append">
                                    <button type="button" id="totalcompute" class="btn btn-outline-primary text-primary">Calculate Total</button>
                                </div>
                            </div>
                        </div> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-md-3">
                        <label for="actualTA">Compute</label>
                        <a class="btn btn-outline-primary text-primary btn-block" id="totalcompute">Calculate Total</a>
                    </div> --}}
                {{-- </div> --}}
            </div>
            <div class="col-md-12" id="SAA-GROUP" style="display: none;">
                <div class="form-group">
                    <label for="actualTA">SAA / SARO Allocation Amount</label>
                    <div class="input-group mb-2">
                        @include('_interface.snip.inputPrepend')
                        <input type="number" class="form-control" id="actualTA{{$include_id}}" name="actualTA" value="0" min="0" readonly>
                        <div class="input-group-append">
                            <button type="button" id="totalcompute" class="btn btn-outline-primary text-primary">< Calculate Total of Breakdown</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="budget_purpose">Breakdown of Approved amount</label>
                    <table class="table table-bordered table-hover table-sm" id="tab_logic">
                        <thead>
                            <tr >
                                <th class="text-center"> #</th>
                                <th class="text-center"> Description</th>
                                <th class="text-center"> Code</th>
                                <th class="text-center"> Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id='addr0'>
                                <td>1</td>
                                <td>
                                <input type="text" name='budget_description[]'  placeholder='Description' class="form-control "/>
                                </td>
                                <td>
                                <input type="number" name='budget_account_code[]' placeholder='Account Code' class="form-control" min="0"/>
                                </td>
                                <td>
                                <input type="number" name='budget_breakdown[]' placeholder='Amount' id="frstamnt" class="form-control annualbreak addamnt" min="0" step=".01"/>
                                </td>
                            </tr>
                            <tr id='addr1'></tr>
                        </tbody>
                    </table>
                    <div class="btn-group float-right">
                        <a id="add_row" class="btn btn-outline-success float-right text-success">Add Row</a>
                        <a id='delete_row' class="float-right btn btn-outline-danger text-danger">Delete Row</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">

        @if ($include_stat ?? '' == 'edit')
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        @else
            <button type="submit" class="btn btn-primary btn-block">{{$button}}</button>
        @endif
    </div>
</div>
