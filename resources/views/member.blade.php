@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    {{ $member->email }}
                </div>

                <div class="card-body">
                    <ul class="list-group">
                    @forelse ($member->lists as $list)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $list->list->name }}
                            <div>
                                <span class="text-muted">{{ __('Added') }}: {{ \Carbon\Carbon::now()->diffForHumans($list->created_at) }}</span>
                                <div class="btn-group ml-4" role="group">
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $list->id }}" data-name="{{ $list->email }}" data-toggle="modal" data-target="#deleteMember">{{ __('Delete') }}</button>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">{{ __('No lists') }}</li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-md-0 mt-4">
                <div class="card-header bg-secondary text-white">{{ __('Add list') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('addListMember') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
                                <input type="hidden" name="email" value="{{ $member->email }}">
                                <select name="listId" class="form-control" required>
                                    @forelse ($lists as $list)
                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                    @empty
                                        <option>{{ __('No lists') }}</option>
                                    @endforelse
                                </select>
                                @if ($errors->has('listId'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('listId') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.deleteMember')
@endsection