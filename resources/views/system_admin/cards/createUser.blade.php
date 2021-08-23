<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="full_name">First Name</label>
                            <div class="input-group">
                                <input class="form-control" type="text"  id="fname{{$include_id}}" name="fname" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="full_name">Middle Initial</label>
                            <div class="input-group">
                                <input class="form-control" type="text"  id="mname{{$include_id}}" name="mname" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="type">Last Name</label>
                            <input class="form-control" type="text"  id="lname{{$include_id}}" name="lname" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="type">By Name</label>
                            <input class="form-control" type="text"  id="byname{{$include_id}}" name="byname" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="type">Name Extension</label>
                            <input class="form-control" type="text"  id="nameext{{$include_id}}" name="nameext" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                {{-- <div class="form-group">
                    <label for="type">Email</label>
                    <input class="form-control" type="email"  id="email" name="email" required>
                </div> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type">Email</label>
                    <input class="form-control" type="email"  id="email{{$include_id}}" name="email" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type">Password</label>
                    <input class="form-control" type="email"  id="password{{$include_id}}" name="password" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="type">access_group</label>
                <input class="form-control" type="text"  id="access_group{{$include_id}}" name="access_group" required>
            </div>
            <div class="col-md-3">
                <label for="type">access level</label>
                <input class="form-control" type="text"  id="access_level{{$include_id}}" name="access_level" required>
            </div>
            <div class="col-md-3">
                <label for="type">Biometrics</label>
                <input class="form-control" type="text"  id="biometricID{{$include_id}}" name="biometricID" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-block mt-5" >Add System User</button>
    </div>
</div>
