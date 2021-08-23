$(document).ready(function () {
    // userstable
    var employeetable = $('#employeetable').DataTable({
        // "ordering": true,
        // ajax: {
        //     url: 'http://192.168.224.68:2019/api/systemadmin/getallemployee',
        //     type: 'GET'
        // },
        // columns:[
        //     {data: 'id', name: 'id'},
        //     {data: 'IDNumber', name: 'IDNumber'},
        //     {data: 'fullname', name: 'fullname'},
        //     {data: 'byname', name: 'Byname'},
        //     {data: 'designation', name: 'designation'},
        //     {data: 'avatar', name: 'avatar'}
        // ],
        "info": true,
        "responsive": true,
        "autoWidth": true,
        buttons: [
        ],
        "lengthMenu": [[4, 8, 10, 12, 16, 20, 24, 28,30, -1], [4, 8, 10, 12, 16, 20, 24, 28,30, "All"]],
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
        // "order": [[5, "asc" ]],
        "displayLength": 30,
    });

    var biometrictable = $('#biometrictable').DataTable({
        'select': {
            'style': 'multi'
         },
         'ordering': true,
         "order": [[1, "asc" ]],
    })
    var tableuserstable = $('#sysuserstable').DataTable({
        processing: true,
        // serverSide: true,
        ajax: {
            url: 'http://192.168.224.68:2019/api/systemadmin/getAllUsers',
            type: 'GET',
            error: function (xhr, error, code)
            {
                data = []
            },
            // data: function (data){
            //     if(data.result = 200){
            //         return data
            //     }else{
            //         data.yourObj = []
            //         alert('problem with users table!');
            //         return data
            //     }
            // }
        },
        columns:[
            {data: 'name', name: 'Name'},
            {data: 'designation', name: 'Designation'},
            {data: 'division_name', name: 'Division'},
            {data: 'section_name', name: 'Section'},
        ],
        ordering: true,
        "order": [[0, "asc" ]],
        'select': {
            'style': 'multi'
         },
        // buttons: [
        //     {
        //         text: 'Reload',
        //         action: function (e, dt, node, config) {
        //             dt.ajax.reload;
        //         }
        //     }
        // ],
        "lengthMenu": [[10,20,50,100, -1], [10,20,50,100, "All"]],
        "displayLength": 20,
        "drawCallback": function( settings ) {

            // $('<li><a onclick="refresh_tab()" class="fa fa-refresh"></a></li>').prependTo('div.dataTables_paginate ul.pagination');
        }
    });
    // $('<button class="btn btn-secondary" id="refresh" onclick"refresh_tab()">Refresh Table</button>').appendTo('div.dataTables_filter');

    // table = $("#my-datatable").DataTable();
    $("#refresh").on("click", function () {
        tableuserstable.ajax.reload(null, false);
    });
    // function refresh_tab(){
    //     alert('sdf')
    //     ref.ajax.reload();
    // }

            // $('#refreshtable').on('click', function(e){
            //     alert('sdfsfd')
            //     // tableuserstable.ajax.reload();
            // });

    $('#frm-empcsv').on('submit', function(e){
        var form = this;

        var rows_selected = employeetable.column(0).checkboxes.selected();
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

     /////////////////////////
     /////////////////////////
     /////////////////////////
     /////////////////////////

     $(".show_hide_password").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
