<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            {{$include_title}}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        {{-- <input class="form-control" type="hidden" name="year" value="{{$data['year']}}"> --}}
        <input class="form-control" type="hidden" name="user_name" id="user_name" value="{{auth()->user()->prefix.' '.auth()->user()->name_family.', '.auth()->user()->name .' '. auth()->user()->name_middle.' , '. auth()->user()->name_extension}}">
        <div class="row mb-3">
            <div class="col">
                <label for="wfp_id">Item Name</label>
                <input class="form-control" type="text">
            </div>
            <div class="col">
                <label for="wfp_id">Item Description</label>
                <input type="text" class="form-control">
                {{-- <input class="form-control" id="bid_amount" type="number" name="bid_amount" value="0" min="0" required="required" step="0.01">
                <span class="form-text text-muted mb-2">
                    Maximum Bid: ₱ <span id="maxbid"></span>
                </span> --}}
            </div>
        </div>
    </div>
        <button type="submit" class="btn btn-primary float-right btn-block">Confirm Item Request</button>
    </div>
</div>
