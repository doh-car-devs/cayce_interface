const { default: Axios } = require("axios");

$(document).ready(function() {


    $('#ppmp_genDesc').select2({
        theme: 'bootstrap4',
        // tags: true,
        // multiple: true,
        allowClear: true,
        // tokenSeparators: [',', ' '],
        minimumInputLength: 4,
        minimumResultsForSearch: 10,
        language: {
            noResults: function() {
              return 'Item Not Found<button class="btn btn-block btn-outline-danger btn-xs" id="no-results-btn" data-toggle="collapse" data-target="#collapseExample">Click here to request NEW item</a>';
            },
        },
        escapeMarkup: function(markup) {
            return markup;
          },
        ajax: {
            url: "http://192.168.224.68:2019/api/ppmp/items",
            dataType: "json",
            type: "GET",
            data: function (params) {
                // console.log(params.term);
                var newparams = params.term.replace(/ /g, "%20")
                // console.log(newparams);

                var queryParameters = {
                    term: newparams || ''
                }
                // console.log(queryParameters)
                // console.log(params.term)
                return queryParameters;
            },
            processResults: function (data) {
                // console.log(data)
                return {
                    results: $.map(data.items, function (item) {
                        return {
                            id: item.id,
                            text: item.text,
                            code: item.code,
                            price: item.price,
                            unitname: item.unitname,
                            unit: item.unit,
                            branch: item.branch,
                        }
                    }),
                };
            },
            // cache: true
        },

    });

    $('#ppmp_genDesc_edit').select2({
        theme: 'bootstrap4',
        allowClear: true,
        minimumInputLength: 4,
        minimumResultsForSearch: 10,
        language: {
            noResults: function() {
              return 'Item Not Found<button class="btn btn-block btn-outline-danger btn-xs" id="no-results-btn" data-toggle="collapse" data-target="#collapseExample">Click here to request NEW item</a>';
            },
        },
        escapeMarkup: function(markup) {
            return markup;
          },
        ajax: {
            url: "http://192.168.224.68:2019/api/ppmp/items",
            dataType: "json",
            type: "GET",
            data: function (params) {
                console.log(params.term);
                var newparams = params.term.replace(/ /g, "%20")
                console.log(newparams);

                var queryParameters = {
                    term: newparams || ''
                }
                // console.log(queryParameters)
                // console.log(params.term)
                return queryParameters;
            },
            processResults: function (data) {
                // console.log(data)
                return {
                    results: $.map(data.items, function (item) {
                        return {
                            id: item.id,
                            text: item.text,
                            code: item.code,
                            price: item.price,
                            unitname: item.unitname,
                            unit: item.unit,
                            branch: item.branch,
                        }
                    }),
                };
            },
            // cache: true
        },

    });

    // on select of item
    $("#ppmp_genDesc").on('select2:select', function(e)
    {
        // console.log(e.params.data)
        // alert('sdfdfdf')
        // console.log(e.params.price)
        $('#ppmp_abc1').val(e.params.data.price);
        $('#ppmp_unit1').val(e.params.data.unitname);

        $('#ppmp_branch1').val(e.params.data.branch);
        $('#ppmp_id1').val(e.params.data.id);
        $('#ppmp_item_name1').val(e.params.data.text);
        $('#ppmp_price1').val(e.params.data.price);
        $('#ppmp_unit11').val(e.params.data.unit);
    });
    // on clear of item
    $("#ppmp_genDesc").on('select2:clear', function(e)
    {
        $('#ppmp_abc1').val(0);
        $('#ppmp_unit1').val('');
        $('#ppmp_estbudget').val(0);
    });

    // on select of item
    $("#ppmp_genDesc_edit").on('select2:select', function(e)
    {
        console.log(e.params.data)
        $('#ppmp_abc3').val(e.params.data.price);
        $('#ppmp_unit3').val(e.params.data.unitname);

        $('#ppmp_branch3').val(e.params.data.branch);
        $('#ppmp_id2').val(e.params.data.id);
        $('#ppmp_item_name3').val(e.params.data.text);
        $('#ppmp_price3').val(e.params.data.price);
        $('#ppmp_unit13').val(e.params.data.unit);
    });
    // on clear of item
    $("#ppmp_genDesc_edit").on('select2:clear', function(e)
    {
        $('#ppmp_abc3').val(0);
        $('#ppmp_unit3').val('');
        $('#ppmp_estbudget').val(0);
    });
});

