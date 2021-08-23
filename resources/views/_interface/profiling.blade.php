<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('_interface.includes.head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script>
        $(document).ready(function() {
            $('.understood').on('click', function() {
                if ($(this).is(":checked")) {
                    $("#submitsubmit").removeAttr("disabled");
                } else {
                    $("#submitsubmit").attr("disabled", "disabled");
                }
            })

            $('.csex').on('change', function(){
                // console.log($(this).val())
                if($(this).val() == 'Male'){
                    $('.iffemale').hide()
                }
                if($(this).val() == 'Female'){
                    $('.iffemale').show()
                }
            });

            $('.employed').on('change', function(){
                // console.log($(this).val())
                if($(this).val() == 'no'){
                    $('.employyy').hide()
                }
                if($(this).val() == 'yes'){
                    $('.employyy').show()
                }
            });
            $('.histocovid').on('change', function(){
                // console.log($(this).val())
                if($(this).val() == 'no'){
                    $('.covidshow').hide()
                }
                if($(this).val() == 'yes'){
                    $('.covidshow').show()
                }
            });

            $('.allergy').on('change', function(){
                // console.log($(this).val())
                if($(this).val() == 'no'){
                    $('.alergg').hide()
                }
                if($(this).val() == 'yes'){
                    $('.alergg').show()
                }
            });
        })
    </script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="hold-transition">
    <div class="container-fluid mt-5">
        @include('_interface.includes.messages')
        <form action="{{route('profiling-store')}}" method="POST">
        @csrf
            <input type="hidden"  id="spa" name="spa" value="{{auth()->user()->id}}">
            <div class="card">
                <div class="card-header">
                    <h4 class=" text-center">ONLINE COVID-19 VACCINE PROFILING</h4>
                </div>
                <div class="card-body pr-5 pl-5" style="background-color:#c4c4c4">
                    <div class="row border rounded p-2 border-dark">
                        <p class="lead ">Suffix | First Name | Middle Name | Last Name</p>

                        <div class="col-md-4">
                            <input required type="text" name="first_name" id="first_name" class="form-control mb-2" placeholder="First Name">
                        </div>
                        <div class="col-md-3">
                            <input required type="text" name="middle_name" id="middle_name" class="form-control mb-2" placeholder="Middle Name">
                        </div>
                        <div class="col-md-3">
                            <input required type="text" name="last_name" id="last_name" class="form-control mb-2" placeholder="Last Name">
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" id="suffix" name="suffix" required>
                                <option value="NOT APPLICABLE" selected>Suffix</option>
                                <option value="JR">JR.</option>
                                <option value="SR">SR.</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                            </select>
                        </div>
                    </div>
        {{-- <hr class="mb-4"> --}}
                    <div class="pt-3"></div>
                    <div class="row border rounded p-2 border-dark">
                        <p class="lead ">Philhealth number | PWD Number</p>
                        <div class="col-md-6">
                            <input type="text" name="ph_number" id="ph_number" class="form-control mb-2" placeholder="Philhealth Number">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="pwd_number" id="pwd_number" class="form-control mb-2" placeholder="PWD Number">
                        </div>
                    </div>
        {{-- <hr class="mb-4"> --}}
        <div class="pt-3"></div>
            <div class="row border rounded p-2 border-dark">
                <p class="lead ">House No. Streee Purok | Barangay | Municipality | Province</p>
                <div class="col-md-3">
                    <input required type="text" name="Address_1" id="Address_1" class="form-control mb-2" placeholder="House No./Street/Purok">
                </div>
                <div class="col-md-3">
                    <input required type="text" name="Barangay" id="Barangay" class="form-control mb-2" placeholder="Barangay">
                </div>
                <div class="col-md-3">
                    <input required type="text" name="Municipality" id="Municipality" class="form-control mb-2" placeholder="Municipality">
                </div>
                <div class="col-md-3">
                    <input required type="text" name="Province" id="Province" class="form-control mb-2" placeholder="Province">
                </div>
            </div>
        {{-- <hr class="mb-4"> --}}
        <div class="pt-3"></div>
            <div class="row border rounded p-2 border-dark">
                <p class="lead ">Contact Number | Civil Status | Birthday | Age</p>
                {{-- <p class="lead ">Contact Number | Civil Status | Birthday | Age</p> --}}
                <div class="col-md-3">
                    {{-- <label>Contact Number</label> --}}
                    <input required type="text" name="contact_number" id="contact_number" class="form-control mb-2" placeholder="Contact Number">
                </div>
                <div class="col-md-5">
                    {{-- <label class="">Civil Status</label> --}}
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="radio-inline" class="text-white">
                                <input type="radio" class="civil" name="civil" checked class="text-white" value="single">single
                            </label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" class="civil" name="civil"  class="text-white" value="widow/er">widow/er
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="radio-inline" class="text-white">
                                <input type="radio" class="civil" name="civil"  class="text-white" value="married">married
                            </label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" class="civil" name="civil"  class="text-white" value="annulled">annulled
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="radio-inline" class="text-white">
                                <input type="radio" class="civil" name="civil"  class="text-white" value="separated">separated
                            </label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" class="civil" name="civil"  class="text-white" value="co-habitation">co-habitation
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    {{-- <label>Birthday</label> --}}
                    <input  type="date" name="birthday" class="form-control mb-2"/>
                </div>
                <div class="col-md-2">
                    {{-- <label>Age</label> --}}
                    <input required type="text" name="age" id="age" class="form-control mb-2" placeholder="Age">
                </div>
            </div>
        <div class="pt-3"></div>
        {{-- <hr class="mb-4"> --}}
            <div class="row border rounded p-2 border-dark">
                <div class="col-md-2">
                    <label class="">Currently Employed?</label>
                    <br>
                    <label class="radio-inline" class="text-white">
                        <input type="radio" class="employed" name="employed"  class="text-white" value="yes">Yes
                    </label>
                    <label class="radio-inline" class="text-white">
                        <input type="radio" class="employed" name="employed" checked class="text-white" value="no">No
                    </label>
                </div>
                <div class="col-md-10 employyy" style="display:none">
                    <div class="row">
                        <p class="lead ">Profession | Name Of Emmployer | Employer Address | Employer Contact</p>
                        <div class="col-md-3">
                            <input  type="text" name="profession" id="profession" class="form-control mb-2" placeholder="Profession">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="employer" id="employer" class="form-control mb-2" placeholder="Name Of Employer">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="emp_address" id="emp_address" class="form-control mb-2" placeholder="Employee Address">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="emp_number" id="emp_number" class="form-control mb-2" placeholder="Employee Contact Number">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-3"></div>
            {{-- <hr class="mb-4"> --}}
                    <div class="row border rounded p-2 border-dark">
                        <div class="col-md-2">
                            <label class="">Sex</label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" class="csex" name="sex" checked class="text-white" value="Male">Male
                            </label>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" class="csex" name="sex" class="text-white" value="Female">Female
                            </label>
                        </div>
                        <div class="col-md-3 iffemale" style="display:none">
                            <label class="">Breastfeeding / Pregnant</label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="pregnant"  class="text-white" value="yes">Yes
                            </label>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="pregnant" checked class="text-white" value="no">No
                            </label>
                        </div>
                    </div>
            <div class="pt-3"></div>
            {{-- <hr class="mb-4"> --}}
                    <div class="row border rounded p-2 border-dark">
                        <div class="col-md-2">
                            <label class="">With Allergy?</label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="allergy"   class="text-white allergy" value="yes">Yes
                            </label>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="allergy"checked class="text-white allergy" value="no">No
                            </label>
                        </div>
                        <div class="col-md-5 alergg" style="display: none">
                            <p class="lead ">Type of allergy</p>
                            <input type="text" name="alergy_type" id="alergy_type" class="form-control mb-2" placeholder="Type of Allergy">
                        </div>
                        {{-- <div class="col-md-5 alergg" style="display: none">
                            <div class="custom-control custom-checkbox">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="customCheck1" value="yes">
                                            <label class="custom-control-label" for="customCheck1">TB</label>
                                            <br>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2" name="customCheck2" value="yes">
                                            <label class="custom-control-label" for="customCheck2">HIV</label>
                                            <br>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="custom-control-input" id="customCheck3" name="customCheck3" value="yes">
                                            <label class="custom-control-label" for="customCheck3">HCV</label>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="customCheck4" value="yes">
                                            <label class="custom-control-label" for="customCheck4">HBV</label>
                                            <br>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="custom-control-input" id="customCheck5" name="customCheck5" value="yes">
                                            <label class="custom-control-label" for="customCheck5">CA</label>
                                            <br>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="custom-control-input" id="customCheck6">
                                            <label class="custom-control-label" for="customCheck6">On Chemotherapy</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
            <div class="pt-3"></div>
            {{-- <hr class="mb-4"> --}}
                    <div class="row border rounded p-2 border-dark">
                        <div class="col-md-3">
                            <label class="">History of COVID-19 Infection</label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" class="histocovid" name="goviddd"  class="text-white" value="yes">Yes
                            </label>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" class="histocovid" name="goviddd" checked class="text-white" value="no">No
                            </label>
                        </div>
                        <div class="col-md-5 covidshow" style="display: none">
                            <label class="">Date Of Infection</label>
                            <input  type="date" name="infection_date" class="form-control mb-2"/>
                            {{-- <input type="text" name="infection_date" id="infection_date" class="form-control mb-2" placeholder="Date of Infection"> --}}
                        </div>
                        <div class="col-md-4 covidshow" style="display: none">
                            <label class="">Classification of Infection</label>
                            <br>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="infection_classification"  class="text-white" value="Asymptomatic">Asymptomatic
                            </label>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="infection_classification"  class="text-white" value="Mild">Mild
                            </label>
                            <label class="radio-inline" class="text-white">
                                <input type="radio" name="infection_classification"  class="text-white" value="Severe">Severe
                            </label>
                        </div>
                    </div>
                    {{-- <div class="row covidshow" >

                    </div> --}}
                    <hr class="mt-4 mb-2">

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input understood" id="understood" name="understood">
                        <label class="form-check-label font-weight-bold understood" for="exampleCheck1">I do hereby declare that all the informatin given above is true to the best of my knowledge and belief</label>
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
