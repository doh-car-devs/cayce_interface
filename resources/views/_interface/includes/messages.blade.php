@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
        <span class="font-weight-bold">{{Session::get('error')}}</span>
        Please contact the <a href="#" class="alert-link text-white">Administrator</a> for more information.<a href="{{url()->previous() }}" class="font-weight-bold"> Back</a>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
    </div>
@elseif(Session::has('success'))
	<div class="alert alert-success" role="alert">
		<h4 class="alert-heading">Success!</h4>
		{{ Session::get('success') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
{{-- @elseif(Session::has('feature-new'))
	<div class="alert alert-warning" role="alert">
		<h4 class="alert-heading">Hi!</h4>
		{{Session::get('feature-new')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div> --}}
@elseif(Session::has('welcome'))
	<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
		{{Session::get('welcome')}}
		<i class="far fa-smile-beam"></i>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
@else
	<div class="hidden-sm-up"></div>
@endif
{{-- Timeout => myScripts --}}
@if(Session::has('page_alert_inventory'))
	<div class="alert alert-warning alert-dismissible fade show" role="alert" id="page-alert">
        <h4 class="alert-heading">There was a problem connecting to Inventory API. Please Inform ICT section : local 150</h4>
        {{Session::get('page_alert_inventory')}}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif

<div class="alert alert-danger" role="alert" id="port2019" style="display: none">
    <span class="font-weight-bold">{{Session::get('error')}}</span>
    YOU ARE CURRENTLY IN A DEVELOPMENT SERVER. PLEASE CLICK THE LINK BELOW.
   <a href="http://192.168.224.68:2019" class="alert-link text-white"> FMTIS PORTAL </a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
