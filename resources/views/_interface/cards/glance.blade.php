<div class="card">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>
            Your Account at a glance
        </h3>
        <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#allocated-budget" data-toggle="tab">Allocated Budget</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#WFP-stat" data-toggle="tab">WFP Status</a>
                </li>
            </ul>
        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="tab-content p-0">
            <!-- Morris chart - Sales -->
            <div class="chart tab-pane active" id="allocated-budget" style="position: relative; height: 400px; overflow-y: auto;">
                    @include('_wfp.tables.glance')
            </div>
            <div class="chart tab-pane" id="WFP-stat" style="position: relative; height: 400px; overflow-y: auto;">
                <div class="row">
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> 100</span>
                            <h5 class="description-header">₱ {{number_format($data['dashboard_wfp']['totalAllocatedGAA'], 2, '.', ',')}}</h5>
                            <span class="description-text">TOTAL CONSUMABLE <b>GAA</b> BUDGET TO SECTION</span>
                        </div>
                    </div>
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> {{number_format(($data['dashboard_wfp']['totalGAA'] == 0 || $data['dashboard_wfp']['totalAllocatedGAA'] == 0 ? 0 : ($data['dashboard_wfp']['totalGAA'] / $data['dashboard_wfp']['totalAllocatedGAA'])) * 100, 2, '.', ',')}}%</span>
                            <h5 class="description-header">₱ {{number_format($data['dashboard_wfp']['totalGAA'], 2, '.', ',')}}</h5>
                            <span class="description-text">TOTAL PLANNED <b>GAA</b> BUDGET</span>
                            @include('_interface.includes.glance.wfp_gaa_knob')
                        </div>
                    </div>
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> 100%</span>
                            <h5 class="description-header">₱ {{number_format($data['dashboard_wfp']['totalAllocated'], 2, '.', ',')}}</h5>
                            <span class="description-text">TOTAL CONSUMABLE <b>SAA</b> BUDGET TO SECTION</span>
                        </div>
                    </div>
                    <div class="col-sm-3 col-6">
                        <div class="description-block">
                            <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> {{number_format(($data['dashboard_wfp']['total'] == 0  || $data['dashboard_wfp']['totalAllocated'] == 0 ? 0 :  ($data['dashboard_wfp']['total'] / $data['dashboard_wfp']['totalAllocated'])) * 100, 2, '.', ',')}}%</span>
                            <h5 class="description-header">₱ {{number_format($data['dashboard_wfp']['total'], 2, '.', ',')}}</h5>
                            <span class="description-text">TOTAL PLANNED <b>SAA</b> BUDGET</span>
                            @include('_interface.includes.glance.wfp_saa_knob')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.card-body -->
</div>
