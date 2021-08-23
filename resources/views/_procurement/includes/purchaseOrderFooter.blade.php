<div class="row">
    @foreach ($data['bids'] as $j)
        <div class="col-md-6">
            <div class="description-block border-right">
                {{-- <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> {{number_format(($data['totalGAA'] == 0 || $data['totalAllocatedGAA'] == 0 ? 0 : ($data['totalGAA'] / $data['totalAllocatedGAA'])) * 100, 2, '.', ',')}}%</span> --}}
                <h3 class=" text-success">{{$j['bidder_name']}}</h3>
                <span class="description-text">BIDDER NAME</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="description-block">
                {{-- <span class="description-percentage text-success"><i class="fas fa-caret-right"></i> {{number_format(($data['totalGAA'] == 0 || $data['totalAllocatedGAA'] == 0 ? 0 : ($data['totalGAA'] / $data['totalAllocatedGAA'])) * 100, 2, '.', ',')}}%</span> --}}
                <h3 class=" text-success">{{$j['bidder_status']}}</h3>
                <span class="description-text">BIDDER STATUS</span>
            </div>
        </div>

        @break
    @endforeach
</div>
