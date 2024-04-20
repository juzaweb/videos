<div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.videos.import') }}" method="post" class="form-ajax">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="import-modal-label">{{ __('Import Video') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Field::text(__('Source URL'), 'source_url', ['required' => true, 'id' => 'source_url']) }}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Import') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>