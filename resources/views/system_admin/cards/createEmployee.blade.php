<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="full_name">ID Number</label>
                    <div class="input-group">
                        <input class="form-control" type="text"  id="ID_number" name="IDNumber" required>
                    </div>
                    <small class="form-text text-muted mb-2">
                        NOTE: ID numbers will be auto generated depending on the type of employee
                    </small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type">User Type</label>
                    <select class="form-control mb-3 single-basic" id="uusertype" name="type" required="required" style="width:100%">
                        <option disabled value="" selected hidden>Please Select....</option>
                        {{-- <option value="JC">JC</option>
                        <option value="REGULAR">REGULAR</option> --}}
                        {{-- <option value="HRH">Deployed HRH</option> --}}
                        @foreach ($data['typeds'] as $key => $item)
                            <option value="{{$item['IDNumber']}}">{{$item['IDNumber']}}</option>

                        @endforeach
                        {{-- <option value="BeGH">Benguet General Hospital</option>
                        <option value="BGH">Baguio General Hospital</option>
                        <option value="BAP">Baguio PHM</option>
                        <option value="BAM">Baguio M</option>
                        <option value="STO">Santo Ninio</option>
                        <option value="BIU">Baguio Isolation Unit</option>
                        <option value="AP">Apayao</option>
                        <option value="AB">Abra</option>
                        <option value="BE">Benguet</option>
                        <option value="KA">Kalinga</option>
                        <option value="IF">Ifugao</option>
                        <option value="MPP">Mountain Province</option> --}}
                    </select>
                    <small class="form-text text-muted mb-2">
                        <span class="font-weight-bold">Next ID Numbers: </span> <br>
                        <span class="font-weight-bold">Regular: </span> {{$data['lastReg']+1}}<br>
                        <span class="font-weight-bold">Job Contractor: </span> {{$data['lastJC']+1}}
                        <input type="hidden" disabled name="regular" id="regular" value="{{$data['lastReg']+1}}">
                        <input type="hidden" disabled name="jc" id="jc" value="{{$data['lastJC']+1}}">
                    </small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="type">Division / Section</label>
            <select class="form-control mb-3 single-basic" id="type" name="type"  style="width:100%">
                <option disabled value="" selected hidden>Please Select....</option>
                    {{-- @foreach ($collection as $item)
                        <option value="JC">JC</option>
                    @endforeach --}}
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <div class="input-group">
                <input class="form-control" type="text" name="fullname" required="required">
            </div>
            <small class="form-text text-muted mb-2">
                SAMPLE: Juan H. Dela Cruz, Rodrigo Roa Duterte, Gets Mo Nadiba
            </small>
        </div>

        <div class="form-group">
            <label for="designation">Designation</label>
            <div class="input-group">
                <input class="form-control" type="text" name="designation" required="required">
            </div>
            <small class="form-text text-muted mb-2">
                SAMPLE: Administrative Assistant IV
            </small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="full_name">By Name</label>
            <div class="input-group">
                <input class="form-control" type="text" name="byname" required="required">
            </div>
            <small class="form-text text-muted mb-2">
                SAMPLE: Juan, Digong, Basic
            </small>
        </div>

        {{-- <input type="file" name="avatar" class="form-control" accept="image/x-png,image" > --}}
        <div class="form-group files color">
            <label for="avatarUpload">File Upload</label>
            {{-- <label>Upload Your File </label> --}}
            <input type="file" class="form-control" name="avatar" class="form-control" accept="image/x-png,image">
        </div>
        <small class="form-text text-muted mb-2">
            Photo Must be in PNG format and has 700x700 pixels
        </small>
        {{-- <div class="form-group">
            <label for="avatarUpload">File Upload</label>
            <div class="input-group">
                <div class="custom-file">
                    <label class="custom-file-label" for="avatarUpload">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                </div>
            </div>
        </div> --}}
    </div>
    <button type="submit" class="btn btn-primary btn-block" > Store User</button>
</div>
