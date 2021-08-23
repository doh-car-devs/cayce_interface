<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-table mr-2"></i>
            <span class="font-weight-bold">Annual Budget Table </span> | {{$data['year']}}
        </h3>
        <div class="card-tools">
            <div class="btn-group export-tools flex-wrap" id="wfptools"></div>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="border p-2 rounded">
            <h3 class="mt-2 mb-2 text-primary">General Appropriations Act (GAA)</h3>
            @include('_budget.tables.annualBudget')
        </div>
        <hr class="mt-5 mb-5">
        <div class="border p-2 rounded">
            <h3 class="mt-2 mb-2 text-primary">Sub Allotment Advice Budget (SAA)</h3>
            @include('_budget.tables.saaAnnualBudget')
        </div>
        <hr class="mt-5 mb-5">
        <div class="border p-2 rounded">
            <h3 class="mt-2 mb-2 text-primary">SARO Budget (SARO)</h3>
            @include('_budget.tables.saroAnnualBudget')
        </div>
        <hr class="mt-5 mb-5">
        <div class="border p-2 rounded">
            <h3 class="mt-2 mb-2 text-primary">Trust Funds</h3>
            @include('_budget.tables.trustFunds')
        </div>
    </div>
    <div class="card-footer">
        {{-- <h5 class=" p-1 float-right" ><span class="font-weight-bold"> Total:</span> ₱{{number_format($data['total'])}}</h5> --}}
    </div>
</div>
