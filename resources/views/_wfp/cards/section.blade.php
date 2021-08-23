<div class="card card-success">
    <div class="card-header hand-cursor" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
        <h3 class="card-title">
            <i class="fas fa-plus-square mr-2"></i>
            Section Select
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Toggle Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ($data['section'] as $item)
            <div class="col-md-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$item['section_abbr']}}</h3>
                        <p>{{$item['section_name']}}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book-medical"></i>
                    </div>
                    <form action="{{route('wfp.manage.division')}}" method="get">
                        <input name="selecteddivision" type="hidden" value="{{$item['division_id']}}">
                        <input name="selectedsection" type="hidden" value="{{$item['id']}}">
                        @csrf
                        <div class="form-group">
                            <select class="form-control " name="program_select" id="program_select" onchange="this.form.submit()">
                                <option disabled value="" selected hidden>Select Program...</option>
                                {{-- <optgroup label="Select {{$item['section_abbr']}}"><option value="1">All Programs for | {{$item['section_name']}}</option></optgroup> --}}
                                <optgroup label="All Programs">
                                @foreach ($data['program'] as $i)
                                    @if ($i['sec_id']  == $item['id'])
                                        <option value="{{$i['id']}}">{{$i['program']}} - {{$i['description']}}</option>
                                    @endif
                                @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>