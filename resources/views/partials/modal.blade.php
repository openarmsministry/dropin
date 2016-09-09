<div class="modal fade" id="{{ $id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{{ $title }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ $content }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if (isset($formId))
                    <button type="button" class="btn btn-{{$type}}" onclick="event.preventDefault(); document.getElementById('{{ $formId }}').submit();">
                        {{ $submitText }}
                    </button>
                @else
                    <button type="button" class="btn btn-primary">{{ $submitText }}</button>
                @endif
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->