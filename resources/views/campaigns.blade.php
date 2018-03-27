@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('campaigns') }}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="items">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    {{ __('All campaigns') }}
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2 search" type="search" placeholder="{{ __('Name') }}" aria-label="Search">
                    </form>
                </div>

                <div class="card-body">
                    <ul class="list-group list">
                    @forelse ($campaigns as $campaign)
                        <li class="list-group-item d-flex justify-content-between align-items-center @if(!$campaign->active) bg-warning @else bg-success text-white @endif">
                            <div>
                                <span class="name">{{ $campaign->title }}</span>
                            </div>
                            <div>
                                <span>{{ $campaign->list->name }}</span>
                            </div>
                            <div>
                                <span>{{ __('Start date') }}: {{ \Carbon\Carbon::now()->diffForHumans($campaign->send_time) }}</span>
                                {{-- <span>{{ $campaign->send_time->format('Y-m-d H:i') }}</span> --}}
                            </div>
                            <div>
                                <span>{{ __('Updated') }}: {{ \Carbon\Carbon::now()->diffForHumans($campaign->updated_at) }}</span>
                                <div class="btn-group ml-4" role="group">
                                    <a href="{{ route('campaign', $campaign->id) }}" class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $campaign->id }}" data-name="{{ $campaign->title }}" data-toggle="modal" data-target="#deleteCampaign">{{ __('Delete') }}</button>
                                </div>
                                @if(!$campaign->active)
                                    <button type="button" class="btn btn-success btn-sm status-btn" data-id="{{ $campaign->id }}" data-name="{{ $campaign->title }}" data-toggle="modal" data-target="#campaignStatus">{{ __('Activate') }}</button>
                                @else
                                    <button type="button" class="btn btn-danger btn-sm status-btn" data-id="{{ $campaign->id }}" data-name="{{ $campaign->title }}" data-toggle="modal" data-target="#campaignStatus">{{ __('Deactivate') }}</button>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">{{ __('No campaigns') }}</li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-md-0 mt-4">
                <div class="card-header bg-secondary text-white">{{ __('Add campaign') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('addCampaign') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="template" class="col-sm-4 col-form-label text-md-right">{{ __('Template') }}</label>

                            <div class="col-md-8">
                                <select id="template" name="templateId" class="form-control">
                                    <option>{{ __('Create new template') }}</option>
                                    @forelse ($templates as $template)
                                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                                    @empty
                                        <option>{{ __('No templates') }}</option>
                                    @endforelse
                                </select>
                                @if ($errors->has('templateId'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('templateId') }}</strong>
                                    </span>
                                @endif
                                <small class="form-text text-muted">
                                    <a href="{{ route('templates') }}">{{ __('Templates') }}</a>
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="list" class="col-sm-4 col-form-label text-md-right">{{ __('Mailing list') }}</label>

                            <div class="col-md-8">
                                <select id="list" name="listId" class="form-control" required>
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
                                <small class="form-text text-muted">
                                    <a href="{{ route('templates') }}">{{ __('Mailing lists') }}</a>
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label text-md-right">{{ __('Start date') }}</label>

                            <div class="col-md-4">
                                <input type="date" name="start_date" class="form-control" required>
                                
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input type="time" name="start_time" class="form-control" required>
                                
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
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

@include('modals.deleteCampaign')
@include('modals.campaignStatus')
@endsection