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
                <li class="nav-item mr-3">
                    <a class="btn btn-primary mb-1  active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true"><i class="fas fa-table mr-1"></i> View Items</a>
                </li>
                <li class="nav-item btn-group ml-auto">
                    <a class="btn btn-success mb-1 " id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false"><i class="fas fa-plus-square mr-1"></i>Create Purchase Order <small>(PO)</small></a>
                </li>
            </ul>
        </div>
    </div>

	<div class="tab-content" id="custom-content-above-tabContent">
		<div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
		</div>
		{{-- <div class="tab-pane fade pt-3 pb-5" id="custom-content-above-messages" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">
			<form action="{{route('api.ppmp.store')}}" method="post">
			@csrf
            @include('_interface.cards.widecard',
			['include_id' => '1', 'include_title' => 'Purchase Request'
			])
			</form>
        </div> --}}
        <div class="tab-pane fade pt-3 pb-5" id="custom-content-above-messages" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">
            @include('_interface.cards.widecard',
            ['include_title' => 'Generate Purchase Order','include_content' => '_interface.includes.empty',
            ])
        </div>
    </div>

    @include('_interface.cards.wideCard',
    ['include_title' => 'Create Purchase Order','include_content' => '_procurement.tables.purchaseOrder',
    ])
@endsection

@section('jsSpecificImports')
@endsection

@section('cssSpecificImports')
@endsection


<!-- page script -->
@section('js')
<script>
$(document).ready(function() {
   var table = $('#prtable').DataTable({
    //   'ajax': 'https://gyrocode.github.io/files/jquery-datatables/arrays_id.json',
      'columnDefs': [
        {
            "targets": 0,
            "visible": false,
        },
        {
            'targets': 1,
            'checkboxes': {
                'selectRow': true
            }
        }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']],
      "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;

                api.column(0, {
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

   // Handle form submission event
   $('#frm-pr').on('submit', function(e){
      var form = this;

      var rows_selected = table.column(1).checkboxes.selected();
      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'value-'+index)
                .val(rowId)
         );
      });
    //   alert($(form).serialize());
        $('#redirect_value').val(rows_selected.join("yyy"));
      // FOR DEMONSTRATION ONLY
      // The code below is not needed in production

      // Output form data to a console
      $('#example-console-rows').text(rows_selected.join(","));
      // Output form data to a console
      $('#example-console-form').text($(form).serialize());
    //   alert($(form).serialize());
    //   $('#redirect_value').val('$(form).serialize()');
      // Remove added elements
    //   $('input[name="id\[\]"]', form).remove();

      // Prevent actual form submission
    //   e.preventDefault();
   });
});

</script>
@endsection
