@extends('_interface.layouts.dashboard')

@section('content')
    {{-- @include('_interface.cards.wideCard',
    ['include_title' => 'Profile', 'include_content' => '_interface.includes.empty'
    ]) --}}
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4>Password</h4>
                <p>After a successful password update, you will be redirected to the login page where you can log in with your new password.</p>
            </div>
            <div class="col-md-9">
                <form>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Old Password</label>
                      <input type="password" class="form-control" id="formGroupExampleInput" placeholder="">
                      <small id="passwordHelpBlock" class="form-text text-muted">
                        You must provide your current password in order to change it.
                      </small>

                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password">
                            <div class="input-group-addon">
                              <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                          </div>
                    </div>

                    {{-- <div class="input-group">
                        <input class="form-control" id="ppmp_estbudget_edit3" type="password" name="ppmp_estBudget" required="required">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-primary text-primary show_hide_password">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div> --}}

                    <hr>

                    <div class="form-group">
                      <label for="formGroupExampleInput2">New Password</label>
                      <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="">

                      <label for="formGroupExampleInput22" class="mt-2">Password Confirmation</label>
                      <input type="password" class="form-control" id="formGroupExampleInput22" placeholder="">
                    </div>
                    <button class="btn btn-primary float-left">Save password</button>
                    <a href="#" class="ml-2 align-middle">I forgot my password</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('jsSpecificImports')
@endsection

@section('cssSpecificImports')
@endsection

@section('js')
@endsection
