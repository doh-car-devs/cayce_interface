<div class="card">
    <div class="card-header">
        <h5 class="card-title">Your Account at a glance</h5>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">

                <div class="chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                </div>
                <!-- /.chart-responsive -->
                <h3 class="mb-3">Breakdown of Allocated Budget</h3>
                @include('_wfp.tables.glance')
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <div class="card" >
                    <div class="card-header">
                        <p class="text-center card-title">
                            <strong>Budget Status</strong>
                        </p>
                    </div>
                    <div class="card-body" style="height: 350px; max-height:450px; overflow: auto;">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-olive elevation-1">₱</span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Allocated <b class="olive">SAA</b> Budget for <i>{{session('section.section_abbr')}} Section</i></span>
                                <span class="info-box-number"><b>₱</b>{{number_format($data['programBudget']['SAA']), '.', ',' ?? 'No budget Allocated'}}</span>
                            </div>
                        </div>
                        <div class="progress-group">
                        </div>

                        <br>
                        <hr>
                        <br>

                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-cyan elevation-1">₱</span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Allocated <b class="cyan">GAA</b> Budget for <i>{{session('section.section_abbr')}} Section</i></span>
                                <span class="info-box-number"><b>₱</b>{{number_format($data['programBudget']['GAA']), '.', ',' ?? 'No budget Allocated'}}</span>
                            </div>
                        </div>

                        <div class="progress-group">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
