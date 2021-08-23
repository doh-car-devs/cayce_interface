<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            Assign Purhcase Request Number
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <label for="budget_parent_id">Purchase Request Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{$data['PRprep']}}-</div>
                    </div>
                    <input type="text" class="form-control" name="prnumber" id="prnumber" value="" onclick="blur()" readonly>
                    {{-- <input type="text" class="form-control" name="prnumber" value="{{$data['PRLast']}}"> --}}
                </div>
                <input type="hidden" class="form-control" name="fullprnumber" id="fullprnumber" value="" onclick="blur()" readonly>
            </div>
            <div class="col-md-6">
                <label for="budget_parent_id">Last Stored Purchase Request Number</label>
                <input type="text" class="form-control" disabled readonly onclick="blur()" value="{{$data['lastPR']['assigned_id']}}">
            </div>
        </div>

    </div>
    <div class="card-footer">
        <button id="assignPR" class="btn btn-primary btn-block form-control">Assign Purchase Request Number</button>
    </div>
</div>
