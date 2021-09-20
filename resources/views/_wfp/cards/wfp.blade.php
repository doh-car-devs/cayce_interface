<div class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title my-auto">
            <i class="fas fa-table mr-2"></i>
            @if (session('section')->secion_name == 'Division Head')
                WFP | {{$data['year']}}
            @else
                @if (strpos(Request::url(), 'supplemental') )
                    Supplemental WFP | {{session('division')->division_abbr}} - {{session('section')->section_abbr}} {{$data['year']}}
                @endif
                @if (strpos(Request::url(), 'index') )
                    WFP | {{session('division')->division_abbr}} - {{session('section')->section_abbr}} {{$data['year']}}
                @endif
            @endif
        </h3>
        {{-- <div class="card-tools">
            <div class="btn-group export-tools flex-wrap" id="wfptools"></div>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div> --}}
    </div>
    <div class="card-body">
        @if (strpos(Request::url(), 'supplemental') )
            @include('_wfp.tables.supplimental_wfp')
        @endif
        @if (strpos(Request::url(), 'index') )
            @include('_wfp.tables.wfp')
        @endif
        @if (strpos(Request::url(), 'division') )
            <div class="row">
                <div class="col">
                    <h1 class="mt-3">Regular WFP</h1>
                    @include('_wfp.tables.wfp')
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1 class="mt-3">Supplemental WFP</h1>
                    @include('_wfp.tables.supplimental_wfp')
                </div>
            </div>
        @endif
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> 100</span>
                    <h5 class="description-header">₱ {{number_format($data['totalAllocatedGAA'], 2, '.', ',')}}</h5>
                    <span class="description-text">TOTAL CONSUMABLE <b>GAA</b> BUDGET TO SECTION</span>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> {{number_format(($data['totalGAA'] == 0 || $data['totalAllocatedGAA'] == 0 ? 0 : ($data['totalGAA'] / $data['totalAllocatedGAA'])) * 100, 2, '.', ',')}}%</span>
                    <h5 class="description-header">₱ {{number_format($data['totalGAA'], 2, '.', ',')}}</h5>
                    <span class="description-text">TOTAL PLANNED <b>GAA</b> BUDGET</span>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> 100%</span>
                    <h5 class="description-header">₱ {{number_format($data['totalAllocated'], 2, '.', ',')}}</h5>
                    <span class="description-text">TOTAL CONSUMABLE <b>SAA</b> BUDGET TO SECTION</span>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="description-block">
                    <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> {{number_format(($data['total'] == 0  || $data['totalAllocated'] == 0 ? 0 :  ($data['total'] / $data['totalAllocated'])) * 100, 2, '.', ',')}}%</span>
                    <h5 class="description-header">₱ {{number_format($data['total'], 2, '.', ',')}}</h5>
                    <span class="description-text">TOTAL PLANNED <b>SAA</b> BUDGET</span>
                </div>
            </div>
        </div>
    </div>
</div>
