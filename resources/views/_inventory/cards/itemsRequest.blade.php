<div class="card card-primary mt-3">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-list mr-2"></i>
            <span class="font-weight-bold">Item Requests</span>
        </h3>
        <div class="card-tools">
            <div class="btn-group export-tools flex-wrap" id="ppmptools"></div>
            {{-- <a href="#" target="_blank" type="button" class="btn btn-tool btn-default-outline" data-toggle="tooltip" title="Print this table" onclick="window.print()">
                <i class="fas fa-print"></i> Print Table
            </a> --}}
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        @foreach (session('user_link_group') as $key => $group)
            @if ($group->link_group == 'TWG')
                @include('_inventory.tables.itemsRequest')
                @break
            @endif
        @endforeach

        @include('_inventory.tables.userItemsRequest')
    </div>
</div>