$(document).ready(function() {
    $('#wfpDeliverable').select2({
        theme: 'bootstrap4',
        allowClear: true,
        tokenSeparators: [',', ' '],
        minimumInputLength: 2,
        minimumResultsForSearch: 10,
        language: {
            noResults: function() {
              return 'No Result/s Found<button class="btn btn-block btn-outline-danger btn-xs" id="no-results-btn" data-toggle="modal" data-target="#edit2" onclick="pastevalue()">Click here to add new</a>';
            },
        },
        escapeMarkup: function(markup) {
            return markup;
          },
        ajax: {
            url: "http://192.168.224.68:2019/api/wfp/deliverableList",
            dataType: "json",
            type: "GET",
            data: function (params) {
                var queryParameters = {
                    term: params.term || 1
                }
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data.items, function (item) {
                        return {
                            id: item.text,
                            text: item.text,
                        }
                    }),
                };
            },
            cache: true
        }
    });
});

// DATATABLE
$(document).ready(function () {
    var maindivisionwfptablevar = $('#maindivisionwfptable').DataTable({
        "scrollX": true,
        "ordering": true,
        // "responsive": true,
        "autoWidth": true,
        // dom: 'Bfrtlip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0,2,3,4,5,6,7,8,9,10,11,12,13]
                    // columns: [ 0, ':visible' ]
                }
            }
            ,'colvis'
        ],
        "lengthMenu": [[5, 10, 25, 50,100, -1], [5, 10, 25, 50,100, "All"]],
        "columnDefs": [
            // {
            //     "visible": true,
            //     "targets": 0
            // },
            // {
            //     'targets': 1,
            //     'checkboxes': {
            //         'selectRow': true
            //     }
            // }
        ],
        'select': {
            'style': 'multi'
         },
        "order": [[0, "asc" ]],
        "rowsGroup": [0,2],
        "displayLength": 50,
        // "createdRow": function (row, data, dataIndex) {
        //     if (data[0] == "A. Strategic Functions") {
        //         $(row).addClass('active');
        //     }
        //     if (data[0] == "B. Core Functions") {
        //         $(row).addClass('active');
        //     }
        //     if (data[0] == "C. Support Functions") {
        //         $(row).addClass('active');
        //     }
        // },
    });
    new $.fn.dataTable.Buttons( maindivisionwfptablevar, {
        buttons: [
            { extend: 'copy', className: 'btn btn-tool btn-xs btn-default text-warning font-weight-bold', text: 'COPY SELECTED ROWS', exportOptions: {columns: [ 0,2,3,4,5,6,7,8,9,10,11,12,13]}}, { extend: 'excel', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export Excel File', title: 'Excel'},
            { extend: 'pdf', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export PDF File', title: 'PDF'}
        ]
    } );

    maindivisionwfptablevar.buttons( 1, null ).container().appendTo('#dvsnwfp'
    );
});

