@if (empty($data['HR']))
    <span class="text-danger h1">*Biometrics API is down</span>
@endif
<table id="biometrictable" class="table table-bordered table-sm table-hover">
{{-- <table id="biometrictablesdf" class="table table-bordered table-sm table-hover"> --}}
    <thead class="thead-dark">
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Badge Number</th>
            <th>Title</th>
            <th>Gender</th>
            <th>Birthday</th>
            <th>Department ID</th>
            <th>Department Name</th>
            <th>QR</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="wfptablebody">
        @if ($data['HRRegular'])
            @foreach ($data['HR'] as $key => $user)
                <tr>
                    <td>
                        {{$user['userid']}}
                    </td>
                    <td>
                        {{$user['name']}}
                    </td>
                    <td>
                        {{$user['badgenumber']}}
                    </td>
                    <td>
                        {{$user['title']}}
                    </td>
                    <td>-</td>
                    <td>
                        {{$user['birthday']}}
                    </td>
                    <td>
                        {{$user['defaultdeptid']}}
                    </td>
                    <td>
                        {{$user['deptname']}}
                    </td>
                    <td>
                        {{-- <div id="{{$user['userid']}}qrqr">my qr</div>
                        <div id="placeHoldersss">sdfsdfs</div> --}}
                        {{-- <canvas id="qr-code"></canvas> --}}
                        {{-- <canvas id="{{$user['userid']}}qr-code"></canvas> --}}
                        <input id="text{{$user['userid']}}" type="hidden" value="{{$user['userid']}}"  /><br />
                        <div class="qrcode{{$user['userid']}} qrcode"></div>
                    </td>

                    <td class="text-right align-middle">
                        <div class="btn-group btn-group-sm">
                            <form action="{{route('api.systemadmin.checkdtr')}}/{{$user['userid']}}/monthly/{{date('m', strtotime(date('Y-m')." -1 month"))}}/{{date('Y')}}" method="get" target="_blank">
                                <button type="submit" data-id="{{$user['userid']}}" class="btn btn-secondary "  data-placement="left" data-tt="tooltip" title="Check DTR Previous Month"><i class="far fa-calendar-minus"></i></button>
                            </form>
                            <form action="{{route('api.systemadmin.checkdtr')}}/{{$user['userid']}}/monthly/{{date('m')}}/{{date('Y')}}" method="get" target="_blank">
                                <button type="submit" data-id="{{$user['userid']}}" class="btn btn-primary"  data-placement="left" data-tt="tooltip" title="Check this Month DTR"><i class="far fa-calendar-alt"></i></button>
                            </form>

                            {{-- <form action="{{route('api.systemadmin.checkdtr')}}/{{$user['userid']}}/monthly/{{date('m')}}/{{date('Y')}}" method="get" target="_blank">
                                <button type="submit" data-id="{{$user['userid']}}" class="btn btn-primary"  data-placement="left" data-tt="tooltip" title="Check this Month DTR"><i class="fa fa-circle-o fa-stack-2x">2</i></button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{-- <span class="fa-stack">
    <!-- The icon that will wrap the number -->
    <span class="fa fa-square-o fa-stack-2x"></span>
    <!-- a strong element with the custom content, in this case a number -->
    <strong class="fa-stack-1x">
        1
    </strong>
</span> --}}
