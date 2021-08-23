<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-between mr-1 ml-1">
            <div class="col-xs-6">
                @if (isset($data['year']))
                    <form action="{{route('api.wfp.sort')}}" method="post">
                        @csrf
                        <select class="form-control mb-1" id="selected-yeara" name="year" onchange="this.form.submit()" data-placement="bottom" data-tt="tooltip" title="Select Year" style="width:100%">
                            <option selected disabled>Data For Year - {{$data['year']}}</option>
                            @for ($i = 2015; $i < now()->year+4; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </form>
                @else

                @endif
            </div>
            <div class="col-xs-6">
                <li class="nav-item btn-group float-sm-right">
                    <a class="btn btn-flat btn-outline-secondary hBack" data-placement="bottom" data-tt="tooltip" title="Click to go backwards"><i class="fas fa-arrow-left"></i></a>
                    <a class="btn btn-flat btn-outline-secondary hForward" data-placement="bottom" data-tt="tooltip" title="Click to go forward"><i class="fas fa-arrow-right"></i></a>
				</li>
            </div>
        </div>
    </div>
</div>