$(document).ready(function () {
    var groupColumn = 0;
    var globalTitle = 'WFP and PPMP Tables for {{auth()->user()->name_family}}, {{auth()->user()->name}} {{auth()->user()->name_middle}}';
    if (typeof globaldisplayLength === 'undefined') {
        globaldisplayLength = 10;
    }
    var table_wfp = $('#mainwfptable').DataTable({
        dom: "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "scrollX": true,
        "ordering": true,
        "info": true,
        // "responsive": true,
        "autoWidth": true,
        buttons: [
        ],
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "columnDefs": [
            {
                "visible": true,
                "targets": groupColumn
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
        "order": [[0, "asc" ]],
        "rowsGroup": [0,2],
        "displayLength": globaldisplayLength,
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
        "footerCallback" : function (row, data, start, end, display){
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
            .column( 11 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

            // Total over this page
            pageTotal = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 11 ).footer() ).html(
                '₱ '+pageTotal.toLocaleString(undefined, {minimumFractionDigits: 2})
            );

            $('tr:eq(1) th:eq(1)', api.table().footer()).html('₱ '+total.toLocaleString(undefined, {minimumFractionDigits: 2}));
        },
    });

    table_wfp.on('page.dt', function() {
        $('html, body').animate({
          scrollTop: $(".dataTables_wrapper").offset().top
         }, 'slow');
      });

    // var table_wfp_consolidated = $('#mainwfptableconsolidated').DataTable({
    //     dom: "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
    //     "<'row'<'col-sm-12'tr>>" +
    //     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    //     "scrollX": true,
    //     "ordering": true,
    //     "info": true,
    //     // "responsive": true,
    //     "autoWidth": true,
    //     buttons: [
    //     ],
    //     "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    //     "columnDefs": [
    //         {
    //             "visible": true,
    //             "targets": groupColumn
    //         },
    //         {
    //             'targets': 1,
    //             'checkboxes': {
    //                 'selectRow': true
    //             }
    //         }
    //     ],
    //     'select': {
    //         'style': 'multi'
    //      },
    //     "order": [[0, "asc" ]],
    //     "rowsGroup": [0,2],
    //     "displayLength": globaldisplayLength,
    //     "createdRow": function (row, data, dataIndex) {
    //         if (data[0] == "A. Strategic Functions") {
    //             $(row).addClass('active');
    //         }
    //         if (data[0] == "B. Core Functions") {
    //             $(row).addClass('active');
    //         }
    //         if (data[0] == "C. Support Functions") {
    //             $(row).addClass('active');
    //         }
    //     },
    //     "footerCallback" : function (row, data, start, end, display){
    //         var api = this.api(), data;
    //         // Remove the formatting to get integer data for summation
    //         var intVal = function ( i ) {
    //             return typeof i === 'string' ?
    //                 i.replace(/[\$,]/g, '')*1 :
    //                 typeof i === 'number' ?
    //                     i : 0;
    //         };

    //         // Total over all pages
    //         total = api
    //         .column( 10 )
    //         .data()
    //         .reduce( function (a, b) {
    //             return intVal(a) + intVal(b);
    //         }, 0 );

    //         // Total over this page
    //         pageTotal = api
    //             .column( 10, { page: 'current'} )
    //             .data()
    //             .reduce( function (a, b) {
    //                 return intVal(a) + intVal(b);
    //             }, 0 );
    //         // Update footer
    //         $( api.column( 11 ).footer() ).html(
    //             '₱ '+pageTotal.toLocaleString(undefined, {minimumFractionDigits: 2})
    //         );

    //         $('tr:eq(1) th:eq(1)', api.table().footer()).html('₱ '+total.toLocaleString(undefined, {minimumFractionDigits: 2}));
    //     },
    // });

    var table_wfp_consolidated = $('#mainwfptableconsolidated').DataTable({
        dom: "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "scrollX": true,
        "ordering": true,
        "info": true,
        // "responsive": true,
        "autoWidth": true,
        buttons: [
        ],
        "lengthMenu": [[5, 10, 25, 50,100, -1], [5, 10, 25, 50,100, "All"]],
        "columnDefs": [
            {
                "visible": true,
                "targets": groupColumn
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
        "order": [[1, "asc" ]],
        "rowsGroup": [2],
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
        "footerCallback" : function (row, data, start, end, display){
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
            .column( 10 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

            // Total over this page
            pageTotal = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 2 ).footer() ).html(
                '₱ '+pageTotal.toLocaleString(undefined, {minimumFractionDigits: 2})
            );

            $('tr:eq(1) th:eq(1)', api.table().footer()).html('₱ '+total.toLocaleString(undefined, {minimumFractionDigits: 2}));
        },
    });
    table_wfp_consolidated.on('page.dt', function() {
        $('html, body').animate({
          scrollTop: $(".dataTables_wrapper").offset().top
         }, 'slow');
      });

    // Handle form submission event
   $('#frm-wfp').on('submit', function(e){
    var ans = window.confirm("You are about to generate Office Consolidated WFP. Press OK to continue")
    if (ans) {
        var form = this;

        var rows_selected = table_wfp.column(1).checkboxes.selected();
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
          $('#redirect_value').val(rows_selected.join("yyy"));
        // Output form data to a console
        $('#example-console-rows').text(rows_selected.join(","));
        $('#example-console-form').text($(form).serialize());
    }else {
        e.preventDefault();
    }


 });

   $('#frm-wfp123').on('submit', function(e){
    alert('sdfsdf')
    var ans = window.confirm("You are about to generate Office Consolidated WFP. Press OK to continue")
    if (ans) {
        var form = this;

        var rows_selected = table_wfp_consolidated.column(1).checkboxes.selected();
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
          $('#redirect_value').val(rows_selected.join("yyy"));
        // Output form data to a console
        $('#example-console-rows').text(rows_selected.join(","));
        $('#example-console-form').text($(form).serialize());
    }else {
        e.preventDefault();
    }


 });

// Handle form submission event
    //    $('#frmdvsn-wfp').on('submit', function(e){
    //     var form = this;

    //     var rows_selected = table_wfp.column(1).checkboxes.selected();
    //     // Iterate over all selected checkboxes
    //     $.each(rows_selected, function(index, rowId){
    //        // Create a hidden element
    //        $(form).append(
    //            $('<input>')
    //               .attr('type', 'hidden')
    //               .attr('name', 'value-'+index)
    //               .val(rowId)
    //        );
    //     });
    //       $('#redirect_value').val(rows_selected.join("yyy"));
    //     // Output form data to a console
    //     $('#example-console-rows').text(rows_selected.join(","));
    //     $('#example-console-form').text($(form).serialize());

    //  });
    // UNCOMMENT FOR ADDING BUTTON LIKE PRINT/COPY/PDF
    // new $.fn.dataTable.Buttons( table, {
    //     buttons: [
    //         { extend: 'copy', className: 'btn btn-tool btn-xs btn-default text-dark'}, { extend: 'excel', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export Excel File', title: globalTitle},
    //         { extend: 'pdf', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export PDF File', title: globalTitle}
    //     ]
    // } );

    // table.buttons( 1, null ).container().appendTo('#wfptools'
    // );

    // edit wfp
    $(document).ready(function() {
        $('table[id="mainwfptable"]').on('click', 'button[id="edt_id"]', function () {
            var value = $(this).attr('data-id');
            var strArray = value.split("||");
            $('#function2').val(strArray[0]);
            $('#activities2').val(strArray[1]);
            $('#timeframe2').val(strArray[2]);
            $('#q12').val(strArray[3]);
            $('#q22').val(strArray[4]);
            $('#q32').val(strArray[4]);
            $('#q42').val(strArray[6]);
            $('#item2').val(strArray[7]);
            $('#cost2').val(strArray[8]);
            $('#fundSource_id2').val(strArray[9]).trigger("change");
            console.log(strArray);
            // $('#function_type2').val(strArray[10]);
            $('#function_type2').val(strArray[11]);
            $('#selected-year2').val(strArray[12]);
            $('#deliverable_id2').val(strArray[13]);
            $('#resp_person_edt').val(strArray[14]).trigger("change");
        });

        $('table[id="mainwfptable"]').on('click', 'button[id="add_ppmp"]', function () {
            var value = $(this).attr('data-id');
            var strArray = value.split("||");
            // $("#wfp_id3").select2('data', {id: 39});
            $("#wfp_id3").val([value, "selected"]).trigger("change");

var availamount = $(this).attr('data-cost');
// window.confirm("You have ₱"+ Number(availamount).toLocaleString() + ' unallocated funds.')
$('#estbudget3').text(numeral(availamount).format('0,0.00'));
$('#ppmp_estbudget').attr('max', availamount);
            // $('#wfp_id3').val(value);
            // alert(value)
            // $('#activities2').val(strArray[1]);
            // $('#timeframe2').val(strArray[2]);
            // $('#q12').val(strArray[3]);
            // $('#q22').val(strArray[4]);
            // $('#q32').val(strArray[4]);
            // $('#q42').val(strArray[6]);
            // $('#item2').val(strArray[7]);
            // $('#cost2').val(strArray[8]);
            // $('#fundSource_id2').val(strArray[9]);
            // console.log(strArray);
            // $('#function_type2').val(strArray[11]);
            // $('#selected-year2').val(strArray[12]);
            // $('#deliverable_id2').val(strArray[13]);
        });

        $('table[id="mainwfptable"]').on('click', 'button[id="dup_id"]', function () {
            var value = $(this).attr('data-id');
            var strArray = value.split("||");
            // $("#wfp_id3").select2('data', {id: 39});
                                    // $("#wfp_id3").val([value, "selected"]).trigger("change");

                                    // var availamount = $(this).attr('data-cost');
                                    // // window.confirm("You have ₱"+ Number(availamount).toLocaleString() + ' unallocated funds.')
                                    // $('#estbudget3').text(numeral(availamount).format('0,0.00'));
                                    // $('#ppmp_estbudget').attr('max', availamount);
                                    // // $('#wfp_id3').val(value);
                                    // // alert(value)
                                    // // $('#activities2').val(strArray[1]);
                                    // // $('#timeframe2').val(strArray[2]);
                                    // // $('#q12').val(strArray[3]);
                                    // // $('#q22').val(strArray[4]);
                                    // // $('#q32').val(strArray[4]);
                                    // // $('#q42').val(strArray[6]);
                                    // // $('#item2').val(strArray[7]);
                                    // // $('#cost2').val(strArray[8]);
                                    // // $('#fundSource_id2').val(strArray[9]);
                                    // // console.log(strArray);
                                    // // $('#function_type2').val(strArray[11]);
                                    // // $('#selected-year2').val(strArray[12]);
            $('#deliverable_id2').val(strArray[13]);
            // alert(strArray[13])
            Axios.post('/api/services/redirect/redirectAPI/', {
                redirect_year: '2021',
                myid: strArray[13]
            })
                .then(function(response) {
                    crossDomain: true
                    console.log(response)
                })
                .catch(function (error) {
                    console.log(error)
                })
                .then(function (){
                    console.log('done')
                })
        });

        $('table[id="mainwfptable"]').on('click', 'button[id="duplicate_wfp"]', function () {
            var value = $(this).attr('data-id');
            var strArray = value.split("||");
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
            console.log(strArray[9]);
            // $('#function_type2').val(strArray[10]);
            $('#function_type2').val(strArray[11]);
            $('#selected-year2').val(strArray[12]);
            $('#deliverable_id2').val(strArray[13]);
        });


    });

    var tableppmp = $('#mainppmptable').DataTable({
        "dom": "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "scrollX": true,
        "ordering": true,
        "info": true,
        // "responsive": true,
        "autoWidth": true,
        buttons: [
        ],
        "lengthMenu": [[5, 10,20,30,50,100, -1], [5, 10,20,30,50,100, "All"]],
        "columnDefs": [{
            "visible": false,
            "targets": groupColumn
        },{
            'targets': 1,
            'checkboxes': {
                'selectRow': true
            }
        }
        ],
        'select': {
            'style': 'multi'
         },
        "order": [
            [groupColumn, 'asc']
        ],
        "displayLength": 20,
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
        },
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
            .column( 7 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

            // Total over this page
            pageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 6 ).footer() ).html(
                '₱ '+pageTotal.toLocaleString(undefined, {minimumFractionDigits: 2})
            );
            console.log(pageTotal)
            $('tr:eq(1) th:eq(1)', api.table().footer()).html('₱ '+total.toLocaleString(undefined, {minimumFractionDigits: 2}));
        },
    });

    tableppmp.on('page.dt', function() {
        $('html, body').animate({
          scrollTop: $(".dataTables_wrapper").offset().top
         }, 'slow');
      });

    $('#frm-ppmp').on('submit', function(e){
        var form = this;

        var rows_selected = tableppmp.column(1).checkboxes.selected();
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
          $('#redirect_value').val(rows_selected.join("yyy"));
        // Output form data to a console
        $('#example-console-rows').text(rows_selected.join(","));
        $('#example-console-form').text($(form).serialize());

     });

    // UNCOMMENT FOR ADDING BUTTON LIKE PRINT/COPY/PDF
    // new $.fn.dataTable.Buttons( table, {
    //     buttons: [
    //         { extend: 'copy', className: 'btn btn-tool btn-xs btn-default text-dark'}, { extend: 'excel', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export Excel File', title: globalTitle},
    //         { extend: 'pdf', className: 'btn btn-tool btn-xs btn-default text-dark', text: 'Export PDF File' , title: globalTitle}
    //     ]
    // } );

    // table.buttons( 1, null ).container().appendTo('#ppmptools'
    // );


    $('table[id="mainppmptable"]').on('click', 'button[id="edtPPMP_id"]', function () {
        var value = $(this).attr('data-id');
        var strArray = value.split("||");
        // $('.modal-content #wfp_id').val(strArray[0]);
        // alert(strArray[0]);
        $(".modal-content #wfp_id2").val([strArray[0], "selected"]).trigger("change");
        // $(".modal-content #ppmp_genDesc_edit").val([strArray[1], "selected"]).trigger("change");
        $('.modal-content #ppmp_genDesc_edit').val(strArray[1]);
        $('.modal-content #ppmp_genDesc_editinput').val(strArray[1]);
        $('.modal-content #ppmp_qty2').val(strArray[2]);
        $('.modal-content #ppmp_unit2').val(strArray[3]);
        $('.modal-content #ppmp_abc2').val(strArray[4]);
        $('.modal-content #ppmp_estbudget').val(strArray[4]);
        $(".modal-content #ppmp_mop").val([strArray[6], "selected"]).trigger("change");
        // $('.modal-content #ppmp_mop').val(strArray[6]);
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

        var qtyxabc2 = parseInt($('.modal-content #ppmp_qty2').val()) * parseFloat($('.modal-content #ppmp_abc2').val())
        // alert(qtyxabc2);
        console.log(qtyxabc2.toFixed(2))
        $('.modal-content #ppmp_estbudget_edit').val(qtyxabc2.toFixed(2));
        $('.modal-content #ppmp_estbudget_edit2').val(qtyxabc2.toFixed(2));
    });

    $('button[id="calc_target_wfp"]').on('click', function () {
        var sum = parseInt($('#q1').val()) + parseInt($('#q2').val()) + parseInt($('#q3').val()) + parseInt($('#q4').val())
        $('#cost').val(sum);
    });

    $('.milestoneclass').on('input', function () {
        var total = 0;
        $('.milestoneclass').each(function(key, variable){
            total = total + parseInt($(variable).val());
        });
        console.log(total)
        $('#ppmp_qty').val(total);
        var qtyxabc = parseInt($('#ppmp_qty').val()) * parseFloat($('#ppmp_abc1').val())
        $('#ppmp_estbudget').val(qtyxabc);
    });

    function calcmilestone(){
        alert('hello')
    }

    $('button[id="qtyabc"]').on('click', function () {
        var qtyxabc = parseInt($('#ppmp_qty').val()) * parseFloat($('#ppmp_abc1').val())
        $('#ppmp_estbudget').val(qtyxabc);
        var qtyxabc2 = parseInt($('.modal-content #ppmp_qty').val()) * parseFloat($('.modal-content #ppmp_abc3').val())
        // alert($('.modal-content #ppmp_abc3').val());
        $('.modal-content #ppmp_estbudget_edit').val(qtyxabc2);
    });

    $('button[id="qtyabc2"]').on('click', function () {
        var qtyxabc = parseInt($('#ppmp_qty2').val()) * parseFloat($('#ppmp_abc2').val())
        var qtyxabc3 = parseInt($('#ppmp_qty3').val()) * parseFloat($('#ppmp_abc3').val())
        // alert(qtyxabc3)
        $('#ppmp_estbudget_edit2').val(qtyxabc);
        $('#ppmp_estbudget_edit3').val(qtyxabc3);
        var qtyxabc2 = parseInt($('.modal-content #ppmp_qty').val()) * parseFloat($('.modal-content #ppmp_abc3').val())
        // alert($('.modal-content #ppmp_abc3').val());
        $('.modal-content #ppmp_estbudget_edit').val(qtyxabc2);
    });

    $('button[id="searchguide"]').on('click', function () {
        alert('hello');
        // var qtyxabc = parseInt($('#ppmp_qty').val()) * parseFloat($('#ppmp_abc1').val())
        $('#ppmp_genDesc').val('qtyxabc');
    });

    $('#ppmp_qty').on('keyup', function () {
        var qtyxabc = parseInt($('#ppmp_qty').val()) * parseFloat($('#ppmp_abc1').val())
        $('#ppmp_estbudget').val(qtyxabc);
    });

    //Selecting fund source and auto select program
    $("#fundSource_id").on('select2:select', function () {
        var programid = $(this).find(':selected').attr('data-program');
        $('#wfpProgram').val(programid);
    });

    $("#fundSource_id").on('select2:select', function()
    {
        var type = $(this).find(':selected').attr('data-fundtype');
        var wfpallocate = (type =='SAA' || type =='SARO'|| type =='Trust Funds') ? numeral($(this).find(':selected').attr('data-availableamount')).format('0,0.00') : $(this).find(':selected').attr('data-availableNEP')

        $('#viewperdev3').text(wfpallocate);
        $('#cost').attr('max', wfpallocate);
    });

    $("#wfp_id1").on('select2:select', function()
    {
        var availamount = $(this).find(':selected').attr('data-cost');
        alert(availamount)
        $('#estbudget1').text(numeral(availamount).format('0,0.00'));
        $('#ppmp_estbudget').attr('max', availamount);
    });
    $("#wfp_id2").on('select2:select', function()
    {
        var availamount = $(this).find(':selected').attr('data-cost');
        $('#estbudget2').text(numeral(availamount).format('0,0.00'));
        $('#ppmp_estbudget').attr('max', availamount);
    });

    $("#wfp_id3").on('select2:change', function()
    {
        alert('yown wfpid3')
        var availamount = $(this).find(':selected').attr('data-cost');
        $('#estbudget3').text(numeral(availamount).format('0,0.00'));
        $('#ppmp_estbudget').attr('max', availamount);
    });

    // uncomment for adding button on filter
    // $(" div.dataTables_filter").append('<button class="btn btn-secondary btn-sm" id="lock-search-btn">Lock Search</button>');
    // $("#lock-search-btn").on('click', function(e){
    //     e.preventDefault();
    //     alert('hello')

    // });

    // $("select.custom-select-sm").append('<button class="btn btn-secondary btn-sm" id="lock-search-btn">Lock Search</button>');
    $("select.custom-select-sm").on('change', function(e){
        e.preventDefault();
        var info = table_wfp.page.info();
        var selectedLength = info.length;
        $('#tablelen').val(selectedLength);
        // $('form#formlength').submit;
        document.getElementById('formlength').submit();
        console.log(selectedLength);
    });


    var PeekPPMP
    // PeekPPMP = $('#peek_mainppmptable').DataTable({
    //     // processing: true,
    //     // // serverSide: true,
    //     // ajax: {
    //     //     url: 'http://192.168.224.68:2019/api/systemadmin/getAllUsers',
    //     //     type: 'GET',
    //     //     error: function (xhr, error, code)
    //     //     {
    //     //         data = []
    //     //     },

    //     // },
    //     data: [],
    //     columns:[
    //         {data: 'names'},
    //         {data: 'designation'},
    //         {data: 'division_name'},
    //         {data: 'section_name'},
    //         // {data: 'namess', name: 'Name'},
    //         // {data: 'designation', name: 'Designation'},
    //         // {data: 'division_name', name: 'Division'},
    //         // {data: 'section_name', name: 'Section'},
    //     ],
    //     rowCallback: function (row, data){
    //         // console.log(data)
    //         alert('ssdf')
    //     },
    //     filter: false,
    //     info: false,
    //     ordering: false,
    //     processing: true,
    //     retrieve: true,
    //     paging: false,
    //     searching: false,
    //     order: [1, 'asc'],
    //     // ordering: true,
    //     // "order": [[0, "asc" ]],
    //     // 'select': {
    //     //     'style': 'multi'
    //     //  },

    //     // "lengthMenu": [[10,20,50,100, -1], [10,20,50,100, "All"]],
    //     // "displayLength": 20,
    //     // "drawCallback": function( settings ) {
    //     // }
    // });

    $('table[id="mainwfptable"]').on('click', 'button[id="peak_id"]', function (event) {
        $('#peek_mainppmptable').DataTable().clear().destroy();
        $('#disp-ppmp').text('No PPMP Associated with this WFP');
        var value = $(this).attr('data-id');
        PeekPPMP = $('#peek_mainppmptable').DataTable({
            "scrollX": true,
            "scrollY": true,
            "ordering": true,
            ajax: {
                url: 'http://192.168.224.68:2019/api/peek/ppmpinwfp/'+value,
                type: 'GET',

                error: function (xhr, error, code)
                {
                    data = []
                },
            },
            data: [],
            columns:[
                {data: 'ppmp_id'},
                {data: 'program_abbr'},
                {data: 'item_name'},
                {data: 'qty'},
                {data: 'unit'},
                {data: 'abc'},
                {data: 'estimated_budget'},
                {data: 'parent_type_abbr'},
                {data: 'mode'},
                {data: 'ppmp_comment'},
                {data: 'ppmp_status'},
            ],
            rowCallback: function (row, data){
                $('#disp-ppmp').text(data.activities);
                $('#ppmp-number').text(data.activities);
            },
            filter: false,
            info: false,
            ordering: false,
            processing: true,
            retrieve: true,
            paging: false,
            searching: false,
            order: [1, 'asc'],
        });
    });

    $('table[id="mainwfptableconsolidated"]').on('click', 'button[id="peak_id"]', function (event) {
        $('#peek_mainppmptable').DataTable().clear().destroy();
        $('#disp-ppmp').text('No PPMP Associated with this WFP');
        var value = $(this).attr('data-id');
        PeekPPMP = $('#peek_mainppmptable').DataTable({
            "scrollX": true,
            "scrollY": true,
            "ordering": true,
            ajax: {
                url: 'http://192.168.224.68:2019/api/peek/ppmpinwfp/'+value,
                type: 'GET',

                error: function (xhr, error, code)
                {
                    data = []
                },
            },
            data: [],
            columns:[
                {data: 'ppmp_id'},
                {data: 'program_abbr'},
                {data: 'item_name'},
                {data: 'qty'},
                {data: 'unit'},
                {data: 'abc'},
                {data: 'estimated_budget'},
                {data: 'parent_type_abbr'},
                {data: 'mode'},
                {data: 'ppmp_comment'},
                {data: 'ppmp_status'},
            ],

            rowCallback: function (row, data){
                $('#disp-ppmp').text(data.activities);
                $('#ppmp-number').text(data.activities);
            },
            filter: false,
            info: false,
            ordering: false,
            processing: true,
            retrieve: true,
            paging: false,
            searching: false,
            order: [1, 'asc'],
        });
    });


    $('.reload-ajax-table').on('click', function() {
        // $('#peek_mainppmptable').DataTable().clear().destroy();
        // $('#peek_mainppmptable').DataTable().fnDestroy();
        // $('#peek_mainppmptable').DataTable().clear().draw();
        // $('#peek_mainppmptable').DataTable().destroy();
        // $('#peek_mainppmptable').html('');
    });
});
