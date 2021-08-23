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
                <div class="col">
                    @include('_inventory.cards.itemsRequest')
                </div>
                <div class="col">
                    @include('_inventory.cards.items')
                </div>
            </div>
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

    <form action="{{route('api.twg.update')}}" method="POST">
        @csrf
        @include('_interface.modals.add',
            ['include_title' => 'Request New item','include_content' => '_inventory.cards.create','include_id' => '1',
                'include_button' => 'Approve request', 'include_stat' => 'add', 'includeclass'=> ''
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
        });
    </script>
@endsection
