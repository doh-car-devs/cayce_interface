<div class="card card-primary mt-3">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-table mr-2"></i>
            @if (session('section')->secion_name == 'Division Head')
            <span class="font-weight-bold">PPMP </span> | {{$data['year']}}
            @else
                @if (strpos(Request::url(), 'supplemental') )
                    <span class="font-weight-bold">Supplemental PPMP </span> | {{session('division')->division_abbr}} - {{session('section')->section_abbr}} {{$data['year']}}
                @endif
                @if (strpos(Request::url(), 'index') )
                    <span class="font-weight-bold">PPMP </span> | {{session('division')->division_abbr}} - {{session('section')->section_abbr}} {{$data['year']}}
                @endif
            {{-- <span class="font-weight-bold">PPMP </span> | {{session('division')->division_abbr}} - {{session('section')->section_abbr}} {{$data['year']}} --}}
            @endif
        </h3>
{{--        <div class="card-tools">--}}
{{--            <div class="btn-group export-tools flex-wrap" id="ppmptools"></div>--}}
{{--            --}}{{-- <a href="#" target="_blank" type="button" class="btn btn-tool btn-default-outline" data-toggle="tooltip" title="Print this table" onclick="window.print()">--}}
{{--                <i class="fas fa-print"></i> Print Table--}}
{{--            </a> --}}
{{--            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">--}}
{{--                <i class="fas fa-plus"></i>--}}
{{--            </button>--}}
{{--        </div>--}}
    </div>
    <div class="card-body">
        @if (strpos(Request::url(), 'supplemental') )
            @include('_ppmp.tables.supplemental_ppmp')
            {{-- @include('_wfp.tables.supplimental_wfp') --}}
        @endif
        @if (strpos(Request::url(), 'index') )
            @include('_ppmp.tables.ppmp')

        @endif
        @if (strpos(Request::url(), 'division') )
            <div class="row">
                <div class="col">
                    <h1 class="mt-3">Regular PPMP</h1>
                    @include('_ppmp.tables.ppmp')
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1 class="mt-3">Supplemental PPMP</h1>
                    @include('_ppmp.tables.supplemental_ppmp')
                </div>
            </div>
        @endif
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> 100</span>
                    <h5 class="description-header">₱ </h5>
                    <span class="description-text">TOTAL CONSUMABLE <b>GAA</b> BUDGET TO SECTION</span>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> {{number_format(($data['totalGAA'] == 0 || $data['totalAllocatedGAA'] == 0 ? 0 : ($data['totalGAA'] / $data['totalAllocatedGAA'])) * 100, 2, '.', ',')}}%</span>
                    <h5 class="description-header">₱ </h5>
                    <span class="description-text">TOTAL PLANNED <b>GAA</b> BUDGET</span>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> 100%</span>
                    <h5 class="description-header">₱ </h5>
                    <span class="description-text">TOTAL CONSUMABLE <b>SAA</b> BUDGET TO SECTION</span>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="description-block">
                    <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> {{number_format(($data['total'] == 0  || $data['totalAllocated'] == 0 ? 0 :  ($data['total'] / $data['totalAllocated'])) * 100, 2, '.', ',')}}%</span>
                    <h5 class="description-header">₱ </h5>
                    <span class="description-text">TOTAL PLANNED <b>SAA</b> BUDGET</span>
                </div>
            </div>
        </div>
    </div>
</div>
