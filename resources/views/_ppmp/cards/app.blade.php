<div class="card card-primary mt-3">
    <div class="card-header">
        {{-- <form> --}}
        <form action="{{route('api.services.redirect.pqes')}}" id="frm-wfp" method="POST" target="blank">
            @csrf
            <input type="hidden" value="APP_Report_GlaUnFFnN" name="redirect_key">
            <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
            <input type="hidden"  id="redirect_value" name="redirect_value" value="*">
            @include('_interface.snip.hiddenInput')
            <p><button class="btn btn-success btn-block">GAA - Generate Annual Project Procurement (APP)  .XLSX</button></p>
        </form>
        <h3 class="card-title">
            <i class="fas fa-table mr-2"></i>
            <span class="font-weight-bold">GAA - Annual Project Procurement for </span> | {{$data['year']}}
        </h3>
        <div class="card-tools">
            <div class="btn-group export-tools flex-wrap" id="apptools"></div>
            {{-- <a href="#" target="_blank" type="button" class="btn btn-tool btn-default-outline" data-toggle="tooltip" title="Print this table" onclick="window.print()">
                <i class="fas fa-print"></i> Print Table
            </a> --}}
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        @include('_ppmp.tables.app')
    </div>
    <div class="card-footer">
        {{-- <form action="{{route('api.services.redirect.pqes')}}" id="frm-wfp" method="POST" target="blank">
            @csrf
            <input type="hidden" value="WFP_Report_allQweRTyui" name="redirect_key">
            <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
            <input type="hidden"  id="redirect_value" name="redirect_value" value="all">
            @include('_interface.snip.hiddenInput')
            <hr>
            <p><button class="btn btn-danger btn-block btn-lg">!!! GENERATE CONSOLIDATED OFFICE WFP !!!</button></p>
        </form> --}}


    </div>
</div>


<div class="card card-primary mt-3">
    <div class="card-header">
        <form action="{{route('api.services.redirect.pqes')}}" id="frm-wfp" method="POST" target="blank">
            @csrf
            <input type="hidden" value="APP_Report_GlaUnFFnN" name="redirect_key">
            <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
            <input type="hidden"  id="redirect_value" name="redirect_value" value="*">
            @include('_interface.snip.hiddenInput')
            <p><button class="btn btn-success btn-block">SAA - Generate Annual Project Procurement (APP)  .XLSX</button></p>
        </form>
        <h3 class="card-title">
            <i class="fas fa-table mr-2"></i>
            <span class="font-weight-bold">SAA - Annual Project Procurement for </span> | {{$data['year']}}
        </h3>
        <div class="card-tools">
            <div class="btn-group export-tools flex-wrap" id="apptools"></div>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        @include('_ppmp.tables.appSAA')
    </div>
    <div class="card-footer">
    </div>
</div>
