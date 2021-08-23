<div class="card">
    <div class="card-header hand-cursor reload-ajax-table">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            All Registerd Bidders
        </h3>
        <div class="card-tools">
            <button type="button" class="close reload-ajax-table" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="border m-2 p-4">
            <h4>Create New Bidder</h4>
            <div class="row ">
                <form action="" class="form-group" id="addBidder_form">
                    @csrf
                    <div class="col-md-4">
                        <label for="ppmp_genDesc">Complete Bidder Name</label>
                        <input type="text" id="b_name" name="b_name" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="ppmp_genDesc">Bidder TIN</label>
                        <input type="text" id="b_tin" name="b_tin" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="ppmp_genDesc">Complete Address</label>
                        <input type="text" id="b_address" name="b_address" class="form-control" required>
                    </div>
                </form>
            </div>
            <button class="btn btn-primary btn-block mt-3" id="addBidder_form_btn">Create New Bidder</button>
        </div>
        <div class="row">
            <div class="col">
                {{-- <h1>Table of PPMP associated with selected</h1> --}}
                <span><h3 id="disp-ppmp"></h3><small id="ppmp-number"></small></span>
                <table id="peek_bidders" class="table table-bordered table-sm table-hover" style="width: 100%">
                    <thead class="thead-dark">
                        <tr>
                            <th >ID</th>
                            <th >Name</th>
                            <th >TIN Number</th>
                            <th>Address</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
