<div class="card">
    <div class="card-header hand-cursor reload-ajax-table">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            PPMP
        </h3>
        <div class="card-tools">
            <button type="button" class="close reload-ajax-table" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                {{-- <h1>Table of PPMP associated with selected</h1> --}}
                <span><h3 id="disp-ppmp"></h3><small id="ppmp-number"></small></span>
                <table id="peek_mainppmptable" class="table table-bordered table-sm table-hover" style="width: 100%">
                    <thead class="thead-dark">
                        <tr>
                            {{-- hidden --}}
                            {{-- <th >Group</th> --}}
                            {{-- hidden --}}
                            <th >ID</th>
                            <th >Section</th>
                            <th >General Description</th>
                            {{-- <th>General Description</th> --}}
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>ABC</th>
                            <th>Estimated Budget</th>
                            <th>Fund Source</th>
                            <th>Mode of Procurement</th>
                            {{-- <th class="text-center">Scheduled Milestone of Activities</th> --}}
                            <th>Division Head Comment</th>
                            <th>Status</th>
                            {{-- <th rowspan="2">Status</th>
                            <th rowspan="2">Take Action</th> --}}
                        </tr>
                        {{-- <tr>
                            <th>
                                January - December
                            </th>
                        </tr> --}}
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th colspan="6" style="text-align:right">Filtered Cost Total / Total of currently visible entries:</th>
                            <th colspan="6"style="text-align:left" id="total-id"></th>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align:right">Cost Grand Total:</th>
                            <th colspan="6"style="text-align:left" id="page-total-id"></th>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
</div>
