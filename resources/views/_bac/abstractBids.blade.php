@extends('_interface.layouts.dashboard')
@section('content')
	<div class="row mb-3">
		<div class="col">
			<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
				<li class="mr-3">
					<form action="{{route('api.wfp.sort')}}" method="post">
						@csrf
						<select class="form-control mb-1" id="index-selected-year" name="year" onchange="this.form.submit()">
							<option selected disabled>Selected year - {{$data['year']}}</option>
							@for ($i = 2015; $i < now()->year+4; $i++)
							<option value="{{$i}}">{{$i}}</option>
							@endfor
						</select>
					</form>
				</li>
				<li class="nav-item mr-3">
					{{-- <a class="btn btn-primary mb-1  active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true"><i class="fas fa-table mr-1"></i>{{$data['card_header']}}</a> --}}
					<a class="btn btn-primary mb-1 active" id="custom-content-above-home2-tab" data-toggle="pill" href="#custom-content-above-home2" role="tab" aria-controls="custom-content-above-home2" aria-selected="true"><i class="fas fa-table mr-1"></i>Abstract Of Bids</a>
				</li>
				<li class="nav-item btn-group ml-auto">
					<form action="{{route('api.services.redirect.pqes')}}" method="POST">
						@csrf
						<input type="hidden" value="PQES_report_1FYcvEDOHpl" name="redirect_key">
						<input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
						{{-- <button class="btn btn-success mb-1" type="submit"><i class="fas fa-print mr-1"></i>Generate PQES Report</button> --}}
					</form>
                    {{-- <button class="btn btn-success mb-1" id="peak_id" data-id="{{$i['origwfp_id']}}"><i class="fas fa-print mr-1"></i>View Bidders</button> --}}
                    <button type="button" id="peak_bidders" data-id="" class="btn btn-success mb-1"  data-toggle="modal" data-target="#edit4" data-placement="left" data-tt="tooltip" title="See all Bidders"><i class="far fa-eye"></i> View All Bidders</button>
				</li>

			</ul>
		</div>
	</div>

	<div class="tab-content" id="custom-content-above-tabContent">
        {{-- <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
            @include('_interface.cards.wideCard',
            ['include_title' => $data['card_header'],'include_content' => '_bac.tables.abstract',
            ])
		</div> --}}
        <div class="tab-pane fade show active" id="custom-content-above-home2" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
            @include('_interface.cards.wideCard',
            ['include_title' => 'Abstract Of Bids','include_content' => '_bac.tables.abstractBids',
            ])
        </div>
		<div class="tab-pane fade pb-5" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
			<form method="post" action="{{ route('api.budget.annual.store') }}">
				@csrf
				{{-- @include('_budget.cards.createAnnual', ['include_title' => 'Create Annual Budget', 'button' => 'Create budget for the year','include_id' => '2']) --}}
			</form>
		</div>
		<div class="tab-pane fade pb-5" id="allocate-budget" role="tabpanel" aria-labelledby="allocate-budget-tab">
			<form action="{{route('api.budget.allocateDivision.store')}}" method="POST">
				@csrf
				{{-- @include('_budget.cards.allocateBudgetDivision',
				['include_title' => 'Allocate Budget','include_content' => '_budget.cards.createAnnual','include_id' => '', 'include_read' => '',
				'title' => 'Allocate Budget', 'button' => 'Edit budget for the year', 'include_stat' => 'edit', 'includeclass'=> 'single-basic'
				]) --}}
			</form>
		</div>
	</div>

    {{-- First Row --}}
        {{-- @include('_budget.cards.annualBudget') --}}
        {{-- @include('_budget.cards.createBudgetSource') --}}

	{{-- Second Row --}}
        {{-- @include('_interface.cards.wideCard',
        ['include_title' => 'Budget Allocation Per Division','include_content' => '_budget.tables.allocatedAnnualBudgetDivision',
        'button' => 'Edit budget for the year', 'include_stat' => 'edit'
        ]) --}}


	{{-- Modals --}}
	{{-- Modals --}}
		<form action="{{route('api.bac.bid.store')}}" method="POST">
			@csrf
			@include('_interface.modals.add',
				['include_title' => 'Add bids to item','include_content' => '_bac.cards.addBid','include_id' => '1',
					'button' => 'Add Bid', 'include_stat' => 'add', 'includeclass'=> ''
				])
		</form>

        <form action="" method="POST">
            @csrf
            @include('_interface.modals.edit',
                ['include_content' => '_bac.tables.bidders',
                'include_id' => '4'
                ])
        </form>
        {{--



        <form action="{{route('api.budget.source.store')}}" method="POST">
            @csrf
            @include('_interface.modals.edit',
                ['include_title' => 'Edit Annual Budget Entry','include_content' => '_budget.cards.createAnnual','include_id' => '1',
                'title' => 'Edit Annual Budget Entry', 'button' => 'Edit budget for the year', 'include_stat' => 'edit'
                ])
        </form>

        <form action="{{route('api.budget.source.store')}}" method="POST">
            @csrf
            @include('_interface.modals.edit',
                ['include_content' => '_budget.cards.createBudgetSource',
                'include_id' => '2'
                ])
        </form>

        <form action="" method="POST">
            @csrf
            @include('_interface.modals.confirmation',
                ['include_title' => 'Delete this entry?',
                'include_body' => 'This entry will be deleted and recorded as deleted by'
                ])
        </form> --}}

@endsection
@section('js')

@endsection
