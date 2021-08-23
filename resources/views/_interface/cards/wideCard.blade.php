<div class="card {{$include_head_color ?? 'card-primary'}}">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-table mr-2"></i>
            <span class="font-weight-bold">{{$include_title}}</span> | {{$data['year'] ?? ''}}
        </h3>
        <div class="card-tools">
            <div class="btn-group export-tools flex-wrap" id="wfptools"></div>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Expand Card">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        @include($include_content)
    </div>
    <div class="card-footer">
        @include($include_footer ?? '_interface.includes.empty')
    </div>
</div>
