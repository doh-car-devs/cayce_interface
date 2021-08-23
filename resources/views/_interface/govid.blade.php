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
        })
    </script>
    <style>
        input {
            text-align: center;
        }
    </style>
</head>
<body class="hold-transition">
    <div class="container mt-2">
        @include('_interface.includes.messages')
        <form action="{{route('HDF.submit')}}" method="POST">
        @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-3">
                        <img src="{{asset('assets/icons/DOH-Logo.png')}}" class="mx-auto d-block" alt="doh-logo">
                        </div>
                        <div class="col-sm-9">
                            <h4 class=" text-center" style="display: block; margin-top: auto; margin-bottm: auto;">Help us to keep our community safe by declaring that you have visited this establishment</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-greennn pr-3 pl-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input required type="text" name="first_name" id="first_name" class="form-control mb-2 centext input-sm" placeholder="First Name" value="
@if(isset($data['fname'])) {{$data['fname']}}@endif">
                        </div>
                        <div class="col-md-6">
                            <input required type="text" name="last_name" id="last_name" class="form-control mb-2 centext input-sm" placeholder="Last Name" value="
@if(isset($data['lname'])) {{$data['lname']}}@endif">
                        </div>
                    </div>
                    <input required type="text" name="address" id="address" class="form-control mb-2 centext input-sm" placeholder="Address" value="
@if(isset($data['address'])) {{$data['address']}}@endif">
                    <input required type="text" name="contact_no" id="contact_no" class="form-control mb-2 centext input-sm" placeholder="Contact Number" value="
@if(isset($data['contact'])) {{$data['contact']}}@endif">
                    <div class="form-check">
                        <label class="text-white">Are you currently experiencing any type of the following symptoms: sore throat, body pains, headache and fever?</label>
                        <br>
                        <label class="radio-inline" class="text-white">
                            <input type="radio" name="1"  class="text-white" value="yes">Yes
                        </label>
                        <label class="radio-inline" class="text-white">
                            <input type="radio" name="1" checked class="text-white" value="no">No
                        </label>
                    </div>
                    <hr class="mt-2 mb-2">

                    <div class="row form-check">
                        <div class="col-md-12">
                            <label class="text-white" for="fever">Have you had face-to-face contact with a probable or confirmed COVID-19 case within 1 meter and for more than 15 minutes within the last 14 days?</label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="2"  class="text-white" value="yes">Yes
                            </label>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="2" checked class="text-white" value="no">No
                            </label>
                        </div>

                    </div>

                    <hr class="mt-2 mb-2">

                    <div class="row form-check">
                        <div class="col-md-12">
                            <span></span>
                            <label class="text-white" for="fever">Have you provided direct care for patient with probable or confirmed COVID-19 case without using proper personal protective equipment for the past 14 days?</label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="3"  class="text-white" value="yes">Yes
                            </label>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="3" checked class="text-white" value="no">No
                            </label>
                        </div>
                    </div>

                    <hr class="mt-2 mb-2">

                    <div class="row form-check">
                        <div class="col-md-12">
                            <span></span>
                            <label class="text-white" for="fever">Have you travelled outside the current city/municipality where you reside?</label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="4"  class="text-white" value="yes">Yes
                            </label>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="4" checked class="text-white" value="no">No
                            </label>
                        </div>
                    </div>
                    <hr class="mt-4 mb-4">
                    {{-- <label for="temp" class="text-white text-center">TEMPERATURE <small>in °C</small></label> --}}
                    <input required type="number" name="temp" id="temp" step=".01" class="form-control centext input-lg" placeholder="TEMPERATURE in °C">
                    <hr class="mt-4 mb-2">
                    <p class="text-white font-weight-bold text-center pt-3" style="line-height:100%">I hereby authorize DOH-CAR to collect and process the data indicated herein for the purpose of contact tracing effecting control of the
                        COVID-19 transmission. I understand that my personal information is protected by RA 10173 or the Data Privacy Act of 2012 and that this form will be destroyed after 30 days from the date of accomplishment, following the National Archived of the Philippines.
                    </p>
                    <hr class="mt-4 mb-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="understood" name="understood">
                        <label class="form-check-label text-white font-weight-bold font-italic" for="exampleCheck1">I Understand that by clicking the submit button, I am agreeing the the statement above.</label>
                      </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-lg btn-block" id="submitsubmit" disabled="true" >SUBMIT</button>
            </div>
        </form>
    </div>
</body>
<script>
    $('#temp').on('blur', function() {
        var temp = $(this).val();
        console.log(temp);
    });
</script>
</html>


@section('content')

@endsection
