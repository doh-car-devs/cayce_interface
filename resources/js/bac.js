const { default: Swal } = require("sweetalert2");

$(document).ready(function () {

    $('table[id="mainitemsbids"]').on('click', 'button[id="awardwinbtn"]', function () {
        var value = $(this).attr('data-id');
        var strArray = value.split("||");
        $('#awardnow').val(strArray[0]);

        $('#biddername').text(strArray[1]);
        // $('#activities2').val(strArray[1]);
        // $('#timeframe2').val(strArray[2]);
        // $('#q12').val(strArray[3]);
        // $('#q22').val(strArray[4]);
        // $('#q32').val(strArray[4]);
        // $('#q42').val(strArray[6]);
        // $('#item2').val(strArray[7]);
        // $('#cost2').val(strArray[8]);
        // $('#fundSource_id2').val(strArray[9]);
        // // $('#function_type2').val(strArray[10]);
        // $('#function_type2').val(strArray[11]);
        // $('#selected-year2').val(strArray[12]);
        // $('#deliverable_id2').val(strArray[13]);
    });

    function PeekBidderFunc(params) {
        PeekBidder = $('#peek_bidders').DataTable({
            "scrollX": true,
            "scrollY": true,
            "ordering": true,
            ajax: {
                url: 'http://192.168.224.68:2019/api/peek/bidders/',
                type: 'GET',

                error: function (xhr, error, code)
                {
                    data = []
                },
            },
            data: [],
            columns:[
                {data: 'id'},
                {data: 'bidder_name'},
                {data: 'bidder_TIN'},
                {data: 'bidder_address'},
                {data: 'bidder_status'},
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
    }

    $('#peak_bidders').on('click',function (event) {
        $('#peek_bidders').DataTable().clear().destroy();
        // $('#disp-ppmp').text('No PPMP Associated with this WFP');
        var value = $(this).attr('data-id');
        PeekBidderFunc()
    });

    $('#addBidder_form_btn').on('click', function (event) {
        $('.loader').show();
        $('.overlay').show();
        event.preventDefault();

        $.ajax({
            url: "/api/bac/bidder/store",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                b_name: $("#b_name").val(),
                b_tin: $("#b_tin").val(),
                b_address: $("#b_address").val()
            },
            success: function(response) {
                Swal.fire({
                    title: 'SUCCESS',
                    text: 'Bidder created',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
                $('#peek_bidders').DataTable().clear().destroy();
                PeekBidderFunc()
            },
            complete: function(){
                $('.loader').hide();
                $('.overlay').hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var data = JSON.parse(xhr.responseText)
                // console.log(data)
                // console.log(data.errors)
                Swal.fire({
                    title: 'ERROR! <br>'+data.message,
                    // text: data,
                    html: '<span style="color:red">'+ Object.values(data.errors) +'</span>',
                    icon: 'error',
                    confirmButtonText: 'Try Again',
                  })
            }
        })
    });

    var mainabstractbids = $('#mainabstractbids').DataTable({
        dom: "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "ordering": true,
        "info": true,
        "responsive": true,
        "autoWidth": true,
        buttons: [
        ],
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "displayLength": 10,
        "columnDefs": [
            {
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }
        ],
        'select': {
            'style': 'multi'
         },
    });

    var mainabstractcanvas = $('#mainabstractcanvas').DataTable({
        dom: "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "ordering": true,
        "info": true,
        "responsive": true,
        "autoWidth": true,
        buttons: [
        ],
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "displayLength": 10,
        "columnDefs": [
            {
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }
        ],
        'select': {
            'style': 'multi'
         },
    });

    // Handle form submission event
   $('#frm-bidder-add').on('submit', function(e){
    e.preventDefault();
    var form = this;

    var rows_selected = mainabstractcanvas.column(0).checkboxes.selected();
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

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
      })

      swalWithBootstrapButtons.fire({
        title: 'Confirmation!',
        html: "You are about to award all CHECKED items to this bidder? <br> "+rows_selected.join(" , "),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes I\'m sure',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {

          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.'+rows_selected.join("yyy"),
            'success'
          )
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
          )
        }
      })
        // var ans = window.confirm("You will be awarding items to checked items")
        // if (ans) {
        //     var form = this;

        //     var rows_selected = table_wfp.column(1).checkboxes.selected();
        //     // Iterate over all selected checkboxes
        //     $.each(rows_selected, function(index, rowId){
        //     // Create a hidden element
        //     $(form).append(
        //         $('<input>')
        //             .attr('type', 'hidden')
        //             .attr('name', 'value-'+index)
        //             .val(rowId)
        //     );
        //     });
        //     $('#redirect_value').val(rows_selected.join("yyy"));
        //     // Output form data to a console
        //     $('#example-console-rows').text(rows_selected.join(","));
        //     $('#example-console-form').text($(form).serialize());
        // }else {
        //     e.preventDefault();
        // }
    });

    var abstract = $('#mainitemsbids').DataTable({
        "ordering": true,
        "info": true,
        "responsive": true,
        "autoWidth": true,
        buttons: [
        ],
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "displayLength": 10,
        "language": {
            "emptyTable": "There are currently no Bids for this item."
          }
    });

    // GET BIDDER LIST
    // GET BIDDER LIST
    $('#bidder1').select2({
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
            url: "http://192.168.224.68:2019/api/bac/bidderList",
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
                            id: item.id,
                            text: item.text,
                        }
                    }),
                };
            },
            cache: true
        }
    });

    $('table[id="mainabstractbids"]').on('click', 'button[id="addBidder"]', function () {
        var value = $(this).attr('data-id');
        var strArray = value.split("||");
        $('.modal-content #item_id').val(strArray[0]);
        $('#maxbid').text(numeral(strArray[1]).format('0,0.00'));
        $('#bid_amount').attr('max', strArray[1]);
    });

    $('table[id="mainabstractcanvas"]').on('click', 'button[id="addBidder"]', function () {
        var value = $(this).attr('data-id');
        var strArray = value.split("||");
        $('.modal-content #item_id').val(strArray[0]);
        $('#maxbid').text(numeral(strArray[1]).format('0,0.00'));
        $('#bid_amount').attr('max', strArray[1]);
    });

    $('table[id="mainbidderpo"]').on('click', 'button[id="edt_id"]', function () {
        var value = $(this).attr('data-id');
        $('#bidder_id').val(value);
    });
});
