<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            Create new Deliverable 
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <input type="hidden"  value="{{auth()->user()->division_id}}" name="division_id">
            <input type="hidden"  value="{{auth()->user()->section_id}}" name="section_id">
            <div class="col-md-12">
                <label for="budget_parent_id">Output Functions / Deliverable</label>
                <textarea required class="form-control" id="function" name="function" rows="4" placeholder="Type here..."></textarea>
            </div>
            {{-- <div class="col-md-3">
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
            </div> --}}
            {{-- <div class="col-md-6">
                <label for="budget_fund_name">SAA Number</label>
                <input type="text" class="form-control" id="budget_saa_number" name="budget_saa_number" placeholder="Budget Name" required>
            </div> --}}
        </div>
        {{--
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
        </div> --}}
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-block form-control">Create new deliverable</button>
    </div>
</div>