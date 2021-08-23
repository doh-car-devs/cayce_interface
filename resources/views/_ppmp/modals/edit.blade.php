<div class="modal fade bd-example-modal-xl" id="ppmpmodal" tabindex="-1" role="dialog" aria-labelledby="ppmpmodal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form action="{{route('api.ppmp.update')}}" method="post">
                @csrf
                @include('_ppmp.cards.edit')
            </form>
        </div>
    </div>
</div>
