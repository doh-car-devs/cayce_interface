<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('_interface.includes.head')
    <script>
        $(document).ready(function() {
            $('#understood').on('click', function() {
                if ($(this).is(":checked")) {
                    $("#submitsubmit").removeAttr("disabled");
                } else {
                    $("#submitsubmit").attr("disabled", "disabled");
                }
            })
            // var timeleft = {!!time()-strtotime($data['timenumber'])!!};
            // console.log({!!time()!!})
            // var downloadTimer = setInterval(function(){
            // timeleft--;
            // document.getElementById("countdowntimer").textContent = timeleft;
            // if(timeleft <= 0)
            //     clearInterval(downloadTimer);
            // },1000);
        })
    </script>
    <style>
        /* body {
        background-image: url("https://www.toptal.com/designers/subtlepatterns/patterns/double-bubble-dark.png");
        background-repeat: repeat;
    } */
    </style>
</head>
<body class="hold-transition"
@if ($data['sessionTemp'] >= '37.5' || $data['a'] == 'yes' || $data['b'] == 'yes' || $data['c'] == 'yes' || $data['d'] == 'yes')
style="background-color:#b4322e"
@else
style="background-color:#caf9ff"
@endif

>
    <div class="container mt-5">
        @include('_interface.includes.messages')
        <div class="card text-left">
        {{-- <div class="card-header text-left d-flex justify-content-center">
            <span class="text-center">FORM SUBMITTED 😷| {{$data['time'] ?? ''}}</span>
        </div> --}}
          <div class="card-body"
            @if ($data['sessionTemp'] >= '37.5' || $data['a'] == 'yes' || $data['b'] == 'yes' || $data['c'] == 'yes' || $data['d'] == 'yes')
                style="background-color:#ffadad"
            @else
                {{-- style="background-repeat: repeat; background-image: url('https://www.toptal.com/designers/subtlepatterns/patterns/shattered.png')"; --}}
            @endif
          >
            <div class="row">
                <div class="col"
                    style="
                    background-image: url({{asset('assets/icons/verified.png')}});
                    background-repeat:no-repeat;
                    width:200px;
                    height:200px;
                    background-size: 200px 200px;
                    background-position: center center;
                    "
                >
                </div>
            </div>
            <h1 class="d-flex justify-content-center">{{date("F j, Y" ,strtotime($data['time'] ?? ''))}}</h1>
            <table class="table table-bordered table-hoverable">
                <thead>
                    <tr>
                        <th style="text-align:center">Time of submission</th>
                        <th style="text-align:center">Registered Temp</th>
                        {{-- <th>Last Refresh</th>
                        <th>Remaining Time</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td scope="row" style="text-align:center">✅ {{date("h:i:s A" ,strtotime($data['time'] ?? ''))}}</td>
                    <td scope="row" style="text-align:center"
                        @if ($data['sessionTemp'] >= '37.5')
                            style="color:red;font-weight:bold"
                        @endif
                    >
                        {{$data['sessionTemp'] ?? ''}} °C
                    </td>
                    </tr>
                </tbody>
            </table>
            {{-- <h2>Time Submitted:</h2> --}}
            {{-- <h1 class="font-weight-bold text-success">✅ {{$data['time'] ?? ''}}</h1> --}}
            {{-- <p class="card-text">You have already filled out your Health Declaration form for today <b>{{$data['time'] ?? ''}}</b>.</p> --}}
                @if ($data['sessionTemp'] >= '37.5' || $data['a'] == 'yes' || $data['b'] == 'yes' || $data['c'] == 'yes' || $data['d'] == 'yes')
                <div class="card mt-2">
                    <div class="card-header d-flex justify-content-center m-o p-0">
                        <h1 class="font-weight-bold display-4 red">ATTENTION!</h1>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <p class="lead">
                            You have registered a temperature of <b class="red font-weight-bold">{{$data['sessionTemp']}} °C</b>.
                            <br>
                            Please approach the stationed <i class="font-weight-bold">Safety Officer</i>.
                        </p>
                    </div>
                </div>
                @if ($data['a'] == 'yes' || $data['b'] == 'yes' || $data['c'] == 'yes' || $data['d'] == 'yes')
                    <p class="lead" style="text-align:center">
                        You have selected "YES" in one or more of the qualifying questions.
                    </p>
                    <ul class="list-group">
                        <li class="list-group-item @if($data['a'] == 'yes') text-danger font-weight-bold bg-cobid @endif">Are you currently experiencing any type of the following symptoms: sore throat, body pains, headache and fever?</li>
                        <li class="list-group-item @if($data['b'] == 'yes') text-danger font-weight-bold bg-cobid @endif">Have you had face-to-face contact with a probable or confirmed COVID-19 case within 1 meter and for more than 15 minutes within the last 14 days?</li>
                        <li class="list-group-item @if($data['c'] == 'yes') text-danger font-weight-bold bg-cobid @endif">Have you provided direct care for patient with probable or confirmed COVID-19 case without using proper personal protective equipment for the past 14 days?</li>
                        <li class="list-group-item @if($data['d'] == 'yes') text-danger font-weight-bold bg-cobid @endif">Have you travelled outside the current city/municipality where you reside?</li>
                    </ul>
                    <span class="">* Text in RED are the items answered with YES.</span>
                @endif
                @endif
                @if ($data['sessionTemp'] <= '37.5')
                    <span class="font-weight-bold  d-flex justify-content-center pt-3">
                        <i> SHOW THIS PAGE WHEN ENTERING DOH-CHD-CAR PREMISES.</i>
                    </span>
                @endif
                <span class="d-flex justify-content-center">
                    <i><small> This form is valid 8 hours from time submitted</small></i>
                </span>
                </div>
            <div class="card-footer">
                <button onClick="window.location.reload();" class="btn btn-primary btn-primary btn-block">Refresh Page</button>
          </div>
        </div>
    </div>
</body>
</html>


@section('content')

@endsection
