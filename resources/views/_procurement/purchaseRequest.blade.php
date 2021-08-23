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
                    <a class="btn btn-success mb-1 " id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false"><i class="fas fa-plus-square mr-1"></i>Create Purchase Request <small>(PR)</small></a>
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
            ['include_title' => 'Generate Purchase Request','include_content' => '_procurement.tables.purchaseRequest',
            ])
        </div>
    </div>

    @include('_interface.cards.wideCard',
    ['include_title' => 'Generated Purchase Requests','include_content' => '_procurement.tables.purchaseRequestList',
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
   var table = $('#generatePR').DataTable({
    dom: "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    'columnDefs': [
        {
            "targets": 0,
            "visible": false,
        },
    ],
      'order': [[2, 'asc']],
   });


   $('table[id="generatePR"]').on('click', 'button[id="prnt_pr"]', function () {
        // alert($(this).attr('data-id'))
        var rows_selected = $(this).attr('data-id');
        $('#redirect_valuepr').val(rows_selected);
        document.getElementById("frm-generatePR").submit()
    });

   // Handle form submission event
//    $('#frm-generatePR').on('submit', function(e){
//       var form = this;

//       var rows_selected = table.column(1).checkboxes.selected();
//       $.each(rows_selected, function(index, rowId){
//          $(form).append(
//              $('<input>')
//                 .attr('type', 'hidden')
//                 .attr('name', 'value-'+index)
//                 .val(rowId)
//          );
//       });
//         $('#redirect_value').val(rows_selected.join("yyy"));
//    });

});
$(document).ready(function() {
    pr2group = 1;
    generatePR2 = $('#generatePR2').DataTable({
            "dom": "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "scrollX": true,
            "scrollY": true,
            "ordering": true,
            ajax: {
                url: 'http://192.168.224.68:2019/api/test/newPurchaseRequests',
                type: 'GET',
                async: 'true',

                error: function (xhr, error, code)
                {
                    data = []
                },
            },
            data: [],
            columns:[
                {data: 'mainTablePPMP_ID',
                    // render: function (data, type, row) {
                    //     // return '<td class="align-middle"><button type="button" id="prnt_pr" data-id="'+row.mainPPMP_ID+'" class="btn btn-primary" data-placement="left" data-tt="tooltip" title="Print This Entry"><i class="fas fa-print"></i></button></td>'
                    //     // ADD button in ajax datatable
                    //     // return '<td class="align-middle"><button type="button" id="prnt_pr" data-id="'+row.mainPPMP_ID+'" class="btn btn-primary" data-placement="left" data-tt="tooltip" title="Print This Entry"><i class="fas fa-print"></i></button></td>'
                    // }
                },
                {data: 'pr_number'},
                {data: 'item_name'},
                {data: 'summ'},
                {data: 'word_unit'},
                {data: 'abc'},
                {data: 'estimated_budget'},
                {data: 'word_MOP'},
                // {data: 'estimated_budget'},
                // {data: 'parent_type_abbr'},
                // {data: 'mode'},
                // {data: 'ppmp_comment'},
                // {data: 'ppmp_status'},
            ],
            // rowCallback: function (row, data){
            //     $('#disp-ppmp').text(data.activities);
            //     $('#ppmp-number').text(data.activities);
            // },
            "columnDefs": [
                { "visible": false, "targets": pr2group }
            ],
            "drawCallback": function (settings, data) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;


                api.column(pr2group, {
                    page: 'current'
                }).data().each(function (group, i) {
        var datarows = api.rows({page:'current'}).data();
        console.log(datarows[i])
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group bg-gray color-palette h4 "><td colspan="21">PR Number: ' + group + '<button type="button" id="prnt_prs" data-id="" class="btn btn-primary" data-placement="left" data-tt="tooltip" title="Print This Entry"><i class="fas fa-print"></i></button></td></tr>'
                        );
                        last = group;
                    }
                });
            },
            filter: false,
            info: false,
            ordering: true,
            processing: true,
            retrieve: true,
            paging: true,
            searching: true,
            order: [1, 'asc'],
            language: {
                "processing": "Loading Purchase Requests. Please wait..."
            },
        });

   var table = $('#prtable').DataTable({
    dom: "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
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
      'order': [[10, 'desc']],
      "pageLength": 25
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
      alert(rows_selected.join("yyy"));
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
