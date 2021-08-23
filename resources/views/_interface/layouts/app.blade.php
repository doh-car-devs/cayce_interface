<!DOCTYPE html>
<html lang="en">

<head>
	@include('_interface.includes.head')
	@yield('cssSpecificImports')
</head>

{{-- <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> --}}
<body>
    <section class="content">
        <div class="container-fluid">
            @yield('content-header')
            @include('_interface.includes.messages')
            @yield('content')
            @include('_interface.includes.controlSidebar')
            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </section>

    <!-- REQUIRED SCRIPTS -->
    <script src="{{asset('js\app.js')}}"></script>

</body>
@include('_interface.includes.foot')
@yield('jsSpecificImports')
@yield('js')
<script>
	$(document).ready(function() {
		$("[data-tt=tooltip]").tooltip();
	});
</script>
<style>
	.hand-cursor{
		cursor: pointer;
	}
</style>
</html>
