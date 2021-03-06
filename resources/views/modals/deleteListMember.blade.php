<div class="modal fade" tabindex="-1" role="dialog" id="deleteListMember" aria-labelledby="deleteListMember" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-danger rounded-top">
                <h5 class="modal-title">{{ __('Delete member') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('deleteListMember') }}">
                @csrf
                <div class="modal-body">
                    <p>{{ __('Are You sure to delete member') }} <strong class="text-danger delete-name"></strong> ?</p>
                    <input type="hidden" class="delete-id" name="memberId">
                    <input type="hidden" class="delete-id-2" name="listId">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>