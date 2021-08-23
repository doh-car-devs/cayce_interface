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
					<a class="btn btn-primary mb-1  active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true"><i class="fas fa-table mr-1"></i>Abstract Of Bids</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
            @include('_interface.cards.wideCard',
            ['include_title' => 'Item Details','include_content' => '_bac.tables.item','include_footer' => '_bac.cards.itemFooter',
            ])
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
        <form action="{{route('api.bac.bidderWin.store')}}" method="POST">
            @csrf

            @include('_interface.modals.edit',
                ['include_title' => 'Award as Winner of Item','include_content' => '_bac.modals.confirm','include_id' => '45', 'include_read' => 'readonly',
                'title' => 'Award as Winner of Item', 'button' => 'Award As winner', 'include_stat' => 'edit', 'includeclass'=> ''
                ])
        </form>
        {{-- <form action="{{route('api.budget.allocateDivision.store')}}" method="POST">
            @csrf
            @include('_interface.modals.edit',
                ['include_title' => 'Allocate Budget','include_content' => '_budget.cards.allocateBudgetDivision','include_id' => '3', 'include_read' => 'readonly',
                'title' => 'Edit Annual Budget Entry', 'button' => 'Edit budget for the year', 'include_stat' => 'edit', 'includeclass'=> ''
                ])
        </form>

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
