<div class="card card-primary mt-3">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-table mr-2"></i>
            <span class="font-weight-bold">Approved Item references</span>
        </h3>
        <div class="card-tools">
            <div class="btn-group export-tools flex-wrap" id="ppmptools"></div>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        @include('_inventory.tables.items')
    </div>
</div>
