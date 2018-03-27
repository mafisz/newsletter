@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('templates') }}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="items">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    {{ __('All templates') }}
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2 search" type="search" placeholder="{{ __('Name') }}" aria-label="Search">
                    </form>
                </div>

                <div class="card-body">
                    <ul class="list-group list">
                    @forelse ($templates as $template)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="name">{{ $template->name }}</span>
                            </div>
                            <div>
                                <span class="text-muted">{{ __('Updated') }}: {{ \Carbon\Carbon::now()->diffForHumans($template->updated_at) }}</span>
                                <div class="btn-group ml-4" role="group">
                                    <a href="{{ route('template', $template->id) }}" class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $template->id }}" data-name="{{ $template->name }}" data-toggle="modal" data-target="#deleteTemplate">{{ __('Delete') }}</button>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">{{ __('No templates') }}</li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-md-0 mt-4">
                <div class="card-header bg-secondary text-white">{{ __('Add template') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('addTemplate') }}">
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

@include('modals.deleteTemplate')
@endsection