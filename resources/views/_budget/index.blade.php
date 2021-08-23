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
					<a class="btn btn-primary mb-1  active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true"><i class="fas fa-table mr-1"></i> View Annual Budgets Table</a>
					{{-- <a class="btn btn-primary mb-1" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true"><i class="fas fa-table mr-1"></i> View Annual Allocated Budgets Table</a> --}}
				</li>
				<li class="nav-item btn-group ml-auto">
					<a class="btn btn-success mb-1 " id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false"><i class="fas fa-plus-square mr-1"></i>Add Annual Budget</a>
					{{-- <a class="btn btn-success mb-1 " id="allocate-budget-tab" data-toggle="pill" href="#allocate-budget" role="tab" aria-controls="allocate-budget" aria-selected="false"><i class="fas fa-money-bill-wave mr-1"></i><i class="fas fa-level-down-alt mr-1"></i>Allocate Budget</a> --}}
				</li>
			</ul>
		</div>
	</div>

	<div class="tab-content" id="custom-content-above-tabContent">
		<div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
		</div>
		<div class="tab-pane fade pb-5" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
			<form method="post" action="{{ route('api.budget.annual.store') }}">
				@include('_budget.cards.createAnnual', ['include_title' => 'Create Annual Budget', 'button' => 'Create budget for the year','include_id' => '2'])
				@csrf
			</form>
		</div>
		<div class="tab-pane fade pb-5" id="allocate-budget" role="tabpanel" aria-labelledby="allocate-budget-tab">
			<form action="{{route('api.budget.allocateDivision.store')}}" method="POST">
				@csrf
				@include('_budget.cards.allocateBudgetDivision',
				['include_title' => 'Allocate Budget','include_content' => '_budget.cards.createAnnual','include_id' => '', 'include_read' => '',
				'title' => 'Allocate Budget', 'button' => 'Edit budget for the year', 'include_stat' => 'edit', 'includeclass'=> 'single-basic'
				])
			</form>
		</div>
	</div>

    {{-- First Row --}}
	@include('_budget.cards.annualBudget')

	{{-- Second Row --}}
	@include('_interface.cards.wideCard',
	['include_title' => 'Budget Allocation Per Division','include_content' => '_budget.tables.allocatedAnnualBudgetDivision',
	'button' => 'Edit budget for the year', 'include_stat' => 'edit'
	])


	{{-- Modals --}}
	{{-- Modals --}}
    <form action="{{route('api.budget.allocateDivision.store')}}" method="POST">
        @csrf
		@include('_interface.modals.edit',
			['include_title' => 'Allocate Budget','include_content' => '_budget.cards.allocateBudgetDivision','include_id' => '3', 'include_read' => 'readonly',
			'title' => 'Edit Annual Budget Entry', 'button' => 'Edit budget for the year', 'include_stat' => 'edit', 'includeclass'=> ''
			])
    </form>

    <form action="{{route('api.budget.annual.edit.store')}}" method="POST">
    {{-- <form  method="POST"> --}}
        @csrf
        <input type="hidden" id="iddddd" name="iddddd">
        <input type="hidden" id="annualllll_id" name="annualllll_id">
		@include('_interface.modals.edit',
			['include_title' => 'Allocate Budget','include_content' => '_budget.modals.editAllocation','include_id' => '5', 'include_read' => 'readonly',
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
	</form>

@endsection
@section('js')
	<script>
		var groupColumn = 0;
		$(document).ready(function() {
		    var annualbudgettable = $('#annualbudgettable').DataTable({
                "dom": "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
		        "ordering": true,
		        "info": true,
		        "responsive": true,
		        "autoWidth": true,
		        // buttons: ['copy', 'excel', 'pdf'],
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		        "order": [
		            [groupColumn, 'asc']
				],
				// "rowsGroup": [0,1],
                "displayLength": 25,
                "footerCallback" : function (row, data, start, end, display){
                    var api = this.api(), data;
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\₱,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                    .column( 1 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 1, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    // Update footer
                    $( api.column( 1 ).footer() ).html(
                        '₱ '+pageTotal.toLocaleString(undefined, {minimumFractionDigits: 2})
                    );
                    // console.log(pageTotal)
                    $('tr:eq(1) th:eq(1)', api.table().footer()).html('₱ '+total.toLocaleString(undefined, {minimumFractionDigits: 2}));
                },
                'select': {
                    'style': 'multi'
                },
			});
		});
		$(document).ready(function() {
		    var saaannualbudgettable = $('#saaannualbudgettable').DataTable({
		        "ordering": true,
		        "info": true,
		        "responsive": true,
		        "autoWidth": true,
		        // buttons: ['copy', 'excel', 'pdf'],
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		        "order": [
		            [groupColumn, 'asc']
				],
				// "rowsGroup": [0,1],
                "displayLength": 25,
                "footerCallback" : function (row, data, start, end, display){
                    var api = this.api(), data;
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\₱,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                    .column( 1 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 1, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    // Update footer
                    $( api.column( 1 ).footer() ).html(
                        '₱ '+pageTotal.toLocaleString(undefined, {minimumFractionDigits: 2})
                    );
                    // console.log(pageTotal)
                    $('tr:eq(1) th:eq(1)', api.table().footer()).html('₱ '+total.toLocaleString(undefined, {minimumFractionDigits: 2}));
                },
                'select': {
                    'style': 'multi'
                },
			});
		});
		$(document).ready(function() {
		    var saroannualbudgettable = $('#saroannualbudgettable').DataTable({
		        "ordering": true,
		        "info": true,
		        "responsive": true,
		        "autoWidth": true,
		        // buttons: ['copy', 'excel', 'pdf'],
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		        "order": [
		            [groupColumn, 'asc']
				],
				// "rowsGroup": [0,1],
		        "displayLength": 25,
			});
		});
		$(document).ready(function() {
		    var saroannualbudgettable = $('#trustfundbudgettable').DataTable({
		        "ordering": true,
		        "info": true,
		        "responsive": true,
		        "autoWidth": true,
		        // buttons: ['copy', 'excel', 'pdf'],
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		        "order": [
		            [groupColumn, 'asc']
				],
				// "rowsGroup": [0,1],
		        "displayLength": 25,
			});
		});
		$(document).ready(function() {
		    var allocatedAnnualBudgetDivision = $('#allocatedAnnualBudgetDivision').DataTable({
		        "ordering": true,
		        "info": true,
		        "responsive": false,
                "autoWidth": true,
                "scrollX": true,
		        // buttons: ['copy', 'excel', 'pdf'],
				"lengthMenu": [[5, 10, 25,30, 50100, -1], [5, 10, 25,30, 50,100, "All"]],
		        "order": [
		            [groupColumn, 'asc']
                ],
                'select': {
                    'style': 'multi'
                },
				"rowsGroup": [2,4,5,6],
                "displayLength": 50,
                "footerCallback" : function (row, data, start, end, display){
                    var api = this.api(), data;
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\₱,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                    .column( 8 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 8, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    // Update footer
                    $( api.column( 8 ).footer() ).html(
                        '₱ '+pageTotal.toLocaleString(undefined, {minimumFractionDigits: 2})
                    );
                    // console.log(pageTotal)
                    $('tr:eq(8) th:eq(8)', api.table().footer()).html('₱ '+total.toLocaleString(undefined, {minimumFractionDigits: 2}));
                },
		    });
        });
		$(document).ready(function() {
            $('table[id="allocatedAnnualBudgetDivision"]').on('click', 'button[id="edt_id_budget"]', function () {
                var value = $(this).attr('data-id');
                var strArray = value.split("||");
                // alert(strArray)
                // $('#progid').val(strArray[0]);
                $("#progid").val([strArray[0], "selected"]).trigger("change");
                // $("#progid").val([value, "selected"]).trigger("change");
                $('#bbsource').val(strArray[1]);
                $('#perdivisionbudget5').val(strArray[2]);
                $('#actualTA5').val(strArray[3]);
                $('#purpose5').val(strArray[4]);
                $('#iddddd').val(strArray[5]);
                $('#annualllll_id').val(strArray[6]);
            });
		});


		var i=1;


    $("#add_row").click(function(){
		$('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='budget_description[]' type='text' placeholder='Description' class='form-control input-md'  /></td><td><input  name='budget_account_code[]' type='number' min='0' placeholder='Account Code'  class='form-control input-md'></td><td><input  name='budget_breakdown[]' type='number' min='0' placeholder='Amount'  class='form-control input-md addamnt'></td>");



		$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
		i++;
	  });

	$('#totalcompute').on('click', function(){
		var amtsum = 0;
		$(".addamnt").each(function(){
			amtsum += +$(this).val();
		});
		$('#actualTA2').val(amtsum)
	});

    $("#delete_row").click(function(){
         if(i>1){
         $("#addr"+(i-1)).html('');
         i--;
         }
     });

	</script>
@endsection
