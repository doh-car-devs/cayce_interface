<div class="row mt-3">
    <div class="col">
        <input type="text" value="{{number_format(($data['dashboard_wfp']['totalGAA'] == 0 || $data['dashboard_wfp']['totalAllocatedGAA'] == 0 ? 0 : ($data['dashboard_wfp']['totalGAA'] / $data['dashboard_wfp']['totalAllocatedGAA'])) * 100, 2, '.', ',')}}" class="dial">
    </div>
</div>
<div class="row">
    <div class="col">
        <span class="font-weight-bold">% OF PLANNED GAA</span>
    </div>
</div>
