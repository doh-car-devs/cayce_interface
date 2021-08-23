@extends('_interface.layouts.dashboard')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col">
			<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
				<li class="mr-4">
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
				<li class="nav-item mr-3 btn-group">
					<a class="btn btn-primary mb-1  active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true"><i class="fas fa-table mr-1"></i> View WFP & APP Tables</a>
                    {{-- <a class="btn btn-primary mb-1 " id="" data-toggle="pill" href="" role="tab" aria-controls="" aria-selected="true"><i class="fas fa-table mr-1"></i> Generate Consolidated OFFICE WFP</a> --}}
                    <form action="{{route('api.services.redirect.pqes')}}" id="frm-wfp" method="POST" target="blank">
                        @csrf
                        <input type="hidden" value="WFP_Report_allQweRTyui" name="redirect_key">
                        <input type="hidden" value="{{$data['year'] ?? ''}}" name="redirect_year">
                        <input type="hidden"  id="redirect_value" name="redirect_value" value="all">
                        @include('_interface.snip.hiddenInput')
                        <button  class="btn btn-primary mb-1 " type="submit">!!! GENERATE CONSOLIDATED OFFICE WFP !!!</button>
                    </form>
				</li>
				<li class="nav-item btn-group">
					<a class="btn btn-success mb-1 " id="custom-content-above-section-tab" data-toggle="pill" href="#custom-content-above-section" role="tab" aria-controls="custom-content-above-section" aria-selected="false"><i class="fas fa-table mr-1"></i>Select Section</a>

					<a class="btn btn-success mb-1 " href="{{ route ('pt.app') }}/1"  aria-selected="false"><i class="fas fa-table mr-1"></i>RD/ARD</a>
					<a class="btn btn-success mb-1 " href="{{ route ('pt.app') }}/2"  aria-selected="false"><i class="fas fa-table mr-1"></i>MSD</a>
					<a class="btn btn-success mb-1 " href="{{ route ('pt.app') }}/3"  aria-selected="false"><i class="fas fa-table mr-1"></i>LHSD</a>
					<a class="btn btn-success mb-1 " href="{{ route ('pt.app') }}/4"  aria-selected="false"><i class="fas fa-table mr-1"></i>RLED</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="tab-content" id="custom-content-above-tabContent">
		<div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
		</div>
		<div class="tab-pane fade pt-3 pb-5" id="custom-content-above-section" role="tabpanel" aria-labelledby="custom-content-above-section-tab">
			{{-- <form action="{{route('store.ppmp')}}" method="post"> --}}
				{{-- @csrf --}}
				@include('_interface.cards.divisionSelect')
			{{-- </form> --}}
		</div>
		<div class="tab-pane fade pt-3 pb-5" id="custom-content-above-division" role="tabpanel" aria-labelledby="custom-content-above-division-tab">
		</div>
	</div>

	@include('_ppmp.cards.app')
	<!-- Modals -->
</div>
@endsection

<!-- page script -->
@section('js')
<script>
	$(document).ready(function () {
		var groupColumn = 0;
		var globalTitle = 'APP Table';

		var APPtable = $('#mainapptable').DataTable({
            "dom": "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "scrollX": true,
			"ordering": true,
			"info": true,
			// "responsive": true,
			"autoWidth": true,
			buttons: [],
			"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"columnDefs": [{
				"visible": true,
				"targets": groupColumn
			},{
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                },
                'orderable': false
            }],
			"order": [[0, "asc" ]],
			"displayLength": 10,
			});
    var APPtableSAA = $('#mainapptableSAA').DataTable({
            "scrollX": true,
			"ordering": true,
			"info": true,
			// "responsive": true,
			"autoWidth": true,
			buttons: [],
			"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"columnDefs": [{
				"visible": true,
				"targets": groupColumn
			},{
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                },
                'orderable': false
            }],
			"order": [[0, "asc" ]],
			"displayLength": 10,
			});
		new $.fn.dataTable.Buttons( APPtable, {
					buttons: [
						{ extend: 'copy', className: 'btn btn-tool btn-xs btn-default'}, { extend: 'excel', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export Excel File', title: globalTitle},
						{ extend: 'pdf', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export PDF File', title: globalTitle}
					]
				} );

		APPtable.buttons( 1, null ).container().appendTo('#apptools');
	});
