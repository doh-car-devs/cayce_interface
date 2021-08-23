@extends('_interface.layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item btn-group mr-3">
                    <a class="btn btn-primary mb-1 active" id="inventory-tab" data-toggle="pill" href="#inventory" role="tab" aria-controls="inventory" aria-selected="true"><i class="fas fa-table mr-1"></i>Inventory List</a>
                </li>
                <li class="nav-item btn-group ml-auto">
                    <a class="btn btn-success mb-1" id="create-inventory-tab" data-toggle="pill" href="#create-inventory" role="tab" aria-controls="create-inventory" aria-selected="false"><i class="fas fa-plus-square mr-2"></i>Create New Item</a>
                    {{-- <a class="btn btn-success mb-1 " id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false"><i class="fas fa-plus-square mr-1"></i> Create PPMP</a> --}}
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
            <div class="row">
                <div class="col-md-12">
                    @include('_inventory.cards.itemsRequest')
                </div>
            </div>
            @include('_inventory.cards.items')
        </div>

        <div class="tab-pane fade pt-3 pb-5" id="create-inventory" role="tabpanel" aria-labelledby="create-inventory-tab">
            <form action="{{route('api.twg.requestItem')}}" method="POST" target="blank">
                @csrf
                @include('_inventory.cards.create',
                [
                    'include_button' => 'Create New Item','include_id' => '11',
                ])
            </form>
        </div>
    </div>

    <form action="{{route('api.twg.update')}}" method="POST" target="blank">
        @csrf
        @include('_interface.modals.add',
            ['include_title' => 'Request New item','include_content' => '_inventory.cards.create','include_id' => '1',
                'include_button' => 'Approve request', 'include_stat' => 'add', 'includeclass'=> ''
            ])
    </form>

    <form>
    {{-- <form action="{{route('api.twg.update')}}" method="POST" target="blank"> --}}
        {{-- api/wfp/createRevision --}}
        @csrf
        @include('_interface.modals.add',
            ['include_title' => 'Edit Selected Item','include_content' => '_inventory.cards.create','include_id' => '454',
                'include_button' => 'Edit Item', 'include_stat' => 'add', 'includeclass'=> ''
            ])
    </form>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            var twgitems = $('#twg_items').DataTable({
                "info": true,
                "scrollX": true,
            });
            var itemrequest = $('#twg_itemsRequest').DataTable({
                "info": true,
                "scrollX": true,
            });

            $('table[id="twg_items"]').on('click', 'button[id="editite_id"]', function () {
                var value = $(this).attr('data-id');
                var strArray = value.split("||");
                console.log(strArray[2])
                $('#firstCategory454').val(strArray[0]);
                $('#secondCategory454').val(strArray[1]);
                $('#branch454').val(strArray[2]).trigger("change");
                $('#category454').val(strArray[3]).trigger("change");
                $('#unit454').val(strArray[4]).trigger("change");
                $('#itemCost454').val(strArray[4]);
                $('#id454').val(strArray[6]).trigger("change");
                // $('#item2').val(strArray[7]);
                // $('#cost2').val(strArray[8]);
                // $('#fundSource_id2').val(strArray[9]).trigger("change");
                // console.log(strArray);
                // // $('#function_type2').val(strArray[10]);
                // $('#function_type2').val(strArray[11]);
                // $('#selected-year2').val(strArray[12]);
                // $('#deliverable_id2').val(strArray[13]);
            });


        });
    </script>
@endsection
