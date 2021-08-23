<div class="row">
    @foreach ($data['testBids'] as $j)
    <div class="col-sm-5 col-6">
        <div class="description-block border-right">
            {{-- <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> {{number_format(($data['totalGAA'] == 0 || $data['totalAllocatedGAA'] == 0 ? 0 : ($data['totalGAA'] / $data['totalAllocatedGAA'])) * 100, 2, '.', ',')}}%</span> --}}
            <h3 class=" text-success">{{$j['item_name']}}</h3>
            <span class="description-text">ITEM NAME</span>
        </div>
    </div>
    <div class="col-sm-2 col-6">
        <div class="description-block border-right">
            {{-- <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> {{number_format(($data['totalGAA'] == 0 || $data['totalAllocatedGAA'] == 0 ? 0 : ($data['totalGAA'] / $data['totalAllocatedGAA'])) * 100, 2, '.', ',')}}%</span> --}}
            <h3 class=" text-success">{{$j['totalqty']}}</h3>
            <span class="description-text">TOTAL QUANTITY</span>
        </div>
    </div>
    <div class="col-sm-2 col-6">
        <div class="description-block border-right">
            <h3 class=" text-success">₱{{number_format($j['price'], 2, '.', ',')}} / <small>{{$j['unit']}}</small></h3>
            <span class="description-text">ITEM PRICE / ITEM ABC</span>
        </div>
    </div>
    <div class="col-sm-3 col-6">
        <div class="description-block ">
            <h3 class=" text-success">₱{{number_format($j['totalppmpamount'], 2, '.', ',')}}</h3>
            <span class="description-text">TOTAL ITEM COST</span>
        </div>
    </div>
    {{-- <div class="col-sm-3 col-6">
        <div class="description-block border-right">
            <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> 100%</span>
            <span class="description-text">TOTAL CONSUMABLE <b>SAA</b> BUDGET TO SECTION</span>
        </div>
    </div>
    <div class="col-sm-3 col-6">
        <div class="description-block">
            <span class="description-text">TOTAL PLANNED <b>SAA</b> BUDGET</span>
        </div>
    </div> --}}
    @break
    @endforeach
</div>
