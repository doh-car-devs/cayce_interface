<div class="row mt-3">
    <div class="col">
        <input type="text" value="{{number_format(($data['dashboard_wfp']['total'] == 0  || $data['dashboard_wfp']['totalAllocated'] == 0 ? 0 :  ($data['dashboard_wfp']['total'] / $data['dashboard_wfp']['totalAllocated'])) * 100, 2, '.', ',')}}" class="dial">
    </div>
</div>
<div class="row">
    <div class="col">
        <span class="font-weight-bold">% OF PLANNED SAA</span>
    </div>
</div>
