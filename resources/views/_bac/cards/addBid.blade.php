<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            {{$include_title}} - {{$data['year']}}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <input class="form-control" type="hidden" name="year" value="{{$data['year']}}">
        <input class="form-control" type="hidden" name="item_id" id="item_id">
        <div class="row mb-3">
            <div class="col">
                <label for="wfp_id">Select bidder</label>
                <select class="form-control mb-3 single-basic" id="bidder{{$include_id}}" name="bidder_id" required="required" style="width:100%">
                    <option disabled value="" selected hidden>Please Select....</option>
                </select>
            </div>
            <div class="col">
                <label for="wfp_id">Bid amount</label>
                <input class="form-control" id="bid_amount" type="number" name="bid_amount" value="0" min="0" required="required" step="0.01">
                <span class="form-text text-muted mb-2">
                    Maximum Bid: ₱ <span id="maxbid"></span>
                </span>
            </div>
        </div>
    </div>
    {{-- <div class="card-body">
        <input name="responsible_person" type="hidden" value="{{auth()->user()->id}}">
        <input name="ppmp_entry_id" id="ppmp_entry_id" type="hidden" value="">
        <div class="row mb-3">
            <div class="col">
                <label for="wfp_id">Select WFP Entry</label>
                <select class="form-control mb-3 single-basic" id="wfp_id{{$include_id}}" name="wfp_id" required="required" style="width:100%">
                    <option disabled value="" selected hidden>Please Select....</option>
                    @foreach ($data['allwfp'] as $i)
                        <optgroup label="{{$i['activities']}}" class="text-white bg-olive mb-2">
                            <option value="{{$i['devliverable_id']}}" data-cost="{{$i['cost'] - $i['total_cost_ppmp']}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;↑ ITEM: ({{$i['item']}})</option>
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row border p-4 m-2 rounded">
            <span class="m-auto lead text-info" id="budget-message"><i class="fas fa-caret-up"></i> Please select WFP entry first<i class="fas fa-caret-up"></i></span>
            <div class="col-md-12 mb-2" id="PPMP-Group{{$include_id}}" style="display: none;">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col">
                                <div class="form-group border p-5 rounded">
                                    <label for="ppmp_genDesc">Item General Description</label>
                                    <select id="ppmp_genDesc" name="ppmp_genDesc" style="width: 100%" data-placeholder="Search for item/s">
                                    </select>
                                    <small class="form-text text-muted mb-2">
                                        Search for items with the Search Box provided above.
                                        <u class="text-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> or request a NEW item </u>
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
                                            <button type="button" class="btn btn-outline-secondary form-control">Request a new item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="ppmp_mop">Mode of Procurement</label>
                                    <select class="form-control mb-3" id="ppmp_mop" name="ppmp_mop" required="required">
                                        <option disabled value="" selected hidden>Please Select...</option>
                                        @foreach ($data['procurementModes'] as $i)
                                            <option value="{{$i['id']}}">{{$i['mode']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
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
                                        <input class="form-control" id="ppmp_qty" type="number" name="ppmp_qty" value="0" min="0" required="required">
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
                                        <input class="form-control" id="ppmp_estbudget" type="number" name="ppmp_estBudget" value="0" min="0" required="required" step="0.01" onfocus="blur();">
                                        <div class="input-group-append">
                                            <button type="button" id="qtyabc" class="btn btn-outline-primary text-primary">QTY × ABC</button>
                                        </div>
                                    </div>
                                    <span class="form-text text-muted mb-2">
                                        Maximum Allocation: ₱ <span id="estbudget{{$include_id}}"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="border p-4 rounded">
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
    </div> --}}
    <div class="card-footer">
        <button type="submit" class="btn btn-primary float-right btn-block">Add Bid</button>
    </div>
</div>
