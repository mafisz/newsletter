@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('list', $list) }}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    {{ $list->name }}
                </div>

                <div class="card-body">
                    <ul class="list-group">
                    @forelse ($list->members as $member)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $member->member->email }}
                            <div>
                                <div class="btn-group ml-4" role="group">
                                    <button type="button" class="btn btn-danger btn-sm delete-btn-2" data-id="{{ $member->member->id }}" data-id2="{{ $list->id }}" data-name="{{ $member->member->email }}" data-toggle="modal" data-target="#deleteListMember">{{ __('Delete') }}</button>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">{{ __('No members') }}</li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mt-md-0 mt-4">
                <div class="card-header bg-secondary text-white">{{ __('Add member') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('addListMember') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
                                <input type="hidden" name="listId" value="{{ $list->id }}">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
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

            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">{{ __('Add members from file') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('addListMembersFile') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="file" class="col-sm-4 col-form-label text-md-right">{{ __('File') }}</label>

                            <div class="col-md-8">
                                <input type="hidden" name="listId" value="{{ $list->id }}">
                                <input type="file" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" required>
                                <small class="form-text text-muted">
                                    {{ __('.txt file with comma separated emails') }}
                                </small>
                                @if ($errors->has('file'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('file') }}</strong>
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

@include('modals.deleteListMember')
@endsection