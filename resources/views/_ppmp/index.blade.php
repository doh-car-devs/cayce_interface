@extends('_interface.layouts.dashboard')
@section('content')
	<div class="row">
		<div class="col">
			<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
				<li class="mr-3">
					<form action="{{route('api.wfp.sort')}}" method="post">
						@csrf
						<select class="form-control mb-1" id="selected-year" name="year" onchange="this.form.submit()">
							<option selected disabled>Selected year - {{$data['year']}}</option>
							@for ($i = 2015; $i < now()->year+4; $i++)
							<option value="{{$i}}">{{$i}}</option>
							@endfor
						</select>
					</form>
				</li>
{{--				<li class="nav-item mr-3">--}}
{{--					<a class="btn btn-primary mb-1  active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true"><i class="fas fa-table mr-1"></i> View PPMP Table</a>--}}
{{--				</li>--}}
{{--				<li class="nav-item mr-3">--}}
{{--					<a class="btn btn-secondary mb-1" id="ItemsMedical-tab" data-toggle="pill" href="#ItemsMedical" role="tab" aria-controls="ItemsMedical" aria-selected="true"><i class="fas fa-table mr-1"></i> View Item References</a>--}}
{{--				</li>--}}
{{--				<li class="nav-item btn-group ml-auto">--}}
{{--					--}}{{-- <a class="btn btn-success mb-1" id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false"><i class="fas fa-plus-square mr-1"></i> Create PPMP</a> --}}
{{--				</li>--}}
			</ul>
		</div>
	</div>
	<div class="tab-content" id="custom-content-above-tabContent">
		<div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
		</div>

		<div class="tab-pane fade pt-3 pb-5" id="ItemsMedical" role="tabpanel" aria-labelledby="ItemsMedical-tab">
            {{-- @include('_interface.cards.wideCard',
            ['include_title' => 'Item References','include_content' => '_inventory.tables.items','include_head_color'=> 'card-warning'
            ]) --}}
		</div>
		<div class="tab-pane fade pt-3 pb-5" id="custom-content-above-messages" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">
			<form action="{{route('api.ppmp.store')}}" method="post">
			@csrf
                @include('_ppmp.cards.create',
                    ['include_id' => '1',
                    ])
			</form>
		</div>
	</div>

	@include('_ppmp.cards.ppmp')

	<!-- Modals -->

	@include('_ppmp.modals.edit',['include_id' => '2',
	])
    @include('_ppmp.modals.delete')

    <form action="{{route('api.twg.requestItem')}}" method="POST">
        @csrf
        @include('_interface.modals.add',
            ['include_title' => 'Request New item','include_content' => '_inventory.cards.create','include_id' => '1',
                'include_button' => 'Add request', 'include_stat' => 'add', 'includeclass'=> ''
            ])
    </form>

	<form action="{{route('api.wfp.deliverable.store')}}" method="POST">
		@csrf
		@include('_interface.modals.edit',
			['include_content' => '_wfp.cards.createDeliverable',
			'include_id' => '1'
			])
	</form>
@endsection

@section('jsSpecificImports')
@endsection

@section('cssSpecificImports')
@endsection


<!-- page script -->
@section('js')
@endsection
