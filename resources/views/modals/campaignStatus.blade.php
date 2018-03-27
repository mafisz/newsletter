<div class="modal fade" tabindex="-1" role="dialog" id="campaignStatus" aria-labelledby="campaignStatus" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-danger rounded-top">
                <h5 class="modal-title">{{ __('Campaign status') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('campaignStatus') }}">
                @csrf
                <div class="modal-body">
                    <p>{{ __('Change campaign status') }} <strong class="text-danger status-name"></strong> ?</p>
                    <input type="hidden" class="status-id" name="campaignId">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">{{ __('Change') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>