</script>
	{{-- <script>
		// DATATABLE
		$(document).ready(function () {
		    var groupColumn = 0;
			var globalTitle = 'WFP and PPMP Tables';

		    var table = $('#mainwfptable').DataTable({
	            "ordering": true,
	            "info": true,
				"responsive": true,
				"autoWidth": true,
				buttons: [
				],
				"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		        "columnDefs": [{
		            "visible": true,
		            "targets": groupColumn
		        }],
		        "order": [[0, "asc" ]],
			    "rowsGroup": [0,1],
				"displayLength": 10,
				"createdRow": function (row, data, dataIndex) {
					if (data[0] == "A. Strategic Functions") {
						$(row).addClass('active');
					}
					if (data[0] == "B. Core Functions") {
						$(row).addClass('active');
					}
					if (data[0] == "C. Support Functions") {
						$(row).addClass('active');
					}
				},
		        // "drawCallback": function (settings) {
		        //     var api = this.api();
		        //     var rows = api.rows({
		        //         page: 'current'
		        //     }).nodes();
		        //     var last = null;

		        //     api.column(groupColumn, {
		        //         page: 'current'
		        //     }).data().each(function (group, i) {
		        //         if (last !== group) {
		        //             $(rows).eq(i).before(
		        //                 '<tr class="group bg-gray color-palette h4 "><td colspan="15">' + group + '</td></tr>'
		        //             );
		        //             last = group;
		        //         }
		        //     });
		        // }
			});
			new $.fn.dataTable.Buttons( table, {
				buttons: [
					{ extend: 'copy', className: 'btn btn-tool btn-xs btn-default text-dark'}, { extend: 'excel', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export Excel File', title: globalTitle},
					{ extend: 'pdf', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export PDF File', title: globalTitle}
				]
			} );

			table.buttons( 1, null ).container().appendTo('#wfptools'
			);

			// edit wfp
			$(document).ready(function() {
				// $('button[id="edt_id"]').on('click', function () {
				$('table[id="mainwfptable"]').on('click', 'button[id="edt_id"]', function () {
					var value = $(this).attr('data-id');

					// var myStr = "The quick brown fox jumps over the lazy dog.";
					var strArray = value.split("||");
					// alert(strArray[13]);
					// Display array values on page
					// for(var i = 0; i < strArray.length; i++){
						// document.write("<p>" + strArray[i] + "</p>");
						$('#function2').val(strArray[0]);
						$('#activities2').val(strArray[1]);
						$('#timeframe2').val(strArray[2]);
						$('#q12').val(strArray[3]);
						$('#q22').val(strArray[4]);
						$('#q32').val(strArray[4]);
						$('#q42').val(strArray[6]);
						$('#item2').val(strArray[7]);
						$('#cost2').val(strArray[8]);
						$('#fundSource_id2').val(strArray[9]);
						// $('#function_type2').val(strArray[10]);
						$('#function_type2').val(strArray[11]);
						$('#selected-year2').val(strArray[12]);
						$('#devliverable_id2').val(strArray[13]);
					// }


				});
			});

		    var table = $('#mainppmptable').DataTable({
	            "ordering": true,
	            "info": true,
				"responsive": true,
				"autoWidth": true,
				buttons: [
				],
				"lengthMenu": [[5, 10, -1], [5, 10, "All"]],
		        "columnDefs": [{
		            "visible": false,
		            "targets": groupColumn
		        }],
		        "order": [
		            [groupColumn, 'asc']
		        ],
		        "displayLength": 5,
		        "drawCallback": function (settings) {
		            var api = this.api();
		            var rows = api.rows({
		                page: 'current'
		            }).nodes();
		            var last = null;

		            api.column(groupColumn, {
		                page: 'current'
		            }).data().each(function (group, i) {
		                if (last !== group) {
		                    $(rows).eq(i).before(
		                        '<tr class="group bg-gray color-palette h4 "><td colspan="21">' + group + '</td></tr>'
		                    );
		                    last = group;
		                }
		            });
		        }
			});
			new $.fn.dataTable.Buttons( table, {
				buttons: [
					{ extend: 'copy', className: 'btn btn-tool btn-xs btn-default text-dark'}, { extend: 'excel', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export Excel File', title: globalTitle},
					{ extend: 'pdf', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export PDF File' , title: globalTitle}
				]
			} );

			table.buttons( 1, null ).container().appendTo('#ppmptools'
			);


			$('table[id="mainppmptable"]').on('click', 'button[id="edtPPMP_id"]', function () {
				var value = $(this).attr('data-id');
				var strArray = value.split("||");
				$('.modal-content #wfp_id').val(strArray[0]);
				$('.modal-content #ppmp_genDesc').val(strArray[1]);
				$('.modal-content #ppmp_qty').val(strArray[2]);
				$('.modal-content #ppmp_unit').val(strArray[3]);
				$('.modal-content #ppmp_abc').val(strArray[4]);
				$('.modal-content #ppmp_estbudget').val(strArray[4]);
				$('.modal-content #ppmp_mop').val(strArray[6]);
				$('.modal-content #milestones1').val(strArray[7]);
				$('.modal-content #milestones2').val(strArray[8]);
				$('.modal-content #milestones3').val(strArray[9]);
				$('.modal-content #milestones4').val(strArray[10]);
				$('.modal-content #milestones5').val(strArray[11]);
				$('.modal-content #milestones6').val(strArray[12]);
				$('.modal-content #milestones7').val(strArray[13]);
				$('.modal-content #milestones8').val(strArray[14]);
				$('.modal-content #milestones9').val(strArray[15]);
				$('.modal-content #milestones10').val(strArray[16]);
				$('.modal-content #milestones11').val(strArray[17]);
				$('.modal-content #milestones12').val(strArray[18]);
				$('.modal-content #ppmp_entry_id').val(strArray[21]);
			});

			$('button[id="calc_target_wfp"]').on('click', function () {
				var sum = parseInt($('#q1').val()) + parseInt($('#q2').val()) + parseInt($('#q3').val()) + parseInt($('#q4').val())
				$('#cost').val(sum);
			});

			$('button[id="qtyabc"]').on('click', function () {
				var qtyxabc = parseInt($('#ppmp_qty').val()) * parseFloat($('#ppmp_abc').val())
				$('#ppmp_estbudget').val(qtyxabc);
			});
		});
	</script> --}}
@endsection
