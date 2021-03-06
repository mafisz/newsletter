@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('members') }}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="items">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    {{ __('All members') }}
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2 search" type="search" placeholder="{{ __('E-mail') }}" aria-label="Search">
                    </form>
                </div>
                
                <div class="card-body">
                    <ul class="list-group list">
                    @forelse ($members as $member)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="name">{{ $member->email }}</span>
                                <span class="badge badge-info badge-pill">{{ $member->lists->count() }}</span>
                            </div>
                            <div>
                                @if($member->active)
                                    <span class="text-success">{{ __('Active') }}</span>
                                @else
                                    <span class="text-danger">{{ __('Not active') }}</span>
                                @endif
                                |
                                <span class="text-muted">{{ __('Added') }}: {{ \Carbon\Carbon::now()->diffForHumans($member->created_at) }}</span>
                                <div class="btn-group ml-4" role="group">
                                    <a href="{{ route('member', $member->id) }}" class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $member->id }}" data-name="{{ $member->email }}" data-toggle="modal" data-target="#deleteMember">{{ __('Delete') }}</button>
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
        {{-- <div class="col-md-4">
            <div class="card mt-md-0 mt-4">
                <div class="card-header bg-secondary text-white">{{ __('Add member') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('addMember') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
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
                    <form method="POST" action="{{ route('addMembersFile') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="file" class="col-sm-4 col-form-label text-md-right">{{ __('File') }}</label>

                            <div class="col-md-8">
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
        </div> --}}
    </div>
</div>

@include('modals.deleteMember')
@endsection