@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="items">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    {{ __('All lists') }}
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2 search" type="search" placeholder="{{ __('Name') }}" aria-label="Search">
                    </form>
                </div>

                <div class="card-body">
                    <ul class="list-group list">
                    @forelse ($lists as $list)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="name">{{ $list->name }}</span>
                                <span class="badge badge-info badge-pill">{{ $list->members->count() }}</span>
                            </div>
                            <div>
                                <span class="text-muted">{{ __('Added') }}: {{ \Carbon\Carbon::now()->diffForHumans($list->created_at) }}</span>
                                <div class="btn-group ml-4" role="group">
                                    <a href="{{ route('list', $list->id) }}" class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                    <button type="button" class="btn btn-warning btn-sm delete-btn" data-id="{{ $list->id }}" data-name="{{ $list->name }}" data-toggle="modal" data-target="#deleteList">{{ __('Delete list without Members') }}</button>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $list->id }}" data-name="{{ $list->name }}" data-toggle="modal" data-target="#deleteListFull">{{ __('Delete list with Members') }}</button>
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
                    <form method="POST" action="{{ route('addList') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
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

@include('modals.deleteList')
@include('modals.deleteListFull')
@endsection