@extends('_interface.layouts.dashboard')
@section('content')
	<div class="row">
		<div class="col">
			<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
				<li class="mr-3">
					<form action="{{route('api.wfp.sort')}}" method="post">
						@csrf
						<select class="form-control mb-1" id="selected-yeara" name="year" onchange="this.form.submit()">
							<option selected disabled>Selected year - {{$data['year']}}</option>
							@for ($i = 2015; $i < now()->year+4; $i++)
							<option value="{{$i}}">{{$i}}</option>
							@endfor
						</select>
					</form>
				</li>
				<li class="nav-item mr-3">
					<a class="btn btn-primary mb-1  active btn-lg" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true"><i class="fas fa-table mr-1"></i> SWFP Table</a>
                </li>

				<li class="nav-item mr-3">
                </li>

				<li class="nav-item btn-group ml-auto">
                    <a class="btn btn-secondary mb-1 btn-lg " data-toggle="modal" data-target="#edit2" id="deliverable-make-tab" data-toggle="pill" href="#deliverable-make" role="tab" aria-controls="deliverable-make" aria-selected="false"><i class="fas fa-plus-square mr-1"></i>Add NEW Deliverable</a>
					<a class="btn btn-success mb-1 btn-lg " id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false"><i class="fas fa-plus-square mr-1"></i> Add Supplemental WFP</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="tab-content" id="custom-content-above-tabContent">
		<div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
		</div>
		<div class="tab-pane fade pt-3 pb-5" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
			@include('_wfp.cards.create')
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
    {{-- {{Request::url() }} --}}

	@include('_wfp.cards.wfp')
	{{-- @include('_ppmp.cards.ppmp') --}}

	<!-- Modals -->
	@include('_wfp.modals.edit')
	{{-- @include('_wfp.modals.duplicate') --}}
	@include('_wfp.modals.delete')

	{{-- @include('_ppmp.modals.edit',['include_id' => '2',
	])
	@include('_ppmp.modals.delete') --}}

	<form action="{{route('api.wfp.deliverable.store')}}" method="POST">
		@csrf
		@include('_interface.modals.edit',
			['include_content' => '_wfp.cards.createDeliverable',
			'include_id' => '2'
			])
    </form>

	{{-- <form action="" method="POST"> --}}
	<form action="{{route('api.ppmp.store')}}" method="POST">
		@csrf
		@include('_interface.modals.edit',
			['include_content' => '_ppmp.cards.edit',
			'include_id' => '3'
			])
    </form>

	<form action="{{route('api.services.table.length')}}" method="POST" id="formlength">
        @csrf
        <input type="hidden" id="tablelen" name="tablelen" value="-1">
		{{-- @include('_interface.modals.edit',
			['include_content' => '_wfp.cards.createDeliverable',
			'include_id' => '2'
			]) --}}
	</form>
@endsection

@section('jsSpecificImports')
@endsection

@section('cssSpecificImports')
@endsection


<!-- page script -->
@section('js')
<script>
    var globaldisplayLength = {!!json_encode($data['entries'])!!};

    // alert(globaldisplayLength)
</script>
@endsection
