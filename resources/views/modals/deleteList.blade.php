<div class="modal fade" tabindex="-1" role="dialog" id="deleteList" aria-labelledby="deleteList" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-white bg-danger rounded-top">
                <h5 class="modal-title">{{ __('Delete list without Members') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('deleteList') }}">
                @csrf
                <div class="modal-body">
                    <p>{{ __('Are You sure to delete list') }} <strong class="text-danger delete-name"></strong> ?</p>
                    <p>{{ __('All campaign connected with this list will be deleted') }}</p>
                    <input type="hidden" class="delete-id" name="listId">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>