@extends('_interface.layouts.dashboard')

@section('content')
    <div class="card {{$include_head_color ?? 'card-primary'}}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-table mr-2"></i>
                <span class="font-weight-bold">Entries with alarm for the last 28 Days
                <span class="font-weight-bold">
            </h3>
            <div class="card-tools">
                <div class="btn-group export-tools flex-wrap" id="wfptools"></div>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="hltdeckalerm" class="table table-bordered table-sm table-hover"width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Temp</th>
                        <th data-placement="top" data-tt="tooltip" title="Are you currently experiencing any type of the following symptoms: sore throat, body pains, headache and fever?" class="small" >experiencing symptoms</th>
                        <th data-placement="top" data-tt="tooltip" title="Have you had face-to-face contact with a probable or confirmed COVID-19 case within 1 meter and for more than 15 minutes within the last 14 days?" class="small" >face-to-face contact...</th>
                        <th data-placement="top" data-tt="tooltip" title="Have you had face-to-face contact with a probable or confirmed COVID-19 case within 1 meter and for more than 15 minutes within the last 14 days?" class="small" >provided direct care...</th>
                        <th data-placement="top" data-tt="tooltip" title="Have you travelled outside the current city/municipality where you reside?" class="small" >Have you travelled outside...</th>
                        <th>Time</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="card {{$include_head_color ?? 'card-primary'}}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-table mr-2"></i>
                <span class="font-weight-bold">All Entries for the last 28 Days
                <span class="font-weight-bold">
            </h3>
            <div class="card-tools">
                <div class="btn-group export-tools flex-wrap" id="wfptools"></div>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="hltdeck" class="table table-bordered table-sm table-hover"width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Temp</th>
                        <th data-placement="top" data-tt="tooltip" title="Are you currently experiencing any type of the following symptoms: sore throat, body pains, headache and fever?" class="small" >experiencing symptoms</th>
                        <th data-placement="top" data-tt="tooltip" title="Have you had face-to-face contact with a probable or confirmed COVID-19 case within 1 meter and for more than 15 minutes within the last 14 days?" class="small" >face-to-face contact...</th>
                        <th data-placement="top" data-tt="tooltip" title="Have you had face-to-face contact with a probable or confirmed COVID-19 case within 1 meter and for more than 15 minutes within the last 14 days?" class="small" >provided direct care...</th>
                        <th data-placement="top" data-tt="tooltip" title="Have you travelled outside the current city/municipality where you reside?" class="small" >Have you travelled outside...</th>
                        <th>Time</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('jsSpecificImports')
<script>
    $(document).ready(function() {
        hdfgroup = 1;
        generatePR2sdf = $('#hltdeck').DataTable({
            "dom": "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "scrollX": true,
            "scrollY": true,
            "ordering": true,
            ajax: {
                url: 'http://192.168.224.68:2019/results/health-declaration-results',
                type: 'GET',
                async: 'true',

                error: function (xhr, error, code)
                {
                    data = []
                },
            },
            data: [],
            columns:[
                {data: 'id'},
                {data: 'second_name'},
                {data: 'address'},
                {data: 'contact_number'},
                {data: 'temp'},
                {data: '1'},
                {data: '2'},
                {data: '3'},
                {data: '4'},
                {data: 'time'},
            ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                console.log(aData['1'])
                if ( aData['1'] == "yes" || aData['2'] == "yes" || aData['3'] == "yes" || aData['4'] == "yes")
                {
                    $('td', nRow).css('background-color', 'yellow');
                }else if(aData['temp'] >= 37.5){
                    $('td', nRow).css('background-color', 'red');
                }
            },
            filter: false,
            info: false,
            ordering: true,
            processing: true,
            retrieve: true,
            paging: true,
            searching: true,
            order: [9, 'desc'],
            language: {
                "processing": "Loading Health Declaration Results"
            },
        });
        hdfwalarm = $('#hltdeckalerm').DataTable({
            "dom": "<'row'<'col-sm-2'l><'col-sm-5'p><'col-sm-5'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "scrollX": true,
            "scrollY": true,
            "ordering": true,
            ajax: {
                url: 'http://192.168.224.68:2019/results/health-declaration-results-alarm',
                type: 'GET',
                async: 'true',

                error: function (xhr, error, code)
                {
                    data = []
                },
            },
            data: [],
            columns:[
                {data: 'id'},
                {data: 'second_name'},
                {data: 'address'},
                {data: 'contact_number'},
                {data: 'temp'},
                {data: '1'},
                {data: '2'},
                {data: '3'},
                {data: '4'},
                {data: 'time'},
            ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                console.log(aData['1'])
                if ( aData['1'] == "yes" || aData['2'] == "yes" || aData['3'] == "yes" || aData['4'] == "yes")
                {
                    $('td', nRow).css('background-color', 'yellow');
                }else if(aData['temp'] >= 37.5){
                    $('td', nRow).css('background-color', 'red');
                }
            },
            filter: false,
            info: false,
            ordering: true,
            processing: true,
            retrieve: true,
            paging: true,
            searching: true,
            order: [9, 'desc'],
            language: {
                "processing": "Loading Health Declaration Results"
            },
        });
    });
</script>
@endsection

@section('cssSpecificImports')
@endsection


<!-- page script -->
@section('js')
<script>
</script>
@endsection
