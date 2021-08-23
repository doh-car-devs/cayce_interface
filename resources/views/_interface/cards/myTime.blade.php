<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-calendar-alt mr-2"></i>
            Latest Time IN/OUT for {{auth()->user()->prefix.' '.auth()->user()->name_family.', '.auth()->user()->name .' '. auth()->user()->name_middle}}
        </h3>

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
    <div class="card-body p-0" style="height:700;">
        <div id="calendar"></div>
        <i class="text-danger ml-3">*if calendar is empty, please contact ICT local 150</i>
    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center">
        <span class="green font-weight-bold">Green - Check In</span> <br>
        <span class="blue font-weight-bold">Blue - Check Out</span> <br>
        <span class=" font-weight-bold">Black - Wrong Type</span> <small>(Contact ICT local 150)</small>
    </div>
    <!-- /.card-footer -->
</div>
