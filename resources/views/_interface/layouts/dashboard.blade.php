<!DOCTYPE html>
<html lang="en">

<head>
	@include('_interface.includes.head')
	@yield('cssSpecificImports')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper container-fluid" id="app">
        <!-- Navbar -->
		@include('_interface.includes.nav')

        <!-- Main Sidebar Container -->
		@include('_interface.includes.sidebar')
        <!-- REQUIRED SCRIPTS -->
        <script src="{{ asset('js\app.js') }}"></script>

        <!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			@include('_interface.includes.header')

			<!-- Main content -->

			<section class="content">
				<div class="container-fluid">
                    @include('_interface.snip.loader')

					@yield('content-header')
					@include('_interface.includes.messages')
					@yield('content')
					@include('_interface.includes.controlSidebar')
				</div>
			</section>
		</div>

        <!-- Control Sidebar -->
		@include('_interface.includes.sidebarRight')

        <!-- Main Footer -->
		@include('_interface.includes.footer')
    </div>
</body>
@include('_interface.includes.foot')
@yield('jsSpecificImports')
@yield('js')
<script>
	// $(document).ready(function() {
    //     $("[data-tt=tooltip]").tooltip();
    //     var sessionPort = window.location.port;
    //     if (sessionPort != 2019) {
    //         document.getElementById("port2019").style.display = "block";
    //         var ask = window.confirm("You are currently in a development mode. Click confirm to access deployment environment")
    //
    //         if (ask) {
    //             window.location.href = "http://192.168.224.68:2019";
    //         }
    //     }
	// });
</script>
<style>
	.hand-cursor{
		cursor: pointer;
	}
</style>
</html>
