<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            Create new Inventory Item
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- <div class="form-group border pr-4 pl-4 pb-3 pt-3 rounded" data-select2-id="3">
                <label for="ppmp_genDesc">Search For Inventory Items</label>
                <select id="ppmp_genDesc" name="ppmp_genDesc" style="width: 100%" data-placeholder="Search for item/s" data-select2-id="ppmp_genDesc" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
                <small class="form-text text-muted">
                    Search for items with the Search Box provided above.
                </small>
                <small class="b-2 text-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <u> or request a NEW item </u>
                </small>

                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <p class="lead"> If the item you are trying to search for is not available.
                        You can create a request form to be approved by TWG officers.</p>
                        <p>You can do so by clicking on the button below.</p>
                        <button type="button" class="btn btn-outline-secondary form-control">Request a new item</button>
                    </div>
                </div>
            </div> --}}
            <div class="col">
                <div class="form-group">
                    <input type="hidden" name="id" id="id{{$include_id}}"/>
                    @foreach (session('user_links') as $link)
                        @if ($link->link_group == "TWG")
                            <label for="firstCategory">Item Status</label>
                            <select class="form-control mb-1 single-basic" id="status{{$include_id}}" name="status" style="width:100%">
                                <option value ="approved" selected>Approved</option>
                                <option value ="pending">Pending</option>
                                <option value ="denied">Denied</option>
                            </select>
                            @break
                        @endif
                    @endforeach
                    <div class="row mb-2 mt-2">
                        <div class="col">
                            <label for="firstCategory">First Category</label>
                            <input type="text" name="firstCategory" id="firstCategory{{$include_id}}" class="form-control" >
                            <small>Indicate general definition of the item, Common noun</small>
                        </div>
                        <div class="col">
                            <label for="secondCategory">Second Category</label>
                            {{-- <input type="text" name="secondCategory" id="secondCategory{{$include_id}}" class="form-control" placeholder=""> --}}
                            <textarea class="form-control" name="secondCategory" id="secondCategory{{$include_id}}" rows="5" placeholder="Item Specification"></textarea>
                            <small>Specific definition of item, item specifications</small>
                        </div>
                    </div>
                    <div class="row mb-2">
                        {{-- <div class="col">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description{{$include_id}}" rows="5"></textarea>
                        </div> --}}
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label for="price">Item Category</label>
                                    <div class="input-group">
                                        <select class="form-control mb-3 single-basic" id="category{{$include_id}}" name="category" required="required" style="width:100%">
                                            <option disabled value="" selected hidden>Please Select....</option>
                                                @if ($data2 !== 'time_out')
                                                    @foreach ($data2 as $i)
                                                        <option value="{{$i['id']}}">{{$i['category']}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="price">Item Branch</label>
                                    <div class="input-group">
                                        <select class="form-control mb-3 single-basic" id="branch{{$include_id}}" name="branch" required="required" style="width:100%">
                                            <option disabled value="" selected hidden>Please Select....</option>
                                                @if ($data3 !== 'time_out')
                                                    @foreach ($data3 as $i)
                                                        <option value="{{$i['id']}}" ">{{$i['branch']}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="price">Item Cost</label>
                                    <div class="input-group">
                                        @include('_interface.snip.inputPrepend')
                                        <input class="form-control" id="itemCost{{$include_id}}" type="number" name="itemCost" value="0" min="0" required="required" step="0.01">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="price">Item Unit</label>
                                    <div class="input-group">
                                        <select class="form-control mb-3 single-basic" id="unit{{$include_id}}" name="unit" required="required" style="width:100%">
                                            <option disabled value="" selected hidden>Please Select....</option>
                                            @if ($data4 !== 'time_out')
                                                @foreach ($data4 as $i)
                                                    <option value="{{$i['id']}}" ">{{$i['unit']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary float-right btn-block">{{$include_button}}</button>
    </div>
</div>
