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
                    <a class="btn btn-primary mb-1 active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true"><i class="fas fa-table mr-1"></i>Employees</a>
                    <a class="btn btn-primary mb-1 " id="employee-tab" data-toggle="pill" href="#employee" role="tab" aria-controls="employee" aria-selected="false"><i class="fas fa-table mr-1"></i>System Users</a>
                    <a class="btn btn-primary mb-1 " id="hr-tab" data-toggle="pill" href="#hr" role="tab" aria-controls="hr" aria-selected="true"><i class="fas fa-table mr-1"></i>Biometrics API</a>
                </li>
                <li class="nav-item btn-group ml-auto">
                    <a class="btn btn-success mb-1 " id="criat-user-tab" data-toggle="pill" href="#criat-user" role="tab" aria-controls="criat-user" aria-selected="false"><i class="fas fa-plus-square mr-1"></i> Add New User</a>
                    <a class="btn btn-success mb-1 " id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false"><i class="fas fa-plus-square mr-1"></i>Add New Employee</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
        </div>
        <div class="tab-pane fade" id="employee" role="tabpanel" aria-labelledby="employee-tab">
            {{-- @include('_interface.cards.wideCard',
            ['include_title' => 'DOH-CAR EMPLOYEE List','include_content' => 'system_admin.tables.employees',
            ]) --}}
            @include('_interface.cards.wideCard',
            ['include_title' => 'System User List','include_content' => 'system_admin.tables.users',
            ])
        </div>
        <div class="tab-pane fade" id="hr" role="tabpanel" aria-labelledby="hr-tab">
            @include('_interface.cards.wideCard',
            ['include_title' => 'Biometrics','include_content' => 'system_admin.tables.biometrics',
            ])
        </div>
        <div class="tab-pane fade pt-3 pb-5" id="custom-content-above-messages" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">
            <form action="{{route('api.systemadmin.store.employee')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('_interface.cards.widecard',
                ['include_title' => 'Add new Employee','include_content' => 'system_admin.cards.createEmployee',
                ])
            </form>
        </div>
        <div class="tab-pane fade pt-3 pb-5" id="criat-user" role="tabpanel" aria-labelledby="criat-user-tab">
            @include('_interface.cards.widecard',
            ['include_title' => 'Add new User','include_content' => 'system_admin.cards.createUser','include_id' => '70'
            ])
        </div>
    </div>

    @include('_interface.cards.wideCard',
    ['include_title' => 'DOH-CAR EMPLOYEE List','include_content' => 'system_admin.tables.employees',
    ])

    {{-- modals --}}
	<form action="{{route('api.wfp.deliverable.store')}}" method="POST">
		@csrf
		@include('_interface.modals.edit',
			['include_content' => 'system_admin.cards.createUser',
			'include_id' => '69'
			])
    </form>

@endsection

@section('jsSpecificImports')
@endsection

@section('cssSpecificImports')
@livewireStyles
<link rel="stylesheet" href="https://deo8mru8cr8lj.cloudfront.net/be670015-0e71-4dca-8785-c28ecea8d203/css/app.css?id=f0e7cc70116e39bc73c8">
<link rel="stylesheet" href="https://deo8mru8cr8lj.cloudfront.net/be670015-0e71-4dca-8785-c28ecea8d203/css/prism.css">
@endsection


<!-- page script -->
@section('js')
@livewireScripts
<script>

    $(document).ready(function() {
        var dataSet = {!!json_encode($data['employees']) !!};

        var columnDefs = [{
            'data': "IDNumber",
            title: "IDNumber",
            type: "readonly"
        }, {
            title: "avatar",
            'data': "avatar",
            type: "text"
        }, {
            title: "byname",
            'data': "byname",
            type: "text"
        }, {
            title: "designation",
            'data': "designation",
            type: "designation"
        }, {
            title: "fullname",
            'data': "fullname",
            type: "fullname"
        }, {
            title: "division_id",
            'data': "division_id",
            type: "division_id"
        }, {
            title: "section_id",
            'data': "section_id",
            type: "section_id"
        }];

        var myTable;

        myTable = $('#example').DataTable({
            // "ajax": 'http://192.168.224.64:8000/regularss',

            "sPaginationType": "full_numbers",
            data: dataSet,
            columns: columnDefs,
            dom: 'Bfrtip', // Needs button container
            select: 'multi',
            responsive: true,
            altEditor: true, // Enable altEditor
            buttons:[]
            // buttons: [{
            //         text: 'Add',
            //         name: 'add', // do not change name
            //     },
            //     {
            //         extend: 'selected', // Bind to Selected row
            //         text: 'Edit',
            //         name: 'edit' // do not change name
            //     },
            //     {
            //         text: 'Reload',
            //         action: function ( e, dt, node, config ) {
            //             alert('sdfsd')
            //         }
            //     }
            //     {
            //         extend: 'selected', // Bind to Selected row
            //         text: 'Delete',
            //         name: 'delete' // do not change name
            //     }
            // ]
        });

        var employees = {!!json_encode($data['HR'])!!}
        function makeCode (myid) {
            var elText = myid;
            // qrcode.makeCode("http://192.168.224.68:2019/HDF/qrScan/"+elText);
            qrcode.makeCode(elText);
        }

        var full = 'qrcode'
        for (let i = 0; i < employees.length; i++) {
            full = "qrcode"+employees[i].userid;
            full = toString(full);
            // console.log($('#qrcode').attr('data-id'+employees[i].userid)[0])
            var qrcode = new QRCode($('.qrcode'+employees[i].userid)[0], {
            // var qrcode = new QRCode(myTable.$('.qrcode'+employees[i].userid), {
            // var qrcode = new QRCode($('#qrcode').attr('data-id'+employees[i].userid)[0], {
                width : 100,
                height : 100,
                correctLevel: QRCode.CorrectLevel.H,
                colorDark: "#36964b",
                colorLight: "#ffffff",
            });
            makeCode(employees[i].userid);
        }

    });

    $(document).ready(function () {
        // on select of item
        function pad(n, width, z) {
            z = z || '0';
            n = n + '';
            return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
        }
        $("#uusertype").on("change", function () {
            selecteduser = $("#uusertype").val();
            var number = selecteduser.match(/\d*$/)
            // number = pad(number, 3)
            // alert()
            // alert(selecteduser.substr(0, number.index) + (++number[0]))
            var number2 = selecteduser.substr(0, number.index) + (++number[0]);
            $('#ID_number').val(number2)
            // if (selecteduser == 'JC') {
            //     $('#ID_number').val('JC-DOHCAR-'+$('#jc').val());
            // }
            // if (selecteduser == 'REGULAR') {
            //     $('#ID_number').val('DOHCAR-'+$('#regular').val());
            // }

            // var IDs = {!!json_encode($data['typeds'])!!}
            // // console.log(IDs)
            // // if (selecteduser == 'HRH') {
            // //     $('#ID_number').val(2);
            // // }
            // IDs.forEach(element => {
            //    console.log(element)
            //     if (selecteduser == 'element') {
            //         $('#ID_number').val('DOHCAR-'+$('#regular').val());
            //     }
            // });
            // if (selecteduser == 'HRH') {
            //     $('#ID_number').val(2);
            // }
        });
    });
</script>
@endsection
