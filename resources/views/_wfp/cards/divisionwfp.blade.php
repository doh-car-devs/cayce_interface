<div class="card card-primary mt-3">
    <div class="card-header">
        <h3 class="card-title">
            Consolidated Division WFP
            {{-- <i class="fas fa-table mr-2"></i>
            @if (session('section')->secion_name == 'Division Head')
            <span class="font-weight-bold">WFP </span> | {{$data['year']}}
            @else
            <span class="font-weight-bold">WFP </span> | {{session('division')->division_abbr}} - {{session('section')->section_abbr}} {{$data['year']}}
            @endif --}}
        </h3>
        <div class="card-tools">
            <div class="btn-group export-tools flex-wrap" id="dvsnwfp"></div>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <h5 class="text-primary ">NOTE: To copy columns, select/highlight rows to be copied by clicking on individual rows before clicking on "Copy selected rows"</h5>
        <p>*If there are no selected/highighted rows when clicking "Copy Selected Rows" all rows will be copied</p>
        @include('_wfp.tables.divisionAllWFP')
    </div>
    {{-- <div class="card-footer">
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
    </div> --}}
</div>
