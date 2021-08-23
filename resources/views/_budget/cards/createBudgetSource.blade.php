<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            Create new fund source
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
                <label for="budget_parent_id">Parent</label>
                <select class="form-control mb-3" id="budget_parent_id" name="budget_parent_id" required="required">
                    <option disabled value="" selected hidden>Please Select....</option>
                    @foreach ($data['parentFunds'] as $i)
                        <option value="{{$i['id']}}">{{$i['parent_abbr'] . ' | ' . $i['parent']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="budget_type_id">Allotment Class</label>
                <select class="form-control mb-3" id="budget_type_id" name="budget_type_id" required="required">
                    <option disabled value="" selected hidden>Please Select....</option>
                    @foreach ($data['typeFunds'] as $i)
                        <option value="{{$i['id']}}">{{$i['type_abbr'] . ' | ' . $i['type']}}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="col-md-2">
                <label for="budget_fund_name">Title Abbreviation</label>
                <input type="text" class="form-control" id="budget_fund_name_abbr" name="budget_fund_name_abbr" placeholder="Budget Name Abreviation">
            </div>--}}
            <div class="col-md-6">
                <label for="budget_fund_name">SAA Number</label>
                <input type="text" class="form-control" id="budget_saa_number" name="budget_saa_number" placeholder="Budget Name" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="budget_purpose">Purspose</label>
                <textarea required class="form-control" id="budget_purpose" name="budget_purpose" rows="2" placeholder="Purpose" value=" "></textarea>
            </div>
            <div class="col-md-4">
                <label for="budget_fund_name">P/P/A Title</label>
                <input type="text" class="form-control" id="budget_fund_name" name="budget_fund_name" placeholder="Title" required>
            </div> 
            <div class="col-md-2">
                <label for="budget_fund_name">Title Abbreviation</label>
                <input type="text" class="form-control" id="budget_fund_name_abbr" name="budget_fund_name_abbr" placeholder="Title Abreviation">
                <small id="helpblock" class="form-text text-primary">
                    You can leave this field <b>BLANK</b>
                </small>
            </div>
            {{-- <div class="col-md-7">
                <div class="container">
                    <div class="row clearfix">
                        <div class="col-md-12 column">
                            <label for="budget_purpose">Breakdown</label>
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
                                        <input type="text" name='budget_description[]'  placeholder='Description' class="form-control"/>
                                        </td>
                                        <td>
                                        <input type="number" name='budget_account_code[]' placeholder='Account Code' class="form-control" min="0"/>
                                        </td>
                                        <td>
                                        <input type="number" name='budget_breakdown[]' placeholder='Amount' class="form-control" min="0"/>
                                        </td>
                                    </tr>
                                    <tr id='addr1'></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="btn-group float-right">
                        <a id="add_row" class="btn btn-outline-success float-right ">Add Row</a>
                        <a id='delete_row' class="float-right btn btn-outline-danger">Delete Row</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-block form-control">Create new fund source</button>
    </div>
</div>