<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" data-placement="bottom" data-tt="tooltip" title="Open / Close Menu"></i><i class="fas fa-bars"></i></a>
		</li>
		{{-- <li class="nav-item d-none d-sm-inline-block">
			<a href="{{route('dashboard')}}" class="nav-link">Home</a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a class="nav-link text-danger font-weight-bold" href="{{ route('logout') }}"
			onclick="event.preventDefault();
						  document.getElementById('logout-form').submit();">
			 {{ __('Logout') }}
			</a>

			<form id=nav-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
        </li> --}}
        {{-- <li class="nav-item d-done d-sm-inline-block">
            <span class="nav-link text-white font-weight-bold" data-placement="bottom" data-tt="tooltip" title="You were last logged in at...">
                {{session('lastActivity')}}
            </span>
        </li> --}}
	</ul>

	<!-- SEARCH FORM -->
	{{-- <form class="form-inline ml-3">
		<div class="input-group input-group-sm">
			<input class="form-control form-control-navbar" type="search" placeholder="Search"
				aria-label="Search">
			<div class="input-group-append">
				<button class="btn btn-navbar" type="submit">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>
	</form> --}}

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
        {{-- @include('_interface.includes.notification') --}}

		<!-- My Account Dropdown Menu -->
		{{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-sliders-h"></i>
            </a>
		</li> --}}

		<li class="nav-item dropdown dropdown-hover">
			<a class="nav-link nav-link font-weight-bold text-white" data-toggle="dropdown" href="#">
                Account
                <i class="fas fa-cog text-white ml-2"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right responsive-dropdown m-0 p-0">
			    <div class="card-widget widget-user-2 d-none d-md-block d-xl-block">
			        <div class="widget-user-header u-tableLight2">
			            <div class="widget-user-image ">
			                <small class=" m-0 p-0 indigo">{{session('division.division_abbr')}} - </small>
			                <small class=" m-0 p-0 indigo">{{session('section.section_abbr')}}</small>
			                <img class="img-circle elevation-2 mr-3" src="{{asset('assets/icons/ICT-Logo.png')}}" alt="User Avatar">
			            </div>
			            <span class="d-block m-0 p-0 h4">
			                {{auth()->user()->prefix.' '.auth()->user()->name_family.', '.auth()->user()->name .' '. auth()->user()->name_middle}}
			            </span>
			            <small class="text-muted m-0 p-0 h6">{{auth()->user()->designation}}</small><br>
			        </div>
                    <div class="card-body text-dark m-0 p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="list-group list-group-flush">
                                    <a href="{{route('userprofile.show',1)}}" class="dropdown-item list-group-item list-group-item-action">
                                        <i class="fas fa-user-circle mr-2"></i> My Profile
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="list-group list-group-flush">
                                    <a href="{{route('user.settings',1)}}" class="dropdown-item list-group-item list-group-item-actio">
                                        <i class="fas fa-user-cog mr-2"></i> Settings
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-danger p-2 btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
			    </div>
                <div class="card-widget widget-user-2 d-sm-block  d-xs-block d-md-none d-xl-none">
			       <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{route('userprofile.show',1)}}" class="dropdown-item list-group-item list-group-item-action">
                                <i class="fas fa-user-circle mr-2"></i> My Profile
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('user.settings',1)}}" class="dropdown-item list-group-item list-group-item-actio">
                                <i class="fas fa-user-cog mr-2"></i> Settings
                            </a>
                        </li>
                    </ul>
                   </div>
                   <div class="card-footer">
                        <a class="btn btn-danger p-2 btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                        <form id="logout-form-smol" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                   </div>
			    </div>
			</div>
		</li>

		{{-- <li class="nav-item dropdown dropdown-hover">
			<a class="nav-link nav-link" data-toggle="dropdown" href="#">
                <i class="fab fa-pied-piper-square text-white mr-2"></i>
                My Account
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="width: 1000px">
				<span class="dropdown-item dropdown-header bg-white color-palette disabled" disabled="disabled">Account</span>
				<a href="{{route('userprofile.show',1)}}" class="dropdown-item">
					<i class="fas fa-user-circle mr-2"></i> My Profile
				</a>
				<span class="dropdown-item dropdown-header bg-white color-palette disabled" disabled="disabled">Settings</span>
				<a href="{{route('user.settings',1)}}" class="dropdown-item">
					<i class="fas fa-user-cog mr-2"></i> Settings
				</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="fas fa-sign-out-alt mr-2"></i> Logout
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
			    </form>
			</div>
		</li> --}}
	</ul>
</nav>
