<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            {{$include_title}} | {{$data['year']}}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <input type="hidden" id="annual_budget_id{{$include_id}}" value="" name="annual_budget_id">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="selected-year">Select Year</label>
                    <input class="form-control" type="number" id="selected-year" name="year" value="{{$data['year']}}" readonly required>
                    {{-- <select class="form-control" id="selected-year" name="year">
                        @foreach ($data['selectedyear'] as $y)
                            <option value="{{$y['year']}}">{{$y['year']}}</option>
                        @endforeach
                    </select> --}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="selected-year">Select Section</label>
                    <select class="form-control single-basic" name="program_id" required style="width: 100%" id="progid">
                        <option value="" selected hidden>Please Select...</option>
                        @foreach ($data['divisions'] as $division)
                            <option value="{{$division['id']}}">{{$division['division_name']}} - {{$division['program']}} | {{$division['description']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="selected-year">Budget Source</label>
                    <select class="form-control allbud {{$includeclass}} " id="bbsource" name="bsource" required style="width: 100%" {{$include_read}}>
                        @if (!empty($data['annual']))
                            <option disabled value="" selected hidden>Select {{$data['year']}} Fund Source...</option>
                            @foreach ($data['annual'] as $i)
                                <option value="{{$i['fund_source_id']}}" data-projected="{{$i['amount']}}" data-nep="{{$i['NEP']}}" class="text-navy">&nbsp;&nbsp;&nbsp;&nbsp;{{$i['parent_type_abbr']}}&nbsp;&nbsp;{{$i['saa_number']}} | {{$i['type_abbr']}} | {{$i['source_name']}}</option>
                            @endforeach
                        @else
                            <option class="text-navy" disabled selected> There is no budget for year {{$data['year']}}</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="selected-year">National Expenditure Program</label>
                    <div class="input-group mb-2">
                        @include('_interface.snip.inputPrepend')
                        <input required type="number" class="form-control" id="perdivisionbudget{{$include_id}}" name="perdivisionbudget" min="0" required step="any">
                        <div class="input-group-append">
                            <button type="button" id="" class="btn btn-outline-primary allocatealla{{$include_id}}">Allocate All</button>
                        </div>
                    </div>
                    <span class="form-text text-muted">Total available NEP: <span id="viewperdev{{$include_id}}" class="font-weight-bold"></span></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="selected-year">Approved Amount</label>
                    <div class="input-group mb-2">
                        @include('_interface.snip.inputPrepend')
                        <input type="number" class="form-control" id="actualTA{{$include_id}}" name="actualTA" min="0" required step="any">
                        <div class="input-group-append">
                            <button type="button" id="" class="btn btn-outline-primary allocatealla{{$include_id}}">Allocate All</button>
                        </div>
                    </div>
                    <span class="form-text text-muted">Total available Amount: <span id="viewactualamt{{$include_id}}" class="font-weight-bold"></span></span>
                </div>
            </div>
        </div>
        <div>
            <div class="form-group">
                <label for="selected-year">Purpose</label>
                <div class="input-group mb-2">
                    {{-- <input type="number" class="form-control" id="actualTA{{$include_id}}" name="actualTA" min="0" required> --}}
                    <textarea class="form-control" name="purpose" id="purpose{{$include_id}}"rows="2"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Allocate Budget</button>
    </div>
</div>
