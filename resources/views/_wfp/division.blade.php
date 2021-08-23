@extends('_interface.layouts.dashboard')
@section('content')
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
				<li class="nav-item mr-3">
					<a class="btn btn-primary mb-1  active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true"><i class="fas fa-table mr-1"></i> View WFP & PPMP Tables</a>
				</li>
				<li class="nav-item btn-group ml-auto">
					<a class="btn btn-success mb-1 " id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false"><i class="fas fa-check-square mr-1"></i>Select section</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="tab-content" id="custom-content-above-tabContent">
		<div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
		</div>
		<div class="tab-pane fade pt-3 pb-5" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
			@include('_wfp.cards.section')
		</div>
	</div>

    <div id="dvsn">
        {{-- @include('_wfp.cards.wfp') --}}
    </div>
    {{-- @include('_wfp.cards.divisionwfp') --}}
    {{-- @include('_wfp.tables.divisionAllWFP') --}}
	{{-- @include('_ppmp.cards.ppmp') --}}

	<!-- Modal -->
	@include('_wfp.modals.DHComment')
    @include('_wfp.modals.confirm')

	@include('_ppmp.modals.DHComment')
	@include('_ppmp.modals.confirm')
@endsection

<!-- page script -->
@section('js')
	{{-- <script>
		// DATATABLE
		$(document).ready(function () {
		    var groupColumn = 0;
		    var table = $('#mainwfptable').DataTable({
	            "ordering": true,
	            "info": true,
				"responsive": true,
				"autoWidth": true,
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
			});

		    var table = $('#mainppmptable').DataTable({
	            "ordering": true,
	            "info": true,
				"responsive": true,
				"autoWidth": true,
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
		                        '<tr class="group bg-gray color-palette h4 "><td colspan="19">' + group + '</td></tr>'
		                    );
		                    last = group;
		                }
		            });
		        }
		    });
		});

	</script> --}}
@endsection
