<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            Attach PPMP Entry - {{$data['year']}}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <input name="responsible_person" type="hidden" value="{{auth()->user()->id}}">
        <input name="ppmp_entry_id" id="ppmp_entry_id" type="hidden" value="">
        <div class="row mb-3">
            <div class="col">
                <label for="wfp_id">Select WFP Entry</label>
                {{-- <input type="text" class="form-control mb-3" id="wfp_id{{$include_id}}" name="wfp_id" required="required" style="width:100%;"> --}}
                <select class="form-control mb-3 single-basic" id="wfp_id{{$include_id}}" name="wfp_id" required="required" style="width:100%;" readonly="true">
                    <option disabled value="" selected hidden>Please Select....</option>
                    @foreach ($data['allApprovedWFP'] as $i)
                        <optgroup label="WFP Output Function / Deliverable: &nbsp; {{$i['activities']}} -- Total Budget: ₱{{number_format($i['allocatedNEP'],2, '.', ',')}} FROM: {{$i['parent_type_abbr']}} | {{$i['source_name']}} | {{$i['type_abbr']}}" class="text-white bg-olive mb-2">
                            <option value="{{$i['devliverable_id']}}" data-cost="{{$i['cost'] - $i['total_cost_ppmp']}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;↑ ITEM: ({{$i['item']}})</option>
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row border p-4 m-2 rounded">
            {{-- <span class="m-auto lead text-info" id="budget-message"><i class="fas fa-caret-up"></i> Please select WFP entry first<i class="fas fa-caret-up"></i></span> --}}
            <div class="col-md-12 mb-2" id="PPMP-Group{{$include_id}}">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="function_type" class="text-danger">PPMP TYPE</label>
                        <select class="form-control single-basic pb-3" style="width: 100%" id="ppmp_type" name="ppmp_type" required="required">
                            <option value="supplemental" selected>supplemental PPMP</option>
                            {{-- <option value="regular">Regular</option> --}}
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="ppmp_genDesc">Item General Description</label>
                        @if ($include_id == 2)
                            <input class="form-control" type="text" id="ppmp_genDesc_editinput" name="ppmp_genDesc" readonly onfocus="blur()">
                        @else

                            <select id="ppmp_genDesc_edit" name="ppmp_genDesc" style="width: 100%" data-placeholder="Search for item/s">
                            </select>
                            <small class="form-text text-muted mb-2">
                                Search for items with the Search Box provided above.
                                <u class="text-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> or request a NEW item</u>
                            </small>
                            <input class="form-control" type="hidden" name="branch" id="ppmp_branch{{$include_id}}">
                            <input class="form-control" type="hidden" name="item_id" id="ppmp_id{{$include_id}}">
                            <input class="form-control" type="hidden" name="price" id="ppmp_price{{$include_id}}">
                            <input class="form-control" type="hidden" name="unit" id="ppmp_unit1{{$include_id}}">
                            <input class="form-control" type="hidden" name="item_name" id="ppmp_item_name{{$include_id}}">
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <p class="lead"> If an item is not available,
                                    please create a request for the specific item. You can do so by clicking on the button below.</p>
                                    <button type="button" class="btn btn-outline-secondary form-control" data-toggle="modal" data-target="#add1">Request a new item</button>
                                </div>
                            </div>
                            <br>
                            <h4>Search guide</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Search in</th>
                                        <th>Prepend</th>
                                        <th>Example</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row"><b>DBM Items</b></td>
                                        <td><span class="text-success font-weight-bold">dbm--</span></td>
                                        <td><button type="button" class="btn btn-link" id="searchguide"><span class="text-success text font-weight-bold">dbm--</span>alcohol</button></td>
                                    </tr>
                                    <tr>
                                        <td scope="row"><b>Items Except DBM</b></td>
                                        <td><span class="text-success font-italic">none</span></td>
                                        <td><button type="button" class="btn btn-link" id="searchguide"><span class="text-success text font-weight-bold"></span>alcohol</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="ppmp_mop">Mode of Procurement</label>
                                    <select class="form-control mb-3 single-basic" id="ppmp_mop" name="ppmp_mop" required="required" style="width: 100%">
                                        <option disabled value="" selected hidden>Please Select...</option>
                                        @foreach ($data['procurementModes'] as $i)
                                            <option value="{{$i['id']}}">{{$i['mode']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="ppmp_abc">ABC</label>
                                    <div class="input-group">
                                        @include('_interface.snip.inputPrepend')
                                        <input class="form-control" id="ppmp_abc{{$include_id}}" type="number" name="ppmp_abc" value="0" min="0" required="required" readonly step=".01">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ppmp_qty">Quantity</label>
                                    <div class="input-group">
                                        @include('_interface.snip.inputPrepend')
                                        <input class="form-control" id="ppmp_qty{{$include_id}}" type="number" name="ppmp_qty" value="0" min="0" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="ppmp_unit">Unit</label>
                                    <input class="form-control mb-3" type="text" name="ppmp_unit" id="ppmp_unit{{$include_id}}" required="required" readonly placeholder="Piece, Box, Set, ...">
                                </div>
                                <div class="form-group">
                                    <label for="ppmp_estBudget">Estimated Budget<small> (Price is not editable)</small></label>
                                    <div class="input-group">
                                        @include('_interface.snip.inputPrepend')
                                        <input class="form-control" id="ppmp_estbudget_edit{{$include_id}}" type="number" name="ppmp_estBudget" value="0" min="0" required="required" step="0.01" onfocus="blur();">
                                        <div class="input-group-append">
                                            <button type="button" id="qtyabc2" class="btn btn-outline-primary text-primary">QTY × ABC</button>
                                        </div>
                                    </div>
                                    <span class="form-text text-muted mb-2">
                                        Maximum Allocation: ₱ <span id="estbudget{{$include_id}}"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="border p-4 rounded">
                            <h3 class="text-danger">***Please make sure that QUANTITY and  TOTAL of Scheduled / Milestone of Activities are the same</h3>
                            <label for="all">Scheduled / Milestone Of Activities</label>
                            <div class="row">
                                @foreach ($data['months'] as $key => $value)
                                    @if ($value == 'July')@break
                                    @else
                                    <div class="col">
                                        <label for="ppmp_mop">{{$value}}</label>
                                        <input class="form-control" type="number" id="milestones{{$key+1}}" name="milestones{{$key+1}}" value="0" min="0" required>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="row">
                                @foreach ($data['months'] as $key => $value)
                                    @if ($key < 6)@continue
                                    @else
                                    <div class="col">
                                        <label for="ppmp_mop">{{$value}}</label>
                                        <input class="form-control" type="number" id="milestones{{$key+1}}" name="milestones{{$key+1}}" value="0" min="0" required>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary float-right btn-block">Add/Update PPMP Entry</button>
    </div>
</div>
