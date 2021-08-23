@extends('_interface.layouts.app')
@section('content')
<section class="content">
    <div class="error-page">
      <h2 class="headline text-danger">500</h2>

      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>

        <p>
          We will work on fixing that right away.
          Meanwhile, you may continue by clicking <a  href="{{ route('logmeout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a> <br>or contact ICT Section Local 150.
        </p>
        <a class="btn btn-block btn " href="{{ route('logmeout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logmeout') }}" method="GET" style="display: none;">
            @csrf
        </form>

        {{-- <form class="search-form">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-search"></i>
              </button>
            </div>
          </div>
          <!-- /.input-group -->
        </form> --}}
      </div>
    </div>
    <!-- /.error-page -->

  </section>
  @endsection
